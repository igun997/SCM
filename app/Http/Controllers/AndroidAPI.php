<?php

namespace App\Http\Controllers;
use Mail;
use Illuminate\Http\Request;
use App\Models\{Pengguna,GeraiPelanggan,GeraiOrder,GeraiOrderDetail,GeraiLayanan,GeraiKontrol,GeraiDriver,GeraiBarang,GeraiBarangDetail,GeraiBagihasil};
class AndroidAPI extends Controller
{
    public function pelanggan_login(Request $req)
    {
      $req->validate([
        "email"=>"required",
        "password"=>"required",
      ]);
      $where = $req->all();
      $where["status"] = 1;
      $get = GeraiPelanggan::where($where);
      if ($get->count() > 0) {
        $d = $get->first();
        return response()->json(["status"=>1,"data"=>$d]);
      }else {
        return response()->json(["status"=>0,"data"=>$req->all()]);
      }
    }
    public function mailsend($data)
    {
      $a = Mail::send($data["view"], $data["view_data"], function ($m) use ($data) {
           $m->from('no-reply@wenow.id', "WENOW SERVICE MAIL");

           $m->to($data["to"],$data["to_name"])->subject($data["subject"]);
       });
       return $a;
    }
    public function mailsend_test()
    {
      $data_mail["view"] = "emails.activation";
      $data_mail["view_data"] = ["url"=>route("activate.email",[1,1])];
      $data_mail["subject"] = "Aktivasi Email Anda";
      $data_mail["to"] = "indra.gunanda@gmail.com";
      $data_mail["to_name"] = "Indra Gunanda";
      $this->mailsend($data_mail);

    }
    public function activate($key,$id)
    {
      $find = GeraiPelanggan::where(["id"=>$id]);
      $key_pelanggan = md5($find->first()->email."|".$find->first()->password);
      if ($key == $key_pelanggan) {
        $find->update(["status"=>1]);
        echo "Selamat Akun Anda Sudah Aktif";
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
        $data_mail["view"] = "emails.activation";
        $data_mail["view_data"] = ["url"=>route("activate.email",[md5($req->email."|".$req->password),$ins->id])];
        $data_mail["subject"] = "Aktivasi Email Anda";
        $data_mail["to"] = $req->email;
        $data_mail["to_name"] = $req->nama;
        $this->mailsend($data_mail);
        return response()->json(["status"=>1]);
      }else {
        return response()->json(["status"=>0]);
      }
    }
    public function updateakun(Request $req,$id)
    {
      $cek = GeraiPelanggan::where(["id"=>$id]);
      if ($cek->count() > 0) {
        $up = $cek->update($req->all());
        if ($up) {
          return response()->json(["status"=>1]);
        }else {
          return response()->json(["status"=>0]);
        }
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
          $c->update(["dijemput"=>$status,"status_order"=>5,"cLat_antar"=>$data["lat"],"cLng_antar"=>$data["lng"],"alamat_antar"=>$data["alamat_antar"]]);
        }else {
          $c->update(["dijemput"=>$status]);
        }
        return response(["status"=>1]);
      }else {
        return response(["status"=>0]);
      }
      // return $data;
    }
    public function cekharga(Request $req)
    {
      $d = GeraiLayanan::whereIn("id",$req->layanan)->get();
      // return $req->rawData["qty_1"];
      $harga = 0;
      foreach ($d as $key => $value) {
        $a = "qty_".$value->id;
        $harga = $harga + ($value->harga * $req->rawData[$a]);
      }
      return ($harga);
    }
    public function listpesanan($id)
    {
      $d = GeraiOrder::where(["gerai_pelanggan_id"=>$id]);
      if ($d->count() > 0) {
        $data = [];
        foreach ($d->get() as $key => $row) {
          $data[] = ["id"=>str_pad($row->id,5,0,STR_PAD_LEFT),"id_unformat"=>$row->id,"nama_layanan"=>date("d-m-Y",strtotime($row->dibuat)),"data"=>$row->gerai_order_details];
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
      // return $data;
      $layanan = $data["gerai_layanan_id"];
      $d = [];
      foreach ($layanan as $key => $value) {
        $d[] = ["qty"=>$data["qty_".$value],"gerai_layanan_id"=>$value];
        unset($data["qty_".$value]);
      }
      unset($data["gerai_layanan_id"]);
      // return $data;
      // $data["totalharga"] = 0;
      $lat = $data["cLat"];
      $lng = $data["cLng"];
      $pemilik_id = $data["pemilik_id"];
      $c = Pengguna::where(["id_pengguna"=>$pemilik_id]);
      if ($c->count() > 0) {
        $row = $c->first();
        $latP = $row->lat;
        $lngP = $row->lng;
        $km = $this->_distance($lat,$lng,$latP,$lngP,"km");
        return $km;
        if ($km <= 25) {
          // $ps = [];
          // $p[] = ["tgl"=>date("d-m-Y"),"status"=>"Order Dibuat"];
          // $data["progress"] = "test";
          // return $data;
          $a = GeraiOrder::create($data);
          if ($a) {
            $dt = [];
            foreach ($d as $key => $value) {
              $dt[] = ["qty"=>$value["qty"],"gerai_layanan_id"=>$value["gerai_layanan_id"],"gerai_order_id"=>$a->id];
            }
            $detail = GeraiOrderDetail::insert($dt);
            if ($detail) {
              GeraiOrder::where(["id"=>$a->id])->update(["progress"=>json_encode([["tgl"=>date("d-m-Y"),"status"=>"Order Dibuat"]])]);
              return ["status"=>1];
            }else {
              GeraiOrder::find($a->id)->delete();
              return ["status"=>0];
            }
          }else {
            return ["status"=>0,"msg"=>"Order Gagal Di Lakukan"];
          }
        }else {
          return response()->json(["status"=>0,"msg"=>"Maksimal Jarak Adalah 25 KM"]);
        }
        return $data;
      }else {
        return response()->json(["status"=>0,"msg"=>"Data Gerai Tidak Ditemukan"]);
      }
    }
    public function pesanan($id = null)
    {
      if ($id == null) {
        $c = GeraiOrder::all();
        foreach ($c as $key => &$value) {
          $value->gerai_driver;
          $value->gerai_layanan;
          $value->pengguna;
          $value->gerai_driver_antar;
          $value->gerai_driver_jemput;
          $value->id_formatted = str_pad($value->id,5,0,STR_PAD_LEFT);
          $value->order = $value->status_format($value->status_order);
          foreach ($value->gerai_order_details as $k => $v) {
            $v->gerai_layanan;
          }
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
      $client = new \GuzzleHttp\Client();
      $res = $client->request('GET', 'https://maps.googleapis.com/maps/api/distancematrix/json?units='.$unit.'&origins='.$lat1.','.$lon1.'&destinations='.$lat2.','.$lon2.'&key=AIzaSyD1cM44pjtWnEej7CgCeCVtYx5D70ImTdQ');
      $res = json_decode($res->getBody());
      if (isset($res->rows[0]->elements[0]->distance->value)) {
        return $res->rows[0]->elements[0]->distance->value;
      }else {
        return false;
      }
    }
    public function terima(Request $req)
    {
      $data = $req->all();
      $id = $data["id"];
      unset($data["id"]);
      $cek = GeraiOrder::where("id",$id);
      if ($cek->count() > 0) {
        $row = $cek->first();
        $sLat = $row->pengguna->lat;
        $sLng = $row->pengguna->lng;
        if ($row->dijemput == 1) {
          $cLat = $cek->first()->cLat_antar;
          $cLng = $cek->first()->cLng_antar;
          $harga = 0;
          $list_layanan = $cek->first()->gerai_order_details;
          foreach ($list_layanan as $key => $value) {
            $harga = $harga + ($value->gerai_layanan->harga*$value->qty);
          }
          $km = $this->_distance($cLat,$cLng,$sLat,$sLng,"km");
          $data["dLat_antar"] = $sLat;
          $data["dLng_antar"] = $sLng;
          $data["gerai_driver_id_antar"] = $data["gerai_driver_id"];
          unset($data["dLat"]);
          unset($data["dLng"]);
          unset($data["gerai_driver_id"]);
          $data["jarak_antar"] = round($km);
          $data["totalharga"] = $harga;
          $data["ongkir_antar"] = ($data["jarak_antar"]*5000);
          $data["status_order"] = 5;
          $cek->update($data);
          return response()->json(["status"=>1,"data"=>$data]);
        }else {
          $cLat = $cek->first()->cLat;
          $cLng = $cek->first()->cLng;
          $harga = 0;
          $list_layanan = $cek->first()->gerai_order_details;
          foreach ($list_layanan as $key => $value) {
            $harga = $harga + ($value->gerai_layanan->harga*$value->qty);
          }
          $km = $this->_distance($cLat,$cLng,$sLat,$sLng,"km");
          $data["dLat"] = $sLat;
          $data["dLng"] = $sLng;
          $data["jarak"] = round($km);
          $data["ongkir_jemput"] = ($data["jarak"]*5000);
          $data["totalharga"] = $harga;
          $data["status_order"] = 1;
          $cek->update($data);
          return response()->json(["status"=>1,"data"=>$data]);
        }
      }else {
        return response()->json(["status"=>0]);
      }
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
        foreach ($v->gerai_order_details as $ks => $vs) {
          $vs->gerai_layanan;
        }
        $v->list_layanan = $v->gerai_order_details;
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
      $s = "";
      foreach ($data->gerai_order_details as $key => $value) {
        $s = $s."<p>".($key+1)." - ".$value->gerai_layanan->nama." x ".$value->qty."</p>";
      }
      $data->list_layanan = $s;
      foreach ($data->gerai_order_details as $key => $value) {
        $value->gerai_layanan;
      }
      $data->jarakTempuh = ($data->jarak == null)?"Belum Ditentukan":$data->jarak." KM";
      $data->dibuatFormat = date("Y-m-d",strtotime($data->dibuat));
      return $data;
    }
}
