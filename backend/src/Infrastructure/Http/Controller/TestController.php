<?php

namespace AscenderBlog\Infrastructure\Http\Controller;

use AscenderBlog\Infrastructure\Http\Controller;

final readonly class TestController extends Controller
{
    public function index(): void
    {
        var_dump('Test');
    }

    public function notFound(): void
    {
        var_dump('NOT FOUND METHOD');
    }
}