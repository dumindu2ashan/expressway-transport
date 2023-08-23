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

Route::prefix('users')->group(function() {
    Route::get('/list', 'UsersController@index')->name('user.list');
    Route::get('/edit/{id}', 'UsersController@edit')->name('user.edit');

    Route::post('/change-status', 'UsersController@changeStatus')->name('user.change-status');
    Route::post('/update', 'UsersController@update')->name('user.update');
});
