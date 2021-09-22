<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\produkController;
use App\Http\Controllers\userController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\productController;
use App\Http\Controllers\ordersController;
use App\Http\Controllers\kategoriController;

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

Route::get('/', [homeController::class, 'index'])->name('utama');
Route::get('/check-out/{id}', [ordersController::class, 'fillCheckout'])->name('check');
Route::post('/check-out/process', [ordersController::class, 'store'])->name('check-out.process');

Route::middleware(['auth'])->group(function () {
    Route::get('/product', [productController::class, 'listProduct'])->name('product');
    Route::post('/product/add', [productController::class, 'create'])->name('product.add');
    Route::post('/product/update/{id}', [productController::class, 'update'])->name('product.update');
    Route::get('/product/edit/{id}', [productController::class, 'edit'])->name('product.edit');
    Route::post('/product/delete/{id}', [productController::class, 'destroy'])->name('product.destroy');

    Route::get('/kategori', [kategoriController::class, 'index'])->name('kategori');
    Route::post('/kategori/add', [kategoriController::class, 'create'])->name('kategori.add');
    Route::post('/kategori/update/{id}', [kategoriController::class, 'update'])->name('kategori.update');
    Route::post('/kategori/delete/{id}', [kategoriController::class, 'destroy'])->name('kategori.destroy');

    Route::get('/orders', [ordersController::class, 'index'])->name('orders');

    Route::get('/profile', [userController::class, 'profile'])->name('profile');
    Route::post('/profile/update/{id}', [userController::class, 'update'])->name('profile-update');
    Route::post('/profile/change-profile/{id}', [userController::class, 'updateProfile'])->name('profile-foto');
});
require __DIR__ . '/auth.php';
