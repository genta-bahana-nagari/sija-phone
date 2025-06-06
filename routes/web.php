<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\CheckoutController;

// Beranda
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/load-more', [HomeController::class, 'loadMore'])->name('home.loadMore');

// Informasi Toko
Route::view('/about-store', 'about-store')->name('about.store');

// Produk (Smartphones)
Route::prefix('phones')->group(function () {
    Route::get('/see-all', [PhoneController::class, 'seeAll'])->name('phones.see-all');
    Route::get('/{id}', [PhoneController::class, 'show'])->name('phones.show');
});

// Checkout
// web.php
Route::prefix('checkout')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::post('/from-product', [CheckoutController::class, 'checkoutFromProduct'])->name('checkout.fromProduct');
});