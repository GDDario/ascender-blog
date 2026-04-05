<?php

declare(strict_types=1);

namespace AscenderBlog\Domain\Exception;

use AscenderBlog\Domain\ValueObject\ValueObject;
use Exception;
use Throwable;

final class InvalidPasswordException extends Exception
{
    public const string MESSAGE = 'Invalid password.';

    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct(empty($message) ? self::MESSAGE : $message, $code, $previous);
    }
}