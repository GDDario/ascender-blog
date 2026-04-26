<?php

namespace Test\Domain\Entiy;

use AscenderBlog\Domain\Entity\User;
use AscenderBlog\Domain\Exception\EntityValidationException;
use AscenderBlog\Domain\ValueObject\Email;
use AscenderBlog\Domain\ValueObject\Name;
use AscenderBlog\Domain\ValueObject\Username;
use AscenderBlog\Infrastructure\Uuid\RamseyUuidService;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function test_user_cannot_be_created_without_password(): void
    {
        $this->expectException(EntityValidationException::class);

        $uuidService = new RamseyUuidService();

        $user = new User(
            id: $uuidService->generate(),
            username: new Username('John_Doe'),
            name: new Name('John Doe'),
            email: new Email('john@doe.com'),
        );
        $user->validateForCreation();
    }
}
