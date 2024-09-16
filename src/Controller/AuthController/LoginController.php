<?php

namespace App\Controller\AuthController;

use App\Kernel\Controller\Controller;

class LoginController extends Controller
{
    public function index(): void
    {
        $this->view('pages/auth/login');
    }

    public function login(): void
    {
        $this->auth()->attempt(
            $this->request()->input('email'),
            $this->request()->input('password')
        );

        $this->redirect('home');
    }
}