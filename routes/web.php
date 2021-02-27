<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

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

    // Order

    Route::put('cart/edit', [CartController::class, 'editCart'])->name('cart.edit');
    Route::get('cart/get', [CartController::class, 'getCart'])->name('cart.get');
    Route::delete('cart/empty', [CartController::class, 'emptyCart'])->name('cart.empty');
    Route::get('cart/checkout', [CartController::class, 'checkoutCart'])->name('cart.checkout');
    Route::post('cart/create-order', [CartController::class, 'createOrder'])->name('cart.create-order');

    Route::group(['middleware' => 'can:is-manager'], function () {
        Route::resource('products', ProductController::class);
        Route::get('products/{product}/delete', [ProductController::class, 'delete'])->name('products.delete');

        Route::get('today-orders/', [OrderController::class, 'getOrdersOfToday'])->name('orders.today');
    });
});
