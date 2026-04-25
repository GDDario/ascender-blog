<?php

declare(strict_types=1);

namespace AscenderBlog\Application\UseCase\Authentication\Register;

use AscenderBlog\Domain\Entity\User;
use AscenderBlog\Domain\Exception\DuplicatedValueException;
use AscenderBlog\Domain\Exception\InvalidPasswordException;
use AscenderBlog\Domain\Exception\InvalidValueObjectException;
use AscenderBlog\Domain\Exception\ValueAlreadyExistsException;
use AscenderBlog\Domain\Service\Security\PasswordHasher;
use AscenderBlog\Domain\Service\Uuid\UuidService;
use AscenderBlog\Infrastructure\Persistence\Pdo\Repository\PdoUserRepository;
use AscenderBlog\Infrastructure\Presenter\DuplicatedValueErroPresenter;
use AscenderBlog\Infrastructure\Security\ArgonPasswordHasher;
use AscenderBlog\Infrastructure\Uuid\RamseyUuidService;

final readonly class RegisterUseCase
{
    private PdoUserRepository $repository;
    private UuidService $uuidService;
    private PasswordHasher $passwordHasher;

    public function __construct()
    {
        $this->repository = new PdoUserRepository();
        $this->uuidService = new RamseyUuidService();
        $this->passwordHasher = new ArgonPasswordHasher();
    }

    /**
     * @throws InvalidPasswordException
     * @throws InvalidValueObjectException
     * @throws DuplicatedValueException
     */
    public function execute(RegisterInputDTO $input): RegisterOutputDTO
    {
        if ($input->password->toString() !== $input->passwordConfirmation->toString()) {
            throw new InvalidPasswordException('Passwords do not match.');
        }

        $hash = $this->passwordHasher->hash($input->password->toString());

        $user = new User(
            id: $this->uuidService->generate(),
            username: $input->username,
            name: $input->name,
            email: $input->email,
            password: $hash
        );

        $createdUser = $this->repository->save($user);

        return new RegisterOutputDTO($createdUser);
    }
}
