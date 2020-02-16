<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use \App\Models\{MasterBb,MasterKomposisi,MasterPelanggan,MasterProduk,MasterSatuan,MasterSuplier,MasterTransportasi,Pemesanan,PemesananDetail,PengadaanBb,PengadaanBbDetail,Pengaturan,Pengguna,Pengiriman,PengirimanDetail,Produksi,ProduksiDetail,WncGerai,WncOrder,WncPelanggan,WncProduk,PengadaanBbRetur,PengadaanBbReturDetail,PengadaanProduk,PengadaanProdukDetail,PengadaanProdukRetur,PengadaanProdukReturDetail,PeramalanProduksi,Penyusutan,Po,PosBarang,PosRegister,PosTransaksi,PosTransaksiDetail,Permintaan,PermintaanDetail};
use PDF;
use \App\Events\SCMNotif;
use \Carbon\CarbonPeriod;
class PosAPI extends Controller
{

    public function __construct()
    {
      $this->middleware('jwt.verify');
    }

    public function checkValidity()
    {
      return ["status"=>"Valid"];
    }

    public function me()
    {
      return response()->json(Auth::guard()->user());
    }
    public function transaksi()
    {
      $sess = Auth::guard()->user();
      $data = Po::where(["id_pos"=>$sess->id_pos])->first();
      $reg = $data->pos_registers;
      $trx = [];
      foreach ($reg as $key => $value) {
        foreach ($value->pos_transaksis as $k => $v) {
          $trx[] = $v;
        }
      }
      return response()->json($trx);
    }
    public function kasir()
    {
      $sess = Auth::guard()->user();
      $data = Po::where(["pos_id"=>$sess->id_pos])->get();
      return response()->json($data);
    }

