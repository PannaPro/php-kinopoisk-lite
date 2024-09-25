<?php

use App\Controller\AuthController\RegistryController;
use App\Controller\HomeController;
use App\Kernel\Router\Route;

return [
    Route::get('/', [HomeController::class, 'index']),
    Route::get('/registry', [RegistryController::class, 'index']),
    Route::post('/registry', [RegistryController::class, 'registry']),
];