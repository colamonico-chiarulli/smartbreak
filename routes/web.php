<?php
/**
 * File:	/routes/web.php
 * @package smartbreak
 * @author  Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * @copyright	(c)2021 IISS Colamonico-Chiarulli Acquaviva delle Fonti (BA) Italy
 * Created Date: 	December 15th, 2020 11:05pm
 * -----
 * Last Modified: 	May 18th 2021 5:00:11 pm
 * Modified By: 	Rino Andriano <andriano@colamonicochiarulli.edu.it>
 * -----
 * @license	https://www.gnu.org/licenses/agpl-3.0.html AGPL 3.0
 * ------------------------------------------------------------------------------
 * SmartBreak is a School Bar food booking web application
 * developed during the PON course "The AppFactory" 2020-2021 with teachers
 * & students of "Informatica e Telecomunicazioni"
 * at IISS "C. Colamonico - N. Chiarulli" Acquaviva delle Fonti (BA)-Italy
 * Expert dr. Giovanni Ciriello <giovanni.ciriello.5@gmail.com>
 * ----------------------------------------------------------------------------
 * SmartBreak is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by
 * the Free Software Foundation
 *
 * SmartBreak is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * You should have received a copy of the GNU Affero General Public License along
 * with this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * The interactive user interfaces in original and modified versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the SmartBreak
 * logo and IISS "Colamonico-Chiarulli" copyright notice. If the display of the logo
 * is not reasonably feasible for technical reasons, the Appropriate Legal Notices
 * must display the words
 * "(C) IISS Colamonico-Chiarulli-https://colamonicochiarulli.edu.it - 2021".
 *
 * ------------------------------------------------------------------------------
 */

?>
<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\CronController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

//use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
//use RuntimeException;

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

Route::get('/privacy', function(){ return view('pages.static.privacy'); });
Route::get('/credits', function(){ return view('pages.static.credits'); });
Route::get('/', function(){ return view('pages.homepage.index'); });

Route::get('notification', [HomeController::class, 'notification']);

Route::get('reset-num-items-products', [CronController::class, 'resetNumItemsProducts']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::post('upload-file', [UploadController::class, 'store']);
    Route::delete('upload-file', [UploadController::class, 'delete']);
    Route::get('analytics', [AnalyticsController::class, 'getAnalyticsPage'])->name('analytics');
    Route::post('analytics-getcharts', [AnalyticsController::class, 'getChartsDataset'])->name('analytics.getcharts');

    // STUDENT AREA
    Route::group(['middleware' => 'can:is-student'], function () {
        Route::group(['prefix' => 'cart', 'middleware' => 'orders.timerange_check'], function () {
            Route::get('choose-products', [CartController::class, 'chooseProducts'])->name('cart.choose-products');
            Route::put('edit', [CartController::class, 'editCart'])->name('cart.edit');
            Route::get('get', [CartController::class, 'getCart'])->name('cart.get');
            Route::delete('empty', [CartController::class, 'emptyCart'])->name('cart.empty');
            Route::get('checkout', [CartController::class, 'checkoutCart'])->name('cart.checkout');
            Route::post('create-order', [CartController::class, 'createOrder'])->name('cart.create-order');
        });

        Route::get('student-orders', [OrderController::class, 'getOrdersByStudent'])->name('orders.by-student');
        Route::get('class-orders', [OrderController::class, 'getOrdersOfTodayByClass'])->name('orders.today-by-class');
    });

    // MANAGER AREA
    Route::group(['middleware' => 'can:is-admin-or-manager'], function () {
        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);

        Route::get('orders-by-day/{date?}', [OrderController::class, 'getOrdersByDay'])->name('orders.by-day');
        Route::get('products-by-day/{date?}', [OrderController::class, 'getProductsByDay'])->name('products.by-day');
        Route::get('orders-set-status', [OrderController::class, 'setOrderStatus'])->name('orders.set-status');
        Route::get('products-stocks', [ProductController::class, 'getStocks'])->name('products.stocks');
        Route::post('set-stocks', [ProductController::class, 'setStocks'])->name('products.set-stocks');
    });

    // ADMIN AREA
    Route::group(['middleware' => 'can:is-admin'], function () {
        Route::resource('sites', SiteController::class);
        Route::resource('classes', SchoolclassController::class);
        Route::resource('users', UserController::class);
        Route::resource('students', StudentController::class);
        Route::get('import-students', [UserController::class, 'importStudentView'])->name('users.import');;
        Route::post('import-students-csv', [UserController::class, 'importStudentCSV'])->name('users.import-csv');
        Route::get('import-classes', [SchoolClassController::class, 'importSchoolClassView'])->name('classes.import');;
        Route::post('import-classes-csv', [SchoolClassController::class, 'importSchoolClassCSV'])->name('classes.import-csv');
        
        Route::get('optimize', function() {
            $exitCode = Artisan::call('optimize:clear');
            return 'Cache cleared ' . $exitCode;
        });
    });
});

/*
Route::get('test-error', function(){
    Bugsnag::notifyException(new RuntimeException("Test error"));
});
*/
