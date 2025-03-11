<?php

namespace Tests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\User;
use App\ValueObject\UserId;
use App\ValueObject\Name;
use App\ValueObject\Email;
use App\ValueObject\Password;

class UserTest extends TestCase
{
    public function testUserCreation(): void
    {
        $userId = new UserId('123456');
        $name = new Name('Juan Arena');
        $email = new Email('Juan@example.com');
        $password = new Password('Secret123!');
        
        $user = new User($userId, $name, $email, $password);
        
        $this->assertEquals('123456', $user->getId());
        $this->assertEquals('Juan Arena', $user->getName());
        $this->assertEquals('Juan@example.com', $user->getEmail());
        $this->assertNotNull($user->getCreatedAt());
    }
}
