<?php

use Context\VariableContext;
use Context\AssignContext;
use Context\PrintStmtContext;
use Context\IfStmtContext;
use Context\ForStmtContext;
use Context\IdExpContext;
use Context\LiteralExpContext;

use Context\WhileStmtContext;


class Interpreter extends GrammarBaseVisitor {
    private $env;

    public function __construct() {
        $this->env = new Environment();
    }

    // El punto de entrada 'start' visita a sus hijos (instrucciones)
    public function visitStart(\GrammarParser\StartContext $ctx) {
        foreach ($ctx->children as $child) {
            $this->visit($child);
        }
    }

    public function visitVariableDecl(\GrammarParser\VariableDeclContext $ctx) {
        $name = $ctx->ID()->getText();
        $type = $ctx->type()->getText();
        $value = null;

        if ($ctx->expression()) {
            $value = $this->visit($ctx->expression());
            if ($value->type !== $type) {
                throw new \Exception("Error Semántico: Tipo incorrecto para variable '$name'. Se esperaba $type.");
            }
        }
        $this->env->define($name, $value);
        return null;
    }

    public function visitPrintStmt(\GrammarParser\PrintStmtContext $ctx) {
        $expressions = $ctx->expression();
        $output = [];
        foreach ($expressions as $exp) {
            $val = $this->visit($exp);
            $output[] = $val->value;
        }
        echo implode(" ", $output) . PHP_EOL;
        return null;
    }

    public function visitLiteralExp(\GrammarParser\LiteralExpContext $ctx) {
        $lit = $ctx->literal();
        if ($lit->INT()) return new Value('int32', intval($lit->INT()->getText()));
        if ($lit->STRING()) return new Value('string', trim($lit->STRING()->getText(), '"'));
        if ($lit->BOOLEAN()) return new Value('bool', $lit->BOOLEAN()->getText() === 'true');
        // ... agregar los demás
        return null;
    }

    public function visitIdExp(\GrammarParser\IdExpContext $ctx) {
        return $this->env->get($ctx->ID()->getText());
    }
    
    // Para las expresiones de suma/resta que ahora se llaman AddSubExp
    public function visitAddSubExp(\GrammarParser\AddSubExpContext $ctx) {
        $left = $this->visit($ctx->expression(0));
        $right = $this->visit($ctx->expression(1));
        $op = $ctx->op->getText();

        if ($op === '+') {
            return new Value($left->type, $left->value + $right->value);
        } else {
            return new Value($left->type, $left->value - $right->value);
        }
    }
}