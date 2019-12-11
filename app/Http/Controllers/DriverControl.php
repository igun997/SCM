<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Models\{MasterBb,MasterKomposisi,MasterPelanggan,MasterProduk,MasterSatuan,MasterSuplier,MasterTransportasi,Pemesanan,PemesananDetail,PengadaanBb,PengadaanBbDetail,Pengaturan,Pengguna,Pengiriman,PengirimanDetail,Produksi,ProduksiDetail,WncGerai,WncOrder,WncPelanggan,WncProduk,PengadaanBbRetur,PengadaanBbReturDetail,PengadaanProduk,PengadaanProdukDetail,PengadaanProdukRetur,PengadaanProdukReturDetail,GeraiPelanggan,GeraiOrder,GeraiLayanan,GeraiKontrol,GeraiDriver,GeraiBarangDetail,GeraiBarang,GeraiBagihasil};

class DriverControl extends Controller
{
    public function index()
    {
      $order = GeraiDriver::where(["id"=>session()->get("id")])->first()->pemilik->gerai_orders([0,1],session()->get("id"));
      return view("franchise.driver.home")->with(["title"=>"Dashboard Driver","data"=>$order]);
    }
    public function selesai($id)
    {
      $cek = GeraiOrder::where("id",$id);
      if ($cek->count() > 0) {
        $cek->update(["status_order"=>2]);
      }
      return back();
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
    public function terima(Request $req,$id)
    {
      $data = $req->all();
      $cek = GeraiOrder::where("id",$id);
      if ($cek->count() > 0) {
        $cLat = $cek->first()->cLat;
        $cLng = $cek->first()->cLng;
        $qty = $cek->first()->qty;
        $harga = $cek->first()->gerai_layanan->harga;
        $km = $this->_distance($cLat,$cLng,$data["dLat"],$data["dLng"],"km");
        $data["jarak"] = round($km);
        $data["totalharga"] = ($qty*$harga)+($data["jarak"]*5000);
        $cek->update($data);
        return response()->json(["status"=>1,"data"=>$data]);
      }else {
        return response()->json(["status"=>0]);
      }
    }


}
