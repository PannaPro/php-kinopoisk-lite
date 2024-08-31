<?php

namespace App\Kernel\View;

class View
{
    private readonly string $name;

    public function page(string $name): void
    {
        include_once APP_PATH . "/template/$name.php";
    }
}