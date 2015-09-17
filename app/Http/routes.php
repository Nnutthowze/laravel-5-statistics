<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', function() {
    return view('index');
});

Route::get('parse', function() {
    $this->app['ParserService']->parse();
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

/**
 * Routes for authorized users
 */
Route::group(['middleware' => 'auth', 'prefix' => 'dashboard'], function () {

    Route::get('/', 'DashboardController@index');
    Route::get('show', ['uses' => 'DashboardController@show', 'as' => 'show']);
        //->where(['from' => '20\d{2}-\d{2}-\d{2}', 'to' => '20\d{2}-\d{2}-\d{2}']);
});


