<?php

namespace AscenderBlog\Infrastructure\Http\Controller;

use AscenderBlog\Infrastructure\Http\Controller;

final readonly class TestController extends Controller
{
    public function index() {
        var_dump('Test');
    }
}