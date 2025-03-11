<?php

namespace Tests\ValueObject;

use PHPUnit\Framework\TestCase;
use App\ValueObject\UserId;

class UserIdTest extends TestCase
{
    public function testUserIdCreation(): void
    {
        $userId = new UserId('abcd1234');
        $this->assertEquals('abcd1234', $userId->value());
    }
}
