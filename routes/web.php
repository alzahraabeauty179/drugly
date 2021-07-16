<?php

use App\DataTables\CategoryDataTable;
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

        Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

            Route::get('/', 'HomeController@index')->name('home');
            Route::get('/home', 'HomeController@index')->name('home');

            ######################### Brands #########################
            Route::resource('brands', 'BrandController');

            ######################### Categories #########################
            Route::resource('categories', 'CategoryController');
<<<<<<< HEAD
=======
            Route::get('categories', function (CategoryDataTable $dataTable) {
                return $dataTable->render('dashboard.categories.index');
            })->name('categories.index');
>>>>>>> 49b1c1e1632bee077282ed38ea07db085049017d

            ######################### Sub Categories #########################
            Route::resource('subcategories', 'SubCategoryController');

            ######################### Users #########################
            Route::resource('users', 'UserController');

            ######################### Products #########################
            Route::resource('products', 'ProductController');

        });

    }
);
