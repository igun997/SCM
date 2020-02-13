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

Route::post('login', 'AuthPos@login');
Route::group([
    'middleware' => 'jwt.verify',
    'namespace' => '\App\Http\Controllers',
    'prefix' => 'v1'
], function ($router) {
  Route::post('testAkun', 'AuthPos@test');
  Route::get('logout', 'AuthPos@logout');
});
Route::group([
    'middleware' => 'jwt.verify',
    'namespace' => '\App\Http\Controllers',
    'prefix' => 'v1/pos'
], function ($router) {
  Route::get('check', 'PosAPI@checkValidity');
  Route::get('me', 'PosAPI@me');
});
