<?php

namespace Jonas\Core\Router;

class Route
{
    private string $routesKey;
    private array $routes;

    public function __construct(array $routes)
    {
        $this->handler();
        $this->routes = $routes;
    }

    public function handler(): void
    {
        $pathInfo = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $method = $_SERVER["REQUEST_METHOD"];

        $this->routesKey = "$method|$pathInfo";
    }

    public function dispatch()
    {
        if (!array_key_exists($this->routesKey, $this->routes)) {
            http_response_code(404);
        }

        [$class, $method] = $this->routes[$this->routesKey];

        return $class->{$method}();
    }
}