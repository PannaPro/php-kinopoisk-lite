<?php

namespace App\Kernel\Router;

interface RouteInterface
{
    public static function get($uri, $action, $middleware = []): static;

    public static function post($uri, $action, $middleware = []): static;

    public function getUri(): string;

    public function getMethod(): string;

    public function getAction(): mixed;

    public function getMiddlewares(): array;

    public function hasMiddlewares(): bool;
}