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

Route::post('/update-user-FCM', 'FireBaseController@updateUserFCM')->name('updateUserFCM');

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

            Route::resource('roles', 'RoleController');

            ######################### Brands #########################
            Route::resource('brands', 'BrandController');

            ######################### Categories #########################
            Route::resource('categories', 'CategoryController');
            Route::get('sub/cat', 'CategoryController@subCategory')->name('subcat');

            ######################### Sub Categories #########################
            Route::resource('subcategories', 'SubCategoryController');

            ######################### Users #########################
            Route::resource('users', 'UserController');

            ######################### App Settings #########################
            Route::resource('appsettings', 'AppSettingController');

            ######################### Products #########################
            Route::resource('products', 'ProductController');
            Route::get('product', 'ProductController@downloadSheet')->name('download.sheetExcel');

            ######################### Notifications #########################
            Route::get('/test', 'NotificationController@store')->name('testNotifies');
            Route::post('/mark-as-read', 'NotificationController@markAsRead')->name('markAsRead');
            Route::resource('notifications', 'NotificationController');

              ######################### stagnants #########################
              Route::resource('stagnants', 'StagnantsController');


        });

    }
);
