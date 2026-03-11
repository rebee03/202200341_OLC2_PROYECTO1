<?php

class Error {
    public $type;    // 'lexico', 'sintactico', 'semantico'
    public $desc;    // string
    public $line;    // int
    public $col;     // int

    public function __construct($type, $desc, $line = 0, $col = 0) {
        $this->type = $type;
        $this->desc = $desc;
        $this->line = $line;
        $this->col = $col;
    }
}