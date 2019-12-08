<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Pengguna,GeraiPelanggan,GeraiOrder,GeraiLayanan,GeraiKontrol,GeraiDriver,GeraiBarang,GeraiBarangDetail,GeraiBagihasil};
class AndroidAPI extends Controller
{
    public function pelanggan_login(Request $req)
    {
      $req->validate([
        "email"=>"required",
        "password"=>"required",
      ]);
      $where = $req->all();
      $get = GeraiPelanggan::where($where);
      if ($get->count() > 0) {
        $d = $get->first();
        return response()->json(["status"=>1,"data"=>$d]);
      }else {
        return response()->json(["status"=>0]);
      }
    }
    public function pelanggan_register(Request $req)
    {
      $req->validate([
        "nama"=>"required",
        "jk"=>"required",
        "email"=>"required|unique:gerai_pelanggan,email",
        "password"=>"required|min:3",
        "no_hp"=>"required|numeric|min:11",
        "alamat"=>"required",
      ]);
      $data = $req->all();
      $ins = GeraiPelanggan::create($data);
      if ($ins) {
        return response()->json(["status"=>1]);
      }else {
        return response()->json(["status"=>0]);
      }
    }
    public function penggunalist()
    {
      $get = Pengguna::where(["level"=>"gerai"]);
      if ($get->count() > 0) {
        $data = $get->get();
        return response()->json(["status"=>1,"data"=>$data]);
      }else {
        return response()->json(["status"=>0]);
      }
    }
    public function dijemput(Request $req,$status,$id)
    {
      $data = $req->all();
      $c = GeraiOrder::where(["id"=>$id]);
      if ($c->count() > 0) {
        if ($status == 1) {
          $c->update(["dijemput"=>$status,"status_order"=>5,"cLat"=>$data["lat"],"cLng"=>$data["lng"]]);
        }else {
          $c->update(["dijemput"=>$status]);
        }
        return response(["status"=>1]);
      }else {
        return response(["status"=>0]);
      }
    }
    public function cekharga($id)
    {
      $d = GeraiLayanan::where(["id"=>$id])->first();
      return $d->harga;
    }
    public function listpesanan($id)
    {
      $d = GeraiOrder::where(["gerai_pelanggan_id"=>$id]);
      if ($d->count() > 0) {
        $data = [];
        foreach ($d->get() as $key => $row) {
          $data[] = ["id"=>str_pad($row->id,5,0,STR_PAD_LEFT),"id_unformat"=>$row->id,"nama_layanan"=>$row->gerai_layanan->nama];
        }
        return ["status"=>1,"data"=>$data];
      }else {
        return ["status"=>0];
      }
    }
    public function layananlist($id)
    {
      $get = GeraiLayanan::where(["pemilik_id"=>$id]);
      if ($get->count() > 0) {
        $data = $get->get();
        return response()->json(["status"=>1,"data"=>$data]);
      }else {
        return response()->json(["status"=>0]);
      }
    }
    public function submitorder(Request $req)
    {

      $data = $req->all();
      $cek = GeraiOrder::where(["gerai_pelanggan_id"=>$req->gerai_pelanggan_id])->whereIn("status_order",[0,1,2,3,4,5]);
      if ($cek->count() > 0) {
        return response()->json(["status"=>0,"msg"=>"Orderan Masih Ada"]);
      }
      $data["totalharga"] = 0;
      $a = GeraiOrder::create($data);
      if ($a) {
        return ["status"=>1];
      }else {
        return ["status"=>0];
      }
    }
    public function pesanan($id = null)
    {
      if ($id == null) {
        $c = GeraiOrder::all();
        foreach ($c as $key => &$value) {
          $value->gerai_driver;
          $value->gerai_layanan;
          $value->id_formatted = str_pad($value->id,5,0,STR_PAD_LEFT);
          $value->order = $value->status_format($value->status_order);
        }
        return ["status"=>1,"data"=>$c];
      }else {
        return ["status"=>0,"data"=>[]];
      }
    }
}
