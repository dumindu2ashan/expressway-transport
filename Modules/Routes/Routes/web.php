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
Route::group(['prefix' => 'route'], function () {
    Route::group(['middleware' => ['auth', 'managerUserAccess']], function () {
        Route::get('/list', 'RoutesController@index')->name('route.list');
    });

    Route::group(['middleware' => ['auth', 'userAccess']], function () {
        Route::get('/create', 'RoutesController@create')->name('route.create');
        Route::get('/edit/{id}', 'RoutesController@edit')->name('route.edit');

        Route::post('/store', 'RoutesController@store')->name('route.store');
        Route::post('/update', 'RoutesController@update')->name('route.update');
    });

    Route::group(['middleware' => ['auth', 'userAccess']], function () {
        Route::post('/change-status', 'RoutesController@changeStatus')->name('route.change-status');
    });
});
