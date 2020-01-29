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
    Route::group(['prefix' => 'products'], function() {
        Route::get('create', 'ProductsController@navCreate')->name('nav_create_product');
        Route::get('update/{id}', 'ProductsController@navUpdate')->name('nav_update_product');

        Route::get('creates', 'ProductsController@create')->name('create_product');
        Route::get('updates/{id}', 'ProductsController@update')->name('update_product');
    });

    Route::group(['prefix' => 'devices'], function() {
        Route::get('create', 'DevicesController@navCreate')->name('nav_create_device');
        Route::get('creates', 'DevicesController@create')->name('create_device');
    });
});

Auth::routes();

Route::get('/management', 'HomeController@index')->name('home');
