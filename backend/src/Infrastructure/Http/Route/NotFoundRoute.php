<?php

declare(strict_types=1);

namespace AscenderBlog\Infrastructure\Http\Route;

use AscenderBlog\Infrastructure\Http\Controller;
use AscenderBlog\Infrastructure\Http\Request\RequestMethod;
use AscenderBlog\Infrastructure\Http\Route;

final readonly class NotFoundRoute extends Route
{
    public static function build(): Route
    {
        $controller = new NotFoundController();

        return new Route(
            '/404',
            $controller,
            'index',
            RequestMethod::GET
        );
    }
}

final readonly class NotFoundController extends Controller
{
    public function index(): array
    {
        echo 'Not found';

        return [
            'error' => 404,
            'message' => 'Resource not found.',
        ];
    }
}