<?php

namespace AscenderBlog\Infrastructure\Http\Request;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;

class Request extends Message implements RequestInterface
{
    public array $headers = [];

    public function getRequestTarget(): string
    {
        // TODO: Implement getRequestTarget() method.
    }

    public function withRequestTarget(string $requestTarget): RequestInterface
    {
        // TODO: Implement withRequestTarget() method.
    }

    public function getMethod(): string
    {
        // TODO: Implement getMethod() method.
    }

    public function withMethod(string $method): RequestInterface
    {
        // TODO: Implement withMethod() method.
    }

    public function getUri(): UriInterface
    {
        // TODO: Implement getUri() method.
    }

    public function withUri(UriInterface $uri, bool $preserveHost = false): RequestInterface
    {
        // TODO: Implement withUri() method.
    }

    private function getOriginalHeaderKey(string|int $name): string|int|false
    {
        $loweredName = strtolower($name);

        $header = array_find(array_keys($this->headers), function ($key) use ($loweredName) {
            return $loweredName === strtolower($key);
        });

        return $header !== null ? $header : false;
    }
}
