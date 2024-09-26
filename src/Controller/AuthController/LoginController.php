<?php

namespace App\Controller\AuthController;

use App\Kernel\Controller\Controller;

class LoginController extends Controller
{
    public function index(): void
    {
        $this->view('login');
    }

    public function login(): void
    {
        $email = $this->request()->input('email');
        $password = $this->request()->input('password');

        if ($this->auth()->attempt($email, $password)) {
            $this->redirect('/');
        } else {
            $this->session()->set('error', 'Не верный логин или пароль');
            $this->redirect('/login');
        }
    }

    public function logout(): void
    {
        $this->auth()->logout();

        $this->redirect('/');
    }
}