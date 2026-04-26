<?php

declare(strict_types=1);

namespace AscenderBlog\Domain\Entity;

use AscenderBlog\Domain\Exception\EntityValidationException;
use AscenderBlog\Domain\ValueObject\Email;
use AscenderBlog\Domain\ValueObject\Name;
use AscenderBlog\Domain\ValueObject\Username;
use AscenderBlog\Domain\ValueObject\Uuid;
use DateTime;

final readonly class User
{
    public function __construct(
        public Uuid      $id,
        public Username  $username,
        public Name      $name,
        public Email     $email,
        public ?string   $password = null,
        public ?DateTime $createdAt = null
    ) {
    }

    public function validateForCreation(): void
    {
        if (empty($this->password)) {
            throw new EntityValidationException('Password at cannot be null.');
        }
    }
}
