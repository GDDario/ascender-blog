<?php

declare(strict_types=1);

namespace AscenderBlog\Domain\Entity;

final readonly class User
{
    public function __construct(
        public string $id,
        public string $username,
        public string $name,
        public string $email,
    )
    {
    }
}