<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PemasaranControl extends Controller
{
  public function index()
  {
    $data["title"] = "Beranda Pemasaran";
    return view("pemasaran.home")->with($data);
  }
}
