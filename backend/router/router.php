<?php

use AscenderBlog\Infrastructure\Http\Request;
use AscenderBlog\Infrastructure\Http\Request\RequestMethod;
use AscenderBlog\Infrastructure\Http\Route\RouteRegistry;

$url = $_SERVER['REQUEST_URI'];
$method = RequestMethod::from(strtolower($_SERVER['REQUEST_METHOD']));
$rawBody = file_get_contents('php://input');
$body = json_decode($rawBody, true);

$request = new Request(
    method: $method,
    url: $url,
    body: $body,
    queryParameters: $_GET
);

/** @var RouteRegistry $registry */
$registry = require __DIR__ . '/routes.php';

$route = $registry->match($url, $method);

$return = $route->controller->{$route->method}($request);

if (is_array($return)) {
    header('Content-Type: application/json');
    $json = json_encode($return);

    if (!$json) {
        echo json_encode([
            'code' => 500,
            'message' => 'Internal server error.',
        ]);
    }

    echo $json;
    exit;
}

echo $return;
exit;