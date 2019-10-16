<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\{MasterBb,MasterKomposisi,MasterPelanggan,MasterProduk,MasterSatuan,MasterSuplier,MasterTransportasi,Pemesanan,PemesananDetail,PengadaanBb,PengadaanBbDetail,PengdaanProduk,PengdaanProdukDetail,Pengaturan,Pengguna,Pengiriman,PengirimanDetail,Produksi,ProduksiDetail,WncGerai,WncOrder,WncPelanggan,WncProduk};
class ApiControl extends Controller
{
    //Public API
    public function login(Request $req)
    {
      $req->validate([
        "email"=>"required|min:2",
        "password"=>"required|min:2"
      ]);
      $data = $req->all();
      $data["status"] = 1;
      $cek = Pengguna::where($data);
      if ($cek->count() > 0) {
        $row = $cek->first();
        session(["level"=>$row->level,"id_pengguna"=>$row->id_pengguna,"nama"=>$row->nama_pengguna]);
        return response()->json(["status"=>1,"path"=>url("$row->level")]);
      }else {
        return response()->json(["status"=>0]);
      }
    }

    //Direktur
    public function master_bb_read(Request $req,$id = null)
    {
      if ($id != null) {
        $find = MasterBb::join("master__satuan","master__satuan.id_satuan","=","master__bb.id_satuan")->where(["id_bb"=>$id])->first();
        if ($id == "all") {
          if ($req->input("q") != null) {
            if ($req->input("q") == "") {
              $find = MasterBb::join("master__satuan","master__satuan.id_satuan","=","master__bb.id_satuan")->get();
            }else {
              $find = MasterBb::where("id_bb","like","%".$req->input("q")."%")->orWhere("nama","like","%".$req->input("q")."%")->join("master__satuan","master__satuan.id_satuan","=","master__bb.id_satuan")->get();
            }
          }else {
            $find = MasterBb::join("master__satuan","master__satuan.id_satuan","=","master__bb.id_satuan")->get();
          }
        }
        $res = [];
        return response()->json($find);
      }
      $data = [];
      $data["data"] = [];
      $getAll = MasterBb::orderBy("tgl_register","desc")->get();
      $btnCreate = function($id){
        return $actionBtn = '<button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle">Aksi</button>
        <div class="dropdown-menu dropdown-menu-right">
        <button class="dropdown-item edit" data-id="'.$id.'" type="button">
          Ubah
        </button>
        </div>';
      };
      foreach ($getAll as $key => $value) {
        $data["data"][] = [$value->id_bb,$value->nama,$value->stok." ".$value->master_satuan->nama_satuan,$value->stok_minimum." ".$value->master_satuan->nama_satuan,number_format($value->harga),date("Y-m-d",strtotime($value->tgl_register)),$btnCreate($value->id_bb)];
      }
      return response()->json($data);
    }
    public function master_bb_insert(Request $req)
    {
      $req->validate([
        "nama"=>"required|min:2",
        "stok_minimum"=>"required|numeric",
        "harga"=>"required|numeric",
        "id_satuan"=>"required|numeric",
      ]);
      $kodifikasi = "BB".date("dmy")."-".str_pad((MasterBb::count()+1),3,0,STR_PAD_LEFT);
      $data = $req->all();
      $data["id_bb"] = $kodifikasi;
      $ins = MasterBb::create($data);
      if ($ins) {
        return response()->json(["status"=>1],200);
      }else {
        return response()->json(["status"=>0],500);
      }
    }
    public function master_bb_update(Request $req,$id)
    {
      $req->validate([
        "nama"=>"required|min:2",
        "stok_minimum"=>"required|numeric",
        "harga"=>"required|numeric",
        "id_satuan"=>"required|numeric",
      ]);
      $ins = MasterBb::findOrFail($id)->update($req->all());
      if ($ins) {
        return response()->json(["status"=>1],200);
      }else {
        return response()->json(["status"=>0],500);
      }
    }

