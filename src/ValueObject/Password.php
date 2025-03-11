<?php

namespace App\ValueObject;
use App\Exception\WeakPasswordException;

class Password
{
    private string $value;

    public function __construct(string $value)
    {
        // Validación: mínimo 8 caracteres, al menos una letra mayúscula, un número y un carácter especial
        if (strlen($value) < 8 ||
            !preg_match('/[A-Z]/', $value) ||
            !preg_match('/[0-9]/', $value) ||
            !preg_match('/[\W]/', $value)) {
            throw new WeakPasswordException();
        }
        $this->value = $value;
    }

    public function hash(): string
    {
        return password_hash($this->value, PASSWORD_BCRYPT);
    }
}
