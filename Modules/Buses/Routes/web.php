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

Route::group(['prefix' => 'buses', 'middleware' => ['auth', 'adminAccess']], function () {
    Route::get('/list', 'BusesController@index')->name('bus.list');
    Route::get('/create', 'BusesController@create')->name('bus.create');
    Route::get('/edit/{id}', 'BusesController@edit')->name('bus.edit');

    Route::post('/store', 'BusesController@store')->name('bus.store');
    Route::post('/update', 'BusesController@update')->name('bus.update');
    Route::post('/change-status', 'BusesController@changeStatus')->name('bus.change-status');
});
