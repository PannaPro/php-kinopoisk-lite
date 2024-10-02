<?php

namespace App\Controller\Admin;

use App\Kernel\Controller\Controller;
use App\Service\CategoryService;
use App\Service\MovieService;

class AdminController extends Controller
{
    public function index(): void
    {
        $categoryService = new CategoryService($this->db());
        $movieService = new MovieService($this->db());

        $categories = $categoryService->all();
        $movies = $movieService->all();

        $this->view('admin/index', ['categories' => $categories, 'movies' => $movies]);
    }
}