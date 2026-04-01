<?php

declare(strict_types=1);

namespace AscenderBlog\Domain\Exception;

use AscenderBlog\Domain\ValueObject\ValueObject;
use Exception;
use Throwable;

final class InvalidValueObjectException extends Exception
{
    public const string MESSAGE = 'Invalid value object';

    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct(empty($message) ? self::MESSAGE : $message, $code, $previous);
    }

    public static function fromValueObject(ValueObject $valueObject, string $incorrectValueString): self
    {
        return new self("$incorrectValueString is not a valid {$valueObject->getRealNameInWords()} value.");
    }
}