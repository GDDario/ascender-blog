<?php

namespace AscenderBlog\Infrastructure\Http;

use AscenderBlog\Infrastructure\Http\Request\RequestMethod;
use stdClass;

final readonly class Request
{
    /** @var array{key: string, value: string} */
    public array $pathParameters;

    /**
     * @param array{key: string, value: string} $queryParameters
     */
    public function __construct(
        public RequestMethod $method,
        public string $url,
        public stdClass $body,
        public array $queryParameters
    )
    {
    }

    private function extractPathParametersFromUrl(): array
    {
        return [];
    }
}
