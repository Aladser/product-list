<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';
Route::get('/', fn () => view('welcome'))->name('main');
Route::resource('/product', ProductController::class);
