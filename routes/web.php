<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;

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

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    //Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    //Route::post('/products-store', [ProductController::class, 'store'])->name('products.store');
    //Route::get('/products', [ProductController::class, 'index'])->name('products.list');
    Route::resource('products', ProductController::class);

});

Route::resource('products', ProductController::class);


