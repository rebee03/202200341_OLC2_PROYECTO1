<?php

require_once 'Symbol.php';

class SymbolTable {
    private $scopes = []; // array of arrays: [0 => global, 1 => current, ...]

    public function __construct() {
        $this->scopes[] = []; // Global scope
    }

    public function pushScope($scopeName) {
        $this->scopes[] = []; // New scope
        return $scopeName;
    }

    public function popScope() {
        array_pop($this->scopes);
    }

    public function addSymbol(Symbol $symbol) {
        $currentScope = &$this->scopes[count($this->scopes) - 1];
        if (isset($currentScope[$symbol->name])) {
            return false; // Already exists
        }
        $currentScope[$symbol->name] = $symbol;
        return true;
    }

    public function lookup($name) {
        for ($i = count($this->scopes) - 1; $i >= 0; $i--) {
            if (isset($this->scopes[$i][$name])) {
                return $this->scopes[$i][$name];
            }
        }
        return null;
    }

    public function getAllSymbols() {
        $all = [];
        foreach ($this->scopes as $scope) {
            foreach ($scope as $sym) {
                $all[] = $sym;
            }
        }
        return $all;
    }
}