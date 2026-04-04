<?php

declare(strict_types=1);

namespace AscenderBlog\Application\UseCase\Authentication\Register;

use AscenderBlog\Domain\ValueObject\Email;
use AscenderBlog\Domain\ValueObject\Password;

final readonly class RegisterInputDTO
{
    public function __construct(
        public string $name,
        public Email $email,
        public Password $password,
        public Password $passwordConfirmation,
    )
    {
    }
}