<?php

namespace App\Exception;

class UserAlreadyExistsException extends \InvalidArgumentException
{
    public function __construct(
        string $message = "El email ya se encuentra registrado.",
        int $code = 0,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
