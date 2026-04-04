<?php

declare(strict_types=1);

namespace AscenderBlog\Application\UseCase\Authentication\Register;


use AscenderBlog\Infrastructure\Persistence\Pdo\Repository\PdoUserRepository;

final readonly class RegisterUseCase
{
    private PdoUserRepository $repository;

    public function __construct()
    {
        $this->repository = new PdoUserRepository();
    }

    public function execute(RegisterInputDTO $input): RegisterOutputDTO
    {


        return new RegisterOutputDTO($user, $token);
    }
}