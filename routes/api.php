<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;


Route::apiResources([
    'companies' => CompanyController::class,
]);
Route::apiResources([
    'profiles' => ProfileController::class,
]);
