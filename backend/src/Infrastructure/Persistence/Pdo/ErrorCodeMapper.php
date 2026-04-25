<?php

namespace AscenderBlog\Infrastructure\Persistence\Pdo;

final readonly class ErrorCodeMapper
{
    const mixed UNIQUE_KEY_VIOLATION = 23505;

    public static function isUniqueKeyViolation(mixed $errorCode): bool
    {
        return $errorCode == self::UNIQUE_KEY_VIOLATION;
    }
}
