<?php

namespace App\Controller;

class HomeController
{
    public function index(): void
    {
        include_once APP_PATH . '/template/home.php';
    }
}