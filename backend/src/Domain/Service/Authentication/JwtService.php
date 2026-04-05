<?php

declare(strict_types=1);

namespace AscenderBlog\Domain\Service\Authentication;

interface JwtService
{
    public function createToken();

    public function validateToken();

    public function issueToken();
}