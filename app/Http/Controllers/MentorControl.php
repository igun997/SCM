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
