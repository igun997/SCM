<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use \App\Models\{MasterBb,MasterKomposisi,MasterPelanggan,MasterProduk,MasterSatuan,MasterSuplier,MasterTransportasi,Pemesanan,PemesananDetail,PengadaanBb,PengadaanBbDetail,Pengaturan,Pengguna,Pengiriman,PengirimanDetail,Produksi,ProduksiDetail,WncGerai,WncOrder,WncPelanggan,WncProduk,PengadaanBbRetur,PengadaanBbReturDetail,PengadaanProduk,PengadaanProdukDetail,PengadaanProdukRetur,PengadaanProdukReturDetail,GeraiPelanggan,GeraiOrder,GeraiOrderDetail,GeraiLayanan,GeraiKontrol,GeraiDriver,GeraiBarangDetail,GeraiBarang,GeraiBagihasil};
class GeraiControl extends Controller
{
    public function index_fix($id)
    {
      $a = GeraiKontrol::where(["id"=>$id]);
      $a->update(["status_evaluasi"=>1]);
      return back();
    }
    public function set_pesanan()
    {
      $data = [
        "title"=>"Tambah Pesanan",
        "randomize"=>Str::random(12),
        "layanan"=>GeraiLayanan::where(["pemilik_id"=>session()->get("id_pengguna")])->get()
      ];
      return view("franchise.gerai.pesanan_set")->with($data);
    }
    public function set_pesanansimpan(Request $req)
    {
      $data = $req->all();
      $qty = $req->qty;
      unset($data["qty"]);
      $data["status"] = 1;
      $createUser = GeraiPelanggan::create($data);
      if ($createUser) {
        $id = $createUser->id;
        $set = ["gerai_pelanggan_id"=>$id,"pemilik_id"=>session()->get("id_pengguna"),"status_order"=>2,"catatan"=>$req->catatan,"progress"=>[["tgl"=>date("d-m-Y"),"status"=>"Barang Diterima Di Gerai"]],"totalharga"=>$data["totalharga"],"offline"=>1];
        $order = GeraiOrder::create($set);
        if ($order) {
          $id = $order->id;
          $item = [];
          foreach ($qty as $key => $value) {
            if ($value > 0) {
              $item[] = ["gerai_order_id"=>$id,"gerai_layanan_id"=>$key,"qty"=>$value];
            }
          }
          $yes = GeraiOrderDetail::insert($item);
          if ($yes) {
            return response()->json(["status"=>1]);
          }else {
            return response()->json(["status"=>0]);
          }
        }else {
          return response()->json(["status"=>0]);

        }
      }else {
        return response()->json(["status"=>0]);

      }
    }
    public function detailapi($id)
    {
      $d = GeraiOrder::where("id",$id);
      if ($d->count() > 0) {
        $data = $d->first();
        $data->gerai_driver;
        $data->gerai_layanan;
        $data->nama_pelanggan = $data->gerai_pelanggan->nama;
        $data->pengguna;
        $data->gerai_driver_antar;
        $data->gerai_driver_jemput;
        $data->id_formatted = str_pad($data->id,5,0,STR_PAD_LEFT);
        $data->order = $data->status_format($data->status_order);
        foreach ($data->gerai_order_details as $k => $v) {
          $v->gerai_layanan;
        }
        return ["status"=>true,"data"=>$data];
      }else {
        return ["status"=>false];
      }
    }
    public function layanan_selesaikanorder($id)
    {
      $cek = GeraiOrder::where(["id"=>$id]);
      if ($cek->count() > 0) {
        $progress = $cek->first()->progress;
        $progress[] = ["tgl"=>date("d-m-Y"),"status"=>"Order Selesai"];
        $p = json_encode($progress);
        $cek->update(["status_order"=>6,"progress"=>$p]);
        return back();
      }else {
        return back()->withErrors(["msg"=>"Gagal Update"]);
      }
    }
    public function index()
    {
      $trx = GeraiKontrol::where(["pemilik_id"=>session()->get("id_pengguna")]);
      $data = $trx->get();
      return view("franchise.gerai.home")->with(["title"=>"Dashboard Gerai","data"=>$data]);
    }
    public function pesanan()
    {
      $d = GeraiOrder::where(["pemilik_id"=>session()->get("id_pengguna")])->get();
      $data = ["title"=>"Data Pesanan","data"=>$d];
      return view("franchise.gerai.pesanan")->with($data);
    }
    public function layanan()
    {
      $d = GeraiLayanan::where(["pemilik_id"=>session()->get("id_pengguna")])->orderBy("id","desc")->get();
      $data = ["title"=>"Data Layanan","data"=>$d];
      return view("franchise.gerai.layanan")->with($data);
    }
    public function pesanan_selesai($id)
    {
      $cek = GeraiOrder::where(["id"=>$id]);
      if ($cek->count() > 0) {
        $progress = $cek->first()->progress;
        $progress[] = ["tgl"=>date("d-m-Y"),"status"=>"Order Selesai"];
        $p = json_encode($progress);
        $cek->update(["status_order"=>6,"progress"=>$p]);
        return back();
      }else {
        return back()->withErrors(["msg"=>"Gagal Update"]);
      }
    }
    public function layanan_diterima($id)
    {
      $cek = GeraiOrder::where(["id"=>$id]);
      if ($cek->count() > 0) {
        $progress = $cek->first()->progress;
        $progress[] = ["tgl"=>date("d-m-Y"),"status"=>"Diterima Gerai"];
        $p = json_encode($progress);
        $cek->update(["status_order"=>2,"progress"=>$p]);
        return back();
      }else {
        return back()->withErrors(["msg"=>"Gagal Update"]);
      }
    }
    public function layanan_cuci($id)
    {
      $cek = GeraiOrder::where(["id"=>$id]);
      if ($cek->count() > 0) {
        $progress = $cek->first()->progress;
        $progress[] = ["tgl"=>date("d-m-Y"),"status"=>"Sedang Dicuci"];
        $p = json_encode($progress);
        $cek->update(["status_order"=>3,"progress"=>$p]);
        return back();
      }else {
        return back()->withErrors(["msg"=>"Gagal Update"]);
      }
    }
    public function layanan_cuciselesai($id)
    {
      $cek = GeraiOrder::where(["id"=>$id]);
      if ($cek->count() > 0) {
        $progress = $cek->first()->progress;
        $progress[] = ["tgl"=>date("d-m-Y"),"status"=>"Selesai Dicuci"];

        $p = json_encode($progress);
        $cek->update(["status_order"=>4,"progress"=>$p]);
        return back();
      }else {
        return back()->withErrors(["msg"=>"Gagal Update"]);
      }
    }
    public function laporanpesanan()
    {
      $d = GeraiOrder::where(["pemilik_id"=>session()->get("id_pengguna")])->get();
      $data = ["title"=>"Laporan Pesanan","data"=>$d];
      return view("franchise.gerai.lappesanan")->with($data);
    }
    public function laporanbarang()
    {
      $d = GeraiBarang::where(["pemilik_id"=>session()->get("id_pengguna")]);
      $data = $d->get();
      $c = ["title"=>"Laporan Data Barang","data"=>$data];
      return view("franchise.gerai.laporanbarang")->with($c);
    }
    public function keuangan()
    {
      $d = GeraiOrder::where(["pemilik_id"=>session()->get("id_pengguna"),"status_order"=>6]);
      if ($d->count() > 0) {
        $data =$d->get();
        return view("franchise.gerai.keuangan")->with(["title"=>"Laporan Keuangan","data"=>$data]);
      }else {
        return back();
      }
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
      $stok = 0;
      foreach ($data->gerai_barang_details as $key => $value) {
        if ($value->jenis == "masuk") {
          $stok = $stok + $value->qty;
        }else {
          $stok = $stok - $value->qty;
        }
      }
      $data->stok = $stok;
      return view("franchise.gerai.barang_keluar")->with(["title"=>"Tambah Barang Keluar","data"=>$data]);
    }
}
