<?php

declare(strict_types=1);

namespace AscenderBlog\Infrastructure\Presenter;

interface ErrorPresenterInterface
{
    public function present(string $message): array;
}
