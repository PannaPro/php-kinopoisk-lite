<?php

use App\Kernel\App;

define('APP_PATH', dirname(__DIR__));

require_once APP_PATH . '/vendor/autoload.php';

$app = new App();

$app->run();



// создать страницу с формой добавления фильмов
// создать обработчик пост запроса, роут и внедрить в контейнер зависимостей
