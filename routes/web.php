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
//Test Deply
Route::get('/test',"ApiControl@test");

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

Route::get('/gen/invoice/pemesanan/{id?}',"ApiControl@invoicePemesanan")->name("gen.invoice.pemesanan");
Route::get('/gen/invoice/pengadaan/{id?}',"ApiControl@invoicePengadaaan")->name("gen.invoice.pengadaan");
Route::get('/gen/invoice/pengadaanbb/{id?}',"ApiControl@invoicePengadaaanbb")->name("gen.invoice.pengadaanbb");
Route::post('/stat',"ApiControl@stat")->name("chart");
//Private API
//All Access
Route::get('/gen/laporanbb',"ApiControl@laporanbb")->name("laporan.pengadaan.bb");
Route::get('/gen/laporanproduk',"ApiControl@laporanproduk")->name("laporan.pengadaan.produk");

Route::group(['middleware' => ['produksi']], function () {
  Route::get('/produksi',"ProduksiControl@index")->name('produksi.home');
  Route::get('/api/produksi/master_bb_read/{id?}',"ApiControl@master_bb_read")->name("produksi.api.master_bb_read");
  Route::post('/api/produksi/master_bb_insert',"ApiControl@master_bb_insert")->name("produksi.api.master_bb_insert");
  Route::post('/api/produksi/master_bb_update/{id?}',"ApiControl@master_bb_update")->name("produksi.api.master_bb_update");

  Route::get('/api/produksi/master_satuan_read/{id?}',"ApiControl@master_satuan_read")->name("produksi.api.master_satuan_read");
  Route::post('/api/produksi/master_satuan_insert',"ApiControl@master_satuan_insert")->name("produksi.api.master_satuan_insert");
  Route::post('/api/produksi/master_satuan_update/{id?}',"ApiControl@master_satuan_update")->name("produksi.api.master_satuan_update");

  Route::get('/api/produksi/master_produk_read/{id?}',"ApiControl@master_produk_read")->name("produksi.api.master_produk_read");
  Route::post('/api/produksi/master_produk_insert',"ApiControl@master_produk_insert")->name("produksi.api.master_produk_insert");
  Route::post('/api/produksi/master_produk_update/{id?}',"ApiControl@master_produk_update")->name("produksi.api.master_produk_update");

  Route::get('/api/produksi/master_komposisi_read/{id?}',"ApiControl@master_komposisi_read")->name("produksi.api.master_komposisi_read");
  Route::post('/api/produksi/master_komposisi_insert',"ApiControl@master_komposisi_insert")->name("produksi.api.master_komposisi_insert");
  Route::get('/api/produksi/master_komposisi_hapus/{id?}',"ApiControl@master_komposisi_hapus")->name("produksi.api.master_komposisi_hapus");
  Route::get('/api/kode_produksi',"ApiControl@kode_produksi")->name("produksi.api.kode_produksi");

  Route::get('/api/produksi/produksi_listproduk',"ApiControl@produksi_listproduk")->name("produksi.api.produksi_listproduk");
  Route::get('/api/produksi/produksi_read/{id?}',"ApiControl@produksi_read")->name("produksi.api.produksi_read");
  Route::post('/api/produksi/produksi_insert',"ApiControl@produksi_insert")->name("produksi.api.produksi_insert");
  Route::post('/api/produksi/produksi_update/{id?}',"ApiControl@produksi_update")->name("produksi.api.produksi_update");


});
// -- Direktur ---
Route::group(['middleware' => ['direktur']], function () {
  //NormalRoute
  Route::get('/direktur',"DirekturControl@index")->name('private.direktur.home');
  // API
  Route::get('/api/direktur/produksi_read/{id?}',"ApiControl@produksi_read")->name("private.api.produksi_read");
  Route::post('/api/direktur/produksi_insert',"ApiControl@produksi_insert")->name("private.api.produksi_insert");
  Route::post('/api/direktur/produksi_update/{id?}',"ApiControl@produksi_update")->name("private.api.produksi_update");
  //Pengaturan
  Route::get('/api/direktur/pengaturan/{id?}',"ApiControl@pengaturan_read")->name("private.api.pengaturan");
  Route::post('/api/direktur/pengaturan/add',"ApiControl@pengaturan_add")->name("private.api.pengaturan_add");
  Route::post('/api/direktur/pengaturan/update',"ApiControl@pengaturan_update")->name("private.api.pengaturan_update");
  Route::get('/api/direktur/pengaturan/del/{id?}',"ApiControl@pengaturan_delete")->name("private.api.pengaturan_delete");
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

  //Monitoring Pengadaan
  Route::get('/api/direktur/pbahanbaku_read_direktur/{id?}',"ApiControl@pbahanbaku_read_direktur")->name("private.api.pbahanbaku_read_direktur");
  Route::get('/api/direktur/pproduk_read_direktur/{id?}',"ApiControl@pproduk_read_direktur")->name("private.api.pproduk_read_direktur");
  Route::get('/api/direktur/pbahanbaku_setujui_direktur/{id?}',"ApiControl@pbahanbaku_setujui_direktur")->name("private.api.pbahanbaku_setujui_direktur");
  Route::get('/api/direktur/pbahanbaku_tolak_direktur/{id?}/{catatan?}',"ApiControl@pbahanbaku_tolak_direktur")->name("private.api.pbahanbaku_tolak_direktur");
  Route::get('/api/direktur/pproduk_setujui_direktur/{id?}',"ApiControl@pproduk_setujui_direktur")->name("private.api.pproduk_setujui_direktur");
  Route::get('/api/direktur/pproduk_tolak_direktur/{id?}/{catatan?}',"ApiControl@pproduk_tolak_direktur")->name("private.api.pproduk_tolak_direktur");
  Route::get('/api/direktur/konfirretur/{status?}/{id?}',"ApiControl@pbahanbakudirektur_konfirmasi")->name("private.api.konfirmasi_retur");
  Route::get('/api/direktur/konfirreturproduk/{status?}/{id?}',"ApiControl@pprodukdirektur_konfirmasi")->name("private.api.konfirmasi_retur_produk");

  Route::get('/api/direktur/pbahanbakugudangretur_check/{id?}',"ApiControl@pbahanbakugudangretur_check")->name("private.api.pbahanbakugudangretur_check");
  Route::get('/api/direktur/pbahanbakugudangretur_poread/{id?}',"ApiControl@pbahanbakugudangretur_poread")->name("private.api.pbahanbakugudangretur_poread");
  Route::get('/api/direktur/pbahanbakugudangretur_read/{id?}',"ApiControl@pbahanbakugudangretur_read")->name("private.api.pbahanbakugudangretur_read");
  Route::get('/api/direktur/pbahanbakugudangretur_show/{id?}',"ApiControl@pbahanbakugudangretur_show")->name("private.api.pbahanbakugudangretur_show");
  Route::get('/api/direktur/pbahanbakugudangretur_detailretur/{id?}',"ApiControl@pbahanbakugudangretur_detailretur")->name("private.api.pbahanbakugudangretur_detailretur");
  Route::get('/api/direktur/kode_pbahanbakugudangretur/{id?}',"ApiControl@kode_pbahanbakugudangretur")->name("private.api.kode_pbahanbakugudangretur");
  Route::post('/api/direktur/pbahanbakugudangretur_edit/{id?}',"ApiControl@pbahanbakugudangretur_edit")->name("private.api.pbahanbakugudangretur_edit");
  Route::post('/api/direktur/pbahanbakugudangretur_ajukan/{id?}',"ApiControl@pbahanbakugudangretur_ajukan")->name("private.api.pbahanbakugudangretur_ajukan");

  Route::get('/api/direktur/pprodukgudangretur_check/{id?}',"ApiControl@pprodukgudangretur_check")->name("private.api.pprodukgudangretur_check");
  Route::get('/api/direktur/pprodukgudangretur_poread/{id?}',"ApiControl@pprodukgudangretur_poread")->name("private.api.pprodukgudangretur_poread");
  Route::get('/api/direktur/pprodukgudangretur_read/{id?}',"ApiControl@pprodukgudangretur_read")->name("private.api.pprodukgudangretur_read");
  Route::get('/api/direktur/pprodukgudangretur_show/{id?}',"ApiControl@pprodukgudangretur_show")->name("private.api.pprodukgudangretur_show");
  Route::get('/api/direktur/pprodukgudangretur_detailretur/{id?}',"ApiControl@pprodukgudangretur_detailretur")->name("private.api.pprodukgudangretur_detailretur");
  Route::get('/api/direktur/kode_pprodukgudangretur/{id?}',"ApiControl@kode_pprodukgudangretur")->name("private.api.kode_pprodukgudangretur");
  Route::post('/api/direktur/pprodukgudangretur_edit/{id?}',"ApiControl@pprodukgudangretur_edit")->name("private.api.pprodukgudangretur_edit");
  Route::post('/api/direktur/pprodukgudangretur_ajukan/{id?}',"ApiControl@pprodukgudangretur_ajukan")->name("private.api.pprodukgudangretur_ajukan");


  Route::get("api/direktur/pemesanan_read/{id?}","ApiControl@direktur_pemesanan_read")->name("private.api.pemesanan_read");
  Route::post("api/direktur/pemesanan_update/{id?}","ApiControl@direktur_pemesanan_update")->name("private.api.pemesanan_update");

  Route::get("api/direktur/pengiriman_read/{id?}","ApiControl@pengiriman_read")->name("private.api.pengiriman_read");

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
  // pengandaan_bahanabaku_proses
  Route::get('/api/pengadaan/pbahanabaku_read/{id?}',"ApiControl@pbahanabaku_read")->name("pengadaan.api.pbahanabaku_read");
  Route::get('/api/pengadaan/pengandaan_bahanabaku_read/{id?}',"ApiControl@pengandaan_bahanabaku_read")->name("pengadaan.api.pengandaan_bahanabaku_read");
  Route::post('/api/pengadaan/pengandaan_bahanabaku_insert',"ApiControl@pengandaan_bahanabaku_insert")->name("pengadaan.api.pengandaan_bahanabaku_insert");
  Route::get('/api/pengadaan/pengandaan_bahanabaku_batal/{id?}',"ApiControl@pengandaan_bahanabaku_batal")->name("pengadaan.api.pengandaan_bahanabaku_batal");
  Route::get('/api/pengadaan/pengandaan_bahanabaku_selesai/{id?}',"ApiControl@pengandaan_bahanabaku_selesai")->name("pengadaan.api.pengandaan_bahanabaku_selesai");
  Route::post('/api/pengadaan/pengandaan_bahanabaku_proses/{id?}',"ApiControl@pengandaan_bahanabaku_proses")->name("pengadaan.api.pengandaan_bahanabaku_proses");
  //Hasilkan Kode Pengadaan Bahan Baku
  Route::get('/api/pengadaan/kode_pbb',"ApiControl@kode_pbb")->name("pengadaan.api.kode_pbb");
  Route::get('/api/pengadaan/pbahanbakugudangretur_check/{id?}',"ApiControl@pbahanbakugudangretur_check")->name("pengadaan.api.pbahanbakugudangretur_check");
  Route::get('/api/pengadaan/pbahanbakugudangretur_poread/{id?}',"ApiControl@pbahanbakugudangretur_poread")->name("pengadaan.api.pbahanbakugudangretur_poread");
  Route::get('/api/pengadaan/pbahanbakugudangretur_read/{id?}',"ApiControl@pbahanbakugudangretur_read")->name("pengadaan.api.pbahanbakugudangretur_read");
  Route::get('/api/pengadaan/pbahanbakugudangretur_show/{id?}',"ApiControl@pbahanbakugudangretur_show")->name("pengadaan.api.pbahanbakugudangretur_show");
  Route::get('/api/pengadaan/pbahanbakugudangretur_detailretur/{id?}',"ApiControl@pbahanbakugudangretur_detailretur")->name("pengadaan.api.pbahanbakugudangretur_detailretur");
  Route::get('/api/pengadaan/kode_pbahanbakugudangretur/{id?}',"ApiControl@kode_pbahanbakugudangretur")->name("pengadaan.api.kode_pbahanbakugudangretur");
  Route::post('/api/pengadaan/pbahanbakugudangretur_edit/{id?}',"ApiControl@pbahanbakugudangretur_edit")->name("pengadaan.api.pbahanbakugudangretur_edit");
  Route::post('/api/pengadaan/pbahanbakugudangretur_ajukan/{id?}',"ApiControl@pbahanbakugudangretur_ajukan")->name("pengadaan.api.pbahanbakugudangretur_ajukan");
  Route::get('/api/pengadaan/konfirretur/{status?}/{id?}',"ApiControl@pbahanbakupengadaan_konfirmasi")->name("pengadaan.api.konfirmasi_retur");

  // Produk
  Route::get('/api/pengadaan/pproduk_read/{id?}',"ApiControl@pproduk_read")->name("pengadaan.api.pproduk_read");
  Route::get('/api/pengadaan/pengandaan_produk_read/{id?}',"ApiControl@pengandaan_produk_read")->name("pengadaan.api.pengandaan_produk_read");
  Route::post('/api/pengadaan/pengandaan_produk_insert',"ApiControl@pengandaan_produk_insert")->name("pengadaan.api.pengandaan_produk_insert");
  Route::get('/api/pengadaan/pengandaan_produk_batal/{id?}',"ApiControl@pengandaan_produk_batal")->name("pengadaan.api.pengandaan_produk_batal");
  Route::get('/api/pengadaan/pengandaan_produk_selesai/{id?}',"ApiControl@pengandaan_produk_selesai")->name("pengadaan.api.pengandaan_produk_selesai");
  Route::post('/api/pengadaan/pengandaan_produk_proses/{id?}',"ApiControl@pengandaan_produk_proses")->name("pengadaan.api.pengandaan_produk_proses");
  //Hasilkan Kode Pengadaan Bahan Baku
  Route::get('/api/pengadaan/kode_pp',"ApiControl@kode_pp")->name("pengadaan.api.kode_pp");
  Route::get('/api/pengadaan/pprodukgudangretur_check/{id?}',"ApiControl@pprodukgudangretur_check")->name("pengadaan.api.pprodukgudangretur_check");
  Route::get('/api/pengadaan/pprodukgudangretur_poread/{id?}',"ApiControl@pprodukgudangretur_poread")->name("pengadaan.api.pprodukgudangretur_poread");
  Route::get('/api/pengadaan/pprodukgudangretur_read/{id?}',"ApiControl@pprodukgudangretur_read")->name("pengadaan.api.pprodukgudangretur_read");
  Route::get('/api/pengadaan/pprodukgudangretur_show/{id?}',"ApiControl@pprodukgudangretur_show")->name("pengadaan.api.pprodukgudangretur_show");
  Route::get('/api/pengadaan/pprodukgudangretur_detailretur/{id?}',"ApiControl@pprodukgudangretur_detailretur")->name("pengadaan.api.pprodukgudangretur_detailretur");
  Route::get('/api/pengadaan/kode_pprodukgudangretur/{id?}',"ApiControl@kode_pprodukgudangretur")->name("pengadaan.api.kode_pprodukgudangretur");
  Route::post('/api/pengadaan/pprodukgudangretur_edit/{id?}',"ApiControl@pprodukgudangretur_edit")->name("pengadaan.api.pprodukgudangretur_edit");
  Route::post('/api/pengadaan/pprodukgudangretur_ajukan/{id?}',"ApiControl@pprodukgudangretur_ajukan")->name("pengadaan.api.pprodukgudangretur_ajukan");
  Route::get('/api/pengadaan/konfirreturproduk/{status?}/{id?}',"ApiControl@pprodukpengadaan_konfirmasi")->name("pengadaan.api.konfirmasi_returproduk");
});
Route::group(['middleware' => ['gudang']], function () {
  Route::get('/gudang',"GudangControl@index")->name('private.gudang.home');
  Route::get('/api/gudang/produksi_read/{id?}',"ApiControl@produksi_read")->name("gudang.api.produksi_read");
  Route::post('/api/gudang/produksi_insert',"ApiControl@produksi_insert")->name("gudang.api.produksi_insert");
  Route::post('/api/gudang/produksi_update/{id?}/{in?}',"ApiControl@produksi_update")->name("gudang.api.produksi_update");
  //Satuan
  Route::get('/api/gudang/master_satuan_read/{id?}',"ApiControl@master_satuan_read")->name("gudang.api.master_satuan_read");
  Route::post('/api/gudang/master_satuan_insert',"ApiControl@master_satuan_insert")->name("gudang.api.master_satuan_insert");
  Route::post('/api/gudang/master_satuan_update/{id?}',"ApiControl@master_satuan_update")->name("gudang.api.master_satuan_update");
  //Bahan Baku
  Route::get('/api/gudang/master_bb_read/{id?}',"ApiControl@master_bb_read")->name("gudang.api.master_bb_read");
  Route::post('/api/gudang/master_bb_insert',"ApiControl@master_bb_insert")->name("gudang.api.master_bb_insert");
  Route::post('/api/gudang/master_bb_update/{id?}',"ApiControl@master_bb_update")->name("gudang.api.master_bb_update");
  //Suplier
  Route::get('/api/gudang/master_suplier_read/{id?}',"ApiControl@master_suplier_read")->name("gudang.api.master_suplier_read");
  Route::post('/api/gudang/master_suplier_insert',"ApiControl@master_suplier_insert")->name("gudang.api.master_suplier_insert");
  Route::post('/api/gudang/master_suplier_update/{id?}',"ApiControl@master_suplier_update")->name("gudang.api.master_suplier_update");
  //Produk dan Komposisi
  Route::get('/api/gudang/master_produk_read/{id?}',"ApiControl@master_produk_read")->name("gudang.api.master_produk_read");
  Route::post('/api/gudang/master_produk_insert',"ApiControl@master_produk_insert")->name("gudang.api.master_produk_insert");
  Route::post('/api/gudang/master_produk_update/{id?}',"ApiControl@master_produk_update")->name("gudang.api.master_produk_update");

  Route::get('/api/gudang/master_komposisi_read/{id?}',"ApiControl@master_komposisi_read")->name("gudang.api.master_komposisi_read");
  Route::post('/api/gudang/master_komposisi_insert',"ApiControl@master_komposisi_insert")->name("gudang.api.master_komposisi_insert");
  Route::get('/api/gudang/master_komposisi_hapus/{id?}',"ApiControl@master_komposisi_hapus")->name("gudang.api.master_komposisi_hapus");

  //gudang Bahan Baku
  Route::get('/api/gudang/pbahanabaku_read/{id?}',"ApiControl@pbahanabakugudang_read")->name("gudang.api.pbahanabaku_read");
  Route::post('/api/gudang/pbahanbakugudang_konfirmasi/{id?}',"ApiControl@pbahanbakugudang_konfirmasi")->name("gudang.api.pbahanabaku_konfirmasi");
  Route::get('/api/gudang/pengandaan_bahanabaku_read/{id?}',"ApiControl@pengandaan_bahanabaku_read")->name("gudang.api.pengandaan_bahanabaku_read");
  Route::post('/api/gudang/pengandaan_bahanabaku_insert',"ApiControl@pengandaan_bahanabaku_insert")->name("gudang.api.pengandaan_bahanabaku_insert");
  Route::get('/api/gudang/pengandaan_bahanabaku_batal/{id?}',"ApiControl@pengandaan_bahanabaku_batal")->name("gudang.api.pengandaan_bahanabaku_batal");
  //Hasilkan Kode gudang Bahan Baku
  Route::get('/api/gudang/kode_pbb',"ApiControl@kode_pbb")->name("gudang.api.kode_pbb");
  Route::get('/api/gudang/pbahanbakugudangretur_check/{id?}',"ApiControl@pbahanbakugudangretur_check")->name("gudang.api.pbahanbakugudangretur_check");
  Route::get('/api/gudang/pbahanbakugudangretur_poread/{id?}',"ApiControl@pbahanbakugudangretur_poread")->name("gudang.api.pbahanbakugudangretur_poread");
  Route::get('/api/gudang/pbahanbakugudangretur_read/{id?}',"ApiControl@pbahanbakugudangretur_read")->name("gudang.api.pbahanbakugudangretur_read");
  Route::get('/api/gudang/pbahanbakugudangretur_show/{id?}',"ApiControl@pbahanbakugudangretur_show")->name("gudang.api.pbahanbakugudangretur_show");
  Route::get('/api/gudang/pbahanbakugudangretur_detailretur/{id?}',"ApiControl@pbahanbakugudangretur_detailretur")->name("gudang.api.pbahanbakugudangretur_detailretur");
  Route::get('/api/gudang/kode_pbahanbakugudangretur/{id?}',"ApiControl@kode_pbahanbakugudangretur")->name("gudang.api.kode_pbahanbakugudangretur");
  Route::post('/api/gudang/pbahanbakugudangretur_edit/{id?}',"ApiControl@pbahanbakugudangretur_edit")->name("gudang.api.pbahanbakugudangretur_edit");
  Route::post('/api/gudang/pbahanbakugudangretur_ajukan/{id?}',"ApiControl@pbahanbakugudangretur_ajukan")->name("gudang.api.pbahanbakugudangretur_ajukan");
  //Produk
  Route::get('/api/gudang/pproduk_read/{id?}',"ApiControl@pprodukgudang_read")->name("gudang.api.pproduk_read");
  Route::post('/api/gudang/pprodukgudang_konfirmasi/{id?}',"ApiControl@pprodukgudang_konfirmasi")->name("gudang.api.pproduk_konfirmasi");
  Route::get('/api/gudang/pengandaan_bahanabaku_read/{id?}',"ApiControl@pengandaan_bahanabaku_read")->name("gudang.api.pengandaan_bahanabaku_read");
  Route::post('/api/gudang/pengandaan_bahanabaku_insert',"ApiControl@pengandaan_bahanabaku_insert")->name("gudang.api.pengandaan_bahanabaku_insert");
  Route::get('/api/gudang/pengandaan_bahanabaku_batal/{id?}',"ApiControl@pengandaan_bahanabaku_batal")->name("gudang.api.pengandaan_bahanabaku_batal");
  Route::get('/api/gudang/kode_pbb',"ApiControl@kode_pbb")->name("gudang.api.kode_pbb");
  Route::get('/api/gudang/pprodukgudangretur_check/{id?}',"ApiControl@pprodukgudangretur_check")->name("gudang.api.pprodukgudangretur_check");
  Route::get('/api/gudang/pprodukgudangretur_poread/{id?}',"ApiControl@pprodukgudangretur_poread")->name("gudang.api.pprodukgudangretur_poread");
  Route::get('/api/gudang/pprodukgudangretur_read/{id?}',"ApiControl@pprodukgudangretur_read")->name("gudang.api.pprodukgudangretur_read");
  Route::get('/api/gudang/pprodukgudangretur_show/{id?}',"ApiControl@pprodukgudangretur_show")->name("gudang.api.pprodukgudangretur_show");
  Route::get('/api/gudang/pprodukgudangretur_detailretur/{id?}',"ApiControl@pprodukgudangretur_detailretur")->name("gudang.api.pprodukgudangretur_detailretur");
  Route::get('/api/gudang/kode_pprodukgudangretur/{id?}',"ApiControl@kode_pprodukgudangretur")->name("gudang.api.kode_pprodukgudangretur");
  Route::post('/api/gudang/pprodukgudangretur_edit/{id?}',"ApiControl@pprodukgudangretur_edit")->name("gudang.api.pprodukgudangretur_edit");
  Route::post('/api/gudang/pprodukgudangretur_ajukan/{id?}',"ApiControl@pprodukgudangretur_ajukan")->name("gudang.api.pprodukgudangretur_ajukan");


});
Route::group(['middleware'=>['pemasaran']],function(){
  Route::get('/pemasaran',"PemasaranControl@index")->name('private.pemasaran.home');
  Route::get('/api/pemasaran/master_produk_read/{id?}',"ApiControl@master_produk_read")->name("pemasaran.api.master_produk_read");
  Route::post('/api/pemasaran/master_produk_insert',"ApiControl@master_produk_insert")->name("pemasaran.api.master_produk_insert");
  Route::post('/api/pemasaran/master_produk_update/{id?}',"ApiControl@master_produk_update")->name("pemasaran.api.master_produk_update");

  Route::get('/api/pemasaran/master_komposisi_read/{id?}',"ApiControl@master_komposisi_read")->name("pemasaran.api.master_komposisi_read");
  Route::post('/api/pemasaran/master_komposisi_insert',"ApiControl@master_komposisi_insert")->name("pemasaran.api.master_komposisi_insert");
  Route::get('/api/pemasaran/master_komposisi_hapus/{id?}',"ApiControl@master_komposisi_hapus")->name("pemasaran.api.master_komposisi_hapus");

  Route::get('/api/pemasaran/master_transportasi_read/{id?}',"ApiControl@master_transportasi_read")->name("pemasaran.api.master_transportasi_read");
  Route::post('/api/pemasaran/master_transportasi_insert',"ApiControl@master_transportasi_insert")->name("pemasaran.api.master_transportasi_insert");
  Route::post('/api/pemasaran/master_transportasi_update/{id?}',"ApiControl@master_transportasi_update")->name("pemasaran.api.master_transportasi_update");

  Route::get('/api/pemasaran/master_satuan_read/{id?}',"ApiControl@master_satuan_read")->name("pemasaran.api.master_satuan_read");
  Route::post('/api/pemasaran/master_satuan_insert',"ApiControl@master_satuan_insert")->name("pemasaran.api.master_satuan_insert");
  Route::post('/api/pemasaran/master_satuan_update/{id?}',"ApiControl@master_satuan_update")->name("pemasaran.api.master_satuan_update");

  Route::get('/api/pemasaran/master_pelanggan_read/{id?}',"ApiControl@master_pelanggan_read")->name("pemasaran.api.master_pelanggan_read");
  Route::post('/api/pemasaran/master_pelanggan_insert',"ApiControl@master_pelanggan_insert")->name("pemasaran.api.master_pelanggan_insert");
  Route::post('/api/pemasaran/master_pelanggan_update/{id?}',"ApiControl@master_pelanggan_update")->name("pemasaran.api.master_pelanggan_update");

  Route::get("api/pemasaran/p_produk_read/{id?}","ApiControl@p_produk_read")->name("pemasaran.api.p_produk_read");
  Route::get("api/pemasaran/listpelanggan","ApiControl@listpelanggan")->name("pemasaran.api.listpelanggan");
  Route::post("api/pemasaran/p_produk_trans","ApiControl@p_produk_trans")->name("pemasaran.api.p_produk_trans");

  Route::get("api/pemasaran/pemesanan_read/{id?}","ApiControl@pemesanan_read")->name("pemasaran.api.pemesanan_read");
  Route::post("api/pemasaran/pemesanan_update/{id?}","ApiControl@pemesanan_update")->name("pemasaran.api.pemesanan_update");

  Route::get("api/pemasaran/pengiriman_read/{id?}","ApiControl@pengiriman_read")->name("pemasaran.api.pengiriman_read");
  Route::get("api/pemasaran/transportasi_aktif","ApiControl@aktif_trasport")->name("pemasaran.api.aktif_trasport");
  Route::get("api/pemasaran/ready_ship","ApiControl@ready_ship")->name("pemasaran.api.ready_ship");
  Route::get("api/pemasaran/kode","ApiControl@pengiriman_kode")->name("pemasaran.api.pengiriman_kode");
  Route::post("api/pemasaran/pengiriman_update/{id?}","ApiControl@pengiriman_update")->name("pemasaran.api.pengiriman_update");
  Route::post("api/pemasaran/pengiriman_insert/{id?}","ApiControl@pengiriman_insert")->name("pemasaran.api.pengiriman_insert");
});
