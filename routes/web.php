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



Route::get('works/crete', 'WorkController@index')->middleware('auth');

Route::group(['middleware' => 'auth'],function(){
    Route::get('/holiday', 'HolidayController@create');
    Route::POST('/holiday', 'HolidayController@store');
    Route::delete('/holiday', 'HolidayController@destroy');
    Route::get('/', 'CalendarController@index')->name('new');
});


Auth::routes();

Route::group(['prefix' => 'admin'],function(){
    Route::get('/',   function(){return redirect('/admin/home');});
    Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\Auth\LoginController@login');
    Route::get('register', 'Admin\Auth\RegisterController@showLoginForm')->name('admin.register');
    Route::post('register', 'Admin\Auth\RegisterController@register');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'],function(){
    Route::post('logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');
    Route::get('home', 'Admin\HomeController@index')->name('admin.home');
    Route::get('/', 'Admin\HomeController@index')->name('admin.home');
    Route::get('/annualholidays/create', 'Admin\HomeController@create');
    Route::post('/annualholidays/', 'Admin\HomeController@store');
});