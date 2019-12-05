<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Models\{MasterBb,MasterKomposisi,MasterPelanggan,MasterProduk,MasterSatuan,MasterSuplier,MasterTransportasi,Pemesanan,PemesananDetail,PengadaanBb,PengadaanBbDetail,Pengaturan,Pengguna,Pengiriman,PengirimanDetail,Produksi,ProduksiDetail,WncGerai,WncOrder,WncPelanggan,WncProduk,PengadaanBbRetur,PengadaanBbReturDetail,PengadaanProduk,PengadaanProdukDetail,PengadaanProdukRetur,PengadaanProdukReturDetail,GeraiPelanggan,GeraiOrder,GeraiLayanan,GeraiKontrol,GeraiDriver,GeraiBarangDetail,GeraiBarang,GeraiBagihasil};
class GeraiControl extends Controller
{
    public function index()
    {
      return view("franchise.gerai.home")->with(["title"=>"Dashboard Gerai"]);
    }
    public function layanan()
    {
      $d = GeraiLayanan::where(["pemilik_id"=>session()->get("id_pengguna")])->orderBy("id","desc")->get();
      $data = ["title"=>"Data Layanan","data"=>$d];
      return view("franchise.gerai.layanan")->with($data);
    }
    public function barang()
    {
      $brg = GeraiBarang::where(["pemilik_id"=>session()->get("id_pengguna")])->orderBy("id","desc")->get();
      $data = ["title"=>"Data Barang","barang"=>$brg];
      return view("franchise.gerai.barang")->with($data);
    }
    public function barang_trans(Request $req,$id,$konf=null)
    {
      if ($konf == 1) {
        $up = GeraiBarangDetail::where(["id"=>$id]);
        $up->update(["konf_pemilik"=>1,"tgl_konf"=>date("Y-m-d")]);
        return back();
      }
      if (isset($_POST["qty"])) {
        $data = $req->all();
        $data["gerai_barang_id"] = $id;
        $data["jenis"] = "keluar";
        $data["konf_pemilik"] = 1;
        $data["tgl_konf"] = date("Y-m-d");
        $ins = GeraiBarangDetail::create($data);
        return back();
      }
      $data = GeraiBarang::where(["id"=>$id])->first();
      return view("franchise.gerai.barang_keluar")->with(["title"=>"Tambah Barang Keluar","data"=>$data]);
    }
}
