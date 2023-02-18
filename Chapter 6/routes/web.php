<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductGalleryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');


Auth::routes();


Route::get('products/{id}/gallery', [ProductController::class, 'gallery'])->name('product.gallery');
Route::get('/products/{id}/galleries/create', [ProductGalleryController::class, 'buat'])->name('buat');
Route::resource('product', ProductController::class);

Route::resource('categories', CategoryController::class);

Route::resource('product-galleries', ProductGalleryController::class);

Route::get('transactions/{id}/set-status', [TransactionController::class, 'setStatus'])->name('transactions.status');

Route::resource('transactions', TransactionController::class);

Route::get('/history', [TransactionController::class, 'history'])->name('transactions.history');
