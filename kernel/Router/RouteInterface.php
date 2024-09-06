<?php

namespace App\Kernel\Router;

interface RouteInterface
{
    public static function get($uri, $action): static;

    public static function post($uri, $action): static;

    public function getUri(): string;

    public function getMethod(): string;

    public function getAction(): mixed;

}