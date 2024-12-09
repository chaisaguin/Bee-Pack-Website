<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CartController;
use Illuminate\Container\Attributes\Auth;

// Both '/' and '/home' will show the home page
Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/home', [FrontendController::class, 'home']);
Route::get('/shop', [FrontendController::class, 'shop'])->name('shop');
Route::get('/about', [FrontendController::class, 'about'])->name('about');

// Cart Routes
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

// Product Routes
Route::get('/product', [FrontendController::class, 'product'])->name('product');
Route::get('/product/{id}', [FrontendController::class, 'product'])->name('product');
Route::get('/test-mongodb', [ProductsController::class, 'testMongoDB']);

// Authentication Routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');

// Customer Account Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/account', [AuthController::class, 'account'])->name('customer.account');
    Route::put('/account/{customerId}', [AuthController::class, 'updateCustomer'])->name('customer.update');
    Route::post('/email/verification-notification/{customerId}', [AuthController::class, 'sendVerificationEmail'])
        ->name('verification.send');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/email/verify/{id}', [AuthController::class, 'verifyEmail'])
    ->name('verification.verify');

// product routes
    Route::post('/products', [ProductsController::class, 'store']);
    Route::put('/products/{id}', [ProductsController::class, 'update']);