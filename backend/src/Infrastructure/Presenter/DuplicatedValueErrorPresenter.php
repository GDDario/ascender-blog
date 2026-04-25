<?php

declare(strict_types=1);

namespace AscenderBlog\Infrastructure\Presenter;

final readonly class DuplicatedValueErrorPresenter implements ErrorPresenterInterface
{
    public function present(string $message): array
    {
        return [
            'error' => 'Duplicated value error.',
            'message' => $message
        ];
    }
}
