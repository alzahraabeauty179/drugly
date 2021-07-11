<?php

use App\Http\Controllers\Dashboard\CategoryController;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
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







// define("PAGINATE_NUMBER", 6);
// date_default_timezone_set('Africa/Cairo');


Auth::routes();

Route::group(['middleware' => ['guest']], function () {

    Route::get('/', function () {
        return view('auth.login');
    });
});


Route::group(
    [
        'prefix'     => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth'],
        'namespace'  => 'Dashboard'
    ],
    function () {

<<<<<<< HEAD
        Route::get('/dashboard/home','HomeController@index')->name('dashboard.home');

        Route::prefix('dashboard')->namespace('Dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

            ######################### Brands #########################
            Route::resource('brands', 'BrandController');

        });
       
=======
        Route::prefix('dashboard')->name('dashboard.')->group(function () {
            Route::get('/', 'HomeController@index')->name('home');
            Route::get('home', 'HomeController@index')->name('home');

            Route::resource('categories', 'CategoryController');
        });
>>>>>>> 647ebd9dba771750f50220a6a85b17db44d61a15
    }
);
