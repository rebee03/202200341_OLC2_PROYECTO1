<?php
// src/Interpreter.php

require_once __DIR__ . '/Environment.php';
require_once __DIR__ . '/FlowTypes.php';
require_once __DIR__ . '/Natives.php';

use Antlr\Antlr4\Runtime\Tree\ParseTree;

class Interpreter extends GrammarBaseVisitor
{
    private Environment $global;
    private array $functions = [];  // hoisting: nombre => FunctionDeclContext
    public  array $output    = [];  // líneas para la consola
    public  array $errors    = [];  // tabla de errores
    public  array $symbols   = [];  // tabla de símbolos

    public function __construct()
    {
        $this->global = new Environment();
    }

    // ══════════════════════════════════════════════════════════════
    // PROGRAMA — punto de entrada
    // ══════════════════════════════════════════════════════════════

    public function visitProgram(Context\ProgramContext $ctx)
    {
        // ── HOISTING: registrar todas las funciones primero ──────
        foreach ($ctx->declaration() as $decl) {
            $fn = $decl->functionDecl();
            if ($fn !== null) {
                $name = $fn->ID()->getText();
                $this->functions[$name] = $fn;
                $this->addSymbol(
                    $name, 'función', 'global', '—',
                    $fn->ID()->getSymbol()->getLine(),
                    $fn->ID()->getSymbol()->getCharPositionInLine()
                );
            }
        }

        // ── Variables y constantes globales ─────────────────────
        foreach ($ctx->declaration() as $decl) {
            if ($decl->varDecl() !== null) {
                $this->execVarDecl($decl->varDecl(), $this->global, 'global');
            }
            if ($decl->constDecl() !== null) {
                $this->execConstDecl($decl->constDecl(), $this->global, 'global');
            }
        }

        // ── Ejecutar main() ──────────────────────────────────────
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

    // ══════════════════════════════════════════════════════════════
    // DECLARACIONES
    // ══════════════════════════════════════════════════════════════

    // var x int32 = 10  |  var w, z int32 = 1, 2
    private function execVarDecl(
        Context\VarDeclContext $ctx,
        Environment $env,
        string $scope
    ): void {
        $ids   = $ctx->identifierList()->ID();
        $type  = $ctx->type()->getText();
        $exprs = $ctx->expressionList()
                    ? $ctx->expressionList()->expression()
                    : [];

        for ($i = 0; $i < count($ids); $i++) {
            $name  = $ids[$i]->getText();
            $line  = $ids[$i]->getSymbol()->getLine();
            $col   = $ids[$i]->getSymbol()->getCharPositionInLine();
            $value = isset($exprs[$i])
                ? $this->evalExpr($exprs[$i], $env)
                : $this->defaultValue($type);

            try {
                $env->declare($name, $value, $type);
                $this->addSymbol($name, $type, $scope, $value, $line, $col);
            } catch (RuntimeException $e) {
                $this->addError('Semántico', $e->getMessage(), $line, $col);
            }
        }
    }

    // const pi float32 = 3.14
    private function execConstDecl(
        Context\ConstDeclContext $ctx,
        Environment $env,
        string $scope
    ): void {
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
    }

    // ══════════════════════════════════════════════════════════════
    // FUNCIONES
    // ══════════════════════════════════════════════════════════════

    private function callFunction(
        string $name,
        array $args,
        Environment $callerEnv
    ): mixed {
        if (!isset($this->functions[$name])) {
            throw new RuntimeException("Función '$name' no declarada.");
        }

        $fn     = $this->functions[$name];
        $params = $fn->parameterList()
                    ? $fn->parameterList()->parameter()
                    : [];

        if (count($params) !== count($args)) {
            throw new RuntimeException(
                "Función '$name': se esperaban " . count($params) .
                " parámetros, se recibieron " . count($args) . "."
            );
        }

        // Entorno local cuyo padre es el global (no el caller)
        $local = new Environment($this->global);

        foreach ($params as $i => $param) {
            $pName = $param->ID()->getText();
            $pType = $param->type()->getText();
            $local->declare($pName, $args[$i], $pType);
            $this->addSymbol(
                $pName, $pType, $name, $args[$i],
                $param->ID()->getSymbol()->getLine(),
                $param->ID()->getSymbol()->getCharPositionInLine()
            );
        }

        $result = $this->execBlock($fn->block(), $local, $name);

        if ($result instanceof ReturnSignal) {
            return $result->value;
        }
        return null;
    }

    // ══════════════════════════════════════════════════════════════
    // BLOQUE
    // ══════════════════════════════════════════════════════════════

    private function execBlock(
        Context\BlockContext $ctx,
        Environment $env,
        string $scope
    ): mixed {
        foreach ($ctx->statement() as $stmt) {
            $result = $this->execStatement($stmt, $env, $scope);
            if ($result instanceof ReturnSignal  ||
                $result instanceof BreakSignal   ||
                $result instanceof ContinueSignal) {
                return $result;
            }
        }
        return null;
    }

    // ══════════════════════════════════════════════════════════════
    // SENTENCIAS
    // ══════════════════════════════════════════════════════════════

    private function execStatement(
        Context\StatementContext $ctx,
        Environment $env,
        string $scope
    ): mixed {
        if ($ctx->varDecl() !== null) {
            $this->execVarDecl($ctx->varDecl(), $env, $scope);
            return null;
        }
        if ($ctx->constDecl() !== null) {
            $this->execConstDecl($ctx->constDecl(), $env, $scope);
            return null;
        }
        if ($ctx->simpleStmt() !== null) {
            return $this->execSimpleStmt($ctx->simpleStmt(), $env, $scope);
        }
        if ($ctx->returnStmt() !== null) {
            return $this->execReturn($ctx->returnStmt(), $env);
        }
        if ($ctx->breakStmt() !== null) {
            return new BreakSignal();
        }
        if ($ctx->continueStmt() !== null) {
            return new ContinueSignal();
        }
        if ($ctx->ifStmt() !== null) {
            return $this->execIf($ctx->ifStmt(), $env, $scope);
        }
        if ($ctx->switchStmt() !== null) {
            return $this->execSwitch($ctx->switchStmt(), $env, $scope);
        }
        if ($ctx->forStmt() !== null) {
            return $this->execFor($ctx->forStmt(), $env, $scope);
        }
        if ($ctx->block() !== null) {
            $inner = new Environment($env);
            return $this->execBlock($ctx->block(), $inner, $scope);
        }
        return null;
    }

    // ── SimpleStmt ───────────────────────────────────────────────

    private function execSimpleStmt(
        Context\SimpleStmtContext $ctx,
        Environment $env,
        string $scope
    ): mixed {

        // DEBUG
        // error_log("execSimpleStmt: " . $ctx->getText());


        // x, y := expr, expr
        if ($ctx->shortVarDecl() !== null) {
            $this->execShortVarDecl($ctx->shortVarDecl(), $env, $scope);
            return null;
        }
        // x = expr  |  x += expr
        if ($ctx->assignment() !== null) {
            $this->execAssignment($ctx->assignment(), $env);
            return null;
        }
        // i++  |  i--
        if ($ctx->incDecStmt() !== null) {
            $this->execIncDec($ctx->incDecStmt(), $env);
            return null;
        }
        // llamada a función como sentencia
        if ($ctx->expressionStmt() !== null) {
            $this->evalExpr($ctx->expressionStmt()->expression(), $env);
            return null;
        }
        return null;
    }

    // x, y := expr, expr
    private function execShortVarDecl(
        Context\ShortVarDeclContext $ctx,
        Environment $env,
        string $scope
    ): void {
        // DEBUG
        // error_log("shortVarDecl ids: " . $ctx->identifierList()->getText() . 
        //         " exprs: " . $ctx->expressionList()->getText());


        $ids   = $ctx->identifierList()->ID();
        $exprs = $ctx->expressionList()->expression();

        // Evaluar todos los valores ANTES de asignar (por si hay múltiples)
        $values = [];
        foreach ($exprs as $e) {
            $val = $this->evalExpr($e, $env);
            // Si retorna array (múltiple retorno), expandir
            if (is_array($val) && count($exprs) === 1) {
                $values = $val;
            } else {
                $values[] = $val;
            }
        }

        foreach ($ids as $i => $id) {
            $name  = $id->getText();
            $line  = $id->getSymbol()->getLine();
            $col   = $id->getSymbol()->getCharPositionInLine();
            $value = $values[$i] ?? null;

            // Inferir tipo: si la expresión es un arrayLiteral, usar su tipo real
            $type = $this->inferType($exprs[$i] ?? null, $value, $env);


            // $type  = Natives::typeOf($value);

            if ($env->existsLocal($name)) {
                // Ya existe en este scope → reasignar
                try {
                    $constType = $env->getType($name);
                    if (str_starts_with($constType, 'const:')) {
                        $this->addError('Semántico',
                            "No se puede modificar la constante '$name'.", $line, $col);
                    } else {
                        $env->assign($name, $value);
                    }
                } catch (RuntimeException $e) {
                    $this->addError('Semántico', $e->getMessage(), $line, $col);
                }
            } else {
                // Nueva variable
                try {
                    $env->declare($name, $value, $type);
                    $this->addSymbol($name, $type, $scope, $value, $line, $col);
                } catch (RuntimeException $e) {
                    $this->addError('Semántico', $e->getMessage(), $line, $col);
                }
            }
        }
    }

    // x = expr  |  x += expr  |  arr[i] = expr
    private function execAssignment(
        Context\AssignmentContext $ctx,
        Environment $env
    ): void {
        $lhsList = $ctx->expressionList(0)->expression();
        $rhsList = $ctx->expressionList(1)->expression();
        $op      = $ctx->assignOp()->getText();

        foreach ($lhsList as $i => $lhs) {
            $rhs = $this->evalExpr($rhsList[$i], $env);
            $this->assignTo($lhs, $op, $rhs, $env);
        }
    }

    // Asigna a una expresión del lado izquierdo
    private function assignTo(
        Context\ExpressionContext $lhs,
        string $op,
        mixed $rhs,
        Environment $env
    ): void {
        $text = $lhs->getText();

        // ── Acceso a arreglo: arr[i] o arr[i][j] ────────────────
        // La expresión lhs es un unaryExpr → primaryExpr con corchetes
        $primary = $this->getPrimaryFromExpr($lhs);
        if ($primary !== null && $this->isArrayAccess($primary)) {
            $this->assignToArray($primary, $op, $rhs, $env);
            return;
        }

        // ── Variable simple ──────────────────────────────────────
        // Extraer nombre limpio (sin espacios ni operadores)
        $name = $this->extractVarName($lhs);
        if ($name === null) {
            $this->addError('Semántico', "Lado izquierdo inválido: $text", 0, 0);
            return;
        }

        try {
            $type = $env->getType($name);
            if (str_starts_with($type, 'const:')) {
                $this->addError('Semántico',
                    "No se puede modificar la constante '$name'.", 0, 0);
                return;
            }
            $current = $env->get($name);
            $newVal  = $this->applyAssignOp($op, $current, $rhs);
            $env->assign($name, $newVal);
        } catch (RuntimeException $e) {
            $this->addError('Semántico', $e->getMessage(), 0, 0);
        }
    }



    // Editado
    private function inferType(
        ?Context\ExpressionContext $expr,
        mixed $value,
        Environment $env
    ): string {
        if ($expr !== null) {
            $unary = $expr->unaryExpr();
            if ($unary !== null && $unary->unaryOp() === null) {
                $primary = $unary->primaryExpr();
                if ($primary !== null && $primary->getChildCount() === 1) {
                    $operand = $primary->operand();
                    if ($operand !== null && $operand->literal() !== null) {
                        $al = $operand->literal()->arrayLiteral();
                        if ($al !== null) {
                            // Construir tipo: [5]int32 o [2][3]int32
                            $size = $al->expression()->getText();
                            $type = $al->type()->getText();
                            return '[' . $size . ']' . $type;
                        }
                    }
                }
            }
        }
        return Natives::typeOf($value);
    }






    // Asigna a arr[i] o arr[i][j]
    private function assignToArray(
        Context\PrimaryExprContext $primary,
        string $op,
        mixed $rhs,
        Environment $env
    ): void {
        // Obtener el arreglo base y los índices
        [$name, $indices] = $this->extractArrayNameAndIndices($primary, $env);
        if ($name === null) return;

        try {
            $arr = $env->get($name);
            if (count($indices) === 1) {
                $current      = $arr[$indices[0]] ?? null;
                $arr[$indices[0]] = $this->applyAssignOp($op, $current, $rhs);
            } elseif (count($indices) === 2) {
                $current              = $arr[$indices[0]][$indices[1]] ?? null;
                $arr[$indices[0]][$indices[1]] = $this->applyAssignOp($op, $current, $rhs);
            }
            $env->assign($name, $arr);
        } catch (RuntimeException $e) {
            $this->addError('Semántico', $e->getMessage(), 0, 0);
        }
    }

    // i++  |  i--
    private function execIncDec(
        Context\IncDecStmtContext $ctx,
        Environment $env
    ): void {
        $name = $ctx->expression()->getText();
        $op   = $ctx->getChild(1)->getText(); // ++ o --

        try {
            $val = $env->get($name);
            $env->assign($name, $op === '++' ? $val + 1 : $val - 1);
        } catch (RuntimeException $e) {
            $this->addError('Semántico', $e->getMessage(), 0, 0);
        }
    }

    // ── Return ───────────────────────────────────────────────────

    private function execReturn(
        Context\ReturnStmtContext $ctx,
        Environment $env
    ): ReturnSignal {
        if ($ctx->expressionList() === null) {
            return new ReturnSignal(null);
        }

        $exprs = $ctx->expressionList()->expression();

        if (count($exprs) === 1) {
            return new ReturnSignal($this->evalExpr($exprs[0], $env));
        }

        // Múltiples retornos → array PHP
        $values = array_map(fn($e) => $this->evalExpr($e, $env), $exprs);
        return new ReturnSignal($values);
    }

    // ── If ───────────────────────────────────────────────────────

    private function execIf(
        Context\IfStmtContext $ctx,
        Environment $env,
        string $scope
    ): mixed {
        $cond = $this->evalExpr($ctx->expression(), $env);

        if ($cond) {
            $inner = new Environment($env);
            return $this->execBlock($ctx->block(0), $inner, $scope);
        }

        // else if
        if ($ctx->ifStmt() !== null) {
            return $this->execIf($ctx->ifStmt(), $env, $scope);
        }

        // else
        if ($ctx->block(1) !== null) {
            $inner = new Environment($env);
            return $this->execBlock($ctx->block(1), $inner, $scope);
        }

        return null;
    }

    // ── Switch ───────────────────────────────────────────────────

    private function execSwitch(
        Context\SwitchStmtContext $ctx,
        Environment $env,
        string $scope
    ): mixed {
        $switchVal = $ctx->expression() !== null
            ? $this->evalExpr($ctx->expression(), $env)
            : true;

        foreach ($ctx->caseClause() as $clause) {
            $exprs = $clause->expressionList()->expression();
            $match = false;
            foreach ($exprs as $e) {
                if ($this->evalExpr($e, $env) == $switchVal) {
                    $match = true;
                    break;
                }
            }
            if ($match) {
                $inner = new Environment($env);
                foreach ($clause->statement() as $stmt) {
                    $result = $this->execStatement($stmt, $inner, $scope);
                    if ($result instanceof BreakSignal)    return null;
                    if ($result instanceof ReturnSignal)   return $result;
                    if ($result instanceof ContinueSignal) return $result;
                }
                return null; // Sin fallthrough
            }
        }

        // default
        if ($ctx->defaultClause() !== null) {
            $inner = new Environment($env);
            foreach ($ctx->defaultClause()->statement() as $stmt) {
                $result = $this->execStatement($stmt, $inner, $scope);
                if ($result instanceof BreakSignal)  return null;
                if ($result instanceof ReturnSignal) return $result;
            }
        }

        return null;
    }

    // ── For ──────────────────────────────────────────────────────

    private function execFor(
        Context\ForStmtContext $ctx,
        Environment $env,
        string $scope
    ): mixed {
        $loopEnv = new Environment($env);

        // for { }  — infinito
        if ($ctx->forClause() === null && $ctx->expression() === null) {
            while (true) {
                $result = $this->execBlock($ctx->block(), $loopEnv, $scope);
                if ($result instanceof BreakSignal)    return null;
                if ($result instanceof ReturnSignal)   return $result;
                // ContinueSignal → seguir iterando
            }
        }

        // for cond { }  — estilo while
        if ($ctx->forClause() === null && $ctx->expression() !== null) {
            while ($this->evalExpr($ctx->expression(), $loopEnv)) {
                $result = $this->execBlock($ctx->block(), $loopEnv, $scope);
                if ($result instanceof BreakSignal)    return null;
                if ($result instanceof ReturnSignal)   return $result;
            }
            return null;
        }

        // for init; cond; post { }  — estilo C
        $fc = $ctx->forClause();
        $simpleStmts = $fc->simpleStmt(); // array de 0, 1 o 2 simpleStmt

        // init (primer simpleStmt antes del primer ';')
        // ANTLR pone los simpleStmt en orden: [init, post] si ambos existen
        $initIdx = 0;
        $postIdx = 1;

        if (count($simpleStmts) > 0 && $initIdx < count($simpleStmts)) {
            // Verificar si hay init: si el primer ';' viene antes del primer simpleStmt
            // La forma más segura es usar el texto del forClause
            $fcText = $fc->getText();
            // Ejecutar init si existe
            $this->execSimpleStmt($simpleStmts[$initIdx], $loopEnv, $scope);
            $postIdx = 1;
        }

        while (true) {
            // Condición
            if ($fc->expression() !== null) {
                $cond = $this->evalExpr($fc->expression(), $loopEnv);
                if (!$cond) break;
            }

            $result = $this->execBlock($ctx->block(), $loopEnv, $scope);
            if ($result instanceof BreakSignal)    return null;
            if ($result instanceof ReturnSignal)   return $result;
            // ContinueSignal → ejecutar post y continuar

            // post (segundo simpleStmt)
            if (count($simpleStmts) > $postIdx) {
                $this->execSimpleStmt($simpleStmts[$postIdx], $loopEnv, $scope);
            }
        }

        return null;
    }

    // ══════════════════════════════════════════════════════════════
    // EVALUACIÓN DE EXPRESIONES
    // ══════════════════════════════════════════════════════════════

    public function visitExpression(Context\ExpressionContext $ctx)
    {
        return $this->evalExpr($ctx, $this->global);
    }

    private function evalExpr(
        Context\ExpressionContext $ctx,
        Environment $env
    ): mixed {
        // expression: unaryExpr | expression binaryOp expression
        if ($ctx->binaryOp() !== null) {
            return $this->evalBinary($ctx, $env);
        }
        return $this->evalUnary($ctx->unaryExpr(), $env);
    }

    // ── Binaria ──────────────────────────────────────────────────

    private function evalBinary(
        Context\ExpressionContext $ctx,
        Environment $env
    ): mixed {
        $op   = $ctx->binaryOp()->getText();
        $left = $this->evalExpr($ctx->expression(0), $env);

        // Cortocircuito
        if ($op === '&&') {
            if (!$left) return false;
            return (bool) $this->evalExpr($ctx->expression(1), $env);
        }
        if ($op === '||') {
            if ($left) return true;
            return (bool) $this->evalExpr($ctx->expression(1), $env);
        }

        $right = $this->evalExpr($ctx->expression(1), $env);

        return match ($op) {
            '+'  => $this->opAdd($left, $right),
            '-'  => $left - $right,
            '*'  => $left * $right,
            '/'  => $right != 0 ? $left / $right
                                : $this->runtimeError("División por cero."),
            '%'  => $left % $right,
            '==' => $left == $right,
            '!=' => $left != $right,
            '<'  => $left < $right,
            '<=' => $left <= $right,
            '>'  => $left > $right,
            '>=' => $left >= $right,
            default => throw new RuntimeException("Operador desconocido: $op")
        };
    }

    private function opAdd(mixed $a, mixed $b): mixed
    {
        // string + string → concatenar
        if (is_string($a) && is_string($b)) return $a . $b;
        return $a + $b;
    }

    // ── Unaria ───────────────────────────────────────────────────

    private function evalUnary(
        Context\UnaryExprContext $ctx,
        Environment $env
    ): mixed {
        // unaryExpr: primaryExpr | unaryOp unaryExpr
        if ($ctx->unaryOp() !== null) {
            $op  = $ctx->unaryOp()->getText();
            $val = $this->evalUnary($ctx->unaryExpr(), $env);
            return match ($op) {
                '-'  => -$val,
                '!'  => !$val,
                '+'  => +$val,
                '&'  => $val,   // dirección — simplificado
                '*'  => $val,   // desreferencia — simplificado
                default => $val
            };
        }
        return $this->evalPrimary($ctx->primaryExpr(), $env);
    }

    // ── Primaria ─────────────────────────────────────────────────

    private function evalPrimary(
        Context\PrimaryExprContext $ctx,
        Environment $env
    ): mixed {
        $childCount = $ctx->getChildCount();

        // primaryExpr: operand  (caso base — un solo hijo)
        if ($childCount === 1) {
            return $this->evalOperand($ctx->operand(), $env);
        }

        // basicType '(' expression ')'  — type cast: float32(x)
        if ($ctx->basicType() !== null) {
            $type = $ctx->basicType()->getText();
            $val  = $this->evalExpr($ctx->expression(0), $env);
            return $this->castValue($val, $type);
        }

        // Obtener el segundo token para distinguir casos
        $second = $ctx->getChild(1)->getText();

        // primaryExpr '(' expressionList? ')'  — llamada a función
        if ($second === '(') {
            return $this->evalCall($ctx, $env);
        }

        // primaryExpr '[' expression ']'  — acceso 1D
        // primaryExpr '[' expression ']' '[' expression ']'  — acceso 2D
        if ($second === '[') {
            return $this->evalArrayRead($ctx, $env);
        }

        // Fallback: operand
        if ($ctx->operand() !== null) {
            return $this->evalOperand($ctx->operand(), $env);
        }

        return null;
    }

    // ── Llamada a función ────────────────────────────────────────

    private function evalCall(
        Context\PrimaryExprContext $ctx,
        Environment $env
    ): mixed {
        // El nombre viene del primaryExpr hijo (puede ser operand → qualifiedIdent)
        $callee = $ctx->primaryExpr();
        $name   = $callee !== null
                    ? $callee->getText()
                    : $ctx->getChild(0)->getText();

        // DEBUG — quitar después
        //error_log("evalCall name: " . $name);

        // Argumentos
        $args = [];
        if ($ctx->expressionList() !== null) {
            foreach ($ctx->expressionList()->expression() as $e) {
                $args[] = $this->evalExpr($e, $env);
            }
        }

        // ── Funciones embebidas ──────────────────────────────────
        switch ($name) {
            case 'fmt.Println':
                Natives::fmtPrintln($args, $this->output);
                return null;

            case 'fmt.Print':
                // Sin salto de línea
                $parts = array_map(fn($v) => $this->valToString($v), $args);
                $last  = count($this->output) - 1;
                if ($last >= 0) {
                    $this->output[$last] .= implode(' ', $parts);
                } else {
                    $this->output[] = implode(' ', $parts);
                }
                return null;

            case 'len':
                //return Natives::len($args[0] ?? null);
                try {
                    return Natives::len($args[0] ?? null);
                } catch (RuntimeException $e) {
                    $this->addError('Semántico', $e->getMessage(), 0, 0);
                    return null;
                }

            case 'now':
                return Natives::now();

            case 'substr':
                return Natives::substr(
                    (string)($args[0] ?? ''),
                    (int)($args[1] ?? 0),
                    (int)($args[2] ?? 0)
                );

            case 'typeOf':
                // Intentar obtener el tipo real desde el Environment
                if ($ctx->expressionList() !== null) {
                    $argExpr = $ctx->expressionList()->expression()[0];
                    // Si el argumento es un identificador simple, buscar su tipo
                    $varName = $this->extractVarNameFromExpr($argExpr);
                    if ($varName !== null && $env->exists($varName)) {
                        $declaredType = $env->getType($varName);
                        // Limpiar prefijo const: si lo hay
                        $declaredType = str_replace('const:', '', $declaredType);
                        return $this->typeOfFromDeclared($declaredType, $args[0] ?? null);
                    }
                }
                return Natives::typeOf($args[0] ?? null);
        }

        // ── Función de usuario ───────────────────────────────────
        try {
            return $this->callFunction($name, $args, $env);
        } catch (RuntimeException $e) {
            $this->addError('Semántico', $e->getMessage(), 0, 0);
            return null;
        }
    }

    // ── Lectura de arreglo ───────────────────────────────────────

    private function evalArrayRead(
        Context\PrimaryExprContext $ctx,
        Environment $env
    ): mixed {
        // Obtener la base (puede ser otro primaryExpr anidado)
        $base = $this->evalPrimary($ctx->primaryExpr(), $env);

        // Índices: buscar todas las expresiones dentro de corchetes
        $exprs = $ctx->expression();

        if (count($exprs) === 1) {
            $idx = (int) $this->evalExpr($exprs[0], $env);
            return $base[$idx] ?? null;
        }

        if (count($exprs) === 2) {
            $i = (int) $this->evalExpr($exprs[0], $env);
            $j = (int) $this->evalExpr($exprs[1], $env);
            return $base[$i][$j] ?? null;
        }

        return null;
    }

    // ── Operand ──────────────────────────────────────────────────

    private function evalOperand(
        Context\OperandContext $ctx,
        Environment $env
    ): mixed {
        // literal
        if ($ctx->literal() !== null) {
            return $this->evalLiteral($ctx->literal(), $env);
        }

        // qualifiedIdent — variable o nombre de función
        if ($ctx->qualifiedIdent() !== null) {
            $name = $ctx->qualifiedIdent()->getText();
            try {
                return $env->get($name);
            } catch (RuntimeException $e) {
                // Puede ser el nombre de una función — se resuelve en evalCall
                // Si no existe como variable, reportar error
                $this->addError('Semántico', $e->getMessage(), 0, 0);
                return null;
            }
        }

        // ( expression )
        if ($ctx->expression() !== null) {
            return $this->evalExpr($ctx->expression(), $env);
        }

        return null;
    }

    // ── Literales ────────────────────────────────────────────────

    private function evalLiteral(
        Context\LiteralContext $ctx,
        Environment $env
    ): mixed {
        if ($ctx->basicLiteral() !== null) {
            return $this->evalBasicLiteral($ctx->basicLiteral());
        }
        if ($ctx->arrayLiteral() !== null) {
            return $this->evalArrayLiteral($ctx->arrayLiteral(), $env);
        }
        return null;
    }

    private function evalBasicLiteral(
        Context\BasicLiteralContext $ctx
    ): mixed {
        if ($ctx->INT_LIT()    !== null) return (int)   $ctx->INT_LIT()->getText();
        if ($ctx->FLOAT_LIT()  !== null) return (float) $ctx->FLOAT_LIT()->getText();
        if ($ctx->BOOL_LIT()   !== null) return $ctx->BOOL_LIT()->getText() === 'true';
        if ($ctx->NIL()        !== null) return null;

        if ($ctx->STRING_LIT() !== null) {
            $raw = $ctx->STRING_LIT()->getText();
            // Quitar comillas dobles y procesar escapes básicos
            $inner = substr($raw, 1, -1);
            return stripcslashes($inner);
        }

        if ($ctx->RUNE_LIT() !== null) {
            $raw   = $ctx->RUNE_LIT()->getText();
            $inner = substr($raw, 1, -1); // quitar comillas simples
            // Procesar escape
            if (strlen($inner) >= 2 && $inner[0] === '\\') {
                $char = stripcslashes($inner);
            } else {
                $char = $inner;
            }
            // Retornar valor numérico Unicode (como Go: rune es int32)
            return mb_ord($char);
        }

        return null;
    }

    private function evalArrayLiteral(
        Context\ArrayLiteralContext $ctx,
        Environment $env
    ): array {
        $elements = $ctx->arrayElements()->arrayElement();
        $result   = [];

        foreach ($elements as $el) {
            // Fila 2D: { expr, expr }
            if ($el->arrayElements() !== null) {
                $row = [];
                foreach ($el->arrayElements()->arrayElement() as $inner) {
                    if ($inner->expression() !== null) {
                        $row[] = $this->evalExpr($inner->expression(), $env);
                    }
                }
                $result[] = $row;
            } elseif ($el->expression() !== null) {
                $result[] = $this->evalExpr($el->expression(), $env);
            }
        }

        return $result;
    }

    // ══════════════════════════════════════════════════════════════
    // HELPERS
    // ══════════════════════════════════════════════════════════════

    // Valor por defecto según tipo declarado
    private function defaultValue(string $type): mixed
    {
        // Arreglo 1D: [5]int32 → array de 5 ceros
        if (preg_match('/^\[(\d+)\](.+)$/', $type, $m)) {
            $size    = (int) $m[1];
            $subType = $m[2];
            return array_fill(0, $size, $this->defaultValue($subType));
        }

        // Arreglo 2D: [2][3]int32 → array de arrays
        if (preg_match('/^\[(\d+)\]\[(\d+)\](.+)$/', $type, $m)) {
            $rows    = (int) $m[1];
            $cols    = (int) $m[2];
            $subType = $m[3];
            $defVal  = $this->defaultValue($subType);
            return array_fill(0, $rows, array_fill(0, $cols, $defVal));
        }

        // Tipos primitivos
        if (str_contains($type, 'int32'))   return 0;
        if (str_contains($type, 'float32')) return 0.0;
        if (str_contains($type, 'bool'))    return false;
        if (str_contains($type, 'string'))  return '';
        if (str_contains($type, 'rune'))    return "\u{0000}";
        return null;
    }

    // Type cast
    private function castValue(mixed $val, string $type): mixed
    {
        return match ($type) {
            'int32'   => (int)   $val,
            'float32' => (float) $val,
            'bool'    => (bool)  $val,
            'string'  => (string) $val,
            'rune'    => is_int($val) ? mb_chr($val) : (string) $val,
            default   => $val
        };
    }

    // Aplicar operador de asignación
    private function applyAssignOp(string $op, mixed $current, mixed $rhs): mixed
    {
        return match ($op) {
            '='  => $rhs,
            '+=' => $this->opAdd($current, $rhs),
            '-=' => $current - $rhs,
            '*=' => $current * $rhs,
            '/=' => $rhs != 0 ? $current / $rhs : null,
            default => throw new RuntimeException("Operador de asignación desconocido: $op")
        };
    }

    // Convertir valor a string para impresión
    private function valToString(mixed $v): string
    {
        if (is_bool($v))  return $v ? 'true' : 'false';
        if ($v === null)  return 'nil';
        return (string) $v;
    }

    // Error en tiempo de ejecución (retorna null y registra el error)
    private function runtimeError(string $msg): mixed
    {
        $this->addError('Semántico', $msg, 0, 0);
        return null;
    }

    // ── Helpers para acceso a arreglos en LHS ───────────────────

    private function getPrimaryFromExpr(
        Context\ExpressionContext $expr
    ): ?Context\PrimaryExprContext {
        if ($expr->binaryOp() !== null) return null;
        $unary = $expr->unaryExpr();
        if ($unary === null || $unary->unaryOp() !== null) return null;
        return $unary->primaryExpr();
    }

    private function isArrayAccess(
        Context\PrimaryExprContext $primary
    ): bool {
        if ($primary->getChildCount() < 2) return false;
        return $primary->getChild(1)->getText() === '[';
    }

    private function extractArrayNameAndIndices(
        Context\PrimaryExprContext $primary,
        Environment $env
    ): array {
        // Obtener nombre base
        $basePrimary = $primary->primaryExpr();
        $name = null;

        if ($basePrimary !== null) {
            if ($basePrimary->operand() !== null &&
                $basePrimary->operand()->qualifiedIdent() !== null) {
                $name = $basePrimary->operand()->qualifiedIdent()->getText();
            } elseif ($basePrimary->getChildCount() === 1 &&
                      $basePrimary->operand() !== null) {
                $name = $basePrimary->operand()->getText();
            }
        }

        if ($name === null) return [null, []];

        // Índices
        $indices = [];
        foreach ($primary->expression() as $e) {
            $indices[] = (int) $this->evalExpr($e, $env);
        }

        return [$name, $indices];
    }

    private function extractVarName(
        Context\ExpressionContext $expr
    ): ?string {
        $primary = $this->getPrimaryFromExpr($expr);
        if ($primary === null) return null;
        if ($primary->getChildCount() !== 1) return null;
        $operand = $primary->operand();
        if ($operand === null) return null;
        $qi = $operand->qualifiedIdent();
        if ($qi === null) return null;
        return $qi->getText();
    }

    // Extrae el nombre de variable de una expresión simple, si es un identificador limpio
    // Editado 
    private function extractVarNameFromExpr(
        Context\ExpressionContext $expr
    ): ?string {
        // Solo funciona para expresiones simples tipo: unaryExpr → primaryExpr → operand → qualifiedIdent
        if ($expr->binaryOp() !== null) return null;
        $unary = $expr->unaryExpr();
        if ($unary === null || $unary->unaryOp() !== null) return null;
        $primary = $unary->primaryExpr();
        if ($primary === null || $primary->getChildCount() !== 1) return null;
        $operand = $primary->operand();
        if ($operand === null || $operand->qualifiedIdent() === null) return null;
        return $operand->qualifiedIdent()->getText();
    }

    private function typeOfFromDeclared(string $type, mixed $val): string
    {
        // Arreglo: [3]int32 → retornar tal cual
        if (str_starts_with($type, '[')) return $type;

        return match(true) {
            str_contains($type, 'int32')   => 'int',
            str_contains($type, 'float32') => 'float64',
            str_contains($type, 'bool')    => 'bool',
            str_contains($type, 'string')  => 'string',
            str_contains($type, 'rune')    => 'int32',
            default => Natives::typeOf($val)
        };
    }

    // ── Agregar a reportes ───────────────────────────────────────

    private function addError(
        string $tipo,
        string $desc,
        int $line,
        int $col
    ): void {
        $this->errors[] = [
            '#'           => count($this->errors) + 1,
            'Tipo'        => $tipo,
            'Descripción' => $desc,
            'Línea'       => $line,
            'Columna'     => $col,
        ];
    }

    private function addSymbol(
        string $id,
        string $type,
        string $scope,
        mixed  $value,
        int    $line,
        int    $col
    ): void {
        $this->symbols[] = [
            'Identificador' => $id,
            'Tipo'          => $type,
            'Ámbito'        => $scope,
            'Valor'         => $this->symbolValue($value),
            'Línea'         => $line,
            'Columna'       => $col,
        ];
    }

    private function symbolValue(mixed $v): string
    {
        if ($v === null)   return '—';
        if (is_bool($v))   return $v ? 'true' : 'false';
        if (is_array($v)) {
            $inner = implode(',', array_map(
                fn($el) => is_array($el)
                    ? '{' . implode(',', $el) . '}'
                    : (string) $el,
                $v
            ));
            return '{' . $inner . '}';
        }
        return (string) $v;
    }
}