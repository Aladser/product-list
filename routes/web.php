<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\PHPMailerController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';
Route::get('/', fn () => view('welcome'))->name('main');

Route::get('/product', [ProductController::class, 'index'])->middleware(['auth'])->name('product');
Route::post('/product', [ProductController::class, 'store']);
Route::post('/product/remove', [ProductController::class, 'destroy']);
Route::post('/product/update', [ProductController::class, 'update']);

Route::get("email", [PHPMailerController::class, "email"])->name("email");
Route::post("send-email", [PHPMailerController::class, "composeEmail"])->name("send-email");