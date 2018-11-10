<?php

Route::get('/', 'RetrieveUsersController@handle');
Route::get('/users/new', 'NewUserController@handle');
Route::get('/users/{id}', 'EditUserController@handle');

Route::post('/users', 'CreateUserController@handle');
Route::post('/users/{id}', 'UpdateUserController@handle');
