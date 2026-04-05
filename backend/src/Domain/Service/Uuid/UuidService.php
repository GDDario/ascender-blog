<?php

declare(strict_types=1);

namespace AscenderBlog\Domain\Service\Uuid;

use AscenderBlog\Domain\ValueObject\Uuid;

interface UuidService
{
    public function generate(): Uuid;

    public function validate(Uuid $uuid): bool;
}