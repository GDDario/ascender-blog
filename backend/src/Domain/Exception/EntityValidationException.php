<?php

declare(strict_types=1);

namespace AscenderBlog\Domain\Exception;

use Exception;
use Throwable;

final class EntityValidationException extends Exception
{
    public const string MESSAGE = 'Entity with bad data.';

    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct(empty($message) ? self::MESSAGE : $message, $code, $previous);
    }
}
