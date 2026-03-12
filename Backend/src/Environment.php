<?php
// src/Environment.php

class Environment {
    private array $values = [];
    private ?Environment $parent;

    public function __construct(?Environment $parent = null) {
        $this->parent = $parent;
    }

    // Declara una variable NUEVA en el scope actual
    public function declare(string $name, mixed $value, string $type): void {
        if (array_key_exists($name, $this->values)) {
            throw new RuntimeException("Identificador '$name' ya ha sido declarado en este ámbito.");
        }
        $this->values[$name] = ['value' => $value, 'type' => $type];
    }

    // Obtiene el valor de una variable buscando hacia arriba
    public function get(string $name): mixed {
        if (array_key_exists($name, $this->values)) {
            return $this->values[$name]['value'];
        }
        if ($this->parent !== null) {
            return $this->parent->get($name);
        }
        throw new RuntimeException("Variable '$name' no declarada en el ámbito actual.");
    }

    // Obtiene el tipo de una variable
    public function getType(string $name): string {
        if (array_key_exists($name, $this->values)) {
            return $this->values[$name]['type'];
        }
        if ($this->parent !== null) {
            return $this->parent->getType($name);
        }
        throw new RuntimeException("Variable '$name' no declarada en el ámbito actual.");
    }

    // Asigna un valor a una variable ya declarada (busca hacia arriba)
    public function assign(string $name, mixed $value): void {
        if (array_key_exists($name, $this->values)) {
            $this->values[$name]['value'] = $value;
            return;
        }
        if ($this->parent !== null) {
            $this->parent->assign($name, $value);
            return;
        }
        throw new RuntimeException("Variable '$name' no declarada en el ámbito actual.");
    }

    // Actualiza también el tipo (útil para inferencia en :=)
    public function assignWithType(string $name, mixed $value, string $type): void {
        if (array_key_exists($name, $this->values)) {
            $this->values[$name]['value'] = $value;
            $this->values[$name]['type']  = $type;
            return;
        }
        if ($this->parent !== null) {
            $this->parent->assignWithType($name, $value, $type);
            return;
        }
        throw new RuntimeException("Variable '$name' no declarada en el ámbito actual.");
    }

    // Verifica si una variable existe en ESTE scope (no en padres)
    public function existsLocal(string $name): bool {
        return array_key_exists($name, $this->values);
    }

    // Verifica si una variable existe en cualquier scope
    public function exists(string $name): bool {
        if (array_key_exists($name, $this->values)) return true;
        if ($this->parent !== null) return $this->parent->exists($name);
        return false;
    }

    // Devuelve todos los símbolos de este scope (para reporte)
    public function getAll(): array {
        return $this->values;
    }

    public function getParent(): ?Environment {
        return $this->parent;
    }
}