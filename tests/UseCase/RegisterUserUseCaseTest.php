<?php

namespace Tests\UseCase;

use PHPUnit\Framework\TestCase;
use App\UseCase\RegisterUserUseCase;
use App\Repository\UserRepositoryInterface;
use App\DTO\RegisterUserRequest;
use App\Exception\UserAlreadyExistsException;
use App\ValueObject\Email;
use App\Entity\User;
use App\ValueObject\UserId;
use App\ValueObject\Name;
use App\ValueObject\Password;

class RegisterUserUseCaseTest extends TestCase
{
    public function testExecuteThrowsExceptionIfEmailExists(): void
    {
        /** 
         * @var \App\Repository\UserRepositoryInterface&\PHPUnit\Framework\MockObject\MockObject 
         */
        $repositoryMock = $this->createMock(UserRepositoryInterface::class);
        // Simular que el repositorio encuentra un usuario
        $repositoryMock->method('findByEmail')->willReturn( new User(
            new UserId('some-id'),
            new Name('somename'),
            new Email('Juan@example.com'),
            new Password('Secret123!')
        ));

        $useCase = new RegisterUserUseCase($repositoryMock);

        $request = new RegisterUserRequest('Patricio Andana', 'patricio@example.com', 'Asdfg123!');

        $this->expectException(UserAlreadyExistsException::class);
        $useCase->execute($request);
    }

    public function testExecuteSavesUserIfEmailNotFound(): void
    {
        /** 
         * @var \App\Repository\UserRepositoryInterface&\PHPUnit\Framework\MockObject\MockObject 
         */
        $repositoryMock = $this->createMock(UserRepositoryInterface::class);
        // Simular que el repositorio NO encuentra un usuario
        $repositoryMock->method('findByEmail')->willReturn(null);

        // Esperar que "save" sea llamado UNA vez
        $repositoryMock->expects($this->once())->method('save');

        $useCase = new RegisterUserUseCase($repositoryMock);

        $request = new RegisterUserRequest('Patricio Andana', 'patricio@example.com', 'Asdfg123!');
        $useCase->execute($request);

        // Si no lanza excepción, consideramos que el test pasa
        $this->assertTrue(true);
    }
}
