<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


use Illuminate\Http\Request;


Route::pattern('id', '[1-9][0-9]*');
Route::pattern('slug', '[a-z-]*');


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/



Route::group(['middleware' => ['web']], function () {
    Route::get('contact', 'FrontController@showContact');
    Route::post('storeContact', 'FrontController@storeContact');
    Route::any('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout');
    Route::get('/', ['as' => 'home', 'uses' => 'FrontController@index']);
    Route::get('prod/{id}/{slug?}', 'FrontController@showProduct');
    Route::get('cat/{id}/{slug?}', 'FrontController@showProductByCategory');
    Route::get('tag/{id}', 'FrontController@showProductByTag');
    Route::resource('cart', 'CartController');
    Route::get('login/registration', 'LoginController@createUser');
    Route::post('login/store', 'LoginController@storeUser');
    Route::get('password/reset', 'LoginController@resetPassword');
    Route::post('password/register', 'LoginController@registerPassword');
    Route::get('mentions', 'FrontController@showMentions');

    Route::group(['middleware' => ['throttle:60,1']], function () {
        Route::any('login', 'LoginController@login');
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::get('command', 'CartController@showCommand');
        Route::get('command/valid', 'CartController@validCommand');
        Route::get('command/historic', 'FrontController@userHistoric');
        Route::any('customer', 'CartController@storeCustomer');
    });

    Route::group(['middleware' => ['admin']], function () {
        Route::get('product/historic', 'ProductController@productHistoric');
        Route::get('product/historic/command_unf', 'ProductController@command_unfHistoric');
    });

    Route::group(['middleware' => ['auth', 'admin']], function () {
        Route::resource('product', 'ProductController');
        Route::get('product/status/{id}', 'ProductController@changeStatus');
    });
});