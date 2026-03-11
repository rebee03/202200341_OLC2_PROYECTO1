<?php

require_once 'vendor/autoload.php';
use Antlr\Antlr4\Runtime\ParserRuleContext; // Para getStart()->getLine(), etc.

require_once 'GrammarBaseVisitor.php'; // Ajusta si es GolampiBaseVisitor
require_once 'SymbolTable.php';
require_once 'Error.php';

class InterpreterVisitor extends GrammarBaseVisitor {
    private $symbolTable;
    private $errors = [];
    private $output = '';
    private $functions = []; // Hoisting: name => ctx

    public function __construct() {
        $this->symbolTable = new SymbolTable();
    }

    // Retorna resultado: output, errors, symbols
    public function getResult() {
        return [
            'output' => $this->output,
            'errors' => $this->errors,
            'symbols' => $this->symbolTable->getAllSymbols()
        ];
    }

    // Agrega error
    private function addError($type, $desc, ParserRuleContext $ctx) {
        $this->errors[] = new Error($type, $desc, $ctx->start->getLine(), $ctx->start->getColumn() + 1);
    }

    // Evalúa expresión: retorna ['value' => mixed, 'type' => string] o null si error
    public function visitExpression($ctx) {
        // Implementa según operadores, precedencia
        // Ejemplo simple para unary, binary, etc.
        if ($ctx->unaryExpr()) {
            return $this->visitUnaryExpr($ctx->unaryExpr());
        }
        // Binary: left op right
        $left = $this->visitExpression($ctx->expression(0));
        if (!$left) return null;
        $right = $this->visitExpression($ctx->expression(1));
        if (!$right) return null;
        $op = $ctx->binaryOp()->getText();

        // Verifica compatibilidad por tablas del PDF
        if (! $this->isCompatible($left['type'], $right['type'], $op)) {
            $this->addError('semantico', "Operacion '$op' invalida entre '{$left['type']}' y '{$right['type']}'", $ctx);
            return null;
        }

        // Ejecuta (maneja short-circuit para && ||)
        if ($op == '&&') {
            if (!$left['value']) return ['value' => false, 'type' => 'bool']; // Short-circuit
        } elseif ($op == '||') {
            if ($left['value']) return ['value' => true, 'type' => 'bool']; // Short-circuit
        }

        // Calcula value (usa switch para ops, maneja tipos)
        $value = null;
        switch ($op) {
            case '+': $value = $left['value'] + $right['value']; break;
            // ... agrega -, *, /, %, ==, !=, <, >, etc.
            // Para string + string: concat
            // Para nil: return null
        }
        $resultType = $this->promoteType($left['type'], $right['type'], $op);
        return ['value' => $value, 'type' => $resultType];
    }

    // Implementa compatibilidad por tablas PDF
    private function isCompatible($t1, $t2, $op) {
        // Ej: para + , si t1==string && t2==string ok; o numéricos, etc.
        // Implementa lógica de tablas
        return true; // Placeholder
    }

    private function promoteType($t1, $t2, $op) {
        // Ej: int32 + float32 -> float32
        return 'float32'; // Placeholder
    }

    public function visitProgram($ctx) {
        // Hoisting: recolecta funciones
        foreach ($ctx->declaration() as $decl) {
            if ($decl->functionDecl()) {
                $name = $decl->functionDecl()->ID()->getText();
                if (isset($this->functions[$name])) {
                    $this->addError('semantico', "Funcion '$name' redeclarada", $decl);
                } else {
                    $this->functions[$name] = $decl->functionDecl();
                    // Agrega a symbols como function
                    $symbol = new Symbol($name, 'function', null, 'global', $decl->start->getLine(), $decl->start->getColumn() + 1);
                    $this->symbolTable->addSymbol($symbol);
                }
            }
        }

        // Procesa globals (vars/consts)
        foreach ($ctx->declaration() as $decl) {
            if ($decl->varDecl() || $decl->constDecl()) {
                $this->visit($decl);
            }
        }

        // Ejecuta main
        if (isset($this->functions['main'])) {
            $mainCtx = $this->functions['main'];
            $this->symbolTable->pushScope('function:main');
            $this->visitBlock($mainCtx->block());
            $this->symbolTable->popScope();
        } else {
            $this->addError('semantico', 'No se encontro funcion main', $ctx);
        }
    }

    public function visitVarDecl($ctx) {
        $ids = $this->visitIdentifierList($ctx->identifierList()); // array of strings
        $type = $this->visitType($ctx->type())->getText();
        $values = $ctx->expressionList() ? $this->visitExpressionList($ctx->expressionList()) : []; // array of ['value','type']

        if (count($ids) != count($values)) {
            $this->addError('semantico', 'Numero de ids y valores no coincide', $ctx);
            return;
        }

        for ($i = 0; $i < count($ids); $i++) {
            $id = $ids[$i];
            if ($this->symbolTable->lookup($id)) {
                $this->addError('semantico', "Variable '$id' redeclarada", $ctx);
                continue;
            }
            $value = count($values) > 0 ? $values[$i]['value'] : $this->defaultValue($type);
            $symType = $type;
            $symbol = new Symbol($id, $symType, $value, $this->symbolTable->currentScopeName(), $ctx->start->getLine(), $ctx->start->getColumn() + 1);
            $this->symbolTable->addSymbol($symbol);
        }
    }

    // Agrega visit para constDecl similar, pero isConst=true, debe inicializar

    public function visitFunctionDecl($ctx) {
        // Ya hoisted, aquí solo si llamada
        // Para ejecución: push scope, add params as symbols, visit block, pop scope, return values
    }

    // Implementa visit para statements: if, for, switch, assignment, etc.

    // Para built-ins: en visitPrimaryExpr si qualifiedIdent como 'fmt'.'Println', ejecuta
    private function handleBuiltIn($name, $args) {
        switch ($name) {
            case 'fmt.Println':
                $prints = [];
                foreach ($args as $arg) {
                    $prints[] = is_array($arg['value']) ? json_encode($arg['value']) : $arg['value']; // Maneja arrays
                }
                $this->output .= implode(' ', $prints) . "\n";
                break;
            case 'len':
                if (count($args) != 1) { /* error */ }
                $val = $args[0]['value'];
                return ['value' => is_string($val) ? strlen($val) : count($val), 'type' => 'int32'];
            case 'now':
                return ['value' => date('Y-m-d H:i:s'), 'type' => 'string'];
            case 'substr':
                if (count($args) != 3) { /* error */ }
                return ['value' => substr($args[0]['value'], $args[1]['value'], $args[2]['value']), 'type' => 'string'];
            case 'typeOf':
                if (count($args) != 1) { /* error */ }
                return ['value' => $args[0]['type'], 'type' => 'string'];
            // Agrega errores si inválido
        }
    }

    // Default values por tipo
    private function defaultValue($type) {
        switch ($type) {
            case 'int32': return 0;
            case 'float32': return 0.0;
            case 'bool': return false;
            case 'rune': return 0; // 
            case 'string': return '';
            // Para array: array_fill(0, size, default(subtype))
            default: return null;
        }
    }

    // ... Agrega más visit: visitIfStmt (handle init, cond bool, block), visitForStmt (loop), etc.
    // Para arrays: en visitArrayLiteral, crea array
    // Para punteros: en type '*type', value ['ptr' => &$otherValue]
    // Desreferencia: *expr -> $expr['value']['ptr']
    // &id -> ['value' => ['ptr' => &$sym->value], 'type' => '*'.$sym->type]
}

?>