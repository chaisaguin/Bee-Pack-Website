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
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add_to_cart'])->name('cart.add');
Route::delete('/cart/remove/{rowId}', [CartController::class, 'removeItem'])->name('cart.remove');
Route::put('/cart/update/{rowId}', [CartController::class, 'updateQuantity'])->name('cart.update');
Route::post('/cart/increase/{rowId}', [CartController::class, 'increase_cart_quantity'])->name('cart.increase');
Route::post('/cart/decrease/{rowId}', [CartController::class, 'decrease_cart_quantity'])->name('cart.decrease');

// Checkout Routes
Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('/place-an-order', [CartController::class, 'place_an_order'])->name('cart.place-an-order');
Route::get('/order-confirmation/{orderId}', [CartController::class, 'order_confirmation'])->name('cart.order-confirmation');

// Feedback Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/feedback', [FrontendController::class, 'show_feedback'])->name('feedback');
    Route::post('/feedback', [FrontendController::class, 'submit_feedback'])->name('feedback.submit');
});

// Product Routes
Route::get('/product', [FrontendController::class, 'product'])->name('product');
Route::get('/product/{id}', [FrontendController::class, 'product'])->name('product');

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

Route::get('/test-mongodb', function () {
    try {
        $address = \App\Models\Address::first();
        return response()->json(['success' => true, 'data' => $address]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'error' => $e->getMessage()]);
    }
});