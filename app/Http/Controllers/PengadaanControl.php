<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PengadaanControl extends Controller
{
    public function index()
    {
      $data["title"] = "Beranda Pengadaan";
      return view("pengadaan.home")->with($data);
    }
}
