<?php

use App\Controller\AuthController\LoginController;
use App\Controller\AuthController\RegistryController;
use App\Controller\HomeController;
use App\Controller\MoviController;
use App\Kernel\Router\Route;
use App\Middleware\AuthMiddleware;
use App\Middleware\GuestMiddleware;

return [
    Route::get('/home', [HomeController::class, 'index']),
    Route::get('/movies', [MoviController::class, 'index']),
    Route::get('/movies/add', [MoviController::class, 'add'], [AuthMiddleware::class]),
    Route::post('/movies/add', [MoviController::class, 'create']),

    Route::get('/registry', [RegistryController::class, 'index'], [GuestMiddleware::class]),
    Route::post('/registry', [RegistryController::class, 'registry']),
    Route::get('/login', [LoginController::class, 'index'], [GuestMiddleware::class]),
    Route::post('/login', [LoginController::class, 'login']),
    Route::post('/logout', [LoginController::class, 'logout']),
];