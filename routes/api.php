<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth'])->group(function () {
    Route::get('employees', 'EmployeeController@index');
    Route::get('employees/{id}', 'EmployeeController@show');
    Route::post('employees', 'EmployeeController@store');
    Route::put('employees/{id}', 'EmployeeController@update');
    Route::delete('employees/{id}', 'EmployeeController@delete');
});