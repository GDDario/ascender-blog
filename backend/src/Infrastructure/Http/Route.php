<?php

namespace AscenderBlog\Infrastructure\Http;

use AscenderBlog\Infrastructure\Http\Request\RequestMethod;

readonly class Route
{
    public function __construct(
        public string $path,
        public Controller $controller,
        public string $method,
        public RequestMethod $requestMethod,
    )
    {
    }
}
