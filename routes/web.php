<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::get('/', 'GeneralRecordsController@index')->name('general_records.index');
    Route::get('/create', 'GeneralRecordsController@create')->name('general_records.create');
    Route::post('/', 'GeneralRecordsController@store')->name('general_records.store');
    Route::get('/{id}/edit', 'GeneralRecordsController@edit')->name('general_records.edit');
    Route::put('/{id}', 'GeneralRecordsController@update')->name('general_records.update');
});