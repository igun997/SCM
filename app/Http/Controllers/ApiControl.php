<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\{MasterBb,MasterKomposisi,MasterPelanggan,MasterProduk,MasterSatuan,MasterSuplier,MasterTransportasi,Pemesanan,PemesananDetail,PengadaanBb,PengadaanBbDetail,Pengaturan,Pengguna,Pengiriman,PengirimanDetail,Produksi,ProduksiDetail,WncGerai,WncOrder,WncPelanggan,WncProduk,PengadaanBbRetur,PengadaanBbReturDetail,PengadaanProduk,PengadaanProdukDetail,PengadaanProdukRetur,PengadaanProdukReturDetail};
use PDF;
use Helpers\Pengaturan as PengaturanHelper;
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
    public function pengaturan_read($id = "")
    {
      if ($id != "") {
        return PengaturanHelper::get(["meta_key"=>$id])->first();
      }else {
        return PengaturanHelper::get(null);
      }
    }
    public function pengaturan_add()
    {
      // code...
    }
    public function pengaturan_update(Request $req)
    {
      $req->validate([
        "ppn"=>"numeric|required",
        "pph"=>"numeric|required"
      ]);
      $ppn = $req->ppn;
      $pph = $req->pph;
      $up1 = PengaturanHelper::up(["meta_key"=>"ppn"],["meta_value"=>$ppn]);
      $up2 = PengaturanHelper::up(["meta_key"=>"pph"],["meta_value"=>$pph]);
      if ($up1 || $up2) {
        return response()->json(["status"=>1]);
      }else {
        return response()->json(["status"=>0]);
      }
    }
    public function pengaturan_delete()
    {
      // code...
    }
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
    public function pproduk_read_direktur($id = null)
    {
      if ($id != null) {
        $whereGet = PengadaanProduk::where(["id_pengadaan_produk"=>$id]);
        if ($whereGet->count() > 0) {
          $row = $whereGet->first();
          $row->master_suplier;
          foreach ($row->pengadaan__produk_details as $key => $value) {
            $value->master_produk;
            $value->master_produk->master_satuan;
          }
          return response()->json(["status"=>1,"data"=>$row]);
        }else {
          return response()->json(["status"=>0,"msg"=>"Not Found"]);
        }
      }else {
        $getAll = PengadaanProduk::orderBy("tgl_register","desc")->orderBy("status_pengadaan","asc")->get();
        $data = [];
        $data["data"] = [];
        $btnCreate = function($id,$status){
          if ($status == 0) {
            return $actionBtn = '<button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle">Aksi</button>
            <div class="dropdown-menu dropdown-menu-right">
            <button class="dropdown-item rincian_produk" data-id="'.$id.'"  type="button">
            Rincian
            </button>
            <button class="dropdown-item setujui_produk" data-id="'.$id.'"  type="button">
            Setujui Pengadaan
            </button>
            <button class="dropdown-item tolak_produk" data-id="'.$id.'"  type="button">
            Tolak Pengadaan
            </button>
            </div>';
          }elseif ($status == 6) {
            return $actionBtn = '<button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle">Aksi</button>
            <div class="dropdown-menu dropdown-menu-right">
            <button class="dropdown-item rincian_produk" data-id="'.$id.'"  type="button">
            Rincian
            </button>
            <button class="dropdown-item retur_produk" data-id="'.$id.'"  type="button">
            Retur Barang
            </button>
            </div>';
          }else {
            $c = PengadaanProdukRetur::where(["id_pengadaan_produk"=>$id]);
            $retur = null;
            if ($c->count() > 0) {
              $retur = '<button class="dropdown-item retur_produk" data-id="'.$id.'"  type="button">
              Retur Barang
              </button>';
            }
            return $actionBtn = '<button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle">Aksi</button>
            <div class="dropdown-menu dropdown-menu-right">
            <button class="dropdown-item rincian_produk" data-id="'.$id.'"  type="button">
            Rincian
            </button>'.$retur.'</div>';
          }
        };
        foreach ($getAll as $key => $value) {
          $data["data"][] = [($key+1),$value->id_pengadaan_produk,"[".$value->id_suplier."]"." ".$value->master_suplier->nama_suplier,status_pengadaan($value->status_pengadaan),konfirmasi($value->konfirmasi_direktur),date("d-m-Y",strtotime($value->tgl_register)),$btnCreate($value->id_pengadaan_produk,$value->status_pengadaan)];
        }
        return response()->json($data);
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
        $getAll = PengadaanBb::orderBy("tgl_register","desc")->orderBy("status_pengadaan","asc")->get();
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
          }elseif ($status == 6) {

            return $actionBtn = '<button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle">Aksi</button>
            <div class="dropdown-menu dropdown-menu-right">
            <button class="dropdown-item rincian" data-id="'.$id.'"  type="button">
            Rincian
            </button>
            <button class="dropdown-item retur" data-id="'.$id.'"  type="button">
            Retur Barang
            </button>
            </div>';
          }else {
            $c = PengadaanBbRetur::where(["id_pengadaan_bb"=>$id]);
            $retur = null;
            if ($c->count() > 0) {
              $retur = '<button class="dropdown-item retur" data-id="'.$id.'"  type="button">
              Retur Barang
              </button>';
            }
            return $actionBtn = '<button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle">Aksi</button>
            <div class="dropdown-menu dropdown-menu-right">
            <button class="dropdown-item rincian" data-id="'.$id.'"  type="button">
            Rincian
            </button>'.$retur.'</div>';
          }
        };
        foreach ($getAll as $key => $value) {
          $data["data"][] = [($key+1),$value->id_pengadaan_bb,"[".$value->id_suplier."]"." ".$value->master_suplier->nama_suplier,status_pengadaan($value->status_pengadaan),konfirmasi($value->konfirmasi_direktur),date("d-m-Y",strtotime($value->tgl_register)),$btnCreate($value->id_pengadaan_bb,$value->status_pengadaan)];
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

    public function pproduk_setujui_direktur($id)
    {
      $find = PengadaanProduk::findOrFail($id)->update(["status_pengadaan"=>2,"konfirmasi_direktur"=>1,"tgl_perubahan"=>date("Y-m-d")]);
      if ($find) {
        return response()->json(["status"=>1]);
      }else {
        return response()->json(["status"=>0]);
      }
    }
    public function pproduk_tolak_direktur($id,$catatan=null)
    {
      $find = PengadaanProduk::findOrFail($id)->update(["status_pengadaan"=>1,"catatan_direktur"=>$catatan,"tgl_perubahan"=>date("Y-m-d")]);
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
    public function pengandaan_produk_batal($id='')
    {
      $find = PengadaanProduk::findOrFail($id)->update(["status_pengadaan"=>8]);
      if ($find) {
        return response()->json(["status"=>1]);
      }else {
        return response()->json(["status"=>0]);
      }
    }
    public function pengandaan_bahanabaku_selesai($id='')
    {
      $cek = PengadaanBbRetur::where(["id_pengadaan_bb"=>$id])->whereNotIn("status_retur",[0,2]);
      // return $cek->count();
      if ($cek->count() > 0) {
        $find = PengadaanBb::findOrFail($id)->update(["status_pengadaan"=>7]);
        return response()->json(["status"=>1]);
      }else {
        if (PengadaanBbRetur::where(["id_pengadaan_bb"=>$id])->count() == 0) {
          $find = PengadaanBb::findOrFail($id)->update(["status_pengadaan"=>7]);
          return response()->json(["status"=>1]);
        }
        return response()->json(["status"=>0]);
      }
    }
    public function pengandaan_produk_selesai($id='')
    {
      $cek = PengadaanProdukRetur::where(["id_pengadaan_produk"=>$id])->whereNotIn("status_retur",[0,2]);
      // return $cek->count();
      if ($cek->count() > 0) {
        $find = PengadaanProduk::findOrFail($id)->update(["status_pengadaan"=>7]);
        return response()->json(["status"=>1]);
      }else {
        if (PengadaanProdukRetur::where(["id_pengadaan_produk"=>$id])->count() == 0) {
          $find = PengadaanProduk::findOrFail($id)->update(["status_pengadaan"=>7]);
          return response()->json(["status"=>1]);
        }
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
    public function pengandaan_produk_proses(Request $req,$id)
    {
      $a = $req->input("perkiraan_tiba");
      $find = PengadaanProduk::where("id_pengadaan_produk",$id);
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
        $getAll = PengadaanBb::orderBy("tgl_register","desc")->orderBy("status_pengadaan","asc")->get();
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
            <a class="dropdown-item" href="'.route("gen.invoice.pengadaanbb",$id).'" target="_blank">
            Cetak
            </a>
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
            <a class="dropdown-item" href="'.route("gen.invoice.pengadaanbb",$id).'" target="_blank">
            Cetak
            </a>
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
            <a class="dropdown-item" href="'.route("gen.invoice.pengadaanbb",$id).'" target="_blank">
            Cetak
            </a>
            </div>';
          }else {
            $c = PengadaanBbRetur::where(["id_pengadaan_bb"=>$id]);
            $retur = null;
            if ($c->count() > 0) {
              $retur = '<button class="dropdown-item retur" data-id="'.$id.'"  type="button">
              Retur Barang
              </button>';
            }
            return $actionBtn = '<button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle">Aksi</button>
            <div class="dropdown-menu dropdown-menu-right">
            <button class="dropdown-item rincian" data-id="'.$id.'"  type="button">
            Rincian
            </button>
            <a class="dropdown-item" href="'.route("gen.invoice.pengadaanbb",$id).'" target="_blank">
            Cetak
            </a>
            '.$retur.'</div>';
          }
        };
        foreach ($getAll as $key => $value) {
          $data["data"][] = [($key+1),$value->id_pengadaan_bb,"[".$value->id_suplier."]"." ".$value->master_suplier->nama_suplier,status_pengadaan($value->status_pengadaan),konfirmasi($value->konfirmasi_direktur),konfirmasi($value->konfirmasi_gudang),$value->catatan_gudang,$value->catatan_direktur,date("d-m-Y",strtotime($value->tgl_register)),($value->tgl_perubahan == null)?null:date("d-m-Y",strtotime($value->tgl_perubahan)),$btnCreate($value->id_pengadaan_bb,$value->status_pengadaan)];
        }
        return response()->json($data);
      }
    }
    public function pproduk_read($id = null)
    {
      if ($id != null) {
        $whereGet = PengadaanProduk::where(["id_pengadaan_produk"=>$id]);
        if ($whereGet->count() > 0) {
          $row = $whereGet->first();
          $row->master_suplier;
          foreach ($row->pengadaan__produk_details as $key => $value) {
            $value->master_produk;
            $value->master_produk->master_satuan;
          }
          return response()->json(["status"=>1,"data"=>$row]);
        }else {
          return response()->json(["status"=>0,"msg"=>"Not Found"]);
        }
      }else {
        $getAll = PengadaanProduk::orderBy("tgl_register","desc")->orderBy("status_pengadaan","asc")->get();
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
            <a class="dropdown-item" href="'.route("gen.invoice.pengadaan",$id).'" target="_blank">
            Cetak
            </a>
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
            <a class="dropdown-item" href="'.route("gen.invoice.pengadaan",$id).'" target="_blank">
            Cetak
            </a>
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
            <a class="dropdown-item" href="'.route("gen.invoice.pengadaan",$id).'" target="_blank">
            Cetak
            </a>
            </div>';
          }else {
            $c = PengadaanProdukRetur::where(["id_pengadaan_produk"=>$id]);
            $retur = null;
            if ($c->count() > 0) {
              $retur = '<button class="dropdown-item retur" data-id="'.$id.'"  type="button">
              Retur Barang
              </button>';
            }
            return $actionBtn = '<button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle">Aksi</button>
            <div class="dropdown-menu dropdown-menu-right">
            <button class="dropdown-item rincian" data-id="'.$id.'"  type="button">
            Rincian
            </button>
            <a class="dropdown-item" href="'.route("gen.invoice.pengadaan",$id).'" target="_blank">
            Cetak
            </a>
            '.$retur.'</div>';
          }
        };
        foreach ($getAll as $key => $value) {
          $data["data"][] = [($key+1),$value->id_pengadaan_produk,"[".$value->id_suplier."]"." ".$value->master_suplier->nama_suplier,status_pengadaan($value->status_pengadaan),konfirmasi($value->konfirmasi_direktur),konfirmasi($value->konfirmasi_gudang),$value->catatan_gudang,$value->catatan_direktur,date("d-m-Y",strtotime($value->tgl_register)),($value->tgl_perubahan == null)?null:date("d-m-Y",strtotime($value->tgl_perubahan)),$btnCreate($value->id_pengadaan_produk,$value->status_pengadaan)];
        }
        return response()->json($data);
      }
    }
    public function pengandaan_produk_read($id = null)
    {
      $kosong = MasterProduk::whereRaw("stok_minimum >= stok")->orderBy("stok","asc")->get();
      $ada = MasterProduk::whereRaw("stok_minimum < stok")->orderBy("stok","desc")->get();
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
        $data["data"][] = [$cik($value->id_produk,$value->nama_produk,$value->stok,$value->harga_produksi,1),$value->nama_produk,$value->stok." ".$value->master_satuan->nama_satuan,$value->stok_minimum." ".$value->master_satuan->nama_satuan,number_format($value->harga_produksi),number_format($value->harga_distribusi)];
      }
      foreach ($ada as $key => $value) {
          $data["data"][] = [$cik($value->id_produk,$value->nama_produk,$value->stok,$value->harga_produksi),$value->nama_produk,$value->stok." ".$value->master_satuan->nama_satuan,$value->stok_minimum." ".$value->master_satuan->nama_satuan,number_format($value->harga_produksi),number_format($value->harga_distribusi)];
      }
      return response()->json($data);
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
    public function kode_produksi()
    {
      $kodifikasi = "PPR".date("dmy")."-".str_pad((Produksi::count()+1),3,0,STR_PAD_LEFT);
      return response()->json(["kode"=>$kodifikasi]);
    }
    public function kode_pp()
    {
      $kodifikasi = "PP".date("dmy")."-".str_pad((PengadaanProduk::count()+1),3,0,STR_PAD_LEFT);
      return response()->json(["kode"=>$kodifikasi]);
    }
    public function pengandaan_produk_insert(Request $req)
    {
      $req->validate([
        "catatan_pengadaan"=>"required|min:10",
        "id_pengadaan_produk"=>"required|unique:pengadaan__produk,id_pengadaan_produk",
        "id_suplier"=>"required|exists:master__suplier,id_suplier",
      ]);
      $cek = PengadaanProduk::whereIn("status_pengadaan",[0,2,3,4,5,6])->count();
      if ($cek > 0) {
        return response()->json(["status"=>0,"msg"=>"Pengadaan Produk Gagal Di Ajukan Karena Pengadaan Sebelumnya Belum Diselesaikan"]);
      }
      $joinBahan = [];
      $getIn = [];
      foreach ($req->jumlah as $key => $value) {
        $getIn[] = $key;
        $joinBahan[] = ["id_produk"=>$key,"jumlah"=>$value,"harga"=>$req->harga[$key],"id_pengadaan_produk"=>$req->id_pengadaan_produk];
      }
      // return $joinBahan;
      $pengadaan = ["id_pengadaan_produk"=>$req->id_pengadaan_produk,"id_suplier"=>$req->id_suplier,"catatan_pengadaan"=>$req->catatan_pengadaan,"dibaca_direktur"=>0];
      $insPengadaan = PengadaanProduk::create($pengadaan);
      if ($insPengadaan) {
        $insBahanBaku = PengadaanProdukDetail::insert($joinBahan);
        if ($insBahanBaku) {
          return response()->json(["status"=>1,"msg"=>"Pengadaan Produk Sukses Di Ajukan, Menunggu Persetujuan Direktur"]);
        }else {
          PengadaanProduk::find($req->id_pengadaan_produk)->delete();
          return response()->json(["status"=>0,"msg"=>"Pengadaan Produk Gagal Di Ajukan"]);
        }
      }else {
        return response()->json(["status"=>0,"msg"=>"Pengadaan Produk Gagal Di Ajukan"]);
      }
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
    public function pprodukgudang_read($id = null)
    {
      if ($id != null) {
        $whereGet = PengadaanProduk::where(["id_pengadaan_produk"=>$id]);
        if ($whereGet->count() > 0) {
          $row = $whereGet->first();
          $row->master_suplier;
          foreach ($row->pengadaan__produk_details as $key => $value) {
            $value->master_produk;
            $value->master_produk->master_satuan;
          }
          return response()->json(["status"=>1,"data"=>$row]);
        }else {
          return response()->json(["status"=>0,"msg"=>"Not Found"]);
        }
      }else {
        $getAll = PengadaanProduk::orderBy("tgl_register","desc")->orderBy("status_pengadaan","asc")->get();
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
          }elseif ($status == 6) {
            return $actionBtn = '<button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle">Aksi</button>
            <div class="dropdown-menu dropdown-menu-right">
            <button class="dropdown-item rincian" data-id="'.$id.'"  type="button">
            Rincian
            </button>
            <button class="dropdown-item retur" data-id="'.$id.'"   type="button">
            Retur Barang
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
          $data["data"][] = [($key+1),$value->id_pengadaan_produk,"[".$value->id_suplier."]"." ".$value->master_suplier->nama_suplier,status_pengadaan($value->status_pengadaan),konfirmasi($value->konfirmasi_direktur),konfirmasi($value->konfirmasi_gudang),$value->catatan_gudang,$value->catatan_direktur,date("d-m-Y",strtotime($value->tgl_register)),($value->tgl_perubahan == null)?null:date("d-m-Y",strtotime($value->tgl_perubahan)),$btnCreate($value->id_pengadaan_produk,$value->status_pengadaan,(time() >= strtotime($value->perkiraan_tiba)),$value->perkiraan_tiba)];
        }
        return response()->json($data);
      }
    }
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
        $getAll = PengadaanBb::orderBy("tgl_register","desc")->orderBy("status_pengadaan","asc")->get();
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
          }elseif ($status == 6) {
            return $actionBtn = '<button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle">Aksi</button>
            <div class="dropdown-menu dropdown-menu-right">
            <button class="dropdown-item rincian" data-id="'.$id.'"  type="button">
            Rincian
            </button>
            <button class="dropdown-item retur" data-id="'.$id.'"   type="button">
            Retur Barang
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
    public function pprodukgudang_konfirmasi(Request $req, $id)
    {
      $find = PengadaanProduk::where(["id_pengadaan_produk"=>$id]);
      $dpost = $req->all();
      if ($find->count() > 0) {
        $up = $find->update($dpost);
        if ($up) {
          $cariBarang = PengadaanProduk::where(["id_pengadaan_produk"=>$id])->first();
          $list = $cariBarang->pengadaan__produk_details;
          $fail = [];
          foreach ($list as $key => $value) {
            $find = MasterProduk::where(["id_produk"=>$value->id_produk]);
            $r = $find->first();
            if ($find->count() > 0) {
              $now = ($r->stok + $value->jumlah);
              $up = $find->update(["stok"=>$now]);
              if (!$up) {
                $fail[] = ["nama"=>$r->nama_produk,"id"=>$r->id_produk,"msg"=>"Stok Barang Tidak Terupdate"];
              }
            }else {
              $fail[] = ["nama"=>$r->nama_produk,"id"=>$r->id_produk,"msg"=>"Barang Tidak Ditemukan"];
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
    public function pbahanbakugudangretur_check($id)
    {
      $find = PengadaanBbRetur::where(["id_pengadaan_bb"=>$id]);
      if ($find->count() > 0) {
        return response()->json(["status"=>1]);
      }else {
        return response()->json(["status"=>0]);
      }
    }
    public function pprodukgudangretur_check($id)
    {
      $find = PengadaanProdukRetur::where(["id_pengadaan_produk"=>$id]);
      if ($find->count() > 0) {
        return response()->json(["status"=>1]);
      }else {
        return response()->json(["status"=>0]);
      }
    }
    public function pbahanbakugudangretur_read($id)
    {
      $btn = function($id){
        return $actionBtn = '<button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle">Aksi</button>
        <div class="dropdown-menu dropdown-menu-right">
        <button class="dropdown-item edit_item" data-id="'.$id.'"  type="button">
        Edit
        </button>
        <button class="dropdown-item hapus_item" data-id="'.$id.'"  type="button">
          Hapus
        </button>
        </div>';
      };
      $g = PengadaanBbReturDetail::where(["id_pengadaan_bb_retur"=>$id]);
      $data = [];
      $data["data"] = [];
      foreach ($g->get() as $key => $value) {
        $keDetail = $value->pengadaan_bb_detail;
        $keBarang = $keDetail->master_bb;
        $data["data"][] = [($key+1),"[".$keBarang->id_bb."]".$keBarang->nama,$keDetail->jumlah,$value->total_retur,$btn($value->id_pengadaan_bb_retur_detail)];
      }
      return response()->json($data);
    }
    public function pprodukgudangretur_read($id)
    {
      $btn = function($id){
        return $actionBtn = '<button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle">Aksi</button>
        <div class="dropdown-menu dropdown-menu-right">
        <button class="dropdown-item edit_item" data-id="'.$id.'"  type="button">
        Edit
        </button>
        <button class="dropdown-item hapus_item" data-id="'.$id.'"  type="button">
          Hapus
        </button>
        </div>';
      };
      $g = PengadaanProdukReturDetail::where(["id_pengadaan_produk_retur"=>$id]);
      $data = [];
      $data["data"] = [];
      foreach ($g->get() as $key => $value) {
        $keDetail = $value->pengadaan_produk_detail;
        $keBarang = $keDetail->master_produk;
        $data["data"][] = [($key+1),"[".$keBarang->id_produk."]".$keBarang->nama_produk,$keDetail->jumlah,$value->total_retur,$btn($value->id_pengadaan_produk_retur_detail)];
      }
      return response()->json($data);
    }

    public function pbahanbakugudangretur_show($id)
    {
      $x = PengadaanBbReturDetail::where(["id_pengadaan_bb_retur_detail"=>$id]);
      if ($x->count() > 0) {
        $row = $x->first();
        $row->pengadaan_bb_retur;
        $row->pengadaan_bb_detail;
        $row->pengadaan_bb_detail->master_bb;
        return  response()->json(["status"=>1,"data"=>$row]);
      }else {
        return  response()->json(["status"=>0,"msg"=>"Data Tidak Ditemukan"]);
      }
    }
    public function pprodukgudangretur_show($id)
    {
      $x = PengadaanProdukReturDetail::where(["id_pengadaan_produk_retur_detail"=>$id]);
      if ($x->count() > 0) {
        $row = $x->first();
        $row->pengadaan_produk_retur;
        $row->pengadaan_produk_detail;
        $row->pengadaan_produk_detail->master_produk;
        return  response()->json(["status"=>1,"data"=>$row]);
      }else {
        return  response()->json(["status"=>0,"msg"=>"Data Tidak Ditemukan"]);
      }
    }

    public function pbahanbakugudangretur_detailretur($id)
    {
      $find = PengadaanBbRetur::where(["id_pengadaan_bb"=>$id]);
      if ($find->count() > 0) {
        $data = $find->first();
        $data->pengadaan_bb;
        $data->pengadaan__bb_retur_details;
        foreach ($data->pengadaan__bb_retur_details as $key => &$value) {
          $value->pengadaan_bb_detail;
          $value->pengadaan_bb_detail->master_bb;
        }
        return response()->json(["status"=>1,"data"=>$data]);
      }else {
        return response()->json(["status"=>0]);
      }
    }
    public function pprodukgudangretur_detailretur($id)
    {
      $find = PengadaanProdukRetur::where(["id_pengadaan_produk"=>$id]);
      if ($find->count() > 0) {
        $data = $find->first();
        $data->pengadaan_produk;
        $data->pengadaan__produk_retur_details;
        foreach ($data->pengadaan__produk_retur_details as $key => &$value) {
          $value->pengadaan_produk_detail;
          $value->pengadaan_produk_detail->master_produk;
        }
        return response()->json(["status"=>1,"data"=>$data]);
      }else {
        return response()->json(["status"=>0]);
      }
    }

    public function pbahanbakugudangretur_edit(Request $req,$id)
    {
      $find = PengadaanBbReturDetail::where(["id_pengadaan_bb_retur_detail"=>$id]);
      if ($find->count() > 0) {
        $up = $find->update($req->all());
        if ($up) {
          return response()->json(["status"=>1,"msg"=>"Data Gagal Di Ubah"]);
        }else {
          return response()->json(["status"=>0,"msg"=>"Data Gagal Di Ubah"]);
        }
      }else {
        return response()->json(["status"=>0,"msg"=>"Data Tidak Ditemukan"]);
      }
    }
    public function pprodukgudangretur_edit(Request $req,$id)
    {
      $find = PengadaanProdukReturDetail::where(["id_pengadaan_produk_retur_detail"=>$id]);
      if ($find->count() > 0) {
        $up = $find->update($req->all());
        if ($up) {
          return response()->json(["status"=>1,"msg"=>"Data Gagal Di Ubah"]);
        }else {
          return response()->json(["status"=>0,"msg"=>"Data Gagal Di Ubah"]);
        }
      }else {
        return response()->json(["status"=>0,"msg"=>"Data Tidak Ditemukan"]);
      }
    }

    public function pbahanbakugudangretur_poread($id)
    {
      $find = PengadaanBb::where(["id_pengadaan_bb"=>$id]);
      $cek = function($any){
        $check = '<div class="custom-controls-stacked">
                        <label class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input listcheck" data-nama="'.$any["nama"].'" data-id="'.$any["id"].'" data-jumlah="'.$any["jumlah"].'" data-kode_barang="'.$any["id_barang"].'">
                          <span class="custom-control-label">'.$any["id_barang"].'</span>
                        </label>
                  </div>';
        return $check;
      };
      if ($find->count() > 0) {
        $t = $find->first();
        $rs = $t->pengadaan__bb_details;
        $data = [];
        $data["data"] = [];
        foreach ($rs as $key => $value) {
          $data["data"][] = [$cek(["id"=>$value->id_pbb_detail,"id_barang"=>$value->master_bb->id_bb,"nama"=>$value->master_bb->nama,"jumlah"=>$value->jumlah]),$value->master_bb->nama,$value->jumlah];
        }
        return response()->json($data);
      }else {
        return response()->json(["data"=>[]]);
      }
    }
    public function pprodukgudangretur_poread($id)
    {
      $find = PengadaanProduk::where(["id_pengadaan_produk"=>$id]);
      $cek = function($any){
        $check = '<div class="custom-controls-stacked">
                        <label class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input listcheck" data-nama="'.$any["nama"].'" data-id="'.$any["id"].'" data-jumlah="'.$any["jumlah"].'" data-kode_barang="'.$any["id_barang"].'">
                          <span class="custom-control-label">'.$any["id_barang"].'</span>
                        </label>
                  </div>';
        return $check;
      };
      if ($find->count() > 0) {
        $t = $find->first();
        $rs = $t->pengadaan__produk_details;
        $data = [];
        $data["data"] = [];
        foreach ($rs as $key => $value) {
          $data["data"][] = [$cek(["id"=>$value->id_pbb_detail,"id_barang"=>$value->master_produk->id_produk,"nama"=>$value->master_produk->nama_produk,"jumlah"=>$value->jumlah]),$value->master_produk->nama_produk,$value->jumlah];
        }
        return response()->json($data);
      }else {
        return response()->json(["data"=>[]]);
      }
    }

    public function kode_pbahanbakugudangretur()
    {
      $kode = (PengadaanBbRetur::count()+1);
      $kodekan = "PBBR".date("dmy")."-".$kode;
      return $kodekan;
    }
    public function kode_pprodukgudangretur()
    {
      $kode = (PengadaanBbRetur::count()+1);
      $kodekan = "PPR".date("dmy")."-".$kode;
      return $kodekan;
    }

    public function pbahanbakugudangretur_ajukan(Request $req,$id)
    {
      $data = $req->all();
      // return $detail;
      $dataSet = ["id_pengadaan_bb_retur"=>$data["id_pengadaan_bb_retur"],"tanggal_retur"=>$data["tanggal_retur"],"id_pengadaan_bb"=>$id];
      $createRetur = PengadaanBbRetur::create($dataSet);
      if ($createRetur) {
        $detail = [];
        foreach ($data["id_pbb"] as $key => $value) {
          $detail[] = ["id_pengadaan_bb_detail"=>$value,"id_pengadaan_bb_retur"=>$data["id_pengadaan_bb_retur"],"total_retur"=>$data["total_retur"][$key],"catatan_retur"=>$data["rincian_retur"][$key]];
        }
        $createDetail = PengadaanBbReturDetail::insert($detail);
        if ($createDetail) {
          return response()->json(["status"=>1]);
        }else {
          return response()->json(["status"=>0]);
        }
      }else {
        return response()->json(["status"=>0]);
      }
      // return response()->json(["status"=>1]);
    }
    public function pprodukgudangretur_ajukan(Request $req,$id)
    {
      $data = $req->all();
      // return $detail;
      $dataSet = ["id_pengadaan_produk_retur"=>$data["id_pengadaan_produk_retur"],"tanggal_retur"=>$data["tanggal_retur"],"id_pengadaan_produk"=>$id];
      $createRetur = PengadaanProdukRetur::create($dataSet);
      if ($createRetur) {
        $detail = [];
        foreach ($data["id_pbb"] as $key => $value) {
          $detail[] = ["id_pengadaan_produk_detail"=>$value,"id_pengadaan_produk_retur"=>$data["id_pengadaan_produk_retur"],"total_retur"=>$data["total_retur"][$key],"catatan_retur"=>$data["rincian_retur"][$key]];
        }
        $createDetail = PengadaanProdukReturDetail::insert($detail);
        if ($createDetail) {
          return response()->json(["status"=>1]);
        }else {
          return response()->json(["status"=>0]);
        }
      }else {
        return response()->json(["status"=>0]);
      }
      // return response()->json(["status"=>1]);
    }

    public function pbahanbakupengadaan_konfirmasi(Request $req,$status,$id)
    {
      $catatan = $req->input("catatan");
      $cek = PengadaanBbRetur::where(["id_pengadaan_bb_retur"=>$id]);
      if ($cek->count() > 0) {
        // return response()->json(["status"=>0]);
        if ($status == 1) {
          $up = $cek->update(["konfirmasi_pengadaan"=>1,"status_retur"=>2,"catatan_pengadaan"=>$catatan]);
        }else {
          $up = $cek->update(["konfirmasi_direktur"=>1,"catatan_direktur"=>"Ditolak Oleh Bag. Pengadaan","konfirmasi_pengadaan"=>1,"status_retur"=>1,"catatan_pengadaan"=>$catatan]);
        }
        if ($up) {
          return response()->json(["status"=>1]);
        }else {
          return response()->json(["status"=>0]);
        }
      }else {
        return response()->json(["status"=>0]);
      }
    }
    public function pprodukpengadaan_konfirmasi(Request $req,$status,$id)
    {
      $catatan = $req->input("catatan");
      $cek = PengadaanProdukRetur::where(["id_pengadaan_produk_retur"=>$id]);
      if ($cek->count() > 0) {
        // return response()->json(["status"=>0]);
        if ($status == 1) {
          $up = $cek->update(["konfirmasi_pengadaan"=>1,"status_retur"=>2,"catatan_pengadaan"=>$catatan]);
        }else {
          $up = $cek->update(["konfirmasi_direktur"=>1,"catatan_direktur"=>"Ditolak Oleh Bag. Pengadaan","konfirmasi_pengadaan"=>1,"status_retur"=>1,"catatan_pengadaan"=>$catatan]);
        }
        if ($up) {
          return response()->json(["status"=>1]);
        }else {
          return response()->json(["status"=>0]);
        }
      }else {
        return response()->json(["status"=>0]);
      }
    }

    public function pbahanbakudirektur_konfirmasi(Request $req,$status,$id)
    {
      $catatan = $req->input("catatan");
      $cek = PengadaanBbRetur::where(["id_pengadaan_bb_retur"=>$id]);
      if ($cek->count() > 0) {
        // return response()->json(["status"=>0]);
        // $obj = $cek->first();
        // return $obj->pengadaan__bb_retur_details;
        if ($status == 1) {
          $up = $cek->update(["konfirmasi_direktur"=>1,"status_retur"=>4,"catatan_direktur"=>$catatan]);

        }else {
          $up = $cek->update(["konfirmasi_direktur"=>1,"status_retur"=>3,"catatan_direktur"=>$catatan]);
        }
        if ($up) {
          $obj = $cek->first();
          $list = $obj->pengadaan__bb_retur_details;
          $fail = [];
          foreach ($list as $key => $value) {
            $vs = $value->pengadaan_bb_detail;
            $find = MasterBb::where(["id_bb"=>$vs->id_bb]);
            $r = $find->first();
            if ($find->count() > 0) {
              $now = ($r->stok - $value->total_retur);
              $up = $find->update(["stok"=>$now]);
              if (!$up) {
                $fail[] = ["nama"=>$r->nama,"id"=>$r->id_bb,"msg"=>"Stok Barang Tidak Terupdate"];
              }
            }else {
              $fail[] = ["nama"=>$r->nama,"id"=>$r->id_bb,"msg"=>"Barang Tidak Ditemukan"];
            }
          }
          return response()->json(["status"=>1,"data"=>$fail]);

        }else {
          return response()->json(["status"=>0]);
        }
      }else {
        return response()->json(["status"=>0]);
      }
    }
    public function pprodukdirektur_konfirmasi(Request $req,$status,$id)
    {
      $catatan = $req->input("catatan");
      $cek = PengadaanProdukRetur::where(["id_pengadaan_produk_retur"=>$id]);
      if ($cek->count() > 0) {
        // return response()->json(["status"=>0]);
        // $obj = $cek->first();
        // return $obj->pengadaan__bb_retur_details;
        if ($status == 1) {
          $up = $cek->update(["konfirmasi_direktur"=>1,"status_retur"=>4,"catatan_direktur"=>$catatan]);

        }else {
          $up = $cek->update(["konfirmasi_direktur"=>1,"status_retur"=>3,"catatan_direktur"=>$catatan]);
        }
        if ($up) {
          $obj = $cek->first();
          $list = $obj->pengadaan__produk_retur_details;
          $fail = [];
          foreach ($list as $key => $value) {
            $vs = $value->pengadaan_produk_detail;
            $find = MasterProduk::where(["id_produk"=>$vs->id_produk]);
            $r = $find->first();
            if ($find->count() > 0) {
              $now = ($r->stok - $value->total_retur);
              $up = $find->update(["stok"=>$now]);
              if (!$up) {
                $fail[] = ["nama"=>$r->nama_produk,"id"=>$r->id_produk,"msg"=>"Stok Barang Tidak Terupdate"];
              }
            }else {
              $fail[] = ["nama"=>$r->nama_produk,"id"=>$r->id_produk,"msg"=>"Barang Tidak Ditemukan"];
            }
          }
          return response()->json(["status"=>1,"data"=>$fail]);

        }else {
          return response()->json(["status"=>0]);
        }
      }else {
        return response()->json(["status"=>0]);
      }
    }
    //Pemasaran
    public function p_produk_read($id=null)
    {
      if ($id == null) {
        $d = MasterProduk::get();
        return response()->json(["status"=>1,"data"=>$d]);
      }else {
        $d = MasterProduk::where(["id_produk"=>$id]);
        if ($d->count() > 0) {
          return response()->json(["status"=>1,"data"=>$d->get()]);
        }else {
          return response()->json(["status"=>0,"msg"=>"Data Dengan Kode Barang ".$keyword." Tidak Ditemukan"]);
        }
      }
    }
    public function __createTransaction($parent,$child)
    {
      $fail = [];
      foreach ($child as $key => $value) {
        $s = MasterProduk::where(["id_produk"=>$value["id_produk"]]);
        if ($s->count() > 0) {
          $obj = $s->first();
          if ($obj->stok < $value["jumlah"]) {
            $fail[] = ["id"=>$value["id_produk"],"msg"=>"Kuantitas Barang Tidak Cukup"];
          }
        }else {
            $fail[] = ["id"=>$value["id_produk"],"msg"=>"Barang Tidak Ditemukan"];
        }
      }
      if (count($fail) > 0) {
        return ["status"=>0,"msg"=>"Error Ditemukan","data"=>$fail];
      }
      $parent["id_pemesanan"] = "PP".date("dmy")."-".str_pad((Pemesanan::count()+1),3,0,STR_PAD_LEFT);
      $parent["status_pesanan"] = 0;
      $parent["status_pembayaran"] = 0;
      $ins = Pemesanan::create($parent);
      foreach ($child as $key => &$value) {
        $value["id_pemesanan"] = $parent["id_pemesanan"];
      }
      // return ["status"=>0,"msg"=>"Error Ditemukan","debug"=>$child,"data"=>$fail];
      if ($ins) {
        $lastid = $parent["id_pemesanan"];
        foreach ($child as $key => &$value) {
          $value["id_pemesanan"] = $lastid;
        }
        $chil = PemesananDetail::insert($child);
        if ($chil) {
          foreach ($child as $key => $value) {
            $s = MasterProduk::where(["id_produk"=>$value["id_produk"]]);
            if ($s->count() > 0) {
              $obj = $s->first();
              $a = $s->update(["stok"=>($obj->stok-$value["jumlah"])]);
              if (!$a) {
                $fail[] = ["id"=>$value["id_produk"],"msg"=>"Gagal Merubah Stok Tersedia"];
              }
            }else {
                $fail[] = ["id"=>$value["id_produk"],"msg"=>"Barang Tidak Ditemukan"];
            }
          }
          if (count($fail) > 0) {
            return ["status"=>0,"msg"=>"Error Ditemukan","data"=>$fail];
          }
          return ["status"=>1,"data"=>[],"msg"=>"Sukses Melakukan Transaksi"];
        }else {
          Pemesanan::delete(["id_pemesanan"=>$lastid]);
          return ["status"=>0,"data"=>[],"msg"=>"Gagal Melakukan Input Item Pada Transaksi"];
        }
      }else {
        return ["status"=>0,"data"=>[],"msg"=>"Gagal Melakukan Sambungan Pada Database"];
      }
    }
    public function p_produk_trans(Request $req)
    {
      //Ambil Pajak
      $ppn = PengaturanHelper::get(["meta_value"=>"ppn"]);
      if ($ppn !== false) {
        $ppn = ($ppn->first()->meta_value/100);
      }else {
        $ppn = 0.1;
      }
      $d = json_decode($req->cart_list);
      $compact = [];
      foreach ($d as $key => $value) {
        $compact[] = ["id_produk"=>$value->product_id,"jumlah"=>$value->product_quantity,"harga"=>$value->product_price];
      }
      $s = $this->__createTransaction(["id_pelanggan"=>$req->id_pelanggan,"catatan_pemesanan"=>$req->catatan_pemesanan,"pajak"=>$ppn],$compact);
      if ($s["status"] == 1) {
        return response()->json(["status"=>1,"msg"=>$s["msg"]]);
      }else {
        return response()->json(["status"=>0,"msg"=>$s["msg"],"data"=>$s["data"]]);
      }
      // return response()->json(["status"=>0,"msg"=>$compact]);
    }
    public function listpelanggan()
    {
      return MasterPelanggan::get();
    }

    //Pemesanan
    public function pemesanan_read($id = null)
    {
      if ($id != null) {
        $getData = Pemesanan::where(["id_pemesanan"=>$id]);
        if ($getData->count() > 0) {
          $d = $getData->first();
          $d->status_pesanan_text = status_pesanan($d->status_pesanan);
          $d->status_pembayaran_text = status_pembayaran($d->status_pembayaran);
          $d->bukti_url = url("upload/".$d->bukti);
          $d->master_pelanggan;
          $d->tgl_register_text = date("d/m/Y",strtotime($d->tgl_register));
          $total =0;
          foreach ($d->pemesanan__details as $sum) {
            $total = $total+($sum->jumlah*$sum->harga);
          }
          $d->totalharga = ($total*$d->pajak)+$total;
          foreach ($d->pemesanan__details as $key => &$value) {
            $value->master_produk;
          }
          return response()->json(["status"=>1,"data"=>$d]);
        }else {
          return response()->json(["status"=>0]);
        }
      }else {
        $getData = Pemesanan::all();
        $data = [];
        $data["data"] = [];
        foreach ($getData as $key => $value) {
          $total =0;
          foreach ($value->pemesanan__details as $sum) {
            $total = $total+($sum->jumlah*$sum->harga);
          }
          $data["data"][] = [($key+1),$value->id_pemesanan,$value->master_pelanggan->nama_pelanggan,status_pesanan($value->status_pesanan),$value->catatan_pemesanan,status_pembayaran($value->status_pembayaran),($value->pajak*100)."%",number_format(($total*$value->pajak)+$total),date("d-m-Y",strtotime($value->tgl_register)),$value->id_pemesanan];
        }
        return response()->json($data);
      }
    }
    public function pemesanan_update(Request $req,$id)
    {
      if ($req->has("file")) {
        $file_data = $req->file;
        $image = $file_data;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = str_random(10).'.'.'png';
        $put = \File::put(public_path(). '/upload/' . $imageName, base64_decode($image));
        if ($put) {
          // return ["status"=>1];
          $set = Pemesanan::where(["id_pemesanan"=>$id]);
          $up = $set->update(["bukti"=>$imageName,"status_pembayaran"=>1]);
          if ($up) {
            return ["status"=>1];
          }else {
            return ["status"=>0];
          }
        }else {
          return ["status"=>0];
        }
      }else {
        $data = $req->all();
        $set = Pemesanan::where(["id_pemesanan"=>$id]);
        if ($set->count() > 0) {
          $up = $set->update($data);
          if ($up) {
            return response()->json(["status"=>1]);
          }else {
            return response()->json(["status"=>0]);
          }
        }
      }
    }

    public function direktur_pemesanan_read($id = null)
    {
      if ($id != null) {
        $getData = Pemesanan::where(["id_pemesanan"=>$id]);
        if ($getData->count() > 0) {
          $d = $getData->first();
          $d->status_pesanan_text = status_pesanan($d->status_pesanan);
          $d->status_pembayaran_text = status_pembayaran($d->status_pembayaran);
          $d->bukti_url = url("upload/".$d->bukti);
          $d->master_pelanggan;
          $d->tgl_register_text = date("d/m/Y",strtotime($d->tgl_register));
          $total =0;
          foreach ($d->pemesanan__details as $sum) {
            $total = $total+($sum->jumlah*$sum->harga);
          }
          $d->totalharga = ($total*$d->pajak)+$total;
          foreach ($d->pemesanan__details as $key => &$value) {
            $value->master_produk;
          }
          return response()->json(["status"=>1,"data"=>$d]);
        }else {
          return response()->json(["status"=>0]);
        }
      }else {
        $getData = Pemesanan::all();
        $data = [];
        $data["data"] = [];
        foreach ($getData as $key => $value) {
          $total =0;
          foreach ($value->pemesanan__details as $sum) {
            $total = $total+($sum->jumlah*$sum->harga);
          }
          $data["data"][] = [($key+1),$value->id_pemesanan,$value->master_pelanggan->nama_pelanggan,status_pesanan($value->status_pesanan),$value->catatan_pemesanan,status_pembayaran($value->status_pembayaran),($value->pajak*100)."%",number_format(($total*$value->pajak)+$total),date("d-m-Y",strtotime($value->tgl_register)),$value->id_pemesanan];
        }
        return response()->json($data);
      }
    }
    public function direktur_pemesanan_update(Request $req,$id)
    {
      if ($req->has("file")) {
        $file_data = $req->file;
        $image = $file_data;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = str_random(10).'.'.'png';
        $put = \File::put(public_path(). '/upload/' . $imageName, base64_decode($image));
        if ($put) {
          // return ["status"=>1];
          $set = Pemesanan::where(["id_pemesanan"=>$id]);
          $up = $set->update(["bukti"=>$imageName,"status_pembayaran"=>1]);
          if ($up) {
            return ["status"=>1];
          }else {
            return ["status"=>0];
          }
        }else {
          return ["status"=>0];
        }
      }else {
        $data = $req->all();
        $set = Pemesanan::where(["id_pemesanan"=>$id]);
        if ($set->count() > 0) {
          $up = $set->update($data);
          if ($up) {
            return response()->json(["status"=>1]);
          }else {
            return response()->json(["status"=>0]);
          }
        }
      }
    }
    // Pengiriman
    public function pengiriman_read($id = null)
    {
      if ($id != null) {
        $getData = Pengiriman::where(["id_pengiriman"=>$id]);
        if ($getData->count() > 0) {
          $d = $getData->first();
          $d->status_pengiriman_text = status_pengiriman($d->status_pengiriman);
          $d->tgl_pengiriman_text = date("d-m-Y",strtotime($d->tgl_pengiriman));
          $d->tgl_register_text =  date("d-m-Y",strtotime($d->tgl_register));
          $d->tgl_kembali_text = "-";
          if ($d->tgl_kembali != null) {
            $d->tgl_kembali_text =  date("d-m-Y",strtotime($d->tgl_kembali));
          }
          $d->master_transportasi;
          $d->pengiriman__details;
          foreach ($d->pengiriman__details as $key => &$value) {
            $value->pemesanan->master_pelanggan;
            $value->pemesanan;
            $value->pemesanan->status_pesanan_text = status_pesanan($value->pemesanan->status_pesanan);
          }
          return response()->json(["status"=>1,"data"=>$d]);
        }else {
          return response()->json(["status"=>0]);
        }
      }else {
        $getData = Pengiriman::all();
        $data = [];
        $data["data"] = [];
        foreach ($getData as $key => $value) {
          $data["data"][] = [
            ($key+1),
            $value->id_pengiriman,
            $value->master_transportasi->no_polisi,
            strtoupper($value->master_transportasi->jenis_transportasi),
            date("d-m-Y",strtotime($value->tgl_pengiriman)),
            (($value->tgl_kembali == null)?"-":date("d-m-Y",strtotime($value->tgl_kembali))),
            $value->nama_pengemudi,
            $value->kontak_pengemudi,
            status_pengiriman($value->status_pengiriman),
            date("d-m-Y",strtotime($value->tgl_register)),
            $value->id_pengiriman,
          ];
        }
        return response()->json($data);
      }
    }
    public function pengiriman_kode()
    {
      $kodifikasi = "PNP".date("dmy")."-".str_pad((Pengiriman::count()+1),3,0,STR_PAD_LEFT);
      return $kodifikasi;
    }
    public function pengiriman_insert(Request $req,$id=null)
    {
      if ($req->has("item")) {
        $data =  $req->all();
        unset($data["item"]);
        $create = Pengiriman::create($data);
        if ($create) {
          $id = $req->id_pengiriman;
          $batch = [];
          foreach ($req->item as $key => $value) {
            $alamat = Pemesanan::where(["id_pemesanan"=>$value])->first()->master_pelanggan->alamat;
            $catatan = Pemesanan::where(["id_pemesanan"=>$value])->first()->catatan_pemesanan;
            if (PengirimanDetail::where(["id_pemesanan"=>$value])->count() > 0) {
              Pengiriman::find($id)->delete();;
              return response()->json(["status"=>0,"msg"=>"Pesanan Dengan ID ".$value." Sedang Di Kirimkan"]);
            }
            Pemesanan::where(["id_pemesanan"=>$value])->update(["status_pesanan"=>2]);
            $batch[] = ["id_pengiriman"=>$id,"id_pemesanan"=>$value,"alamat_tujuan"=>$alamat,"catatan_khusus"=>$catatan];
          }
          $ins = PengirimanDetail::insert($batch);
          if ($ins) {
            MasterTransportasi::where(["id_transportasi"=>$req->id_transportasi])->update(["status_kendaraan"=>2]);
            return response()->json(["status"=>1,"msg"=>"Pengiriman Sukses Di Simpan"]);
          }else {
            foreach ($req->item as $key => $value) {
              PengirimanDetail::where(["id_pemesanan"=>$value])->update(["status_pesanan"=>1]);
            }
            Pengiriman::find($id)->delete();;
            return response()->json(["status"=>0,"msg"=>"Pengiriman Gagal Di Simpan"]);
          }
        }else {
          return response()->json(["status"=>0,"msg"=>"Pengiriman Gagal Di Simpan"]);
        }
      }else {
        return response()->json(["status"=>0,"msg"=>"Tidak ada pesanan yang akan di kirim"]);
      }
    }
    public function pengiriman_update(Request $req,$id)
    {
      $data = $req->all();
      $set = Pengiriman::where(["id_pengiriman"=>$id]);
      if ($set->count() > 0) {
        $row = $set->first();
        $up = $set->update($data);
        if ($up) {
          if ($req->status_pengiriman == 2) {
            foreach ($row->pengiriman__details as $key => $value) {
              Pemesanan::where(["id_pemesanan"=>$value->id_pemesanan])->update(["status_pesanan"=>3]);
              $d = Pemesanan::where(["id_pemesanan"=>$value->id_pemesanan])->first()->pemesanan__details;
              foreach ($d as $k => $v) {
                $mp = MasterProduk::where(["id_produk"=>$v->id_produk]);
                $stok = ($mp->first()->stok + $v->jumlah);
                $mp->update(["stok"=>$stok]);
              }
            }
            MasterTransportasi::where(["id_transportasi"=>$row->id_transportasi])->update(["status_kendaraan"=>0]);
          }elseif ($req->status_pengiriman == 1) {
            foreach ($row->pengiriman__details as $key => $value) {
            $d = Pemesanan::where(["id_pemesanan"=>$value->id_pemesanan])->first()->pemesanan__details;
              foreach ($d as $key => $value) {
                $mp = MasterProduk::where(["id_produk"=>$value->id_produk]);
                $stok = ($mp->first()->stok - $value->jumlah);
                $mp->update(["stok"=>$stok]);
              }
            }
          }elseif ($req->status_pengiriman == 3) {
            foreach ($row->pengiriman__details as $key => $value) {
              Pemesanan::where(["id_pemesanan"=>$value->id_pemesanan])->update(["status_pesanan"=>4]);
            }
            MasterTransportasi::where(["id_transportasi"=>$row->id_transportasi])->update(["status_kendaraan"=>0]);
            $set->update(["tgl_kembali"=>date("Y-m-d")]);
          }
          return response()->json(["status"=>1]);
        }else {
          return response()->json(["status"=>0]);
        }
      }
    }
    public function ready_ship()
    {
      $find = Pemesanan::where(["status_pembayaran"=>3,"status_pesanan"=>1]);
      $cek = function($any){
        $check = '<div class="custom-controls-stacked">
                        <label class="custom-control custom-checkbox">
                          <input type="checkbox" class="custom-control-input listcheck"   data-id="'.$any["id_pemesanan"].'" >
                          <span class="custom-control-label">'.$any["id_pemesanan"].'</span>
                        </label>
                  </div>';
        return $check;
      };
      if ($find->count() > 0) {
        $rs = $find->get();
        $data = [];
        $data["data"] = [];
        foreach ($rs as $key => $value) {
          $data["data"][] = [$cek(["id_pemesanan"=>$value->id_pemesanan]),status_pesanan($value->status_pesanan),$value->id_pemesanan];
        }
        return response()->json($data);
      }else {
        return response()->json(["data"=>[]]);
      }
    }
    public function aktif_trasport()
    {
      $data = MasterTransportasi::where(["status_kendaraan"=>0])->get();
      return $data;
    }
    public function invoicePemesanan($id)
    {
      $kode = $id;
      $invoice = Pemesanan::where(["id_pemesanan"=>$kode])->first();
      $invoice->kode = $kode;
      $invoice->pajak_total = 0;
      $invoice->total_price = 0;
      $invoice->total = 0;
      foreach ($invoice->pemesanan__details as $key => $value) {
        $invoice->total = $invoice->total + ($value->harga*$value->jumlah);
      }
        $invoice->pajak_total = ($invoice->pajak * $invoice->total);
        $invoice->total_price =  ($invoice->pajak_total + $invoice->total);
      $pdf = PDF::loadView('invoice.pesanan', ["invoice"=>$invoice,"title"=>"INVOICE PEMESANAN"])->setPaper('a4', 'landscape');
      return $pdf->stream();
    }
    public function invoicePengadaaan($id)
    {
      $kode = $id;
      $invoice = PengadaanProduk::where(["id_pengadaan_produk"=>$kode])->first();
      $invoice->kode = $kode;
      $invoice->total_price = 0;
      $invoice->total = 0;
      foreach ($invoice->pengadaan__produk_details as $key => $value) {
        $invoice->total = $invoice->total + ($value->harga*$value->jumlah);
      }
        $invoice->total_price =  $invoice->total;
      $pdf = PDF::loadView('invoice.pengadaan', ["invoice"=>$invoice,"title"=>"INVOICE PENGADAAN PRODUK"])->setPaper('a4', 'landscape');
      return $pdf->stream();
    }
    public function invoicePengadaaanbb($id)
    {
      $kode = $id;
      $invoice = PengadaanBb::where(["id_pengadaan_bb"=>$kode])->first();
      $invoice->kode = $kode;
      $invoice->total_price = 0;
      $invoice->total = 0;
      foreach ($invoice->pengadaan__bb_details as $key => $value) {
        $invoice->total = $invoice->total + ($value->harga*$value->jumlah);
      }
        $invoice->total_price =  $invoice->total;
      $pdf = PDF::loadView('invoice.pengadaanbb', ["invoice"=>$invoice,"title"=>"INVOICE PENGADAAN BAHAN BAKU"])->setPaper('a4', 'landscape');
      return $pdf->stream();
    }

    public function produksi_listproduk()
    {
      $data = [];
      $data["data"] = [];
      $d = MasterProduk::orderBy("stok","asc")->get();
      foreach ($d as $key => $value) {
        if ($value->master__komposisis->count() > 0) {
          $ingred = [];
          foreach ($value->master__komposisis as $k => $v) {
            $cStok = $v->master_bb->stok;
            $jml = $v->jumlah * $v->rasio;
            $ingred[] = round($cStok/$jml);
          }

          $data["data"][] = [$value->id_produk,$value->nama_produk,$value->stok,$value->stok_minimum,min($ingred),$value->id_produk];
        }
      }
      return response()->json($data);
    }
    public function produksi_read()
    {
      $data["data"] = [];
      $d = Produksi::where(["jenis"=>"perencanaan"])->get();
      foreach ($d as $key => $value) {
        $harga = 0;
        foreach ($value->produksi__details as $y => $e) {
          $hargaSatuan = 0;
          foreach ($e->master_produk->master__komposisis as $ky => $ve) {
            $r = $ve->rasio;
            $h = $ve->master_bb->harga;
            $hargaSatuan = $hargaSatuan + ($r*$h);
          }
          $harga = $harga + ($e->jumlah*$hargaSatuan);
        }
        $data["data"][] = [$value->id_produksi,ucfirst($value->jenis),konfirmasi($value->konfirmasi_perencanaan),"Rp ".number_format($harga),$value->produksi__details->count(),status_produksi($value->status_produksi),$value->id_produksi];
      }
      return response()->json($data);
    }
    public function produksi_update(Request $req,$id)
    {
      $a = Produksi::where(["id_produksi"=>$id]);
      if ($a->count() > 0) {
        $row = $a->first();
        $a->update($req->all());
        return response()->json(["status"=>1]);
      }else {
        return response()->json(["status"=>0]);
      }
    }
    public function produksi_insert(Request $req)
    {
      $data =  $req->all();
      if (Produksi::whereIn("status_produksi",[0])->count() > 0) {
        return response()->json(["status"=>0,"msg"=>"Harap Selesaikan / Batalkan Terlebih Dahulu Produksi Sebelumnya"]);
      }
      $data["jenis"] = "perencanaan";
      $ins = Produksi::create($data);
      if ($ins) {
        $id = $data["id_produksi"];
        $item = [];
        foreach ($req->item as $k => $v) {
          $arr = ((array) $req->jumlah_produksi);
          foreach ($arr as $key => $value) {
            if ($key == $v) {
              $item[] = ["id_produk"=>$v,"id_produksi"=>$id,"jumlah"=>$value];
            }
          }
        }
        $i = ProduksiDetail::insert($item);
        if ($i) {
          return response()->json(["status"=>1,"debug"=>$arr,"msg"=>"Sukses Input Data Produksi"]);
        }else {
          return response()->json(["status"=>0,"msg"=>"Gagal Input Data Produksi"]);
        }
      }else {
        return response()->json(["status"=>0,"msg"=>"Sukses Input Data Produksi"]);
      }
    }
}
