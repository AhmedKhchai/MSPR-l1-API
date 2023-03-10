<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/forbidden', function () {
    $url = 'https://api.giphy.com/v1/gifs/random?api_key=PYcYN0MOPZjYsWlZMfSzLLrhiDu3Cvb8&tag=access+denied&rating=pg-13';
    $response = file_get_contents($url);
    $response = json_decode($response)->data->images->original->url;

    return view('forbidden', ['gif' => $response]);
});
