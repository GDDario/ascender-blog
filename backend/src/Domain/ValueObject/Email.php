<?php

declare(strict_types=1);

namespace AscenderBlog\Domain\ValueObject;

use AscenderBlog\Domain\Exception\InvalidValueObjectException;

final  class Email implements ValueObject
{
    private const string REAL_NAME_IN_WORDS = 'Email';

    /**
     * @throws InvalidValueObjectException
     */
    public function __construct(
        public string $value
    )
    {
        $this->validate($value);
    }

    /**
     * @throws InvalidValueObjectException
     */
    private function validate(string $value): void
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw InvalidValueObjectException::fromValueObject($this, $value);
        }
    }

    public function getRealNameInWords(): string
    {
        return self::REAL_NAME_IN_WORDS;
    }
}