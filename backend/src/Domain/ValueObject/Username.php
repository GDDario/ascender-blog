<?php

declare(strict_types=1);

namespace AscenderBlog\Domain\ValueObject;

use AscenderBlog\Domain\Exception\InvalidValueObjectException;

final class Username implements ValueObject
{
    private const string REAL_NAME_IN_WORDS = 'Username';

    /**
     * @throws InvalidValueObjectException
     */
    public function __construct(
        public string $value
    ) {
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
            throw new InvalidValueObjectException('Username must have at least 3 characters');
        }

        if (mb_strlen($value) > 32) {
            throw new InvalidValueObjectException('Username cannot exceed 32 characters');
        }

        if (!preg_match('/^[\p{L}\s\_]+$/u', $value)) {
            throw new InvalidValueObjectException('Username contains invalid characters');
        }

        $this->value = $value;
    }

    public function getRealNameInWords(): string
    {
        return self::REAL_NAME_IN_WORDS;
    }
}
