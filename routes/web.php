<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MovieController;

Route::get('/browse_employees', [EmployeeController::class, 'show']);
Route::get('/browse_movies', [MovieController::class, 'show']);


Route::get('/home', function () {
    return view('home'); // Corresponds to resources/views/home.blade.php
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/info', function () {
    phpinfo();
});

