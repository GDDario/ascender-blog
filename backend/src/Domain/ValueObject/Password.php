<?php

declare(strict_types=1);

namespace AscenderBlog\Domain\ValueObject;

use AscenderBlog\Domain\Exception\InvalidValueObjectException;

final  class Password implements ValueObject
{
    private const string REAL_NAME_IN_WORDS = 'Password';

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
        if (strlen($value) < 8) {
            throw new InvalidValueObjectException('Password must be at least 8 characters');
        }

        if (!preg_match('/[A-Z]/', $value)) {
            throw new InvalidValueObjectException('Password must contain uppercase letter');
        }

        if (!preg_match('/[0-9]/', $value)) {
            throw new InvalidValueObjectException('Password must contain a number');
        }

        if (!preg_match('/[\W_]/', $value)) {
            throw new InvalidValueObjectException('Password must contain at least one special character');
        }
    }

    public function getRealNameInWords(): string
    {
        return self::REAL_NAME_IN_WORDS;
    }
}