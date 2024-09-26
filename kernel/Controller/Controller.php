<?php

namespace App\Kernel\Controller;

use App\Kernel\Auth\AuthInterface;
use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Http\RedirectInterface;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Session\SessionInterface;
use App\Kernel\Storage\StorageInterface;
use App\Kernel\View\View;
use App\Kernel\View\ViewInterface;
use Exception;

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

    /**
     * @var AuthInterface
     */
    private AuthInterface $auth;

    /**
     * @var StorageInterface
     */
    private StorageInterface $storage;

    /**
     * @param string $name
     * @param array $data
     * @return void
     * @throws Exception
     */
    public function view(string $name, array $data = []): void
    {
        $this->view->page($name, $data);
    }

    /**
     * @param ViewInterface $view
     * @return void
     */
    public function setView(ViewInterface $view): void
    {
        $this->view = $view;
    }

    /**
     * @return RequestInterface|null
     */
    public function request(): ?RequestInterface
    {
        return $this->request;
    }

    /**
     * @param RequestInterface $request
     * @return void
     */
    public function setRequest(RequestInterface $request): void
    {
        $this->request = $request;
    }

    /**
     * @param RedirectInterface $redirect
     * @return void
     */
    public function setRedirect(RedirectInterface $redirect): void
    {
        $this->redirect = $redirect;
    }

    /**
     * @param string $url
     * @return void
     */
    public function redirect(string $url): void
    {
        $this->redirect->to($url);
    }

    /**
     * @param SessionInterface $session
     * @return void
     */
    public function setSession(SessionInterface $session): void
    {
        $this->session = $session;
    }

    /**
     * @return SessionInterface|null
     */
    public function session(): ?SessionInterface
    {
        return $this->session;
    }

    /**
     * @param DatabaseInterface $database
     * @return void
     */
    public function setDatabase(DatabaseInterface $database): void
    {
        $this->database = $database;
    }

    /**
     * @return DatabaseInterface|null
     */
    public function db(): ?DatabaseInterface
    {
        return $this->database;
    }

    /**
     * @param AuthInterface $auth
     * @return void
     */
    public function setAuth(AuthInterface $auth): void
    {
        $this->auth = $auth;
    }

    /**
     * @return AuthInterface|null
     */
    public function auth(): ?AuthInterface
    {
        return $this->auth;
    }

    /**
     * @return StorageInterface
     */
    public function storage(): StorageInterface
    {
        return $this->storage;
    }

    /**
     * @param StorageInterface $storage
     */
    public function setStorage(StorageInterface $storage): void
    {
        $this->storage = $storage;
    }
}