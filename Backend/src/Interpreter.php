<?php
// src/Interpreter.php

require_once __DIR__ . '/Environment.php';
require_once __DIR__ . '/FlowTypes.php';
require_once __DIR__ . '/Natives.php';

class Interpreter extends GrammarBaseVisitor {

    private Environment $global;
    private array $functions = [];   // hoisting: nombre => ctx del nodo
    public  array $output    = [];   // líneas de salida para la consola
    public  array $errors    = [];   // errores semánticos
    public  array $symbols   = [];   // tabla de símbolos

    public function __construct() {
        $this->global = new Environment();
    }

    // ─────────────────────────────────────────────────────────────
    // PROGRAMA
    // ─────────────────────────────────────────────────────────────

    public function visitProgram($ctx) {
        // HOISTING: primer pasada para registrar todas las funciones
        foreach ($ctx->declaration() as $decl) {
            if ($decl->functionDecl() !== null) {
                $fn   = $decl->functionDecl();
                $name = $fn->ID()->getText();
                $this->functions[$name] = $fn;
                $this->addSymbol($name, 'función', 'global', '—',
                    $fn->ID()->getSymbol()->getLine(),
                    $fn->ID()->getSymbol()->getCharPositionInLine());
            }
        }

        // Segunda pasada: ejecutar declaraciones de variables globales
        foreach ($ctx->declaration() as $decl) {
            if ($decl->varDecl() !== null || $decl->constDecl() !== null) {
                try {
                    $this->visit($decl);
                } catch (RuntimeException $e) {
                    $this->addError('Semántico', $e->getMessage(), 0, 0);
                }
            }
        }

        // Ejecutar main()
        if (!isset($this->functions['main'])) {
            $this->addError('Semántico', 'No se encontró la función main.', 0, 0);
            return null;
        }

        try {
            $this->callFunction('main', [], $this->global);
        } catch (RuntimeException $e) {
            $this->addError('Semántico', $e->getMessage(), 0, 0);
        }

        return null;
    }

    // ─────────────────────────────────────────────────────────────
    // DECLARACIONES
    // ─────────────────────────────────────────────────────────────

    public function visitDeclaration($ctx) {
        if ($ctx->varDecl()      !== null) return $this->visit($ctx->varDecl());
        if ($ctx->constDecl()    !== null) return $this->visit($ctx->constDecl());
        if ($ctx->functionDecl() !== null) return null; // ya registrada en hoisting
        return null;
    }

    // var x int32 = 10
    // var w, z int32 = 1, 2
    public function visitVarDecl($ctx) {
        $ids   = $ctx->identifierList()->ID();
        $type  = $ctx->type()->getText();
        $exprs = $ctx->expressionList() ? $ctx->expressionList()->expression() : [];

        for ($i = 0; $i < count($ids); $i++) {
            $name  = $ids[$i]->getText();
            $line  = $ids[$i]->getSymbol()->getLine();
            $col   = $ids[$i]->getSymbol()->getCharPositionInLine();
            $value = null;

            if (count($exprs) > 0) {
                $value = $this->visit($exprs[$i]);
            } else {
                $value = $this->defaultValue($type);
            }

            try {
                $this->global->declare($name, $value, $type);
                $this->addSymbol($name, $type, 'global', $value, $line, $col);
            } catch (RuntimeException $e) {
                $this->addError('Semántico', $e->getMessage(), $line, $col);
            }
        }
        return null;
    }

    // const max int32 = 100
    public function visitConstDecl($ctx) {
        $name  = $ctx->ID()->getText();
        $type  = $ctx->type()->getText();
        $value = $this->visit($ctx->expression());
        $line  = $ctx->ID()->getSymbol()->getLine();
        $col   = $ctx->ID()->getSymbol()->getCharPositionInLine();

        try {
            $this->global->declare($name, $value, 'const:' . $type);
            $this->addSymbol($name, 'const ' . $type, 'global', $value, $line, $col);
        } catch (RuntimeException $e) {
            $this->addError('Semántico', $e->getMessage(), $line, $col);
        }
        return null;
    }

    // ─────────────────────────────────────────────────────────────
    // FUNCIONES
    // ─────────────────────────────────────────────────────────────

