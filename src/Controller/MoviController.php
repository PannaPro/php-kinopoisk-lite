<?php

namespace App\Controller;

use App\Kernel\Controller\Controller;
use App\Kernel\Database\DatabaseInterface;

class MoviController extends Controller
{
    public function __construct()
    {
    }

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
        $file = $this->request()->file('image');

        $filePath = $file->move('movies');

        //Storage->url('movies/test.jpg');

        $validation = $this->request()->validate([
            'name' => ['required', 'min:3', 'max:255'],
        ]);

        if (!$validation) {
            foreach ($this->request()->errors() as $key => $errors) {
                $this->session()->set($key, $errors);
            }
            $this->redirect('movies/add');
        }
        $id = $this->db()->insert('movies', [
            'name' => $this->request()->input('name'),
            'genre' => $this->request()->input('genre')
        ]);

        $this->redirect('movies/add');
    }
}