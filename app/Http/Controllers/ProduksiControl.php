<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProduksiControl extends Controller
{
  public function index()
  {
    $data["title"] = "Beranda Produksi";
    return view("produksi.home")->with($data);
  }
}
