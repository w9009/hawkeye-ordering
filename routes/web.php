<?php
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

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    } else {
        return view('auth/login');
    }

});

Route::group(['prefix' => 'management'], function() {

    Route::get('inventory', 'HomeController@partsDevices')->name('parts_devices');

    Route::group(['prefix' => 'products'], function() {
        Route::get('create', 'ProductsController@navCreate')->name('nav_create_product');
        Route::get('update/{id}', 'ProductsController@navUpdate')->name('nav_update_product');

        Route::post('creates', 'ProductsController@create')->name('create_product');
        Route::get('updates/{id}', 'ProductsController@update')->name('update_product');
    });

    Route::group(['prefix' => 'devices'], function() {
        Route::get('create', 'DevicesController@navCreate')->name('nav_create_device');
        Route::post('creates', 'DevicesController@create')->name('create_device');

        Route::get('update/{id}', 'DevicesController@navUpdate')->name('nav_update_device');
        Route::get('updates/{id}', 'DevicesController@update')->name('update_device');
    });

    Route::group(['prefix' => 'orders'], function (){
      Route::get('create', 'OrderController@navCreate')->name('nav_create_order');
      Route::post('creates', 'OrderController@create')->name('create_order');

      Route::get('inspect/{id}', 'OrderController@inspect')->name('inspect');
      Route::get('assign/{id}', 'OrderController@assign')->name('assign');
    });
});

Auth::routes();

Route::get('/management', 'OrdersController@index')->name('orders');
