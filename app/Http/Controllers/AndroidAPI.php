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
      // return $data;
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
    public function driver_login(Request $req)
    {
      $req->validate([
        "username"=>"required",
        "password"=>"required",
      ]);
      $where = $req->all();
      $get = GeraiDriver::where($where);
      if ($get->count() > 0) {
        $d = $get->first();
        return response()->json(["status"=>1,"data"=>$d]);
      }else {
        return response()->json(["status"=>0]);
      }
      // return response()->json(["status"=>1]);
    }
    function _distance($lat1, $lon1, $lat2, $lon2, $unit) {
      $theta = $lon1 - $lon2;
      $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
      $dist = acos($dist);
      $dist = rad2deg($dist);
      $miles = $dist * 60 * 1.1515;
      $unit = strtoupper($unit);
      if ($unit == "K") {
        return ($miles * 1.609344);
      } else if ($unit == "N") {
          return ($miles * 0.8684);
        } else {
            return $miles;
          }
    }
    public function terima(Request $req)
    {
      $data = $req->all();
      $id = $data["id"];
      unset($data["id"]);
      $cek = GeraiOrder::where("id",$id);
      if ($cek->count() > 0) {
        $cLat = $cek->first()->cLat;
        $cLng = $cek->first()->cLng;
        $qty = $cek->first()->qty;
        $harga = $cek->first()->gerai_layanan->harga;
        $km = $this->_distance($cLat,$cLng,$data["dLat"],$data["dLng"],"km");
        $data["jarak"] = round($km);
        $data["totalharga"] = ($qty*$harga)+($data["jarak"]*5000);
        $data["status_order"] = 1;
        $cek->update($data);
        return response()->json(["status"=>1,"data"=>$data]);
      }else {
        return response()->json(["status"=>0]);
      }
      // return $req->all();
    }
    public function statusorder_driver(Request $req)
    {
      $data = $req->all();
      $id = $data["id"];
      unset($data["id"]);
      $cek = GeraiOrder::where("id",$id);
      if ($cek->count() > 0) {
        $cek->update($data);
        return response()->json(["status"=>1,"data"=>$data]);
      }else {
        return response()->json(["status"=>0]);
      }
    }
    public function driver_listpesanan($id)
    {
      $order = GeraiDriver::where(["id"=>$id])->first()->pemilik->gerai_orders([0,1],$id);
      foreach ($order as $key => &$v) {
        $v->nama_pelanggan = $v->gerai_pelanggan->nama;
        $v->kode = str_pad($v->id,5,0,STR_PAD_LEFT);
        $v->nama_layanan = $v->gerai_layanan->nama;
        $v->jarakTempuh = ($v->jarak == null)?"Belum Ditentukan":$v->jarak." KM";
        $v->harga = number_format($v->totalharga);
        $v->ownId = $id;

      }
      return $order;
    }
    public function driver_detailpesanan($id)
    {
      $d = GeraiOrder::where("id",$id);
      $data = $d->first();
      $data->nama_pelanggan = $data->gerai_pelanggan->nama;
      $data->kode = str_pad($data->id,5,0,STR_PAD_LEFT);
      $data->nama_layanan = $data->gerai_layanan->nama;
      $data->jarakTempuh = ($data->jarak == null)?"Belum Ditentukan":$data->jarak." KM";
      $data->dibuatFormat = date("Y-m-d",strtotime($data->dibuat));
      return $data;
    }
}
