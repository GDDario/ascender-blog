<?php

namespace AscenderBlog\Infrastructure\Http\Controller;

use AscenderBlog\Application\UseCase\Authentication\Register\RegisterUseCase;
use AscenderBlog\Infrastructure\Http\Controller;
use PDO;

final readonly class AuthenticationController extends Controller
{
    public function register(): void
    {
        $registerUseCase = new RegisterUseCase();


    }
}