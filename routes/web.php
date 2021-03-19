<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\Auth\LoginController;

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

Route::any('register', function () {
    abort(404);
});

Route::get('/login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('/login/google/redirect', [LoginController::class, 'handleGoogleCallback']);

Route::get('notification', [HomeController::class, 'notification']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::post('upload-file', [UploadController::class, 'store']);
    Route::delete('upload-file', [UploadController::class, 'delete']);

    // STUDENT AREA
    Route::group(['middleware' => 'can:is-student'], function () {
        Route::group(['prefix' => 'cart'], function () {
            Route::get('choose-products', [CartController::class, 'chooseProducts'])->name('cart.choose-products');
            Route::put('edit', [CartController::class, 'editCart'])->name('cart.edit');
            Route::get('get', [CartController::class, 'getCart'])->name('cart.get');
            Route::delete('empty', [CartController::class, 'emptyCart'])->name('cart.empty');
            Route::get('checkout', [CartController::class, 'checkoutCart'])->name('cart.checkout');
            Route::post('create-order', [CartController::class, 'createOrder'])->name('cart.create-order');
        });

        Route::get('student-orders', [OrderController::class, 'getOrdersOfTodayByClass'])->name('orders.by-student');
        Route::get('class-orders', [OrderController::class, 'getOrdersOfTodayByClass'])->name('orders.today-by-class');
    });

    // MANAGER AREA
    Route::group(['middleware' => 'can:is-manager'], function () {
        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);

        Route::get('orders-by-day/{date?}', [OrderController::class, 'getOrdersByDay'])->name('orders.by-day');
        Route::get('products-by-day/{date?}', [OrderController::class, 'getProductsByDay'])->name('products.by-day');

    });
});
