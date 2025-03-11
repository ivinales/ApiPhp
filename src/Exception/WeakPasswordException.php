<?php

namespace App\Exception;

class WeakPasswordException extends \InvalidArgumentException
{
    public function __construct(
        string $message = "La contraseña no cumple con la política de seguridad.",
        int $code = 0,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
