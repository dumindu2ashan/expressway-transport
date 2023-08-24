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

Route::group(['prefix' => 'schedule', 'middleware' => ['auth', 'adminAccess']], function () {
    Route::get('/list', 'SchedulesController@index')->name('schedule.list');
    Route::get('/create', 'SchedulesController@create')->name('schedule.create');
    Route::get('/edit/{id}', 'SchedulesController@edit')->name('schedule.edit');

    Route::post('/store', 'SchedulesController@store')->name('schedule.store');
    Route::post('/update', 'SchedulesController@update')->name('schedule.update');
    Route::post('/change-status', 'SchedulesController@changeStatus')->name('schedule.change-status');
    Route::post('/check-available', 'SchedulesController@checkAvailable')->name('schedule.check-available');
});
