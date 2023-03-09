<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::apiResources([
    'companies' => CompanyController::class,
    'profiles' => ProfileController::class,
    'address' => AddressController::class,
    'customers' => CustomerController::class,
    'orders' => OrderController::class,
    'products' => ProductController::class,
]);
Route::delete('orders/{order_id}/product/{product_id}', [OrderController::class, 'deleteProductFromOrder']);