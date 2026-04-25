<?php

declare(strict_types=1);

namespace AscenderBlog\Domain\Exception;

use Exception;
use Throwable;

final class DuplicatedValueException extends Exception
{
    public const string MESSAGE = 'Value already exists.';

    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct(empty($message) ? self::MESSAGE : $message, $code, $previous);
    }

    public static function fromName(string $source, string $value): self
    {
        return new self("$source already has a value $value.");
    }
}
