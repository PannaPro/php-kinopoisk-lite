<?php

namespace App\Kernel\View;

use Exception;

class View
{
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

        extract([
            'view' => $this
        ]);

        include_once $viewPath;
    }

    public function component(string $name): void
    {
        $componentPath =  APP_PATH . "/views/components/$name.php";

        if (!file_exists($componentPath)) {
            echo "Component $name not found";

            return;
        }

        include_once $componentPath;
    }
}