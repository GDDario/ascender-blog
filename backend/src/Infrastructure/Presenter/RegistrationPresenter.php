<?php

declare(strict_types=1);

namespace AscenderBlog\Infrastructure\Presenter;

use AscenderBlog\Domain\Entity\User;

final readonly class RegistrationPresenter implements PresenterInterface
{
    /**
     * @param object<User> $entity
     */
    public function present(object $entity): array
    {
        return [
            'message' => 'User registered successfully!',
            'data' => [
                'id' => $entity->id->toString(),
                'username' => $entity->username->toString(),
                'name' => $entity->name->toString(),
                'email' => $entity->email->toString(),
                'created_at' => $entity->createdAt->format('c')
            ],
        ];
    }
}