    public function pbahanbaku_read_direktur($id = null)
    {
      if ($id != null) {
        $whereGet = PengadaanBb::where(["id_pengadaan_bb"=>$id]);
        if ($whereGet->count() > 0) {
          $row = $whereGet->first();
          $row->master_suplier;
          foreach ($row->pengadaan__bb_details as $key => $value) {
            $value->master_bb;
            $value->master_bb->master_satuan;
          }
          return response()->json(["status"=>1,"data"=>$row]);
        }else {
          return response()->json(["status"=>0,"msg"=>"Not Found"]);
        }
      }else {
        $getAll = PengadaanBb::orderBy("tgl_perubahan","desc")->orderBy("tgl_register","desc")->orderBy("status_pengadaan","asc")->get();
        $data = [];
        $data["data"] = [];
        $btnCreate = function($id,$status){
          if ($status == 0) {
            return $actionBtn = '<button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle">Aksi</button>
            <div class="dropdown-menu dropdown-menu-right">
            <button class="dropdown-item rincian" data-id="'.$id.'"  type="button">
            Rincian
            </button>
            <button class="dropdown-item setujui" data-id="'.$id.'"  type="button">
            Setujui Pengadaan
            </button>
            <button class="dropdown-item tolak" data-id="'.$id.'"  type="button">
            Tolak Pengadaan
            </button>
            </div>';
          }else {
            return $actionBtn = '<button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle">Aksi</button>
            <div class="dropdown-menu dropdown-menu-right">
            <button class="dropdown-item rincian" data-id="'.$id.'"  type="button">
            Rincian
            </button>
            </div>';
          }
        };
        foreach ($getAll as $key => $value) {
          $data["data"][] = [($key+1),$value->id_pengadaan_bb,"[".$value->id_suplier."]"." ".$value->master_suplier->nama_suplier,status_pengadaan($value->status_pengadaan),konfirmasi($value->konfirmasi_direktur),($value->tgl_perubahan == null)?null:date("d-m-Y",strtotime($value->tgl_perubahan)),$btnCreate($value->id_pengadaan_bb,$value->status_pengadaan)];
        }
        return response()->json($data);
      }
    }
    public function pbahanbaku_setujui_direktur($id)
    {
      $find = PengadaanBb::findOrFail($id)->update(["status_pengadaan"=>2,"konfirmasi_direktur"=>1,"tgl_perubahan"=>date("Y-m-d")]);
      if ($find) {
        return response()->json(["status"=>1]);
      }else {
        return response()->json(["status"=>0]);
      }
    }
    public function pbahanbaku_tolak_direktur($id,$catatan=null)
    {
      $find = PengadaanBb::findOrFail($id)->update(["status_pengadaan"=>1,"catatan_direktur"=>$catatan,"tgl_perubahan"=>date("Y-m-d")]);
      if ($find) {
        return response()->json(["status"=>1]);
      }else {
        return response()->json(["status"=>0]);
      }
    }
    public function master_satuan_read($id = null)
    {
      if ($id != null) {
        $find = MasterSatuan::where(["id_satuan"=>$id])->first();
        if ($id == "all") {
          $find = MasterSatuan::selectRaw("id_satuan as value,nama_satuan as text")->get();
        }
        $res = [];
        return response()->json($find);
      }
      $data = [];
      $data["data"] = [];
      $getAll = MasterSatuan::all();
      $btnCreate = function($id,$nama){
        return $actionBtn = '<button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle">Aksi</button>
        <div class="dropdown-menu dropdown-menu-right">
        <button class="dropdown-item edit" data-id="'.$id.'" data-nama="'.$nama.'" type="button">
          Ubah
        </button>
        </div>';
      };
      foreach ($getAll as $key => $value) {
        $data["data"][] = [($key+1),$value->nama_satuan,$btnCreate($value->id_satuan,$value->nama_satuan)];
      }
      return response()->json($data);
    }
    public function master_satuan_insert(Request $req)
    {
      $req->validate([
        "nama_satuan"=>"required|min:2"
      ]);
      $ins = MasterSatuan::create($req->all());
      if ($ins) {
        return response()->json(["status"=>1],200);
      }else {
        return response()->json(["status"=>0],500);
      }
    }
    public function master_satuan_update(Request $req,$id)
    {
      $req->validate([
        "nama_satuan"=>"required|min:2"
      ]);
      $ins = MasterSatuan::findOrFail($id)->update($req->all());
      if ($ins) {
        return response()->json(["status"=>1],200);
      }else {
        return response()->json(["status"=>0],500);
      }
    }

