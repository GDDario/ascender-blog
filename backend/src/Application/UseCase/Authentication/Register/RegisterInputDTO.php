<?php

declare(strict_types=1);

namespace AscenderBlog\Application\UseCase\Authentication\Register;

use AscenderBlog\Domain\ValueObject\Email;
use AscenderBlog\Domain\ValueObject\Name;
use AscenderBlog\Domain\ValueObject\PlainPassword;
use AscenderBlog\Domain\ValueObject\Username;

final readonly class RegisterInputDTO
{
    public function __construct(
        public Username      $username,
        public Name          $name,
        public Email         $email,
        public PlainPassword $password,
        public PlainPassword $passwordConfirmation,
    )
    {
    }
}