<?php

namespace App\ValueObject;
use App\Exception\InvalidEmailException;

class Email
{
    private string $value;

    public function __construct(string $value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException();
        }
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }
}
