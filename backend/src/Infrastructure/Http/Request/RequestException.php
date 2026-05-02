<?php

namespace AscenderBlog\Infrastructure\Http\Request;

use Exception;
use Throwable;

class RequestException extends Exception
{
    public const string MESSAGE = 'Malformed or invalid request.';

    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct(empty($message) ? self::MESSAGE : $message, $code, $previous);
    }
}
