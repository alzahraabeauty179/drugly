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

Route::group(
    [
        'prefix'     => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'guest'],
    ], 
    
    function () {

        Route::get('/', function () {
            return view('home');
        });

        Route::post('user/register', 'Dashboard\UserController@store')->name('user.store');
	
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

            ######################### Roles #########################
            Route::resource('roles', 'RoleController');
            Route::get('user/role', 'RoleController@userRoleIndex')->name('user.role.index');
            Route::post('user/role', 'RoleController@userRoleCreateUpdate')->name('user.role.createUpdate');

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

            ######################### Stores #########################
            Route::resource('stores', 'StoreController');
            Route::post('search-by-product', 'StoreController@searchByProduct')->name('stores.searchByProduct');
            Route::post('search-result', 'StoreController@searchResult')->name('stores.searchResult');
            Route::post('search-result-filter', 'StoreController@searchResultFilter')->name('stores.searchResultFilter');
            Route::get('show/store-products/{store}', 'StoreController@showStoreProducts')->name('stores.products');
            Route::get('get/store-products', 'StoreController@products')->name('products');
            Route::post('search/sheet', 'StoreController@searchSheet')->name('stores.searchSheet');
            Route::get('download/order/sheet-products', 'StoreController@downloadOrderSheet')->name('download.orderSheetExcel');
            Route::get('download/search/sheet-products', 'StoreController@downloadSearchProductsSheet')->name('download.searchSheetExcel');

            ######################### Orders #########################
            Route::resource('orders', 'OrderController');
            Route::get('show', 'OrderController@showOrders')->name('showOrders');
            Route::get('get/order-products', 'OrderController@orderProducts')->name('order.products');
            
            ######################### Areas #########################
            Route::resource('areas', 'AreaController');
            Route::get('sub/areas', 'AreaController@subAreas')->name('subarea');

           ######################### Products #########################
           Route::resource('products', 'ProductController');
           Route::get('product', 'ProductController@downloadNewSheet')->name('download.sheetExcel');
           Route::get('productUpdate', 'ProductController@downloadUpdateSheet')->name('download.sheetExcelUpdate');
           Route::post('product/cat', 'ProductController@exportWithCategory')->name('proCat.sheetExcel');

            ######################### Notifications #########################
            Route::get('/test', 'NotificationController@store')->name('testNotifies');
            Route::post('/mark-as-read', 'NotificationController@markAsRead')->name('markAsRead');
            Route::resource('notifications', 'NotificationController');

            ######################### Stagnants #########################
            Route::resource('stagnants', 'StagnantsController');
        
        	######################### Subscriptions #########################
            Route::resource('subscriptions', 'SubscriptionController');
        	
        	######################### Subscribers #########################
            Route::resource('subscribers', 'SubscriberController');
        
        	######################### Advertisements #########################
            Route::resource('advertisements', 'AdvertisementController');
        
        	######################### Logs #########################
            Route::resource('logs', 'LogController');
        
        });

    }
);
