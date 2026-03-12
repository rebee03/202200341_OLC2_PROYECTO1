<?php
// src/FlowTypes.php

// Señal para 'break' — rompe el bucle actual
class BreakSignal {
    public function __construct() {}
}

// Señal para 'continue' — salta a la siguiente iteración
class ContinueSignal {
    public function __construct() {}
}

// Señal para 'return' — sale de la función con un valor opcional
class ReturnSignal {
    public mixed $value;

    public function __construct(mixed $value = null) {
        $this->value = $value;
    }
}