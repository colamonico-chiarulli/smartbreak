<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

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

Auth::routes();

Route::get('notification', [HomeController::class, 'notification']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::resource('products', ProductController::class);

    Route::get('products/{product}/delete', [ProductController::class, 'delete'])->name('products.delete');

    // Order
    Route::put('cart/edit', [CartController::class, 'editCart'])->name('cart.edit');
    Route::get('cart/empty', [CartController::class, 'emptyCart'])->name('cart.empty');
});
