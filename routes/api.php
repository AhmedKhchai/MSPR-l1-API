<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CustomerController;


Route::apiResources([
    'companies' => CompanyController::class,
    'profiles' => ProfileController::class,
    'address' => AddressController::class,
    'customers' => CustomerController::class,
]);
