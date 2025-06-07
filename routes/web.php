<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;

// Beranda & Informasi Umum
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/load-more', [HomeController::class, 'loadMore'])->name('home.loadMore');
Route::view('/about-store', 'about-store')->name('about.store');

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::view('/login', 'auth.login')->name('login');
    Route::view('/register', 'auth.register')->name('register');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/register', [RegisterController::class, 'register']);
});

// Authenticated User Routes
Route::middleware('auth')->group(function () {

    // Auth Actions
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Profile
    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', 'show')->name('show');
        Route::get('/edit', 'edit')->name('edit');
        Route::post('/', 'update')->name('update');
        Route::get('/change-password', 'editPassword')->name('password');
        Route::post('/change-password', 'updatePassword')->name('password.update');
    });

    // Produk (Smartphones)
    Route::prefix('phones')->name('phones.')->group(function () {
        Route::get('/see-all', [PhoneController::class, 'seeAll'])->name('see-all');
        Route::get('/{id}', [PhoneController::class, 'show'])->name('show');
    });

    // Keranjang
    Route::controller(CartController::class)->prefix('keranjang')->name('cart.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/tambah', 'add')->name('add');
        Route::delete('/{id}', 'remove')->name('remove');
    });

    // Checkout
    Route::controller(CheckoutController::class)->prefix('checkout')->name('checkout.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/', 'store')->name('store');
        Route::post('/from-product', 'checkoutFromProduct')->name('fromProduct');
        Route::post('/keranjang', 'fromCart')->name('cart'); // ← Bulk checkout dari keranjang
        Route::post('/keranjang/hapus-terpilih', [CartController::class, 'bulkDelete'])->name('cart.bulkDelete');
    });

    // History Pemesanan
    Route::controller(CheckoutController::class)->prefix('orders')->name('orders.')->group(function () {
        Route::get('/history', 'orderHistory')->name('history');
        Route::get('/history/{order}', 'show')->name('show');
        Route::patch('/history/{order}/cancel', 'cancel')->name('cancel');
    });
});
