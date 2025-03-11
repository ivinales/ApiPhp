<?php

namespace App\UseCase;

use App\Entity\User;
use App\Repository\UserRepositoryInterface;
use App\ValueObject\UserId;
use App\ValueObject\Name;
use App\ValueObject\Email;
use App\ValueObject\Password;
use App\Event\UserRegisteredEvent;
use App\DTO\RegisterUserRequest;
use App\Exception\UserAlreadyExistsException;
use App\Event\UserRegisteredEventHandler;
use App\DTO\UserResponseDTO;

class RegisterUserUseCase
{
    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function execute(RegisterUserRequest $request): UserResponseDTO
    {
        // Validar si el email ya existe 
        if ($this->repository->findByEmail(new Email($request->getEmail()))) {  throw new UserAlreadyExistsException; }

        // Crear los Value Objects
        $userId = new UserId(md5(uniqid()));
        $name = new Name($request->getName());
        $email = new Email($request->getEmail());
        $password = new Password($request->getPassword());

        // Crear la entidad
        $user = new User($userId, $name, $email, $password);

        // Guardar el usuario
        $this->repository->save($user);

        // Disparar el evento de dominio
        $event = new UserRegisteredEvent($user);

         // Instanciar el handler
         $handler = new UserRegisteredEventHandler();

         // Llamar al método "handle" para simular envío de correo
         $handler->handle($event);

         return new UserResponseDTO(
            $user->getId(),
            $user->getName(),
            $user->getEmail(),
            $user->getCreatedAt()->format('Y-m-d H:i:s')
        );
    }
}
