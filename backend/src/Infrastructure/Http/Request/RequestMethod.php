<?php

namespace AscenderBlog\Infrastructure\Http\Request;

enum RequestMethod: string
{
    case DELETE = 'delete';
    case GET    = 'get';
    case PATCH  = 'patch';
    case POST   = 'post';
    case PUT    = 'put';
}
