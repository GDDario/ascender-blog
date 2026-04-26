<?php

declare(strict_types=1);

namespace Test\Domain\ValueObject;

use AscenderBlog\Domain\Exception\InvalidValueObjectException;
use AscenderBlog\Domain\ValueObject\Username;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class UsernameTest extends TestCase
{
    #[DataProvider('validUsernameProvider')]
    public function test_can_create_username_with_valid_values(string $input, string $expected): void
    {
        $username = new Username($input);

        $this->assertSame($expected, $username->toString());
    }

    #[DataProvider('invalidUsernameProvider')]
    public function test_cannot_create_username_with_invalid_values(string $value): void
    {
        $this->expectException(InvalidValueObjectException::class);

        new Username($value);
    }

    public function test_returns_username_real_name(): void
    {
        $username = new Username('John_Doe');

        $this->assertSame('Username', $username->getRealNameInWords());
    }

    public static function validUsernameProvider(): array
    {
        return [
            'basic' => ['John_Doe', 'John_Doe'],
            'trimmed' => ['  John_Doe  ', 'John_Doe'],
            'with_spaces' => ['John Doe', 'John Doe'],
        ];
    }

    public static function invalidUsernameProvider(): array
    {
        return [
            'too_short' => ['Jo'],
            'too_long' => [str_repeat('a', 33)],
            'contains_number' => ['John2Doe'],
            'contains_hyphen' => ['John-Doe'],
            'only_spaces' => ['   '],
        ];
    }
}
