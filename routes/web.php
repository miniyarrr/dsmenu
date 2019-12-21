<?php

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

Route::group(['middleware' => 'guest'], function () {

    Route::get('/', function () {
        return view('auth.login');
    });

    Route::get('/{any}', function () {
        return view('auth.login');
    });
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', function () {
        return view('welcome');
    });
    Route::get('/{any}', function () {
        return view('welcome');
    });
});



//Route::get('/', function () {
//    return view('welcome');
//});
//Route::get('/{any}', function () {
//    return view('welcome');
//});
//
//
