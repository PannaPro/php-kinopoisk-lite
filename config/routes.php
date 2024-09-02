<?php

use App\Controller\HomeController;
use App\Controller\MoviController;
use App\Kernel\Router\Route;

return [
    Route::get('/home', [HomeController::class, 'index']),
    Route::get('/movies', [MoviController::class, 'index']),
    Route::get('/movies/add', [MoviController::class, 'add']),
    Route::post('/movies/add', [MoviController::class, 'create']),
];