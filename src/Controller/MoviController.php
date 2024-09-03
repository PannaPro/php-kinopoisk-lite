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
            'filmname' => ['require', 'min:3', 'max:255'],
        ]);

        if (!$validation) {
            $this->redirect('movies/add');
        }
        dd($this->session());
    }
}