<?php

namespace App\Controller;

use App\Kernel\Controller\Controller;
use App\Kernel\View\View;

class MoviController extends Controller
{
    public function index(): void
    {
        $this->view('movies');
    }
}