<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';
Route::get('/', fn () => view('welcome'))->name('main');

// страница товаров
Route::get('/product', [ProductController::class, 'index'])->middleware(['auth'])->name('product');
// добавить товар
Route::post('/product', [ProductController::class, 'store']);
// удаление товара. Без $!!!
Route::delete('/product/{id}', [ProductController::class, 'destroy']);
// обновить товар
Route::post('/product/update', [ProductController::class, 'update']);

Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
