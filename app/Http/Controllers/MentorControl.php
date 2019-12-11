<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Models\{MasterBb,MasterKomposisi,MasterPelanggan,MasterProduk,MasterSatuan,MasterSuplier,MasterTransportasi,Pemesanan,PemesananDetail,PengadaanBb,PengadaanBbDetail,Pengaturan,Pengguna,Pengiriman,PengirimanDetail,Produksi,ProduksiDetail,WncGerai,WncOrder,WncPelanggan,WncProduk,PengadaanBbRetur,PengadaanBbReturDetail,PengadaanProduk,PengadaanProdukDetail,PengadaanProdukRetur,PengadaanProdukReturDetail,GeraiPelanggan,GeraiOrder,GeraiLayanan,GeraiKontrol,GeraiDriver,GeraiBarangDetail,GeraiBarang,GeraiBagihasil};
class MentorControl extends Controller
{
  public function index()
  {
    return view("franchise.mentor.home")->with(["title"=>"Dashboard Mentor"]);
  }
  public function controlling_audit($id)
  {
    $trx = GeraiKontrol::where(["pemilik_id"=>$id]);
    $data = $trx->get();
    $gerailist = Pengguna::where(["pengguna_id"=>session()->get("id_pengguna")])->get();
    $c = ["title"=>"Audit Gerai","data"=>$data,"gerai"=>$gerailist];
    return view("franchise.mentor.controlling_audit")->with($c);
  }
  public function controlling_auditpost(Request $req,$id)
  {
    $data = $req->all();
    if ($data["status_evaluasi"] == "") {
      unset($data["status_evaluasi"]);
    }
    $data["mentor_id"] = session()->get("id_pengguna");
    $ins = GeraiKontrol::create($data);
    return back();
  }
  public function laporankeuangan($id)
  {
    $d = GeraiOrder::where(["pemilik_id"=>$id,"status_order"=>6]);
    if ($d->count() > 0) {
      $data =$d->get();
      return view("franchise.gerai.keuangan")->with(["title"=>"Laporan Keuangan","data"=>$data]);
    }else {
      return back();
    }
  }
  public function laporanbarang($id)
  {
    $d = GeraiBarang::where(["pemilik_id"=>$id]);
    $data = $d->get();
    $c = ["title"=>"Laporan Data Barang","data"=>$data];
    return view("franchise.gerai.laporanbarang")->with($c);
  }
  public function laporanpesanan($id)
  {
    $d = GeraiOrder::where(["pemilik_id"=>$id])->get();
    $data = ["title"=>"Laporan Pesanan","data"=>$d];
    return view("franchise.gerai.lappesanan")->with($data);
  }
  public function controlling()
  {
    $frs = Pengguna::where(["pengguna_id"=>session()->get("id_pengguna")])->get();
    return view("franchise.mentor.controlling")->with(["title"=>"Data Controlling","frs"=>$frs]);
  }
  public function franchise_layanan($id)
  {
    $c = Pengguna::where(["pengguna_id"=>session()->get("id_pengguna"),"id_pengguna"=>$id]);
    if ($c->count() > 0) {
      $d = $c->first();
      return view("franchise.mentor.franchise_layanan")->with(["title"=>"Manajemen Layanan MITRA","data"=>$d]);
    }else {
      return back()->withErrors(["msg"=>"Data Tidak Ditemukan"]);
    }
  }
  public function franchise_layananadd(Request $req,$id)
  {
    if ($req->has("nama")) {
      $req->validate([
        "harga"=>"required|numeric",
        "nama"=>"required",
      ]);
      $d = $req->all();
      $d["pemilik_id"] = $id;
      $ins = GeraiLayanan::create($d);
      return redirect(route("mentor.franchise.layanan",$id));
    }
    return view("franchise.mentor.franchise_layananform")->with(["title"=>"Tambah Layanan"]);
  }
  public function franchise_layananedit(Request $req,$id,$ids)
  {
    if ($req->has("nama")) {
      $req->validate([
        "harga"=>"required|numeric",
        "nama"=>"required",
      ]);
      $d = $req->all();
      $d["pemilik_id"] = $id;
      unset($d["_token"]);
      $ins = GeraiLayanan::where(["id"=>$ids])->update($d);
      return redirect(route("mentor.franchise.layanan",$id));
    }
    $data = GeraiLayanan::where(["id"=>$ids]);
    if ($data->count() > 0) {
      return view("franchise.mentor.franchise_layananform")->with(["title"=>"Edit Layanan","data"=>$data->first()]);
    }else {
      return back();
    }
  }
  public function franchise()
  {
    $frs = Pengguna::where(["pengguna_id"=>session()->get("id_pengguna")])->get();
    return view("franchise.mentor.franchise")->with(["title"=>"Data Franchise","frs"=>$frs]);
  }
  public function franchise_barang($id)
  {
    $c = Pengguna::where(["pengguna_id"=>session()->get("id_pengguna"),"id_pengguna"=>$id]);
    if ($c->count() > 0) {
      $d = $c->first();
      return view("franchise.mentor.franchise_barang")->with(["title"=>"Manajemen Barang MITRA","data"=>$d]);
    }else {
      return back()->withErrors(["msg"=>"Data Tidak Ditemukan"]);
    }
  }
  public function franchise_barangmasuk(Request $req,$id = null)
  {
    if (isset($_POST["qty"])) {
      $data = $req->all();
      $data["gerai_barang_id"] = $id;
      $data["jenis"] = "masuk";
      $ins = GeraiBarangDetail::create($data);
      return back();
    }
    $data = GeraiBarang::where(["id"=>$id])->first();
    return view("franchise.mentor.franchise_barangmasuk")->with(["title"=>"Tambah Barang Masuk","data"=>$data]);
  }
  public function franchise_barangadd(Request $req,$id = null)
  {
    if (isset($_POST["nama_barang"])) {
      $data = $req->all();
      $data["pemilik_id"] = $id;
      $data["mentor_id"] = session()->get("id_pengguna");
      $ins = GeraiBarang::create($data);
      return redirect(route("mentor.franchise.barang",$id));
    }
    return view("franchise.mentor.franchise_barangform")->with(["title"=>"Tambah Barang"]);
  }
}
