<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ProductsController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/browse_movies/', [MovieController::class, 'show']);

Route::get('/browse_products/', [ProductsController::class, 'show']);
