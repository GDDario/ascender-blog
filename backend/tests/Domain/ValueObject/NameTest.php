<?php

declare(strict_types=1);

namespace Test\Domain\ValueObject;

use AscenderBlog\Domain\Exception\InvalidValueObjectException;
use AscenderBlog\Domain\ValueObject\Name;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class NameTest extends TestCase
{
    #[DataProvider('validNameProvider')]
    public function test_can_create_name_with_valid_values(string $input, string $expected): void
    {
        $name = new Name($input);

        $this->assertSame($expected, $name->toString());
    }

    #[DataProvider('invalidNameProvider')]
    public function test_cannot_create_name_with_invalid_values(string $value): void
    {
        $this->expectException(InvalidValueObjectException::class);

        new Name($value);
    }

    public function test_returns_name_real_name(): void
    {
        $name = new Name('John Doe');

        $this->assertSame('Name', $name->getRealNameInWords());
    }

    public static function validNameProvider(): array
    {
        return [
            'basic' => ['John Doe', 'John Doe'],
            'trimmed' => ['  John Doe  ', 'John Doe'],
            'unicode_letters' => ['Joao Silva', 'Joao Silva'],
        ];
    }

    public static function invalidNameProvider(): array
    {
        return [
            'too_short' => ['Jo'],
            'too_long' => [str_repeat('a', 256)],
            'contains_number' => ['John2 Doe'],
            'contains_symbol' => ['John@Doe'],
            'only_spaces' => ['   '],
        ];
    }
}
