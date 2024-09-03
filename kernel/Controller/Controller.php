<?php

namespace App\Kernel\Controller;

use App\Kernel\Http\Redirect;
use App\Kernel\Http\Request;
use App\Kernel\Session\Session;
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

    /**
     * @var Redirect
     */
    private Redirect $redirect;

    /**
     * @var Session
     */
    private Session $session;


    public function view(string $name): void
    {
        $this->view->page($name);
    }

    public function setView(View $view): void
    {
        $this->view = $view;
    }

    public function request(): ?Request
    {
        return $this->request;
    }

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    public function setRedirect(Redirect $redirect): void
    {
        $this->redirect = $redirect;
    }

    public function redirect(string $url): void
    {
       $this->redirect->to($url);
    }

    public function setSession(Session $session): void
    {
        $this->session = $session;
    }

    public function session(): ?Session
    {
        return $this->session;
    }
}