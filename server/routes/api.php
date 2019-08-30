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

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('auth/user', 'AuthController@user');
    Route::post('auth/logout', 'AuthController@logout');
});

Route::post('auth/login', 'AuthController@login');
Route::post('auth/register', 'AuthController@register');
