<?php

namespace App\Kernel\Controller;

use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Http\RedirectInterface;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Session\SessionInterface;
use App\Kernel\View\View;
use App\Kernel\View\ViewInterface;

abstract class Controller
{
    /**
     * @var View
     */
    private ViewInterface $view;

    /**
     * @var RequestInterface
     */
    private RequestInterface $request;

    /**
     * @var RedirectInterface
     */
    private RedirectInterface $redirect;

    /**
     * @var SessionInterface
     */
    private SessionInterface $session;

    /**
     * @var DatabaseInterface
     */
    private DatabaseInterface $database;


    public function view(string $name): void
    {
        $this->view->page($name);
    }

    public function setView(ViewInterface $view): void
    {
        $this->view = $view;
    }

    public function request(): ?RequestInterface
    {
        return $this->request;
    }

    public function setRequest(RequestInterface $request): void
    {
        $this->request = $request;
    }

    public function setRedirect(RedirectInterface $redirect): void
    {
        $this->redirect = $redirect;
    }

    public function redirect(string $url): void
    {
       $this->redirect->to($url);
    }

    public function setSession(SessionInterface $session): void
    {
        $this->session = $session;
    }

    public function session(): ?SessionInterface
    {
        return $this->session;
    }

    public function setDatabase(DatabaseInterface $database): void
    {
       $this->database = $database;
    }

    public function db(): ?DatabaseInterface
    {
        return $this->database;
    }
}