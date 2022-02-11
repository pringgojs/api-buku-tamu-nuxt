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
Route::post('guest/store', 'GuestController@store');
Route::get('guest', 'GuestController@index');
Route::post('get-file', 'WelcomeController@getFile');
Route::get('kominfo', 'WelcomeController@kominfo');
Route::get('search', 'WelcomeController@search');
Route::get('/', 'WelcomeController@index');
