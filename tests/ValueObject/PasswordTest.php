<?php

namespace Tests\ValueObject;

use App\Exception\WeakPasswordException;
use PHPUnit\Framework\TestCase;
use App\ValueObject\Password;

class PasswordTest extends TestCase
{
    public function testValidPassword(): void
    {
        $password = new Password('Contrasena123!');
        $this->assertNotEmpty($password->hash());
    }

    public function testInvalidPasswordTooShort(): void
    {
        $this->expectException(WeakPasswordException::class);
        new Password('short');
    }
}
