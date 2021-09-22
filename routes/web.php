<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\produkController;
// use App\Http\Controllers\orderController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\ordersController;

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
Route::get('/dashboard', [homeController::class, 'dashboard'])->name('dashboard');
Route::get('/check-out/{id}', [ordersController::class, 'fillCheckout'])->name('check');
// Route::get('/check-out/{id}', [orderController::class, 'fillCheckout'])->name('check-out');
Route::post('/check-out/process', [orderController::class, 'store'])->name('check-out.process');


Route::middleware(['auth'])->group(function () {
    Route::get('/product', [produkController::class, 'index'])->name('produk');
    Route::post('/product/insert', [produkController::class, 'create']);
    Route::get('/product/delete/{id}', [produkController::class, 'destroy']);
    Route::post('/product/update/{id}', [produkController::class, 'update']);

    Route::get('/orders', [orderController::class, 'index'])->name('orders');
});
require __DIR__ . '/auth.php';
