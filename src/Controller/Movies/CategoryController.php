<?php

namespace App\Controller\Movies;

use App\Kernel\Controller\Controller;
use App\Service\CategoryService;

class CategoryController extends Controller
{

    private $service;

    public function index(): void
    {
        $this->view('admin/category/index');
    }

    public function create(): void
    {
        $validation = $this->request()->validate([
            'name' => ['required', 'min:3', 'max:255']
        ]);

        if (!$validation) {
            foreach ($this->request()->errors() as $key => $errors) {
                $this->session()->set($key, $errors);
            }
            $this->redirect('admin/category/add');
        }

        $this->service()->create($this->request()->input('name'));

        $this->redirect('admin');
    }

    public function edit(): void
    {

        $id = $this->request()->input('id');

        $category = $this->service()->findCategory($id);

        $this->view('admin/category/update', ['category' => $category]);
    }

    public function update(): void
    {
        $validation = $this->request()->validate([
            'name' => ['required', 'min:3', 'max:255']
        ]);

        if (!$validation) {
            foreach ($this->request()->errors() as $key => $errors) {
                $this->session()->set($key, $errors);
            }

            $id = (int)$this->request()->input('id');
            $this->redirect("admin/categories/update?id=$id");
        }

        $this->service()->update(
            $this->request()->input('id'),
            $this->request()->input('name')
        );

        $this->redirect('admin');
    }

    public function remove(): void
    {
        $id = $this->request()->input('id');

        $this->service()->remove($id);

        $this->redirect('admin');
    }


    /** Внедрить сервис контейнер */
    public function service(): CategoryService
    {
        if (! isset($this->service)) {
            $this->service = new CategoryService($this->db());
        }

        return $this->service;
    }
}