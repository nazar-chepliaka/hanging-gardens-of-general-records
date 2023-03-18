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
    Route::get('/', 'GeneralRecordsController@index')->name('main_form');
    Route::get('/create', 'GeneralRecordsController@index')->name('general_records.create');
});