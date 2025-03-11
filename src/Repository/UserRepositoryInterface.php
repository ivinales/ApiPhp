<?php

namespace App\Repository;

use App\Entity\User;
use App\ValueObject\UserId;
use App\ValueObject\Email;

interface UserRepositoryInterface
{
    public function save(User $user): void;
    public function findById(UserId $id): ?User;
    public function delete(UserId $id): void;
    public function findByEmail(Email $email): ?User;

}
