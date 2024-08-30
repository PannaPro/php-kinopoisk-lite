<?php

namespace App;

use App\Http\Request;
use App\Router\Router;

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