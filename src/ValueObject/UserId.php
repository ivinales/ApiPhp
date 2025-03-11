<?php

namespace App\ValueObject;

class UserId
{
    private string $value;

    public function __construct(string $value)
    {
        // Validar formato
        if (empty($value)) {
            throw new \InvalidArgumentException("El ID no puede estar vacío.");
        }
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}
