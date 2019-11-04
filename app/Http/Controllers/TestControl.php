<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Helpers\Pengaturan;

class TestControl extends Controller
{
    public function model()
    {
      return ["data"=>Pengaturan::del(["meta_key"=>"pph"])];
    }
}
