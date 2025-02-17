<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FrontendController;

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('{id}', [ProductController::class, 'show'])->name('show');
        Route::get('{id}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('{id}', [ProductController::class, 'update'])->name('update');
        Route::delete('{id}', [ProductController::class, 'destroy'])->name('destroy');
    });

    // Cart routes
    Route::prefix('cart')->name('cart.')->group(function () {
        Route::post('/add', [CartController::class, 'addToCart'])->name('add');
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::delete('/remove/{cartItem}', [CartController::class, 'removeCartItem'])->name('remove');
        Route::patch('/update/{cartItem}', [CartController::class, 'updateCartItem'])->name('update');
        Route::delete('/clear', [CartController::class, 'clearCart'])->name('clear');
    });

    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::get('{id}', [CategoryController::class, 'show'])->name('show');
        Route::put('{id}', [CategoryController::class, 'update'])->name('update');
        Route::delete('{id}', [CategoryController::class, 'destroy'])->name('destroy');
    });
});

require __DIR__.'/auth.php';

Route::prefix('frontend')->name('frontend.')->group(function () {
    // Home and shopping routes
    Route::get('/eOshop', [FrontendController::class, 'home'])->name('index');
    Route::get('/shopping', [FrontendController::class, 'shop'])->name('shop');

    // Checkout routes
    Route::get('/checkout', [FrontendController::class, 'checkout'])->name('checkout');
    Route::post('/create-checkout-session', [CheckoutController::class, 'createCheckoutSession'])->name('checkout.session.create');
    Route::get('/checkout-success', [CheckoutController::class, 'checkoutSuccess'])->name('checkout.success');
    Route::get('/checkout-cancel', [CheckoutController::class, 'checkoutCancel'])->name('checkout.cancel');

    // Order routes
    Route::get('/order', [FrontendController::class, 'order'])->name('order');
    Route::get('/order/{id}', [FrontendController::class, 'showOrder'])->name('order.show');
});