    private function callFunction(string $name, array $args, Environment $callerEnv): mixed {
        if (!isset($this->functions[$name])) {
            throw new RuntimeException("Función '$name' no declarada.");
        }

        $fn     = $this->functions[$name];
        $params = $fn->parameterList() ? $fn->parameterList()->parameter() : [];

        if (count($params) !== count($args)) {
            throw new RuntimeException(
                "Función '$name': se esperaban " . count($params) .
                " argumentos, se recibieron " . count($args) . "."
            );
        }

        // Nuevo entorno local con global como padre
        $localEnv = new Environment($this->global);

        foreach ($params as $i => $param) {
            $pName = $param->ID()->getText();
            $pType = $param->type()->getText();
            $localEnv->declare($pName, $args[$i], $pType);
            $this->addSymbol($pName, $pType, $name, $args[$i],
                $param->ID()->getSymbol()->getLine(),
                $param->ID()->getSymbol()->getCharPositionInLine());
        }

        $result = $this->executeBlock($fn->block(), $localEnv, $name);

        if ($result instanceof ReturnSignal) {
            return $result->value;
        }
        return null;
    }

    // ─────────────────────────────────────────────────────────────
    // BLOQUE Y SENTENCIAS
    // ─────────────────────────────────────────────────────────────

    private function executeBlock($blockCtx, Environment $env, string $scope): mixed {
        foreach ($blockCtx->statement() as $stmt) {
            $result = $this->executeStatement($stmt, $env, $scope);
            // Propagar señales de flujo
            if ($result instanceof ReturnSignal  ||
                $result instanceof BreakSignal   ||
                $result instanceof ContinueSignal) {
                return $result;
            }
        }
        return null;
    }

    private function executeStatement($stmtCtx, Environment $env, string $scope): mixed {
        // varDecl local
        if ($stmtCtx->varDecl() !== null) {
            return $this->executeVarDeclLocal($stmtCtx->varDecl(), $env, $scope);
        }
        // constDecl local
        if ($stmtCtx->constDecl() !== null) {
            return $this->executeConstDeclLocal($stmtCtx->constDecl(), $env, $scope);
        }
        // simpleStmt
        if ($stmtCtx->simpleStmt() !== null) {
            return $this->executeSimpleStmt($stmtCtx->simpleStmt(), $env, $scope);
        }
        // return
        if ($stmtCtx->returnStmt() !== null) {
            return $this->executeReturn($stmtCtx->returnStmt(), $env, $scope);
        }
        // break
        if ($stmtCtx->breakStmt() !== null) {
            return new BreakSignal();
        }
        // continue
        if ($stmtCtx->continueStmt() !== null) {
            return new ContinueSignal();
        }
        // if
        if ($stmtCtx->ifStmt() !== null) {
            return $this->executeIf($stmtCtx->ifStmt(), $env, $scope);
        }
        // switch
        if ($stmtCtx->switchStmt() !== null) {
            return $this->executeSwitch($stmtCtx->switchStmt(), $env, $scope);
        }
        // for
        if ($stmtCtx->forStmt() !== null) {
            return $this->executeFor($stmtCtx->forStmt(), $env, $scope);
        }
        // bloque anidado
        if ($stmtCtx->block() !== null) {
            $inner = new Environment($env);
            return $this->executeBlock($stmtCtx->block(), $inner, $scope);
        }
        return null;
    }

    // ─────────────────────────────────────────────────────────────
    // DECLARACIONES LOCALES
    // ─────────────────────────────────────────────────────────────

    private function executeVarDeclLocal($ctx, Environment $env, string $scope): null {
        $ids   = $ctx->identifierList()->ID();
        $type  = $ctx->type()->getText();
        $exprs = $ctx->expressionList() ? $ctx->expressionList()->expression() : [];

        for ($i = 0; $i < count($ids); $i++) {
            $name  = $ids[$i]->getText();
            $line  = $ids[$i]->getSymbol()->getLine();
            $col   = $ids[$i]->getSymbol()->getCharPositionInLine();
            $value = count($exprs) > 0
                ? $this->evalExpr($exprs[$i], $env)
                : $this->defaultValue($type);

            try {
                $env->declare($name, $value, $type);
                $this->addSymbol($name, $type, $scope, $value, $line, $col);
            } catch (RuntimeException $e) {
                $this->addError('Semántico', $e->getMessage(), $line, $col);
            }
        }
        return null;
    }

