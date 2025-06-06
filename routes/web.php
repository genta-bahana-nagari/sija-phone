<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PhoneController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/load-more', [HomeController::class, 'loadMore']);
Route::get('phones/see-all', [PhoneController::class, 'seeAll'])->name('phones.see-all');

