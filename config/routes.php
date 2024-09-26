<?php

use App\Controller\Admin\AdminController;
use App\Controller\AuthController\LoginController;
use App\Controller\AuthController\RegistryController;
use App\Controller\HomeController;
use App\Controller\Movies\CategoryController;
use App\Kernel\Router\Route;

return [
    Route::get('/', [HomeController::class, 'index']),

    Route::get('/registry', [RegistryController::class, 'index']),
    Route::post('/registry', [RegistryController::class, 'registry']),
    Route::get('/login', [LoginController::class, 'index']),
    Route::post('/login', [LoginController::class, 'login']),
    Route::post('/logout', [LoginController::class, 'logout']),

    Route::get('/admin', [AdminController::class, 'index']),
    Route::get('/admin/category/add', [CategoryController::class, 'index']),
    Route::post('/admin/category/add', [CategoryController::class, 'create']),
    Route::get('/admin/categories/update', [CategoryController::class, 'edit']),
    Route::post('/admin/categories/update', [CategoryController::class, 'update']),
    Route::post('/admin/categories/delete', [CategoryController::class, 'remove']),
];