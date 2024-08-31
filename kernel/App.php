<?php

namespace App\Kernel;

use App\Kernel\Container\Container;

class App
{
    private Container $container;

    public function __construct()
    {
        $this->container = new Container();
    }

    /**
     * @return void
     */
    public function run(): void
    {
        $this->container
            ->router
            ->dispatch(
            $this->container->request->uri(),
            $this->container->request->method()
        );
    }
}