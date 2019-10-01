<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DirekturControl extends Controller
{
    public function index()
    {
      $data["title"] = "Beranda Direktur";
      return view("direktur.home")->with($data);
    }
}