    public function master_transportasi_read($id = null)
    {
      if ($id != null) {
        $find = MasterTransportasi::where(["id_transportasi"=>$id])->first();
        if ($id == "all") {
          $find = MasterTransportasi::selectRaw("id_satuan as value,nama_satuan as text")->get();
        }
        $res = [];
        return response()->json($find);
      }
      $data = [];
      $data["data"] = [];
      $getAll = MasterTransportasi::all();
      $btnCreate = function($id){
        return $actionBtn = '<button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle">Aksi</button>
        <div class="dropdown-menu dropdown-menu-right">
        <button class="dropdown-item edit" data-id="'.$id.'"  type="button">
          Ubah
        </button>
        </div>';
      };
      foreach ($getAll as $key => $value) {
        $data["data"][] = [$value->id_transportasi,ucfirst($value->jenis_transportasi),$value->no_polisi,status_kendaraan($value->status_kendaraan),date("d-m-Y",strtotime($value->tgl_register)),$btnCreate($value->id_transportasi)];
      }
      return response()->json($data);
    }
    public function master_transportasi_insert(Request $req)
    {
      $req->validate([
        "jenis_transportasi"=>"required",
        "no_polisi"=>"required",
        "status_kendaraan"=>"required|numeric",
      ]);
      $data = $req->all();
      $kodifikasi = "KN".date("dmy")."-".str_pad((MasterTransportasi::count()+1),3,0,STR_PAD_LEFT);
      $data["id_transportasi"] = $kodifikasi;
      $ins = MasterTransportasi::create($data);
      if ($ins) {
        return response()->json(["status"=>1],200);
      }else {
        return response()->json(["status"=>0],500);
      }
    }
    public function master_transportasi_update(Request $req,$id)
    {
      $req->validate([
        "jenis_transportasi"=>"required",
        "no_polisi"=>"required",
        "status_kendaraan"=>"required|numeric",
      ]);
      $ins = MasterTransportasi::findOrFail($id)->update($req->all());
      if ($ins) {
        return response()->json(["status"=>1],200);
      }else {
        return response()->json(["status"=>0],500);
      }
    }

    public function master_suplier_read(Request $req,$id = null)
    {
      if ($id != null) {
        $find = MasterSuplier::where(["id_suplier"=>$id])->first();
        if ($id == "all") {
          if ($req->input("q") != null) {
            if ($req->input("q") == "") {
              $find = MasterSuplier::all();
            }else {
              $find = MasterSuplier::where("id_suplier","like","%".$req->input("q")."%")->orWhere("nama_suplier","like","%".$req->input("q")."%")->get();
            }
          }else {
            $find = MasterSuplier::all();
          }
        }
        $res = [];
        return response()->json($find);
      }
      $data = [];
      $data["data"] = [];
      $getAll = MasterSuplier::all();
      $btnCreate = function($id){
        return $actionBtn = '<button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle">Aksi</button>
        <div class="dropdown-menu dropdown-menu-right">
        <button class="dropdown-item edit" data-id="'.$id.'"  type="button">
          Ubah
        </button>
        </div>';
      };
      foreach ($getAll as $key => $value) {
        $data["data"][] = [$value->id_suplier,$value->nama_suplier,$value->no_kontak,$value->email,$value->alamat,$value->ket,date("d-m-Y",strtotime($value->tgl_register)),$btnCreate($value->id_suplier)];
      }
      return response()->json($data);
    }
    public function master_suplier_insert(Request $req)
    {
      $req->validate([
        "nama_suplier"=>"required",
        "no_kontak"=>"required|numeric",
        "email"=>"required",
        "alamat"=>"required",
        "ket"=>"required",
      ]);
      $data = $req->all();
      $kodifikasi = "SP".date("dmy")."-".str_pad((MasterSuplier::count()+1),3,0,STR_PAD_LEFT);
      $data["id_suplier"] = $kodifikasi;
      $ins = MasterSuplier::create($data);
      if ($ins) {
        return response()->json(["status"=>1],200);
      }else {
        return response()->json(["status"=>0],500);
      }
    }
    public function master_suplier_update(Request $req,$id)
    {
      $req->validate([
        "nama_suplier"=>"required",
        "no_kontak"=>"required|numeric",
        "email"=>"required",
        "alamat"=>"required",
        "ket"=>"required",
      ]);
      $ins = MasterSuplier::findOrFail($id)->update($req->all());
      if ($ins) {
        return response()->json(["status"=>1],200);
      }else {
        return response()->json(["status"=>0],500);
      }
    }

