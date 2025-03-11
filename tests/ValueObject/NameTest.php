<?php

namespace Tests\ValueObject;

use PHPUnit\Framework\TestCase;
use App\ValueObject\Name;

class NameTest extends TestCase
{
    public function testValidName(): void
    {
        $name = new Name('Ian Vinales');
        $this->assertEquals('Ian Vinales', $name->value());
    }

    public function testEmptyName(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Name('');
    }
}
