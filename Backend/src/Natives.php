<?php
// src/Natives.php

class Natives {

    // fmt.Println — imprime valores separados por espacio + salto de línea
    public static function fmtPrintln(array $args, array &$output): void {
        $parts = array_map(function ($v) {
            if (is_bool($v)) return $v ? 'true' : 'false';
            if ($v === null) return 'nil';
            return (string)$v;
        }, $args);
        $output[] = implode(' ', $parts);
    }

    // len — longitud de string o arreglo
    public static function len(mixed $val): int {
        if (is_string($val)) return mb_strlen($val);
        if (is_array($val))  return count($val);
        throw new RuntimeException("len() requiere un string o arreglo.");
    }

    // now — fecha y hora actual
    public static function now(): string {
        return date('Y-m-d H:i:s');
    }

    // substr — subcadena
    public static function substr(string $s, int $start, int $length): string {
        $result = mb_substr($s, $start, $length);
        if ($result === false) {
            throw new RuntimeException("substr(): índices inválidos.");
        }
        return $result;
    }

    // typeOf — tipo de un valor
    public static function typeOf(mixed $val): string {
        if (is_bool($val))    return 'bool';
        if (is_int($val))     return 'int32';
        if (is_float($val))   return 'float32';
        if (is_string($val) && mb_strlen($val) === 1) return 'rune';
        if (is_string($val))  return 'string';
        if (is_array($val))   return 'array';
        if ($val === null)    return 'nil';
        return 'unknown';
    }
}