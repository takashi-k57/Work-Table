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

Route::get('/holiday', 'CalendarController@getHoliday')->middleware('auth');
Route::POST('/holiday', 'CalendarController@postHoliday')->middleware('auth');
Route::get('/', 'CalendarController@index')->middleware('auth');;
Route::get('/holiday/{id}', 'CalendarController@getHolidayId')->middleware('auth');
Route::delete('/holiday', 'CalendarController@deleteHoliday')->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
