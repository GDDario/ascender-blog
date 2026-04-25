<?php

namespace AscenderBlog\Infrastructure\Http\Controller;

use AscenderBlog\Application\UseCase\Authentication\Register\RegisterInputDTO;
use AscenderBlog\Application\UseCase\Authentication\Register\RegisterUseCase;
use AscenderBlog\Domain\Exception\DuplicatedValueException;
use AscenderBlog\Domain\Exception\InvalidPasswordException;
use AscenderBlog\Domain\Exception\InvalidValueObjectException;
use AscenderBlog\Domain\ValueObject\Email;
use AscenderBlog\Domain\ValueObject\Name;
use AscenderBlog\Domain\ValueObject\PlainPassword;
use AscenderBlog\Domain\ValueObject\Username;
use AscenderBlog\Infrastructure\Http\Controller;
use AscenderBlog\Infrastructure\Http\Request;
use AscenderBlog\Infrastructure\Presenter\DuplicatedValueErrorPresenter;
use AscenderBlog\Infrastructure\Presenter\RegistrationPresenter;

final readonly class AuthenticationController extends Controller
{
    /**
     * @throws InvalidPasswordException
     * @throws InvalidValueObjectException
     */
    public function register(Request $request): array
    {
        $registerUseCase = new RegisterUseCase();
        $presenter = new RegistrationPresenter();
        $duplicatedValueErrorPresenter = new DuplicatedValueErrorPresenter();

        try {
            $output = $registerUseCase->execute(
                new RegisterInputDTO(
                    username: new Username($request->body['username']),
                    name: new Name($request->body['name']),
                    email: new Email($request->body['email']),
                    password: new PlainPassword($request->body['password']),
                    passwordConfirmation: new PlainPassword($request->body['password_confirmation']),
                )
            );
        } catch (DuplicatedValueException $e) {
            return $duplicatedValueErrorPresenter->present($e->getMessage());
        }

        return $presenter->present($output->createdUser);
    }
}
