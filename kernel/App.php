<?php

namespace App\Kernel;

use App\Kernel\Http\Request;
use App\Kernel\Router\Router;

class App
{
    /**
     * @return void
     */
    public function run(): void
    {
        $router = new Router();

        $request = Request::createFromGlobal();

        $router->dispatch($request->uri(), $request->method());
    }
}