    public function master_produk_read($id = null)
    {
      if ($id != null) {
        $find = MasterProduk::where(["id_produk"=>$id])->first();
        if ($id == "all") {
          $find = MasterProduk::selectRaw("id_produk as value,nama_produk as text")->get();
        }
        $res = [];
        return response()->json($find);
      }
      $data = [];
      $data["data"] = [];
      $getAll = MasterProduk::all();
      $btnCreate = function($id){
        return $actionBtn = '<button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle">Aksi</button>
        <div class="dropdown-menu dropdown-menu-right">
        <button class="dropdown-item edit" data-id="'.$id.'"  type="button">
          Ubah
        </button>
        <button class="dropdown-item komposisi" data-id="'.$id.'"  type="button">
          Komposisi
        </button>
        </div>';
      };
      foreach ($getAll as $key => $value) {
        $up = date("d-m-Y",strtotime($value->tgl_perubahan));
        if ($value->tgl_perubahan == null) {
          $up = null;
        }
        $data["data"][] = [$value->id_produk,$value->nama_produk,$value->stok." ".$value->master_satuan->nama_satuan,$value->stok_minimum." ".$value->master_satuan->nama_satuan,$value->deskripsi,$value->harga_produksi,$value->harga_distribusi,$up,date("d-m-Y",strtotime($value->tgl_register)),$btnCreate($value->id_produk)];
      }
      return response()->json($data);
    }
    public function master_produk_insert(Request $req)
    {
      $req->validate([
        "nama_produk"=>"required",
        "stok_minimum"=>"required|numeric",
        "deskripsi"=>"required",
        "id_satuan"=>"required|numeric",
      ]);
      $data = $req->all();
      $kodifikasi = "PR".date("dmy")."-".str_pad((MasterProduk::count()+1),3,0,STR_PAD_LEFT);
      $data["id_produk"] = $kodifikasi;
      $ins = MasterProduk::create($data);
      if ($ins) {
        return response()->json(["status"=>1],200);
      }else {
        return response()->json(["status"=>0],500);
      }
    }
    public function master_produk_update(Request $req,$id)
    {
      $req->validate([
        "nama_produk"=>"required",
        "stok_minimum"=>"required|numeric",
        "deskripsi"=>"required",
        "id_satuan"=>"required|numeric",
      ]);
      $data = $req->all();
      $data["tgl_perubahan"] = date("Y-m-d H:i:s");
      $ins = MasterProduk::findOrFail($id)->update($data);
      if ($ins) {
        return response()->json(["status"=>1],200);
      }else {
        return response()->json(["status"=>0],500);
      }
    }
    public function master_komposisi_read($id)
    {
      $data = [];
      $data["data"] = [];
      $getAll = MasterKomposisi::where(["id_produk"=>$id])->get();
      $btnCreate = function($id){
        return $actionBtn = '<button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle">Aksi</button>
        <div class="dropdown-menu dropdown-menu-right">
        <button class="dropdown-item hapus" data-id="'.$id.'"  type="button">
          Hapus
        </button>
        </div>';
      };
      foreach ($getAll as $key => $value) {
        $konversi = konversi($value->rasio,$value->jumlah,$value->harga_bahan);
        $data["data"][] = [($key+1),$value->master_bb->nama,($value->jumlah*$value->rasio)." ".$value->master_bb->master_satuan->nama_satuan,$value->rasio." : 1",$konversi["harga"],date("d-m-Y",strtotime($value->tgl_register)),$btnCreate($value->id_komposisi)];
      }
      return response()->json($data);
    }
    public function master_komposisi_hapus($id)
    {
      $shoot = MasterKomposisi::where(["id_komposisi"=>$id]);
      $shoot2 = $shoot->first();
      $xs = konversi($shoot2->rasio,$shoot2->jumlah,$shoot2->harga_bahan);
      $get = MasterProduk::where(["id_produk"=>$shoot2->id_produk]);
      $x = MasterKomposisi::find($id);
      if ($x->delete()) {
        $now = $get->first()->harga_produksi;
        $get->update(["harga_produksi"=>($now-$xs["harga"])]);
        return response()->json(["status"=>1],200);
      }else {
        return response()->json(["status"=>0],200);
      }
    }
    public function master_komposisi_insert(Request $req)
    {
      $req->validate([
        "id_bb"=>"required|exists:master__bb,id_bb",
        "id_produk"=>"required|exists:master__produk,id_produk",
        "harga_bahan"=>"required",
        "rasio"=>"required|numeric",
        "jumlah"=>"required|numeric",
      ]);
      $data = $req->all();
      $data["harga_bahan"] = (explode("/",$data["harga_bahan"]))[0];
      $cek = MasterKomposisi::where(["id_bb"=>$data["id_bb"],"id_produk"=>$data["id_produk"]]);
      if ($cek->count() > 0) {
        return response()->json(["status"=>0],200);
      }
      $ins = MasterKomposisi::create($data);
      if ($ins) {
        $konv = konversi($data["rasio"],$data["jumlah"],$data["harga_bahan"]);
        $shoot = MasterProduk::where(["id_produk"=>$data["id_produk"]]);
        $row = $shoot->first();
        $shoot->update(["harga_produksi"=>($row->harga_produksi+($konv["harga"]))]);
        return response()->json(["status"=>1,"debug"=>$konv],200);
      }else {
        return response()->json(["status"=>0],500);
      }
    }

