<?php

namespace App\Kernel\Router;

class Route implements RouteInterface
{
    public function __construct(
        private string $uri,
        private string $method,
        private $action,
        private array $middlewares = []
    )
    {
    }

    /**
     * @param $uri
     * @param $action
     * @param array $middlewares
     * @return static
     */
    public static function get($uri, $action, $middlewares = []): static
    {
        return new static($uri, 'GET', $action, $middlewares);
    }

    /**
     * @param $uri
     * @param $action
     * @param array $middlewares
     * @return static
     */
    public static function post($uri, $action, $middlewares = []): static
    {
        return new static($uri, 'POST', $action, $middlewares);
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return mixed
     */
    public function getAction(): mixed
    {
        return $this->action;
    }

    /**
     * @return bool
     */
    public function hasMiddlewares(): bool
    {
        return !empty($this->middlewares);
    }

    /**
     * @return array
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}