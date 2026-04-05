<?php

declare(strict_types=1);

namespace AscenderBlog\Infrastructure\Uuid;

use AscenderBlog\Domain\Service\Uuid\UuidService;
use AscenderBlog\Domain\ValueObject\Uuid;
use Ramsey\Uuid\Uuid as RamseyUuid;

final readonly class RamseyUuidService implements UuidService
{
    public function generate(): Uuid
    {
        return new Uuid(RamseyUuid::uuid7()->toString());
    }

    public function validate(Uuid $uuid): bool
    {
        return RamseyUuid::isValid($uuid->toString());
    }
}