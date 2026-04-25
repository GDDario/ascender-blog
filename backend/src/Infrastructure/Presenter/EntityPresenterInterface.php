<?php

declare(strict_types=1);

namespace AscenderBlog\Infrastructure\Presenter;

/**
 * @template T of object
 */
interface EntityPresenterInterface
{
    /**
     * @param T $entity
     */
    public function present(object $entity): array;
}