    public function master_pelanggan_read($id = null)
    {
      if ($id != null) {
        $find = MasterPelanggan::where(["id_pelanggan"=>$id])->first();
        if ($id == "all") {
          $find = MasterPelanggan::selectRaw("id_pelanggan as value,nama_pelanggan as text")->get();
        }
        $res = [];
        return response()->json($find);
      }
      $data = [];
      $data["data"] = [];
      $getAll = MasterPelanggan::all();
      $btnCreate = function($id){
        return $actionBtn = '<button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle">Aksi</button>
        <div class="dropdown-menu dropdown-menu-right">
        <button class="dropdown-item edit" data-id="'.$id.'"  type="button">
          Ubah
        </button>
        </div>';
      };
      foreach ($getAll as $key => $value) {
        $data["data"][] = [$value->id_pelanggan,$value->nama_pelanggan,$value->alamat,$value->no_kontak,$value->email,date("d-m-Y",strtotime($value->tgl_register)),$btnCreate($value->id_pelanggan)];
      }
      return response()->json($data);
    }
    public function master_pelanggan_insert(Request $req)
    {
      $req->validate([
        "nama_pelanggan"=>"required",
        "no_kontak"=>"required|min:12",
        "password"=>"required|min:6",
        "email"=>"required|unique:master__pelanggan,email",
        "alamat"=>"required|min:5",
      ]);
      $data = $req->all();
      $kodifikasi = "PL".date("dmy")."-".str_pad((MasterPelanggan::count()+1),3,0,STR_PAD_LEFT);
      $data["id_pelanggan"] = $kodifikasi;
      $ins = MasterPelanggan::create($data);
      if ($ins) {
        return response()->json(["status"=>1],200);
      }else {
        return response()->json(["status"=>0],500);
      }
    }
    public function master_pelanggan_update(Request $req,$id)
    {
      $req->validate([
        "nama_pelanggan"=>"required",
        "no_kontak"=>"required|min:12",
        "password"=>"required|min:6",
        "email"=>"required",
        "alamat"=>"required|min:5",
      ]);
      $ins = MasterPelanggan::findOrFail($id)->update($req->all());
      if ($ins) {
        return response()->json(["status"=>1],200);
      }else {
        return response()->json(["status"=>0],500);
      }
    }


