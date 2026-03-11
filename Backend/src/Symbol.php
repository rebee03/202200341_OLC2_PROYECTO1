<?php

class Symbol {
    public $name;   // string
    public $type;   // string e.g., 'int32', 'float32', '[5]int32', '*int32', 'function'
    public $value;  // mixed: int, float, bool, string, array, null (nil)
    public $scope;  // string e.g., 'global', 'function:main', 'block:if'
    public $line;   // int
    public $col;    // int
    public $isConst; // bool

    public function __construct($name, $type, $value = null, $scope = 'global', $line = 0, $col = 0, $isConst = false) {
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
        $this->scope = $scope;
        $this->line = $line;
        $this->col = $col;
        $this->isConst = $isConst;
    }
}