    private function executeConstDeclLocal($ctx, Environment $env, string $scope): null {
        $name  = $ctx->ID()->getText();
        $type  = $ctx->type()->getText();
        $value = $this->evalExpr($ctx->expression(), $env);
        $line  = $ctx->ID()->getSymbol()->getLine();
        $col   = $ctx->ID()->getSymbol()->getCharPositionInLine();

        try {
            $env->declare($name, $value, 'const:' . $type);
            $this->addSymbol($name, 'const ' . $type, $scope, $value, $line, $col);
        } catch (RuntimeException $e) {
            $this->addError('Semántico', $e->getMessage(), $line, $col);
        }
        return null;
    }

    // ─────────────────────────────────────────────────────────────
    // SENTENCIAS SIMPLES
    // ─────────────────────────────────────────────────────────────

    private function executeSimpleStmt($ctx, Environment $env, string $scope): null {
        // x, y := expr, expr
        if ($ctx->shortVarDecl() !== null) {
            $svd   = $ctx->shortVarDecl();
            $ids   = $svd->identifierList()->ID();
            $exprs = $svd->expressionList()->expression();

            for ($i = 0; $i < count($ids); $i++) {
                $name  = $ids[$i]->getText();
                $line  = $ids[$i]->getSymbol()->getLine();
                $col   = $ids[$i]->getSymbol()->getCharPositionInLine();
                $value = $this->evalExpr($exprs[$i], $env);
                $type  = Natives::typeOf($value);

                if ($env->existsLocal($name)) {
                    // Si ya existe en este scope, es reasignación
                    $env->assign($name, $value);
                } else {
                    $env->declare($name, $value, $type);
                    $this->addSymbol($name, $type, $scope, $value, $line, $col);
                }
            }
            return null;
        }

        // x = expr  |  x += expr  etc.
        if ($ctx->assignment() !== null) {
            $asgn  = $ctx->assignment();
            $lhsExprs = $asgn->expressionList(0)->expression();
            $rhsExprs = $asgn->expressionList(1)->expression();
            $op    = $asgn->assignOp()->getText();

            for ($i = 0; $i < count($lhsExprs); $i++) {
                $lhs   = $lhsExprs[$i];
                $rhs   = $this->evalExpr($rhsExprs[$i], $env);
                $this->executeAssignment($lhs, $op, $rhs, $env);
            }
            return null;
        }

        // i++  |  i--
        if ($ctx->incDecStmt() !== null) {
            $ids = $ctx->incDecStmt();
            $varExpr = $ids->expression();
            $op      = $ids->getChild(1)->getText(); // ++ o --
            $name    = $varExpr->getText();
            $current = $env->get($name);

            $env->assign($name, $op === '++' ? $current + 1 : $current - 1);
            return null;
        }

        // llamada a función como sentencia
        if ($ctx->expressionStmt() !== null) {
            $this->evalExpr($ctx->expressionStmt()->expression(), $env);
            return null;
        }

        return null;
    }

    private function executeAssignment($lhsCtx, string $op, mixed $rhs, Environment $env): void {
        // Acceso a arreglo: arr[i] = val
        if (method_exists($lhsCtx, 'primaryExpr') && $lhsCtx->primaryExpr() !== null) {
            // manejar arr[i][j] = val  — simplificado a texto por ahora
        }

        $name = $lhsCtx->getText();

        // Limpiar índices del nombre si los tiene (arr[0] → arr)
        if (strpos($name, '[') !== false) {
            $this->executeArrayAssignment($lhsCtx, $op, $rhs, $env);
            return;
        }

        $current = $env->get($name);

        $newVal = match($op) {
            '='  => $rhs,
            '+=' => $current + $rhs,
            '-=' => $current - $rhs,
            '*=' => $current * $rhs,
            '/=' => $rhs != 0 ? $current / $rhs : null,
            default => throw new RuntimeException("Operador de asignación desconocido: $op")
        };

        // Verificar que no sea constante
        $type = $env->getType($name);
        if (str_starts_with($type, 'const:')) {
            throw new RuntimeException("No se puede modificar la constante '$name'.");
        }

        $env->assign($name, $newVal);
    }

    private function executeArrayAssignment($lhsCtx, string $op, mixed $rhs, Environment $env): void {
        // Extraer nombre e índices del texto: arr[0][1]
        $text = $lhsCtx->getText();
        preg_match('/^([a-zA-Z_][a-zA-Z0-9_]*)(\[.+)$/', $text, $m);
        if (!$m) return;

        $name    = $m[1];
        $idxText = $m[2];
        preg_match_all('/\[([^\]]+)\]/', $idxText, $idxMatches);
        $indices = $idxMatches[1];

        $arr = $env->get($name);

        if (count($indices) === 1) {
            $i = (int)$this->evalExprFromText($indices[0], $env);
            $arr[$i] = $rhs;
        } elseif (count($indices) === 2) {
            $i = (int)$this->evalExprFromText($indices[0], $env);
            $j = (int)$this->evalExprFromText($indices[1], $env);
            $arr[$i][$j] = $rhs;
        }

        $env->assign($name, $arr);
    }

