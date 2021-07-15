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

        Route::get('/dashboard/home','HomeController@index')->name('dashboard.home');

        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

            ######################### Brands #########################
            Route::resource('brands', 'BrandController');

            ######################### Categories #########################
            Route::resource('categories', 'CategoryController');
            ######################### Sub Categories #########################
            Route::resource('subcategories', 'SubCategoryController');

<<<<<<< HEAD
            ######################### Users #########################
            Route::resource('users', 'UserController');
=======
            ######################### products #########################
            Route::resource('products', 'ProductController');
>>>>>>> 65792737e2bbe49a8f8e5b0a967b3a54d4d3b3bc

        });

    }
);
