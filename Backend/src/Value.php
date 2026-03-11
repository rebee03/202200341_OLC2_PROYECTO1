<?php
// Value.php
class Value {
    public $type;  // 'int32', 'float32', 'string', 'bool'
    public $value;

    public function __construct($type, $value) {
        $this->type = $type;
        $this->value = $value;
    }
}
