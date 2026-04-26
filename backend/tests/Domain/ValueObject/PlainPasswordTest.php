<?php

declare(strict_types=1);

namespace Test\Domain\ValueObject;

use AscenderBlog\Domain\Exception\InvalidValueObjectException;
use AscenderBlog\Domain\ValueObject\PlainPassword;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class PlainPasswordTest extends TestCase
{
    #[DataProvider('validPasswordProvider')]
    public function test_can_create_plain_password_with_valid_values(string $value): void
    {
        $password = new PlainPassword($value);

        $this->assertSame($value, $password->toString());
    }

    #[DataProvider('invalidPasswordProvider')]
    public function test_cannot_create_plain_password_with_invalid_values(string $value): void
    {
        $this->expectException(InvalidValueObjectException::class);

        new PlainPassword($value);
    }

    public function test_returns_password_real_name(): void
    {
        $password = new PlainPassword('Strong1!');

        $this->assertSame('Password', $password->getRealNameInWords());
    }

    public static function validPasswordProvider(): array
    {
        return [
            'minimum_length_with_requirements' => ['Strong1!'],
            'longer_password' => ['MyS3cure_P@ssword'],
            'mixed_special_characters' => ['AAaa11@@'],
        ];
    }

    public static function invalidPasswordProvider(): array
    {
        return [
            'too_short' => ['Aa1!abc'],
            'missing_uppercase' => ['password1!'],
            'missing_number' => ['Password!'],
            'missing_special_character' => ['Password1'],
        ];
    }
}
