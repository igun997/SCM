<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GudangControl extends Controller
{
  public function index()
  {
    $data["title"] = "Beranda Gudang";
    return view("gudang.home")->with($data);
  }
}