    private function evalExprFromText(string $text, Environment $env): mixed {
        // Para índices simples: número o variable
        if (is_numeric($text)) return (int)$text;
        return $env->get($text);
    }

    // ─────────────────────────────────────────────────────────────
    // RETURN
    // ─────────────────────────────────────────────────────────────

    private function executeReturn($ctx, Environment $env, string $scope): ReturnSignal {
        if ($ctx->expressionList() === null) {
            return new ReturnSignal(null);
        }

        $exprs = $ctx->expressionList()->expression();

        if (count($exprs) === 1) {
            return new ReturnSignal($this->evalExpr($exprs[0], $env));
        }

        // Múltiples retornos → array
        $values = array_map(fn($e) => $this->evalExpr($e, $env), $exprs);
        return new ReturnSignal($values);
    }

    // ─────────────────────────────────────────────────────────────
    // IF
    // ─────────────────────────────────────────────────────────────

    private function executeIf($ctx, Environment $env, string $scope): mixed {
        $cond  = $this->evalExpr($ctx->expression(), $env);
        $inner = new Environment($env);

        if ($cond) {
            return $this->executeBlock($ctx->block(0), $inner, $scope);
        }

        // else o else if
        if ($ctx->block(1) !== null) {
            $elseEnv = new Environment($env);
            return $this->executeBlock($ctx->block(1), $elseEnv, $scope);
        }

        if ($ctx->ifStmt() !== null) {
            return $this->executeIf($ctx->ifStmt(), $env, $scope);
        }

        return null;
    }

    // ─────────────────────────────────────────────────────────────
    // SWITCH
    // ─────────────────────────────────────────────────────────────

    private function executeSwitch($ctx, Environment $env, string $scope): mixed {
        $switchVal = $ctx->expression() !== null
            ? $this->evalExpr($ctx->expression(), $env)
            : true;

        foreach ($ctx->caseClause() as $clause) {
            $exprs = $clause->expressionList()->expression();
            foreach ($exprs as $e) {
                if ($this->evalExpr($e, $env) == $switchVal) {
                    $inner = new Environment($env);
                    foreach ($clause->statement() as $stmt) {
                        $result = $this->executeStatement($stmt, $inner, $scope);
                        if ($result instanceof BreakSignal)    return null;
                        if ($result instanceof ReturnSignal)   return $result;
                        if ($result instanceof ContinueSignal) return $result;
                    }
                    return null; // En Go, no hay fallthrough por defecto
                }
            }
        }

        // default
        if ($ctx->defaultClause() !== null) {
            $inner = new Environment($env);
            foreach ($ctx->defaultClause()->statement() as $stmt) {
                $result = $this->executeStatement($stmt, $inner, $scope);
                if ($result instanceof BreakSignal)    return null;
                if ($result instanceof ReturnSignal)   return $result;
            }
        }

        return null;
    }

    // ─────────────────────────────────────────────────────────────
    // FOR
    // ─────────────────────────────────────────────────────────────

    private function executeFor($ctx, Environment $env, string $scope): mixed {
        $loopEnv = new Environment($env);

        // for { } — infinito
        if ($ctx->forClause() === null && $ctx->expression() === null) {
            while (true) {
                $result = $this->executeBlock($ctx->block(), $loopEnv, $scope);
                if ($result instanceof BreakSignal)    return null;
                if ($result instanceof ReturnSignal)   return $result;
                // ContinueSignal → continuar el bucle
            }
        }

        // for cond { } — estilo while
        if ($ctx->forClause() === null && $ctx->expression() !== null) {
            while ($this->evalExpr($ctx->expression(), $loopEnv)) {
                $result = $this->executeBlock($ctx->block(), $loopEnv, $scope);
                if ($result instanceof BreakSignal)    return null;
                if ($result instanceof ReturnSignal)   return $result;
            }
            return null;
        }

        // for init; cond; post { } — estilo C
        $fc = $ctx->forClause();

        // init
        if ($fc->simpleStmt(0) !== null) {
            $this->executeSimpleStmt($fc->simpleStmt(0), $loopEnv, $scope);
        }

        while (true) {
            // condición
            if ($fc->expression() !== null) {
                $cond = $this->evalExpr($fc->expression(), $loopEnv);
                if (!$cond) break;
            }

            $result = $this->executeBlock($ctx->block(), $loopEnv, $scope);
            if ($result instanceof BreakSignal)    return null;
            if ($result instanceof ReturnSignal)   return $result;

            // post (i++)
            if ($fc->simpleStmt(1) !== null) {
                $this->executeSimpleStmt($fc->simpleStmt(1), $loopEnv, $scope);
            }
        }

        return null;
    }

