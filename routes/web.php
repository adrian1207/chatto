<?php

Route::get('/', 'LoginController@index');
Route::post('login', 'LoginController@switcher');
Route::post('logout', 'LoginController@logout');

Route::get('/chat', 'ChatController@index');
Route::post('/chat/invite', 'ChatController@invite');
Route::post('/chat/message', 'ChatController@message');
Route::post('/chat/update', 'ChatController@update');