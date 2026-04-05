<?php

declare(strict_types=1);

namespace AscenderBlog\Infrastructure\Security;

use AscenderBlog\Domain\Service\Security\PasswordHasher;

final readonly class ArgonPasswordHasher implements PasswordHasher
{
    public function hash(string $plain): string
    {
        return password_hash($plain, PASSWORD_ARGON2ID);
    }

    public function verify(string $plain, string $hash): bool
    {
        return password_verify($plain, $hash);
    }
}