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

Route::get('/', function () {
    return view('welcome');
});

Route::get('auth/login', 'Auth\LoginController@showLoginForm');
Route::get('login', [ 'as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);

Route::post('auth/login', 'Auth\LoginController@login');
Route::post('login', 'Auth\LoginController@login');

Route::get('employees', 'AdminController@showEmployees');
Route::get('home', 'AdminController@showEmployees');