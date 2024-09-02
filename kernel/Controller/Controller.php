<?php

namespace App\Kernel\Controller;

use App\Kernel\Http\Request;
use App\Kernel\View\View;

abstract class Controller
{
    /**
     * @var View
     */
    private View $view;

    /**
     * @var Request
     */
    private Request $request;


    public function view(string $name): void
    {
        $this->view->page($name);
    }

    public function setView(View $view): void
    {
        $this->view = $view;
    }

    public function request(): Request
    {
        return $this->request;
    }

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }
}