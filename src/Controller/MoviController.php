<?php

namespace App\Controller;

class MoviController
{
    public function index(): void
    {
        include_once APP_PATH . '/template/movies.php';
    }
}