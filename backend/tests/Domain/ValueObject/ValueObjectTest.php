<?php

declare(strict_types=1);

namespace Test\Domain\ValueObject;

use AscenderBlog\Domain\ValueObject\Email;
use AscenderBlog\Domain\ValueObject\Name;
use AscenderBlog\Domain\ValueObject\PlainPassword;
use AscenderBlog\Domain\ValueObject\Username;
use AscenderBlog\Domain\ValueObject\Uuid;
use AscenderBlog\Domain\ValueObject\ValueObject;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class ValueObjectTest extends TestCase
{
    #[DataProvider('valueObjectProvider')]
    public function test_value_objects_implement_contract(ValueObject $valueObject): void
    {
        $this->assertInstanceOf(ValueObject::class, $valueObject);
        $this->assertNotSame('', $valueObject->getRealNameInWords());
    }

    public static function valueObjectProvider(): array
    {
        return [
            'email' => [new Email('john@doe.com')],
            'name' => [new Name('John Doe')],
            'plain_password' => [new PlainPassword('Strong1!')],
            'username' => [new Username('John_Doe')],
            'uuid' => [new Uuid('123e4567-e89b-12d3-a456-426614174000')],
        ];
    }
}