    public function pengguna_read($id = null)
    {
      if ($id != null) {
        $find = Pengguna::where(["id_pengguna"=>$id])->first();
        if ($id == "all") {
          $find = Pengguna::selectRaw("id_pengguna as value,nama_pengguna as text")->get();
        }
        $res = [];
        return response()->json($find);
      }
      $data = [];
      $data["data"] = [];
      $getAll = Pengguna::all();
      $btnCreate = function($id,$status){
        if ($status == 1) {
          return $actionBtn = '<button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle">Aksi</button>
          <div class="dropdown-menu dropdown-menu-right">
          <button class="dropdown-item edit" data-id="'.$id.'"  type="button">
            Ubah
          </button>
          <button class="dropdown-item matikan" data-id="'.$id.'"  type="button">
            Non-Aktifkan
          </button>
          </div>';
        }else {
          return $actionBtn = '<button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle">Aksi</button>
          <div class="dropdown-menu dropdown-menu-right">
          <button class="dropdown-item edit" data-id="'.$id.'"  type="button">
          Ubah
          </button>
          <button class="dropdown-item aktifkan" data-id="'.$id.'"  type="button">
          Aktifkan
          </button>
          </div>';
        }


      };
      foreach ($getAll as $key => $value) {
        $data["data"][] = [$value->id_pengguna,$value->nama_pengguna,$value->no_kontak,$value->alamat,$value->email,ucfirst($value->level),status_akun($value->status),date("d-m-Y",strtotime($value->tgl_register)),$btnCreate($value->id_pengguna,$value->status)];
      }
      return response()->json($data);
    }
    public function pengguna_insert(Request $req)
    {
      $req->validate([
        "nama_pengguna"=>"required",
        "no_kontak"=>"required|numeric|unique:pengguna,no_kontak",
        "alamat"=>"required|min:6",
        "level"=>"required",
        "email"=>"required|unique:pengguna,email",
        "password"=>"required",
      ]);
      $data = $req->all();
      $kodifikasi = "PG".date("dmy")."-".str_pad((Pengguna::count()+1),3,0,STR_PAD_LEFT);
      $data["id_pengguna"] = $kodifikasi;
      $ins = Pengguna::create($data);
      if ($ins) {
        return response()->json(["status"=>1],200);
      }else {
        return response()->json(["status"=>0],500);
      }
    }
    public function pengguna_update(Request $req,$id)
    {
      if ($req->input("status") != null) {
        $ins = Pengguna::findOrFail($id)->update(["status"=>$req->input("status")]);
        if ($ins) {
          return response()->json(["status"=>1],200);
        }else {
          return response()->json(["status"=>0],500);
        }
      }
      $req->validate([
        "nama_pengguna"=>"required",
        "no_kontak"=>"required|numeric",
        "alamat"=>"required|min:6",
        "level"=>"required",
        "email"=>"required",
        "password"=>"required",
      ]);
      $ins = Pengguna::findOrFail($id)->update($req->all());
      if ($ins) {
        return response()->json(["status"=>1],200);
      }else {
        return response()->json(["status"=>0],500);
      }
    }
//Pengadaan
    public function pengandaan_bahanabaku_batal($id='')
    {
      $find = PengadaanBb::findOrFail($id)->update(["status_pengadaan"=>8]);
      if ($find) {
        return response()->json(["status"=>1]);
      }else {
        return response()->json(["status"=>0]);
      }
    }
    public function pengandaan_bahanabaku_selesai($id='')
    {
      $find = PengadaanBb::findOrFail($id)->update(["status_pengadaan"=>7]);
      if ($find) {
        return response()->json(["status"=>1]);
      }else {
        return response()->json(["status"=>0]);
      }
    }
    public function pengandaan_bahanabaku_proses(Request $req,$id)
    {
      $a = $req->input("perkiraan_tiba");
      $find = PengadaanBb::where("id_pengadaan_bb",$id);
      if ($find->count() > 0) {
        $up = $find->update(["perkiraan_tiba"=>$a,"tgl_perubahan"=>date("Y-m-d"),"dibaca_gudang"=>0,"status_pengadaan"=>3]);
        if ($up) {
          return response()->json(["status"=>1,"msg"=>"Data Pengadaan Sukses Tersimpan"]);
        }else {
          return response()->json(["status"=>0,"msg"=>"Data Pengadaan Tidak Berubah"]);
        }
      }else {
        return response()->json(["status"=>0,"msg"=>"Data Pengadaan Tidak Ditemukan"]);
      }
    }
    public function pbahanabaku_read($id = null)
    {
      if ($id != null) {
        $whereGet = PengadaanBb::where(["id_pengadaan_bb"=>$id]);
        if ($whereGet->count() > 0) {
          $row = $whereGet->first();
          $row->master_suplier;
          foreach ($row->pengadaan__bb_details as $key => $value) {
            $value->master_bb;
            $value->master_bb->master_satuan;
          }
          return response()->json(["status"=>1,"data"=>$row]);
        }else {
          return response()->json(["status"=>0,"msg"=>"Not Found"]);
        }
      }else {
        $getAll = PengadaanBb::orderBy("tgl_perubahan","desc")->orderBy("tgl_register","desc")->orderBy("status_pengadaan","asc")->get();
        $data = [];
        $data["data"] = [];
        $btnCreate = function($id,$status){
          if ($status < 1) {
            return $actionBtn = '<button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle">Aksi</button>
            <div class="dropdown-menu dropdown-menu-right">
            <button class="dropdown-item rincian" data-id="'.$id.'"  type="button">
            Rincian
            </button>
            <button class="dropdown-item batalkan" data-id="'.$id.'"  type="button">
            Batalkan Pengadaan
            </button>
            </div>';
          }elseif ($status == 2) {
            return $actionBtn = '<button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle">Aksi</button>
            <div class="dropdown-menu dropdown-menu-right">
            <button class="dropdown-item rincian" data-id="'.$id.'"  type="button">
            Rincian
            </button>
            <button class="dropdown-item proses" data-id="'.$id.'"  type="button">
            Proses Pengadaan
            </button>
            </div>';
          }elseif ($status == 6) {
            return $actionBtn = '<button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle">Aksi</button>
            <div class="dropdown-menu dropdown-menu-right">
            <button class="dropdown-item rincian" data-id="'.$id.'"  type="button">
            Rincian
            </button>
            <button class="dropdown-item retur" data-id="'.$id.'"  type="button">
            Retur Barang
            </button>
            <button class="dropdown-item selesaikan" data-id="'.$id.'"  type="button">
            Selesaikan Transaksi
            </button>
            </div>';
          }else {
            return $actionBtn = '<button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle">Aksi</button>
            <div class="dropdown-menu dropdown-menu-right">
            <button class="dropdown-item rincian" data-id="'.$id.'"  type="button">
            Rincian
            </button>
            </div>';
          }
        };
        foreach ($getAll as $key => $value) {
          $data["data"][] = [($key+1),$value->id_pengadaan_bb,"[".$value->id_suplier."]"." ".$value->master_suplier->nama_suplier,status_pengadaan($value->status_pengadaan),konfirmasi($value->konfirmasi_direktur),konfirmasi($value->konfirmasi_gudang),$value->catatan_gudang,$value->catatan_direktur,date("d-m-Y",strtotime($value->tgl_register)),($value->tgl_perubahan == null)?null:date("d-m-Y",strtotime($value->tgl_perubahan)),$btnCreate($value->id_pengadaan_bb,$value->status_pengadaan)];
        }
        return response()->json($data);
      }
    }
    public function pengandaan_bahanabaku_read($id = null)
    {
      $kosong = MasterBb::whereRaw("stok_minimum >= stok")->orderBy("stok","asc")->get();
      $ada = MasterBb::whereRaw("stok_minimum < stok")->orderBy("stok","desc")->get();
      $data = [];
      $data["data"] = [];
      $cik = function($id,$nama,$stok,$harga,$prio=0){
        if ($prio == 1) {
          $cek = 'checked=""';
        }else {
          $cek = null;
        }
          $check = '<div class="custom-controls-stacked">
                          <label class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input listcheck" data-nama="'.$nama.'" data-id="'.$id.'" data-stok="'.$stok.'" data-harga="'.$harga.'" data-priority="'.$prio.'" '.$cek.'>
                            <span class="custom-control-label">'.$id.'</span>
                          </label>
                    </div>';
          // $check = '<div class="custom-controls-stacked"><label class="custom-control custom-checkbox custom-control-inline"><input type="checkbox" class="custom-control-input listcheck" >'.$id.'</label></div>';
          return $check;

      };
      foreach ($kosong as $key => $value) {
        $data["data"][] = [$cik($value->id_bb,$value->nama,$value->stok,$value->harga,1),$value->nama,$value->stok." ".$value->master_satuan->nama_satuan,$value->stok_minimum." ".$value->master_satuan->nama_satuan,number_format($value->harga)];
      }
      foreach ($ada as $key => $value) {
          $data["data"][] = [$cik($value->id_bb,$value->nama,$value->stok,$value->harga),$value->nama,$value->stok." ".$value->master_satuan->nama_satuan,$value->stok_minimum." ".$value->master_satuan->nama_satuan,number_format($value->harga)];
      }
      return response()->json($data);
    }
    public function kode_pbb()
    {
      $kodifikasi = "PBB".date("dmy")."-".str_pad((PengadaanBb::count()+1),3,0,STR_PAD_LEFT);
      return response()->json(["kode"=>$kodifikasi]);
    }
    public function pengandaan_bahanabaku_insert(Request $req)
    {
      $req->validate([
        "catatan_pengadaan"=>"required|min:10",
        "id_pengadaan_bb"=>"required|unique:pengadaan__bb,id_pengadaan_bb",
        "id_suplier"=>"required|exists:master__suplier,id_suplier",
      ]);
      $cek = PengadaanBb::whereIn("status_pengadaan",[0,2,3,4,5,6])->count();
      if ($cek > 0) {
        return response()->json(["status"=>0,"msg"=>"Pengadaan Bahan Baku Gagal Di Ajukan Karena Pengadaan Sebelumnya Belum Diselesaikan"]);
      }
      $joinBahan = [];
      $getIn = [];
      foreach ($req->jumlah as $key => $value) {
        $getIn[] = $key;
        $joinBahan[] = ["id_bb"=>$key,"jumlah"=>$value,"harga"=>$req->harga[$key],"id_pengadaan_bb"=>$req->id_pengadaan_bb];
      }
      // return $joinBahan;
      $pengadaan = ["id_pengadaan_bb"=>$req->id_pengadaan_bb,"id_suplier"=>$req->id_suplier,"catatan_pengadaan"=>$req->catatan_pengadaan,"dibaca_direktur"=>0];
      $insPengadaan = PengadaanBb::create($pengadaan);
      if ($insPengadaan) {
        $insBahanBaku = PengadaanBbDetail::insert($joinBahan);
        if ($insBahanBaku) {
          return response()->json(["status"=>1,"msg"=>"Pengadaan Bahan Baku Sukses Di Ajukan, Menunggu Persetujuan Direktur"]);
        }else {
          PengadaanBb::find($req->id_pengadaan_bb)->delete();
          return response()->json(["status"=>0,"msg"=>"Pengadaan Bahan Baku Gagal Di Ajukan"]);
        }
      }else {
        return response()->json(["status"=>0,"msg"=>"Pengadaan Bahan Baku Gagal Di Ajukan"]);
      }
    }
    //Gudang
    public function pbahanabakugudang_read($id = null)
    {
      if ($id != null) {
        $whereGet = PengadaanBb::where(["id_pengadaan_bb"=>$id]);
        if ($whereGet->count() > 0) {
          $row = $whereGet->first();
          $row->master_suplier;
          foreach ($row->pengadaan__bb_details as $key => $value) {
            $value->master_bb;
            $value->master_bb->master_satuan;
          }
          return response()->json(["status"=>1,"data"=>$row]);
        }else {
          return response()->json(["status"=>0,"msg"=>"Not Found"]);
        }
      }else {
        $getAll = PengadaanBb::orderBy("tgl_perubahan","desc")->orderBy("tgl_register","desc")->orderBy("status_pengadaan","asc")->get();
        $data = [];
        $data["data"] = [];
        $btnCreate = function($id,$status,$perkiraan,$ptiba=null){
          if ($status == 4) {
            return $actionBtn = '<button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle">Aksi</button>
            <div class="dropdown-menu dropdown-menu-right">
            <button class="dropdown-item rincian" data-id="'.$id.'"  type="button">
            Rincian
            </button>
            <button class="dropdown-item terima_barang" data-id="'.$id.'" data-tiba="'.$ptiba.'"  type="button">
            Konfirmasi Penerimaan
            </button>
            </div>';
          }elseif ($status == 3 && ($perkiraan)) {
            return $actionBtn = '<button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle">Aksi</button>
            <div class="dropdown-menu dropdown-menu-right">
            <button class="dropdown-item rincian" data-id="'.$id.'"  type="button">
            Rincian
            </button>
            <button class="dropdown-item terima_barang" data-id="'.$id.'" data-tiba="'.$ptiba.'"  type="button">
            Konfirmasi Penerimaan
            </button>
            </div>';
          }else {
            return $actionBtn = '<button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle">Aksi</button>
            <div class="dropdown-menu dropdown-menu-right">
            <button class="dropdown-item rincian" data-id="'.$id.'"  type="button">
            Rincian
            </button>
            </div>';
          }
        };
        foreach ($getAll as $key => $value) {
          $data["data"][] = [($key+1),$value->id_pengadaan_bb,"[".$value->id_suplier."]"." ".$value->master_suplier->nama_suplier,status_pengadaan($value->status_pengadaan),konfirmasi($value->konfirmasi_direktur),konfirmasi($value->konfirmasi_gudang),$value->catatan_gudang,$value->catatan_direktur,date("d-m-Y",strtotime($value->tgl_register)),($value->tgl_perubahan == null)?null:date("d-m-Y",strtotime($value->tgl_perubahan)),$btnCreate($value->id_pengadaan_bb,$value->status_pengadaan,(time() >= strtotime($value->perkiraan_tiba)),$value->perkiraan_tiba)];
        }
        return response()->json($data);
      }
    }
    public function pbahanbakugudang_konfirmasi(Request $req, $id)
    {
      $find = PengadaanBb::where(["id_pengadaan_bb"=>$id]);
      $dpost = $req->all();
      if ($find->count() > 0) {
        $up = $find->update($dpost);
        if ($up) {
          $cariBarang = PengadaanBb::where(["id_pengadaan_bb"=>$id])->first();
          $list = $cariBarang->pengadaan__bb_details;
          $fail = [];
          foreach ($list as $key => $value) {
            $find = MasterBb::where(["id_bb"=>$value->id_bb]);
            $r = $find->first();
            if ($find->count() > 0) {
              $now = ($r->stok + $value->jumlah);
              $up = $find->update(["stok"=>$now]);
              if (!$up) {
                $fail[] = ["nama"=>$r->nama,"id"=>$r->id_bb,"msg"=>"Stok Barang Tidak Terupdate"];
              }
            }else {
              $fail[] = ["nama"=>$r->nama,"id"=>$r->id_bb,"msg"=>"Barang Tidak Ditemukan"];
            }
          }
          return response()->json(["status"=>1,"msg"=>"Konfirmasi Barang Berhasil","fail"=>$fail]);
        }else {
          return response()->json(["status"=>0,"msg"=>"Konfirmasi Gagal Data Tidak Tersimpan"]);
        }
      }else {
        return response()->json(["status"=>0,"msg"=>"Konfirmasi Gagal Pengadaan Barang Tidak Ditemukan"]);
      }
    }
}
