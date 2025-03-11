<?php

namespace App\Controller;

use App\UseCase\RegisterUserUseCase;
use App\Repository\DoctrineUserRepository;
use App\DTO\RegisterUserRequest;

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

$requestDto = new RegisterUserRequest(
    $data['name'] ?? '',
    $data['email'] ?? '',
    $data['password'] ?? ''
);

$repository = new DoctrineUserRepository($entityManager);
$useCase = new RegisterUserUseCase($repository);

try {
    $userResponseDto =$useCase->execute($requestDto);
    http_response_code(201);
    echo json_encode([
        "id"        => $userResponseDto->getId(),
        "name"      => $userResponseDto->getName(),
        "email"     => $userResponseDto->getEmail(),
        "createdAt" => $userResponseDto->getCreatedAt(),
    ]);
} catch (\Exception $e) {
    http_response_code(400);
    echo json_encode(["error" => $e->getMessage()]);
}