    // ─────────────────────────────────────────────────────────────
    // EVALUACIÓN DE EXPRESIONES
    // ─────────────────────────────────────────────────────────────

    private function evalExpr($ctx, Environment $env): mixed {
        // Expresión binaria
        if ($ctx->binaryOp() !== null) {
            return $this->evalBinary($ctx, $env);
        }
        // Expresión unaria
        return $this->evalUnary($ctx->unaryExpr(), $env);
    }

    private function evalBinary($ctx, Environment $env): mixed {
        $op    = $ctx->binaryOp()->getText();
        $left  = $this->evalExpr($ctx->expression(0), $env);

        // Cortocircuito
        if ($op === '&&') {
            if (!$left) return false;
            return (bool)$this->evalExpr($ctx->expression(1), $env);
        }
        if ($op === '||') {
            if ($left) return true;
            return (bool)$this->evalExpr($ctx->expression(1), $env);
        }

        $right = $this->evalExpr($ctx->expression(1), $env);

        return match($op) {
            '+'  => $this->opAdd($left, $right),
            '-'  => $left - $right,
            '*'  => $left * $right,
            '/'  => $right != 0 ? $left / $right : null,
            '%'  => $left % $right,
            '==' => $left == $right,
            '!=' => $left != $right,
            '<'  => $left < $right,
            '<=' => $left <= $right,
            '>'  => $left > $right,
            '>=' => $left >= $right,
            default => throw new RuntimeException("Operador binario desconocido: $op")
        };
    }

    private function opAdd(mixed $a, mixed $b): mixed {
        if (is_string($a) && is_string($b)) return $a . $b;
        return $a + $b;
    }

    private function evalUnary($ctx, Environment $env): mixed {
        if ($ctx->unaryOp() !== null) {
            $op  = $ctx->unaryOp()->getText();
            $val = $this->evalUnary($ctx->unaryExpr(), $env);
            return match($op) {
                '-' => -$val,
                '!' => !$val,
                '&' => $val,   // simplificado
                '*' => $val,   // simplificado
                default => $val
            };
        }
        return $this->evalPrimary($ctx->primaryExpr(), $env);
    }

    private function evalPrimary($ctx, Environment $env): mixed {
        // Type cast: float32(expr)
        if ($ctx->basicType() !== null) {
            $type = $ctx->basicType()->getText();
            $val  = $this->evalExpr($ctx->expression(0), $env);
            return $this->castValue($val, $type);
        }

        // Llamada a función: foo(args)  o  fmt.Println(args)
        if ($ctx->getChildCount() > 1) {
            $child1Text = $ctx->getChild(1)->getText();
            if ($child1Text === '(') {
                return $this->evalFunctionCall($ctx, $env);
            }
            // Acceso a arreglo: arr[i] o arr[i][j]
            if ($child1Text === '[') {
                return $this->evalArrayAccess($ctx, $env);
            }
        }

        // Operando simple
        return $this->evalOperand($ctx->operand(), $env);
    }

    private function evalFunctionCall($ctx, Environment $env): mixed {
        $name = $ctx->getChild(0)->getText(); // puede ser "fmt.Println"
        $args = [];

        if ($ctx->expressionList() !== null) {
            $args = array_map(
                fn($e) => $this->evalExpr($e, $env),
                $ctx->expressionList()->expression()
            );
        }

        // Funciones embebidas
        switch ($name) {
            case 'fmt.Println':
                Natives::fmtPrintln($args, $this->output);
                return null;

            case 'len':
                return Natives::len($args[0] ?? null);

            case 'now':
                return Natives::now();

            case 'substr':
                return Natives::substr($args[0], (int)$args[1], (int)$args[2]);

            case 'typeOf':
                return Natives::typeOf($args[0] ?? null);
        }

        // Función de usuario
        return $this->callFunction($name, $args, $env);
    }

