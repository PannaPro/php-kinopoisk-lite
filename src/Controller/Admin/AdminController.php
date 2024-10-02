<?php

namespace App\Controller\Admin;

use App\Kernel\Controller\Controller;
use App\Service\CategoryService;

class AdminController extends Controller
{
    public function index(): void
    {
        $service = new CategoryService($this->db());

        $categories = $service->all();

        $this->view('admin/index', ['categories' => $categories]);
    }
}