<?php

namespace App\Kernel\Router;

use App\Kernel\Controller\Controller;
use App\Kernel\Http\RedirectInterface;
use App\Kernel\Http\RequestInterface;
use App\Kernel\Session\Session;
use App\Kernel\Session\SessionInterface;
use App\Kernel\View\View;
use App\Kernel\View\ViewInterface;

class Router implements RouterInterface
{
    private array $routes = [
        'GET' => [],
        'POST' => []
    ];

    public function __construct(
        private ViewInterface $view,
        private RequestInterface $request,
        private RedirectInterface $redirect,
        private SessionInterface $session
    )
    {
        $this->initRoutes();
    }

    /**
     * @return void
     */
    public function initRoutes(): void
    {
        $routes = $this->getRoutes();

        foreach ($routes as $route) {
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }
    }

    /**
     * @param string $uri
     * @param string $method
     * @return void
     */
    public function dispatch(string $uri, string $method): void
    {
        $route = $this->findRoute($uri, $method);
        if (!$route) {
            $this->notFound();
        }

        if (is_array($route->getAction())) {
            [$controller, $action] = $route->getAction();

            /** @var Controller $controller */
            $controller = new $controller();

            call_user_func([$controller, 'setView'], $this->view);
            call_user_func([$controller, 'setRedirect'], $this->redirect);
            call_user_func([$controller, 'setRequest'], $this->request);
            call_user_func([$controller, 'setSession'], $this->session);
            call_user_func([$controller, $action]);
        } else {
            call_user_func($route->getAction());
        }
    }

    /**
     * @return Route[]
     */
    private function getRoutes(): array
    {
        return require_once APP_PATH . '/config/routes.php';
    }

    /**
     * @param string $uri
     * @param string $method
     * @return Route|false
     */
    private function findRoute(string $uri, string $method): Route|false
    {
        if (!isset($this->routes[$method][$uri])) {
            return false;
        }

        return $this->routes[$method][$uri];
    }

    /**
     * @return void
     */
    private function notFound(): void
    {
        echo '404 not found';
        exit();
    }
}