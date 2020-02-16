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
  Route::get('logout', 'AuthPos@logout');
});
Route::group([
    'middleware' => 'jwt.verify',
    'namespace' => '\App\Http\Controllers',
    'prefix' => 'v1/pos'
], function ($router) {
  Route::get('check', 'PosAPI@checkValidity');
  Route::get('me', 'PosAPI@me');
  Route::get("transaksi",'PosAPI@transaksi');
  Route::get("transaksiById/{id}",'PosAPI@transaksiById');
  Route::get("kasir",'PosAPI@kasir');
  Route::post("kasirinsert",'PosAPI@kasirinsert');
  Route::post("kasirupdate/{id}",'PosAPI@kasirupdate');
  Route::get("check_available_register","PosAPI@check_available_register");
  Route::post("close_pos_register/{id}","PosAPI@close_pos_register");
  Route::post("create_pos_register","PosAPI@create_pos_register");
  Route::post("transaksiinsert",'PosAPI@transaksiinsert');
  Route::get("transaksicancel/{id}",'PosAPI@transaksicancel');
  Route::post("permintaaninsert",'PosAPI@permintaaninsert');
  Route::get("permintaancancel/{id}",'PosAPI@permintaancancel');
  Route::get("permintaan",'PosAPI@permintaan');
  Route::get("permintaanById/{id}",'PosAPI@permintaanById');
  Route::get("barang",'PosAPI@barang');
  Route::get("baranggudang",'PosAPI@baranggudang');
  Route::get("user/{id}","PosAPI@user");

});
