<?php

namespace App\Controller;

use App\Kernel\Controller\Controller;
use App\Service\CategoryService;
use App\Service\MovieService;

class MovieController extends Controller
{
    private $movieService;

    private $categoryService;

    public function __construct()
    {
    }

    public function add(): void
    {
        $categories = $this->categoryService()->all();

        $this->view('admin/movie/add', ['categories' => $categories]);
    }

    public function create(): void
    {
        $file = $this->request()->file('image');

        $filePath = $file->move('movies');

        $this->storage()->url($filePath);

        $validation = $this->request()->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'description' => ['required'],
            'category' => ['required'],
        ]);

        if (!$validation) {
            foreach ($this->request()->errors() as $key => $errors) {
                $this->session()->set($key, $errors);
            }
            $this->redirect('admin/movies/add');
        }

        $this->movieService()->create($this->request(), $filePath);

        $this->redirect('admin');
    }

    /** Внедрить сервис контейнер */
    public function movieService(): MovieService
    {
        if (!isset($this->movieService)) {
            $this->movieService = new MovieService($this->db());
        }

        return $this->movieService;
    }

    public function categoryService(): CategoryService
    {
        if (!isset($this->categoryService)) {
            $this->categoryService = new CategoryService($this->db());
        }

        return $this->categoryService;
    }
}