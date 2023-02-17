<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;


Route::apiResources([
    'companies' => CompanyController::class,
]);