    public function transaksiById($id)
    {
      $d = PosTransaksi::where("id",$id);
      if ($d->count() > 0) {
        $row = $d->first();
        $row->pos_register->po;

        $trow = $row->pos_transaksi_detail;
        if ($trow != null) {
          if (isset($row->pos_transaksi_detail[1])) {
            foreach ($row->pos_transaksi_detail as $key => $value) {
              $value->pos_barang;
            }
          }
        }
        return response()->json(["status"=>1,"data"=>$row]);
      }else {
        return response()->json(["status"=>0]);
      }
    }
    public function kasirinsert(Request $req)
    {
        $req->validate([
          "nama_pengguna"=>"required",
          "username"=>"required|unique:pos,username",
          "password"=>"required",
        ]);
        $sess = Auth::guard()->user();
        $id = $sess->id_pos;
        $data = $req->all();
        $data["level"] = "kasir";
        $data["pos_id"] = $id;
        $data["status"] = 1;
        $data["password"] = Hash::make($data["password"]);
        $ins = Po::create($data);
        if ($ins) {
          return response()->json(["status"=>1],200);
        }else {
          return response()->json(["status"=>0],400);
        }
    }
    public function user($id)
    {
      $cek = Po::where(["id_pos"=>$id]);
      if ($cek->count() > 0) {
        $d = $cek->first();
        return response()->json(["status"=>1,"data"=>$d],200);
      }else {
        return response()->json(["status"=>0],400);
      }
    }
    public function kasirupdate(Request $req,$id)
    {

        $sess = Auth::guard()->user();
        $data = $req->all();
        $data["level"] = "kasir";
        if ($req->has("password")) {
          if ($req->password != "") {
            $data["password"] = Hash::make($data["password"]);
          }else {
            unset($data["password"]);
          }
        }
        $ins = Po::where(["id_pos"=>$id])->update($data);
        if ($ins) {
          return response()->json(["status"=>1],200);
        }else {
          return response()->json(["status"=>0],400);
        }
    }
    public function check_available_register()
    {
      $sess = Auth::guard()->user();
      $id = $sess->id_pos;
      $cek = PosRegister::where(["pos_id"=>$id,"check_out"=>null])->orderBy("check_in","desc");
      if ($cek->count() > 0) {
        return response()->json(["status"=>0,"msg"=>"Ada Sesi Yang Masih Dibuka","data"=>$cek->first()]);
      }else {
        return response()->json(["status"=>1,"msg"=>"Sesi Kosong Silahkan Buka Sesi"]);
      }
    }
    public function create_pos_register(Request $req)
    {
      $req->validate([
        "cash_start"=>"numeric|required"
      ]);
      $sess = Auth::guard()->user();
      $id = $sess->id_pos;
      $data = ["pos_id"=>$id,"check_in"=>date("Y-m-d"),"cash_start"=>$req->cash_start,"cash_close"=>0];
      $ins = PosRegister::create($data);
      if ($ins) {
        return response()->json(["status"=>1],200);
      }else {
        return response()->json(["status"=>0],400);
      }
    }
    public function close_pos_register(Request $req,$id)
    {
      $req->validate([
        "cash_close"=>"numeric|required"
      ]);
      $sess = Auth::guard()->user();
      $data = ["check_out"=>date("Y-m-d"),"cash_close"=>$req->cash_close];
      $ins = PosRegister::where("id",$id)->update($data);
      if ($ins) {
        return response()->json(["status"=>1],200);
      }else {
        return response()->json(["status"=>0],400);
      }
    }
    public function transaksiinsert(Request $req)
    {
      $req->validate([
        "item"=>"required",
        "info"=>"required",
        "pos_register_id"=>"required"
      ]);
      $item = json_decode($req->item);
      $info = json_decode($req->info);
      if (count($item) == 0) {
        return response()->json(["status"=>0],400);
      }
      $inputList = ["nama_pelanggan","total_bayar","pos_register_id","status"];
      $itemKey = ["pos_barang_id","jumlah","harga"];
      foreach ($info as $key => $value) {
        if (!in_array($key,$inputList)) {
          return response()->json(["status"=>0],400);
        }
      }
      $totalPembayaran = 0;
      foreach ($item[0] as $key => $value) {
        if (!in_array($key,$itemKey)) {
          return response()->json(["status"=>0],400);
        }
        if ($key == "harga" && $value == 0) {
          return response()->json(["status"=>0],400);
        }
        if ($key == "jumlah" && $value == 0) {
          return response()->json(["status"=>0],400);
        }
      }
      foreach ($item as $key => $value) {
        $totalPembayaran = $totalPembayaran + ($value->jumlah * $value->harga);
      }
      $newInfo = [];
      $newInfo["nama_pelanggan"] = $info->nama_pelanggan;
      $newInfo["total_bayar"] = $info->total_bayar;
      $newInfo["total_pembayaran"] = $totalPembayaran;
      $newInfo["pos_register_id"] = $req->pos_register_id;
      $newInfo["kembalian"] = ($info->total_bayar - $totalPembayaran);
      $newInfo["tgl_transaksi"] = date("Y-m-d");
      $newInfo["status"] = $info->status;
      if ($newInfo["kembalian"] < 0) {
        return response()->json(["status"=>0],400);
      }elseif($newInfo["kembalian"] == 0) {
        $newInfo["status"] = "selesai";
      }
      $start = PosTransaksi::create($newInfo);
      if ($start) {
        $id_trx = $start->id;
        $newItem = [];
        foreach ($item as $key => $value) {
          $newItem[] =["pos_transaksi_id"=>$id_trx,"pos_barang_id"=>$value->pos_barang_id,"jumlah"=>$value->jumlah,"harga"=>$value->harga];
        }
        foreach ($newItem as $key => $value) {
          $obj = PosBarang::where(["id"=>$value["pos_barang_id"]]);
          $stok = ($obj->first()->stok - $value["jumlah"]);
          if ($stok < 0) {
            PosTransaksi::find($id_trx)->delete();
            return response()->json(["status"=>0],400);
          }
        }
        $end = PosTransaksiDetail::insert($newItem);
        if ($end) {
          if ($newInfo["status"] != "tahan") {
            foreach ($newItem as $key => $value) {
              $obj = PosBarang::where(["id"=>$value["pos_barang_id"]]);
              $stok = ($obj->first()->stok - $value["jumlah"]);
              $obj->update(["stok"=>$stok]);
            }
          }
          return response()->json(["status"=>1],200);
        }else {
          PosTransaksi::find($id_trx)->delete();
          return response()->json(["status"=>0],400);
        }
      }else {
        return response()->json(["status"=>0],400);
      }
    }
    public function transaksicancel($id)
    {
      $cek = PosTransaksi::where(["id"=>$id]);
      if ($cek->count() > 0 && ($cek->first()->status == "selesai" || $cek->first()->status == "tunggu" || $cek->first()->status == "tahan") ) {
        $row = $cek->first();
        foreach ($row->pos_transaksi_detail as $key => $value) {
          $s = PosBarang::where(["id"=>$value->pos_barang_id]);
          $stok = ($s->first()->stok + $value->jumlah);
          $s->update(["stok"=>$stok]);
        }
        $cek->update(["status"=>"batal"]);
        return response()->json(["status"=>1],200);
      }else {
        return response()->json(["status"=>0],400);
      }
    }
    public function permintaaninsert(Request $req)
    {
      $req->validate([
        "item"=>"required",
        "info"=>"required",
      ]);
      $item = json_decode($req->item);
      $info = json_decode($req->info);
      if (count($item) == 0) {
        return response()->json(["status"=>0],400);
      }
      $inputList = ["pos_id"];
      $itemKey = ["id_produk","jumlah"];
      foreach ($info as $key => $value) {
        if (!in_array($key,$inputList)) {
          return response()->json(["status"=>0],400);
        }
      }
      $totalPembayaran = 0;
      foreach ($item[0] as $key => $value) {
        if (!in_array($key,$itemKey)) {
          return response()->json(["status"=>0],400);
        }
        if ($key == "jumlah" && $value == 0) {
          return response()->json(["status"=>0],400);
        }
      }

      $newInfo = [];
      $newInfo["pos_id"] = $info->pos_id;
      $newInfo["tgl_dibuat"] = date("Y-m-d H:i:s");
      $start = Permintaan::create($newInfo);
      if ($start) {
        $id_trx = $start->id;
        $newItem = [];
        foreach ($item as $key => $value) {
          $newItem[] =["permintaan_id"=>$id_trx,"id_produk"=>$value->id_produk,"jumlah"=>$value->jumlah];
        }
        foreach ($newItem as $key => $value) {
          $obj = MasterProduk::where(["id_produk"=>$value["id_produk"]]);
          $stok = ($obj->first()->stok - $value["jumlah"]);
          if ($stok < 0) {
            Permintaan::find($id_trx)->delete();
            return response()->json(["status"=>0],400);
          }
        }
        $end = PermintaanDetail::insert($newItem);
        if ($end) {
          return response()->json(["status"=>1],200);
        }else {
          Permintaan::find($id_trx)->delete();
          return response()->json(["status"=>0],400);
        }
      }else {
        return response()->json(["status"=>0],400);
      }
    }
    public function permintaancancel($id)
    {
      $cek = Permintaan::where(["id"=>$id]);
      if ($cek->count() > 0 && ($cek->first()->status_permintaan != 5)) {
        $row = $cek->first();
        foreach ($row->permintaan_details as $key => $value) {
          $ss = PosBarang::where(["id_produk"=>$value->id_produk,"pos_id"=>$row->pos_id]);
          $s = MasterProduk::where(["id_produk"=>$value->id_produk]);
          $stok = ($s->first()->stok + $value->jumlah);
          $sstok = ($ss->first()->stok - $value->jumlah);
          $s->update(["stok"=>$stok]);
          $ss->update(["stok"=>$stok]);
        }
        $cek->update(["status_permintaan"=>5]);
        return response()->json(["status"=>1],200);
      }else {
        return response()->json(["status"=>0],400);
      }
    }

