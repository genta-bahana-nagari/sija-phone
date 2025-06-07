<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;

// Beranda
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/load-more', [HomeController::class, 'loadMore'])->name('home.loadMore');

// Informasi Toko
Route::view('/about-store', 'about-store')->name('about.store');

// Guest routes: hanya bisa diakses oleh user yang belum login (guest)
Route::middleware('guest')->group(function () {
    // Auth
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login')->middleware('guest');
    
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register')->middleware('guest');
    
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/register', [RegisterController::class, 'register']);
});

// Group route untuk user yang sudah login (auth)
Route::middleware(['auth'])->group(function () {
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Change Password
    Route::get('/profile/change-password', [ProfileController::class, 'editPassword'])->name('profile.password');
    Route::post('/profile/change-password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Produk (Smartphones)
    Route::prefix('phones')->group(function () {
        Route::get('/see-all', [PhoneController::class, 'seeAll'])->name('phones.see-all');
        Route::get('/{id}', [PhoneController::class, 'show'])->name('phones.show');
    });

    // History
    Route::get('/orders/history', [CheckoutController::class, 'orderHistory'])->name('orders.history');
    Route::get('/orders/history/{order}', [CheckoutController::class, 'show'])->name('orders.show');
    Route::patch('/orders/history/{order}/cancel', [CheckoutController::class, 'cancel'])->name('orders.cancel');
    
    // Checkout
    Route::prefix('checkout')->group(function () {
        Route::get('/', [CheckoutController::class, 'index'])->name('checkout');
        Route::post('/', [CheckoutController::class, 'store'])->name('checkout.store');
        Route::post('/from-product', [CheckoutController::class, 'checkoutFromProduct'])->name('checkout.fromProduct');
    }); 
});