<?php

namespace App\Exception;

class InvalidEmailException extends \InvalidArgumentException
{
    public function __construct(
        string $message = "El email proporcionado no es válido.",
        int $code = 0,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
