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

Route::get('/', 'UsersController@retrieve');
Route::get('/users/new', 'UsersController@new');
Route::get('/users/{id}', 'UsersController@edit');

Route::post('/users', 'UsersController@create');
Route::post('/users/{id}', 'UsersController@update');