    private function evalArrayAccess($ctx, Environment $env): mixed {
        // arr[i] o arr[i][j]
        $base = $this->evalPrimary($ctx->primaryExpr(), $env);
        $idx  = (int)$this->evalExpr($ctx->expression(0), $env);

        if ($ctx->getChildCount() > 4) {
            // arr[i][j]
            $j = (int)$this->evalExpr($ctx->expression(1), $env);
            return $base[$idx][$j] ?? null;
        }

        return $base[$idx] ?? null;
    }

    private function evalOperand($ctx, Environment $env): mixed {
        // Literal
        if ($ctx->literal() !== null) {
            return $this->evalLiteral($ctx->literal(), $env);
        }

        // Variable o función: ID o fmt.Println
        if ($ctx->qualifiedIdent() !== null) {
            $name = $ctx->qualifiedIdent()->getText();
            if ($env->exists($name)) {
                return $env->get($name);
            }
            throw new RuntimeException("Variable '$name' no declarada.");
        }

        // Expresión entre paréntesis
        if ($ctx->expression() !== null) {
            return $this->evalExpr($ctx->expression(), $env);
        }

        return null;
    }

    private function evalLiteral($ctx, Environment $env): mixed {
        if ($ctx->basicLiteral() !== null) {
            return $this->evalBasicLiteral($ctx->basicLiteral());
        }
        if ($ctx->arrayLiteral() !== null) {
            return $this->evalArrayLiteral($ctx->arrayLiteral(), $env);
        }
        return null;
    }

    private function evalBasicLiteral($ctx): mixed {
        if ($ctx->INT_LIT()    !== null) return (int)$ctx->INT_LIT()->getText();
        if ($ctx->FLOAT_LIT()  !== null) return (float)$ctx->FLOAT_LIT()->getText();
        if ($ctx->BOOL_LIT()   !== null) return $ctx->BOOL_LIT()->getText() === 'true';
        if ($ctx->NIL()        !== null) return null;
        if ($ctx->STRING_LIT() !== null) {
            $raw = $ctx->STRING_LIT()->getText();
            return stripslashes(substr($raw, 1, -1)); // quitar comillas
        }
        if ($ctx->RUNE_LIT()   !== null) {
            $raw = $ctx->RUNE_LIT()->getText();
            return substr($raw, 1, -1); // quitar comillas simples
        }
        return null;
    }

    private function evalArrayLiteral($ctx, Environment $env): array {
        $elements = $ctx->arrayElements()->arrayElement();
        $result   = [];

        foreach ($elements as $el) {
            if ($el->arrayElements() !== null) {
                // Fila 2D: {1, 2}
                $row = [];
                foreach ($el->arrayElements()->arrayElement() as $inner) {
                    $row[] = $this->evalExpr($inner->expression(), $env);
                }
                $result[] = $row;
            } else {
                $result[] = $this->evalExpr($el->expression(), $env);
            }
        }

        return $result;
    }

    // ─────────────────────────────────────────────────────────────
    // HELPERS
    // ─────────────────────────────────────────────────────────────

    private function defaultValue(string $type): mixed {
        return match(true) {
            str_contains($type, 'int32') => 0,
            str_contains($type, 'float32') => 0.0,
            str_contains($type, 'bool') => false,
            str_contains($type, 'string') => '',
            str_contains($type, 'rune') => "\u{0000}",
            default => null
        };
    }

    private function castValue(mixed $val, string $type): mixed {
        return match($type) {
            'int32'   => (int)$val,
            'float32' => (float)$val,
            'bool'    => (bool)$val,
            'string'  => (string)$val,
            'rune'    => (string)$val,
            default   => $val
        };
    }

    private function addError(string $tipo, string $desc, int $line, int $col): void {
        $this->errors[] = [
            '#'          => count($this->errors) + 1,
            'Tipo'       => $tipo,
            'Descripción'=> $desc,
            'Línea'      => $line,
            'Columna'    => $col,
        ];
    }

    private function addSymbol(string $id, string $type, string $scope,
                                mixed $value, int $line, int $col): void {
        $this->symbols[] = [
            'Identificador' => $id,
            'Tipo'          => $type,
            'Ámbito'        => $scope,
            'Valor'         => is_array($value)
                                ? '{' . implode(',', array_map(
                                    fn($v) => is_array($v)
                                        ? '{'.implode(',',$v).'}'
                                        : (string)$v,
                                    $value)) . '}'
                                : ($value === null ? '—' : var_export($value, true)),
            'Línea'         => $line,
            'Columna'       => $col,
        ];
    }
}