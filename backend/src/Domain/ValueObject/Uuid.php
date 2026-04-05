<?php

declare(strict_types=1);

namespace AscenderBlog\Domain\ValueObject;

use AscenderBlog\Domain\Exception\InvalidValueObjectException;

final  class Uuid implements ValueObject
{
    private const string REAL_NAME_IN_WORDS = 'Uuid';

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
        if (!preg_match(
            '/^[0-9a-f]{8}-[0-9a-f]{4}-[1-8][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i',
            $value
        )) {
            throw InvalidValueObjectException::fromValueObject($this, $value);
        }
    }

    public function getRealNameInWords(): string
    {
        return self::REAL_NAME_IN_WORDS;
    }
}