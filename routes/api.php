<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api'])->group(function () {
    Route::controller(CompanyController::class)->group(function () {
        Route::get('/companies', 'index');
        Route::post('/companies', 'store');
        Route::get('/companies/{id}', 'show');
        Route::put('/companies/{id}', 'update');
        Route::delete('/companies/{id}', 'destroy');
    });
});

Route::middleware(['auth:api'])->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profiles', 'index');
        Route::post('/profiles', 'store');
        Route::get('/profiles/{id}', 'show');
        Route::put('/profiles/{id}', 'update');
        Route::delete('/profiles/{id}', 'destroy');
    });
});

Route::middleware(['auth:api'])->group(function () {
    Route::controller(AddressController::class)->group(function () {
        Route::get('/address', 'index');
        Route::post('/address', 'store');
        Route::get('/address/{id}', 'show');
        Route::put('/address/{id}', 'update');
        Route::delete('/address/{id}', 'destroy');
    });
});

Route::middleware(['auth:api'])->group(function () {
    Route::controller(CustomerController::class)->group(function () {
        Route::get('/customers', 'index');
        Route::post('/customers', 'store');
        Route::get('/customers/{id}', 'show');
        Route::put('/customers/{id}', 'update');
        Route::delete('/customers/{id}', 'destroy');
    });
});

Route::middleware(['auth:api'])->group(function () {
    Route::controller(OrderController::class)->group(function () {
        Route::get('/orders', 'index');
        Route::post('/orders', 'store');
        Route::get('/orders/{id}', 'show');
        Route::put('/orders/{id}', 'update');
        Route::delete('/orders/{id}', 'destroy');
    });
});

Route::middleware(['auth:api'])->group(function () {
    Route::controller(ProductController::class)->group(function () {
        Route::get('/products', 'index');
        Route::post('/products', 'store');
        Route::get('/products/{id}', 'show');
        Route::put('/products/{id}', 'update');
        Route::delete('/products/{id}', 'destroy');
    });
});

Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register');
    Route::get('/login', 'login');
    Route::get('/logout', 'logout');
});
