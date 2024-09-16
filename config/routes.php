<?php

use App\Controller\AuthController\LoginController;
use App\Controller\AuthController\RegistryController;
use App\Controller\HomeController;
use App\Controller\MoviController;
use App\Kernel\Router\Route;

return [
    Route::get('/home', [HomeController::class, 'index']),
    Route::get('/movies', [MoviController::class, 'index']),
    Route::get('/movies/add', [MoviController::class, 'add']),
    Route::post('/movies/add', [MoviController::class, 'create']),

    Route::get('/registry', [RegistryController::class, 'index']),
    Route::post('/registry', [RegistryController::class, 'registry']),
    Route::get('/login', [LoginController::class, 'index']),
    Route::post('/login', [LoginController::class, 'login']),
];