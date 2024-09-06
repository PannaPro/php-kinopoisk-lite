<?php

namespace App\Controller;

use App\Kernel\Controller\Controller;
use App\Kernel\Http\Redirect;
use App\Kernel\Http\Request;
use App\Kernel\Validator\Validator;

class MoviController extends Controller
{
    public function index(): void
    {
        $this->view('pages/movies/movies');
    }

    public function add(): void
    {
        $this->view('pages/movies/add');
    }

    public function create()
    {
        $validation = $this->request()->validate([
            'filmname' => ['required', 'min:3', 'max:255'],
        ]);

        if (!$validation) {
            foreach ($this->request()->errors() as $key => $errors) {
                $this->session()->set($key, $errors);
            }
            $this->redirect('movies/add');
        }

        echo 'Created successfully';
    }
}