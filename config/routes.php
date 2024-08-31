<?php

use App\Controller\HomeController;
use App\Controller\MoviController;
use App\Kernel\Router\Route;

return [
    Route::get('/home', [HomeController::class, 'index']),
    Route::get('/movies', [MoviController::class, 'index']),
    Route::get('/test',
        function () {echo 'test';}
    )
];