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
}
