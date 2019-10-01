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
//Normal Route
Route::get('/', function(){
  $data["title"] = "SCM Wenow";
  return view("layout.login")->with($data);
})->name('public.normal.login');
Route::get("/logout",function(){
  session()->flush();
  return redirect(route("public.normal.login"))->with(["msg"=>"Anda Berhasil Logout"]);
})->name("public.normal.logout");
//Public API
Route::post('/api/public/login',"ApiControl@login")->name("public.api.login");
//Private API
//All Access
// -- Direktur ---
Route::group(['middleware' => ['direktur']], function () {
  //NormalRoute
  Route::get('/direktur',"DirekturControl@index")->name('private.direktur.home');
  // API
  //Satuan
  Route::get('/api/direktur/master_satuan_read/{id?}',"ApiControl@master_satuan_read")->name("private.api.master_satuan_read");
  Route::post('/api/direktur/master_satuan_insert',"ApiControl@master_satuan_insert")->name("private.api.master_satuan_insert");
  Route::post('/api/direktur/master_satuan_update/{id?}',"ApiControl@master_satuan_update")->name("private.api.master_satuan_update");
  //Bahan Baku
  Route::get('/api/direktur/master_bb_read/{id?}',"ApiControl@master_bb_read")->name("private.api.master_bb_read");
  Route::post('/api/direktur/master_bb_insert',"ApiControl@master_bb_insert")->name("private.api.master_bb_insert");
  Route::post('/api/direktur/master_bb_update/{id?}',"ApiControl@master_bb_update")->name("private.api.master_bb_update");
  // Transportasi
  Route::get('/api/direktur/master_transportasi_read/{id?}',"ApiControl@master_transportasi_read")->name("private.api.master_transportasi_read");
  Route::post('/api/direktur/master_transportasi_insert',"ApiControl@master_transportasi_insert")->name("private.api.master_transportasi_insert");
  Route::post('/api/direktur/master_transportasi_update/{id?}',"ApiControl@master_transportasi_update")->name("private.api.master_transportasi_update");
  //Suplier
  Route::get('/api/direktur/master_suplier_read/{id?}',"ApiControl@master_suplier_read")->name("private.api.master_suplier_read");
  Route::post('/api/direktur/master_suplier_insert',"ApiControl@master_suplier_insert")->name("private.api.master_suplier_insert");
  Route::post('/api/direktur/master_suplier_update/{id?}',"ApiControl@master_suplier_update")->name("private.api.master_suplier_update");
  //Produk dan Komposisi
  Route::get('/api/direktur/master_produk_read/{id?}',"ApiControl@master_produk_read")->name("private.api.master_produk_read");
  Route::post('/api/direktur/master_produk_insert',"ApiControl@master_produk_insert")->name("private.api.master_produk_insert");
  Route::post('/api/direktur/master_produk_update/{id?}',"ApiControl@master_produk_update")->name("private.api.master_produk_update");

  Route::get('/api/direktur/master_komposisi_read/{id?}',"ApiControl@master_komposisi_read")->name("private.api.master_komposisi_read");
  Route::post('/api/direktur/master_komposisi_insert',"ApiControl@master_komposisi_insert")->name("private.api.master_komposisi_insert");
  Route::get('/api/direktur/master_komposisi_hapus/{id?}',"ApiControl@master_komposisi_hapus")->name("private.api.master_komposisi_hapus");

  //Pelanggan
  Route::get('/api/direktur/master_pelanggan_read/{id?}',"ApiControl@master_pelanggan_read")->name("private.api.master_pelanggan_read");
  Route::post('/api/direktur/master_pelanggan_insert',"ApiControl@master_pelanggan_insert")->name("private.api.master_pelanggan_insert");
  Route::post('/api/direktur/master_pelanggan_update/{id?}',"ApiControl@master_pelanggan_update")->name("private.api.master_pelanggan_update");

  //Pengguna
  Route::get('/api/direktur/pengguna_read/{id?}',"ApiControl@pengguna_read")->name("private.api.pengguna_read");
  Route::post('/api/direktur/pengguna_insert',"ApiControl@pengguna_insert")->name("private.api.pengguna_insert");
  Route::post('/api/direktur/pengguna_update/{id?}',"ApiControl@pengguna_update")->name("private.api.pengguna_update");


});
Route::group(['middleware' => ['pengadaan']], function () {
  Route::get('/pengadaan',"PengadaanControl@index")->name('private.pengadaan.home');
  //Satuan
  Route::get('/api/pengadaan/master_satuan_read/{id?}',"ApiControl@master_satuan_read")->name("pengadaan.api.master_satuan_read");
  Route::post('/api/pengadaan/master_satuan_insert',"ApiControl@master_satuan_insert")->name("pengadaan.api.master_satuan_insert");
  Route::post('/api/pengadaan/master_satuan_update/{id?}',"ApiControl@master_satuan_update")->name("pengadaan.api.master_satuan_update");
  //Bahan Baku
  Route::get('/api/pengadaan/master_bb_read/{id?}',"ApiControl@master_bb_read")->name("pengadaan.api.master_bb_read");
  Route::post('/api/pengadaan/master_bb_insert',"ApiControl@master_bb_insert")->name("pengadaan.api.master_bb_insert");
  Route::post('/api/pengadaan/master_bb_update/{id?}',"ApiControl@master_bb_update")->name("pengadaan.api.master_bb_update");
  //Suplier
  Route::get('/api/pengadaan/master_suplier_read/{id?}',"ApiControl@master_suplier_read")->name("pengadaan.api.master_suplier_read");
  Route::post('/api/pengadaan/master_suplier_insert',"ApiControl@master_suplier_insert")->name("pengadaan.api.master_suplier_insert");
  Route::post('/api/pengadaan/master_suplier_update/{id?}',"ApiControl@master_suplier_update")->name("pengadaan.api.master_suplier_update");
  //Produk dan Komposisi
  Route::get('/api/pengadaan/master_produk_read/{id?}',"ApiControl@master_produk_read")->name("pengadaan.api.master_produk_read");
  Route::post('/api/pengadaan/master_produk_insert',"ApiControl@master_produk_insert")->name("pengadaan.api.master_produk_insert");
  Route::post('/api/pengadaan/master_produk_update/{id?}',"ApiControl@master_produk_update")->name("pengadaan.api.master_produk_update");

  Route::get('/api/pengadaan/master_komposisi_read/{id?}',"ApiControl@master_komposisi_read")->name("pengadaan.api.master_komposisi_read");
  Route::post('/api/pengadaan/master_komposisi_insert',"ApiControl@master_komposisi_insert")->name("pengadaan.api.master_komposisi_insert");
  Route::get('/api/pengadaan/master_komposisi_hapus/{id?}',"ApiControl@master_komposisi_hapus")->name("pengadaan.api.master_komposisi_hapus");

  //Pengadaan Bahan Baku
  Route::get('/api/pengadaan/pbahanabaku_read/{id?}',"ApiControl@pbahanabaku_read")->name("pengadaan.api.pbahanabaku_read");
  Route::get('/api/pengadaan/pengandaan_bahanabaku_read/{id?}',"ApiControl@pengandaan_bahanabaku_read")->name("pengadaan.api.pengandaan_bahanabaku_read");
  Route::post('/api/pengadaan/pengandaan_bahanabaku_insert',"ApiControl@pengandaan_bahanabaku_insert")->name("pengadaan.api.pengandaan_bahanabaku_insert");
  Route::get('/api/pengadaan/pengandaan_bahanabaku_batal/{id?}',"ApiControl@pengandaan_bahanabaku_batal")->name("pengadaan.api.pengandaan_bahanabaku_batal");
  //Hasilkan Kode Pengadaan Bahan Baku
  Route::get('/api/pengadaan/kode_pbb',"ApiControl@kode_pbb")->name("pengadaan.api.kode_pbb");

});