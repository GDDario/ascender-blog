<?php

namespace AscenderBlog\Infrastructure\Http\Controller;

use AscenderBlog\Application\UseCase\Authentication\Register\RegisterInputDTO;
use AscenderBlog\Application\UseCase\Authentication\Register\RegisterUseCase;
use AscenderBlog\Domain\Exception\InvalidPasswordException;
use AscenderBlog\Domain\Exception\InvalidValueObjectException;
use AscenderBlog\Domain\ValueObject\Email;
use AscenderBlog\Domain\ValueObject\Name;
use AscenderBlog\Domain\ValueObject\PlainPassword;
use AscenderBlog\Domain\ValueObject\Username;
use AscenderBlog\Infrastructure\Http\Controller;
use AscenderBlog\Infrastructure\Http\Request;

final readonly class AuthenticationController extends Controller
{
    /**
     * @throws InvalidPasswordException
     * @throws InvalidValueObjectException
     */
    public function register(Request $request): array
    {
        $registerUseCase = new RegisterUseCase();

        $output = $registerUseCase->execute(
            new RegisterInputDTO(
                username: new Username($request->body['username']),
                name: new Name($request->body['name']),
                email: new Email($request->body['email']),
                password: new PlainPassword($request->body['password']),
                passwordConfirmation: new PlainPassword($request->body['password_confirmation']),
            )
        );
        $createdUser = $output->createdUser;

        return [
            'id' => $createdUser->id->toString(),
            'username' => $createdUser->username->toString(),
            'name' => $createdUser->name->toString(),
            'email' => $createdUser->email->toString(),
            'created_at' => $createdUser->createdAt->format('c')
        ];
    }
}