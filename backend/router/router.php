<?php

use AscenderBlog\Infrastructure\Http\Request;
use AscenderBlog\Infrastructure\Http\Request\RequestMethod;
use AscenderBlog\Infrastructure\Http\Route\RouteRegistry;

$url = $_SERVER['REQUEST_URI'];
$method = RequestMethod::from(strtolower($_SERVER['REQUEST_METHOD']));

$request = new Request(
    method: $method,
    url: $url,
    body: new stdClass,
    queryParameters: $_GET
);

/** @var RouteRegistry $registry */
$registry = require __DIR__ . '/routes.php';

$route = $registry->match($url, $method);

$return = $route->controller->{$route->method}();

if (is_array($return)) {
    $json = json_encode($return);

    if (!$json) {
        header('Content-Type: application/json');

        return [
            'code' => 500,
            'message' => 'Internal server error.',
        ];
    }

    exit;
}

echo $return;
exit;