    public function permintaan()
    {
      $sess = Auth::guard()->user();
      $data = Po::where(["id_pos"=>$sess->id_pos])->first();
      $reg = $data->permintaans;
      $trx = [];
      foreach ($reg as $key => $value) {
        $brg = [];
        foreach ($value->permintaan_details as $k => $v) {
          $brg[] = $v;
          $v->master_produk;
        }
        $value->detail = $brg;
        $trx[] = $value;
      }
      return response()->json($trx);
    }
    public function permintaanById($id)
    {
      $d = Permintaan::where("id",$id);
      if ($d->count() > 0) {
        $row = $d->first();
        $row->po;

        $trow = $row->permintaan_details;
        if ($trow != null) {
          if (isset($row->permintaan_details[1])) {
            foreach ($row->permintaan_details as $key => $value) {
              $value->master_produk;
            }
          }
        }
        return response()->json(["status"=>1,"data"=>$row]);
      }else {
        return response()->json(["status"=>0]);
      }
    }

    public function barang()
    {
        $sess = Auth::guard()->user();
        $id = $sess->id_pos;
        if ($sess->pos_id != null) {
          $id = $sess->pos_id;
        }
        $a = PosBarang::where(["pos_id"=>$id])->orderBy("stok","desc")->get();
        foreach ($a as $key => &$value) {
          $value->master_produk;
        }
        $data = $a;
        return response()->json($data,200);
    }
    public function baranggudang()
    {
      $all = MasterProduk::orderBy("stok","desc")->get();
      return response()->json($all);
    }
}
