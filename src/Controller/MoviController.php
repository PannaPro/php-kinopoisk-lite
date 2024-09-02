<?php

namespace App\Controller;

use App\Kernel\Controller\Controller;
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

    public function create(): void
    {

        $validation = $this->request()->validate([
            'filmname' => ['require', 'min:3', 'max:255'],
        ]);

        if (!$validation) {
            dd($this->request()->errors());
        }
    }
}