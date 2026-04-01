<?php

declare(strict_types=1);

namespace AscenderBlog\Domain\ValueObject;

interface ValueObject
{
    public function getRealNameInWords(): string;
}