<?php

namespace AscenderBlog\Infrastructure\Http;

use AscenderBlog\Infrastructure\Http\Request\RequestMethod;
use Exception;
use ReflectionClass;
use ReflectionException;

final class RouteRegistry
{
    /** @var Route[] */
    public array $routes;

    public function __construct()
    {

    }

    public function get(string $path, string $controller, string $method): void
    {
        $this->addRoute($path, $controller, $method, RequestMethod::GET);
    }

    public function post(string $path, string $controller, string $method): void
    {
        $this->addRoute($path, $controller, $method, RequestMethod::POST);
    }

    public function put(string $path, string $controller, string $method): void
    {
        $this->addRoute($path, $controller, $method, RequestMethod::PUT);
    }

    public function patch(string $path, string $controller, string $method): void
    {
        $this->addRoute($path, $controller, $method, RequestMethod::PATCH);
    }

    public function delete(string $path, string $controller, string $method): void
    {
        $this->addRoute($path, $controller, $method, RequestMethod::DELETE);
    }

    public function addRoute(
        string        $path,
        string        $controller,
        string        $method,
        RequestMethod $requestMethod
    ): void
    {
        try {
        $reflection = new ReflectionClass($controller);
        /** @var Controller $instance */
        $instance = $reflection->newInstance();
        } catch (ReflectionException $e) {
            throw new ControllerException('Controller not found.');
        }

        $route = new Route(
            $path,
            $instance,
            $method,
            $requestMethod
        );

        $this->routes[] = $route;
    }

    /**
     * @throws Exception
     */
    public function match(string $url, RequestMethod $method): Route
    {
        $routes = $this->routes;

        foreach ($routes as $index => $route) {
            if ($route->path === $url && $route->requestMethod === $method) {
                return $route;
            }

            // TODO: find routes by parameters, like /{id}
        }

        throw new Exception('No route matches the given URL');
    }

//    private function matchResources(string $url, RequestMethod $method, Route $route, array $resources): Route|null
//    {
//        foreach ($resources as $resource) {
//            if ($route->path === $url && $route->requestMethod === $method) {
//                return $route;
//            }
//
//        }
//
//        return null;
//    }
}