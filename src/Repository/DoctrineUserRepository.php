<?php

namespace App\Repository;

use App\Entity\User;
use App\ValueObject\UserId;
use App\ValueObject\Email;
use Doctrine\ORM\EntityManagerInterface;

class DoctrineUserRepository implements UserRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function findById(UserId $id): ?User
    {
        return $this->entityManager->find(User::class, $id->value());
    }

    public function delete(UserId $id): void
    {
        $user = $this->findById($id);
        if ($user) {
            $this->entityManager->remove($user);
            $this->entityManager->flush();
        }
    }
    public function findByEmail(Email $email): ?User
    {
        // Buscar la entidad User cuyo campo 'email' sea igual al valor del Value Object Email
        return $this->entityManager
            ->getRepository(User::class)
            ->findOneBy(['email' => $email->value()]);
    }
}
