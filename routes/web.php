<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PhoneController;
use Illuminate\Support\Facades\Route;

Route::get('/about-store', function () {
    return view('about-store');
})->name('about.store');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/load-more', [HomeController::class, 'loadMore']);

// Untuk Smartphones
Route::get('phones/see-all', [PhoneController::class, 'seeAll'])->name('phones.see-all');
Route::get('/phones/{id}', [PhoneController::class, 'show'])->name('phones.show');
