<?php

namespace App\Kernel\Router;

class Route implements RouteInterface
{
    public function __construct(
        private string $uri,
        private string $method,
        private $action,
    )
    {
    }

    /**
     * @param $uri
     * @param $action
     * @return static
     */
    public static function get($uri, $action): static
    {
        return new static($uri, 'GET', $action);
    }

    /**
     * @param $uri
     * @param $action
     * @return static
     */
    public static function post($uri, $action): static
    {
        return new static($uri, 'POST', $action);
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
}