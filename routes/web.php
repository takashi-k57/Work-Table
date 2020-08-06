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

Route::get('/', function (){
    return view('welcome');
});

Route::get('works/crete', 'WorkController@index')->middleware('auth');

Route::get('/holiday', 'HolidayController@create')->middleware('auth');
Route::POST('/holiday', 'HolidayController@show')->middleware('auth');
Route::get('/holiday/{id}', 'HolidayController@edit')->middleware('auth');
Route::delete('/holiday', 'HolidayController@destroy')->middleware('auth');
Route::get('/', 'CalendarController@index')->middleware('auth')->name('new');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
