<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'LoginController@index');
Route::post('login', 'LoginController@switcher');
Route::post('logout', 'LoginController@logout');

Route::get('/chat', 'ChatController@index');
