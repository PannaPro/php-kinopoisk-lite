<?php

namespace App\Controller\AuthController;

use App\Kernel\Controller\Controller;

class RegistryController extends Controller
{
    public function index(): void
    {
        $this->view('pages/auth/registry');
    }

    public function registry(): void
    {
        $validation = $this->request()->validate([
            'email' => ['required', 'email', 'unique:user'],
            'password' => ['required', 'min:8'],
        ]);

        if (!$validation) {
            foreach ($this->request()->errors() as $key => $errors) {
                $this->session()->set($key, $errors);
            }
            $this->redirect('registry');
        }

        $this->db()->insert('user', [
            'email' => $this->request()->input('email'),
            'password' => password_hash($this->request()->input('password'), PASSWORD_DEFAULT)
        ]);

        $this->redirect('home');
    }
}