<?php

declare(strict_types=1);

namespace AscenderBlog\Application\UseCase\Authentication\Register;

use AscenderBlog\Domain\Entity\User;

final readonly class RegisterOutputDTO
{
    public function __construct(public User $createdUser)
    {
    }
}