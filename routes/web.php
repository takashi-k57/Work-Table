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

Route::get('/', 'CalendarController@index')->middleware('auth');
Route::get('/holiday', 'HolidayController@index')->middleware('auth');
Route::post('/holiday', 'HolidayController@store')->middleware('auth');
Route::put('/holiday/{id}', 'HolidayController@update')->middleware('auth');
Route::delete('/holiday/{id}', 'HolidayController@destroy')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
