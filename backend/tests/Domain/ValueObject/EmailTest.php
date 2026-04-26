<?php

declare(strict_types=1);

namespace Test\Domain\ValueObject;

use AscenderBlog\Domain\Exception\InvalidValueObjectException;
use AscenderBlog\Domain\ValueObject\Email;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class EmailTest extends TestCase
{
    #[DataProvider('validEmailProvider')]
    public function test_can_create_email_with_valid_values(string $value): void
    {
        $email = new Email($value);

        $this->assertSame($value, $email->toString());
    }

    #[DataProvider('invalidEmailProvider')]
    public function test_cannot_create_email_with_invalid_values(string $value): void
    {
        $this->expectException(InvalidValueObjectException::class);

        new Email($value);
    }

    public function test_returns_email_real_name(): void
    {
        $email = new Email('john@doe.com');

        $this->assertSame('Email', $email->getRealNameInWords());
    }

    public static function validEmailProvider(): array
    {
        return [
            'simple' => ['john@doe.com'],
            'plus_alias' => ['john+blog@doe.com'],
            'subdomain' => ['john@mail.blog.dev'],
        ];
    }

    public static function invalidEmailProvider(): array
    {
        return [
            'missing_at_symbol' => ['johndoe.com'],
            'missing_domain' => ['john@'],
            'empty' => [''],
            'contains_spaces' => ['john doe@blog.com'],
        ];
    }
}
