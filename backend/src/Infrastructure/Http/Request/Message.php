<?php

namespace AscenderBlog\Infrastructure\Http\Request;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;

class Message implements MessageInterface
{
    public array $headers = [];
    public ProtocolVersion $protocolVersion;

    public function __construct()
    {
        $serverProtocol = $_SERVER['SERVER_PROTOCOL'];
        $serverProtocol = str_replace('HTTP/', '', $serverProtocol);

        $this->protocolVersion = ProtocolVersion::from($serverProtocol);
    }

    public function getProtocolVersion(): string
    {
        return $this->protocolVersion->value;
    }

    public function withProtocolVersion(string $version): MessageInterface
    {
        if (!$this->protocolVersion = ProtocolVersion::tryFrom($version)) {
            throw new RequestException('Invalid http code.');
        }

        return $this;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function hasHeader(string $name): bool
    {
        return $this->getOriginalHeaderKey($name);
    }

    public function getHeader(string $name): array
    {
        $headerKey = $this->getOriginalHeaderKey($name);


        if ($headerKey !== false) {
            return $this->headers[$headerKey];
        }

        return [];
    }

    public function getHeaderLine(string $name): string
    {
        $headerKey = $this->getOriginalHeaderKey($name);

        if ($headerKey !== false) {
            return implode(', ', $this->headers[$headerKey]);
        }

        return '';
        // TODO: Implement getHeaderLine() method.
    }

    public function withHeader(string $name, $value): MessageInterface
    {
        $headerKey = $this->getOriginalHeaderKey($name);

        if ($headerKey !== false) {
            if (is_array($value)) {
                $this->headers[$headerKey] = $value;
            } else {
                $this->headers[$headerKey] = [$value];
            }
        } else {
            if (is_array($value)) {
                $this->headers[$name] = $value;
            } else {
                $this->headers[$name] = [$value];
            }
        }

        return $this;
    }

    public function withAddedHeader(string $name, $value): MessageInterface
    {
        $headerKey = $this->getOriginalHeaderKey($name);

        if ($headerKey !== false && !in_array($value, $this->headers[$headerKey], true)) {
            if (is_array($value)) {
                $this->headers[$headerKey] = array_unique([...$this->headers[$headerKey], ...$value]);
            } else {
                array_push($this->headers[$headerKey], $value);
            }
        }

        return $this;
    }

    public function withoutHeader(string $name): MessageInterface
    {
        $headerKey = $this->getOriginalHeaderKey($name);

        if ($headerKey !== false) {
            unset($this->headers[$headerKey]);
        }

        return $this;
    }

    public function getBody(): StreamInterface
    {
        // TODO: Implement getBody() method.
    }

    public function withBody(StreamInterface $body): MessageInterface
    {
        // TODO: Implement withBody() method.
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
