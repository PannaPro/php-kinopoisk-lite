<?php

namespace App\Controller\AuthController;

use App\Kernel\Controller\Controller;

class RegistryController extends Controller
{
    public function index(): void
    {
        $this->view('register');
    }

    public function registry(): void
    {
        $validation = $this->request()->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:user'],
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required'],
        ]);

        if (!$validation) {
            foreach ($this->request()->errors() as $key => $errors) {
                $this->session()->set($key, $errors);
            }
            $this->redirect('registry');
        }

        $this->db()->insert('user', [
            'name' => $this->request()->input('name'),
            'email' => $this->request()->input('email'),
            'password' => password_hash($this->request()->input('password'), PASSWORD_DEFAULT)
        ]);

        $this->redirect('/');
    }
}