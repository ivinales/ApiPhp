<?php

namespace App\ValueObject;

class Name
{
    private string $value;

    public function __construct(string $value)
    {
        // Ejemplo: mínimo 3 caracteres y solo letras y espacios
        if (strlen($value) < 3 || !preg_match('/^[a-zA-Z\s]+$/', $value)) {
            throw new \InvalidArgumentException("El nombre debe tener al menos 3 caracteres y solo letras.");
        }
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}
