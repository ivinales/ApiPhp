<?php

use App\Exception\InvalidEmailException;
use PHPUnit\Framework\TestCase;
use App\ValueObject\Email;

class EmailTest extends TestCase
{
    public function testValidEmail()
    {
        $email = new Email("ian@example.com");
        $this->assertEquals("ian@example.com", $email->value());
    }

    public function testInvalidEmail()
    {
        $this->expectException(InvalidEmailException::class);
        new Email("ian-email");
    }
}
