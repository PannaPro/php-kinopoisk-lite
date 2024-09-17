<?php

namespace App\Kernel\View;

use App\Kernel\Auth\AuthInterface;
use App\Kernel\Session\SessionInterface;
use Exception;

class View implements ViewInterface
{
    public function __construct(
        private SessionInterface $session,
        private AuthInterface $auth,
    )
    {
    }

    /**
     * @param string $name
     * @throws Exception
     */
    public function page(string $name): void
    {
        $viewPath = APP_PATH . "/views/$name.php";

        if (!file_exists($viewPath)) {
            throw new Exception("View $name not found");
        }

        extract($this->defaultData());

        include_once $viewPath;
    }

    public function component(string $name): void
    {
        $componentPath =  APP_PATH . "/views/components/$name.php";

        if (!file_exists($componentPath)) {
            echo "Component $name not found";

            return;
        }

        extract($this->defaultData());

        include_once $componentPath;
    }

    private function defaultData(): array
    {
        return [
            'view' => $this,
            'session' => $this->session,
            'auth' => $this->auth,
        ];
    }
}