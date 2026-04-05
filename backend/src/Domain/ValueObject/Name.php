<?php

declare(strict_types=1);

namespace AscenderBlog\Domain\ValueObject;

use AscenderBlog\Domain\Exception\InvalidValueObjectException;

final  class Name implements ValueObject
{
    private const string REAL_NAME_IN_WORDS = 'Name';

    /**
     * @throws InvalidValueObjectException
     */
    public function __construct(
        public string $value
    )
    {
        $this->validate($value);
    }

    public function toString(): string
    {
        return $this->value;
    }

    /**
     * @throws InvalidValueObjectException
     */
    private function validate(string $value): void
    {
        $value = trim($value);

        if (mb_strlen($value) < 3) {
            throw new InvalidValueObjectException('Name must have at least 3 characters');
        }

        if (mb_strlen($value) > 255) {
            throw new InvalidValueObjectException('Name cannot exceed 255 characters');
        }

        if (!preg_match('/^[\p{L}\s]+$/u', $value)) {
            throw new InvalidValueObjectException('Name contains invalid characters');
        }

        $this->value = $value;    }

    public function getRealNameInWords(): string
    {
        return self::REAL_NAME_IN_WORDS;
    }
}