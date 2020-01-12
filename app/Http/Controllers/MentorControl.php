<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use \App\Models\{MasterBb,MasterKomposisi,MasterPelanggan,MasterProduk,MasterSatuan,MasterSuplier,MasterTransportasi,Pemesanan,PemesananDetail,PengadaanBb,PengadaanBbDetail,Pengaturan,Pengguna,Pengiriman,PengirimanDetail,Produksi,ProduksiDetail,WncGerai,WncOrder,WncPelanggan,WncProduk,PengadaanBbRetur,PengadaanBbReturDetail,PengadaanProduk,PengadaanProdukDetail,PengadaanProdukRetur,PengadaanProdukReturDetail,GeraiPelanggan,GeraiOrder,GeraiLayanan,GeraiKontrol,GeraiDriver,GeraiBarangDetail,GeraiBarang,GeraiBagihasil};
use PDF;
use \Carbon\Carbon;
use \Carbon\CarbonPeriod;
class MentorControl extends Controller
{
  public function index()
  {
    return view("franchise.mentor.home")->with(["title"=>"Dashboard Mentor"]);
  }

  public function chart($year)
  {
    $data = [];
    $all = Pengguna::where(["level"=>"gerai"])->get();
    $pengguna = [];
    $pengguna_nama = [];
    foreach ($all as $key => $value) {
      $pengguna[] =  $value->id_pengguna;
      $pengguna_nama[$value->id_pengguna] = $value->nama_pengguna;
    }
    $a = array_unique($pengguna);
    foreach ($a as $key => $value) {
      $select = GeraiOrder::where(["status_order"=>6,"pemilik_id"=>$value])->whereBetween("dibuat",[$year."-01-01",$year."-12-31"]);
      $trx = 0;
      $kotor = 0;

      $periode = [];
      $stack = [];
      $period = CarbonPeriod::create($year.'-01-01', $year.'-12-31');
      foreach ($period as $dt) {
          $periode[] =  $dt->format("Y-m");
          $stack[$dt->format("Y-m")] = 0;
      }
      foreach ($periode as $k => $v) {
        foreach ($select->get() as $y => $e) {
          if (date("Y-m",strtotime($e->dibuat)) == $v) {
            $stack[$v] = $stack[$v] + $e->totalharga;

          }
        }
      }
      $color = random_color();
      $nornalis = [];
      foreach ($stack as $ky => $ue) {
        $nornalis[] = $ue;
      }
      $data[] = ["label"=>$pengguna_nama[$value],"backgroundColor"=>"#".$color,"borderColor"=>"#".$color,"borderWidth"=>1,"data"=>$nornalis];
    }

    return response()->json($data);

  }
  public function bagihasil_print($id)
  {
      $invoice = GeraiBagihasil::where(["id"=>$id])->first();
      $pemilik = Pengguna::where(["id_pengguna"=>$invoice->pemilik_id])->first();
      // return response()->json(["d"=>$pemilik]);
      $pdf = PDF::loadView('invoice.bagi', ["invoice"=>$invoice,"pemilik"=>$pemilik,"title"=>"KWITANSI BAGI HASIL"])->setPaper('a4', 'landscape');
      return $pdf->stream();
  }
  public function franchise_setlokasiaksi(Request $req,$id)
  {
      $c = Pengguna::where(["pengguna_id"=>session()->get("id_pengguna"),"id_pengguna"=>$id]);
      if ($c->count() > 0) {
        $c->update($req->all());
        return response()->json(["status"=>1]);
      }else {
        return response()->json(["status"=>0]);
      }
  }
  public function franchise_setlokasi($id)
  {
    $c = Pengguna::where(["pengguna_id"=>session()->get("id_pengguna"),"id_pengguna"=>$id]);
    if ($c->count() > 0) {
      $d = $c->first();
      return view("franchise.mentor.franchise_setlokasi")->with(["title"=>"Set Lokasi Gerai","data"=>$d]);
    }else {
      return back()->withErrors(["msg"=>"Data Tidak Ditemukan"]);
    }
  }
  public function franchise_driver($id)
  {
    $c = Pengguna::where(["pengguna_id"=>session()->get("id_pengguna"),"id_pengguna"=>$id]);
    if ($c->count() > 0) {
      $d = $c->first();
      return view("franchise.mentor.franchise_driver")->with(["title"=>"Manajemen Driver","data"=>$d]);
    }else {
      return back()->withErrors(["msg"=>"Data Tidak Ditemukan"]);
    }
  }
  public function franchise_driveradd(Request $req,$id)
  {
    if ($req->has("nama")) {
      $d = $req->all();
      $d["pemilik_id"] = $id;
      $ins = GeraiDriver::create($d);
      return redirect(route("mentor.franchise.driver",$id));
    }
    return view("franchise.mentor.franchise_driverform")->with(["title"=>"Tambah Driver"]);
  }
  public function bagihasil()
  {
    $frs = Pengguna::where(["pengguna_id"=>session()->get("id_pengguna")])->get();
    return view("franchise.mentor.bagihasil")->with(["title"=>"Bagi Hasil","frs"=>$frs]);
  }
  public function _bagihasil($id)
  {
    $patokan = GeraiBagihasil::where(["pemilik_id"=>$id])->orderBy("dibuat","desc");
    if ($patokan->count() > 0) {
      $setTgl = $patokan->first()->dibuat;
      $tglSekrng = date("Y-m-d");
      $carbon = new Carbon($setTgl);
      $now = Carbon::now();
      $totalHari = $carbon->diff($now)->days;
      if ($totalHari >= 30) {
        $a = GeraiOrder::where(["status_order"=>6,"pemilik_id"=>$id])->whereBetween("dibuat",[date($setTgl),date($tglSekrng)])->get();
        $total = 0;
        foreach ($a as $key => $value) {
          $total = $total+$value->totalharga;
        }
        $persentase = $total;
        $pemilik = $persentase*0.6;
        $pusat = $persentase*0.4;
        $now = date("d-m-Y",strtotime($tglSekrng));
        $dec1 = date("d-m-Y",strtotime($setTgl));
        $tempData = ["status"=>true,"data"=>["totalkotor"=>$persentase,"totalpesanan"=>count($a),"pemilik"=>$pemilik,"pusat"=>$pusat,"periode"=>date("m/Y",strtotime($dec1))." - ".date("m/Y",strtotime($now)),"mentor_id"=>session()->get("id_pengguna"),"pemilik_id"=>$id]];
        return $tempData;
      }else {
        return ["status"=>false,"msg"=>"Bagi Minimal Dalam 30 Hari atau Lebih"];
      }
    }else {
      $a = GeraiOrder::where(["status_order"=>6,"pemilik_id"=>$id])->get();
      $total = 0;
      foreach ($a as $key => $value) {
        $total = $total+$value->totalharga;
      }
      $persentase = $total;
      $pemilik = $persentase*0.6;
      $pusat = $persentase*0.4;
      $now = date("d-m-Y");
      $dec1 = date("d-m-Y",strtotime("-1 month",strtotime($now)));
    $tempData = ["status"=>true,"data"=>["totalkotor"=>$persentase,"totalpesanan"=>count($a),"pemilik"=>$pemilik,"pusat"=>$pusat,"periode"=>date("m/Y",strtotime($dec1))." - ".date("m/Y",strtotime($now)),"mentor_id"=>session()->get("id_pengguna"),"pemilik_id"=>$id]];
      return $tempData;
    }
  }
  public function bagihasil_list(Request $req,$id)
  {
    $a =  $this->_bagihasil($id);
    if ($req->has("periode")) {
      $data = $a["data"];
      $ins = GeraiBagihasil::create($data);
      return back();
    }
    $cek = GeraiBagihasil::where(["pemilik_id"=>$id])->get();
    $person = Pengguna::where(["id_pengguna"=>$id])->first();
    $mentor = Pengguna::where(["id_pengguna"=>session()->get("id_pengguna")])->first();
    return view("franchise.mentor.bagihasil_list")->with(["title"=>"Bagi Hasil","data"=>$cek,"person"=>$person,"mentor"=>$mentor,"form_data"=>$a]);
  }
  public function franchise_driveredit(Request $req,$id)
  {
    $cek = GeraiDriver::where(["id"=>$id]);
    if ($cek->count() > 0) {
      if ($req->has("nama")) {
        $d = $req->all();
        unset($d["_token"]);
        // return $d;
        $ins = GeraiDriver::where(["id"=>$id])->update($d);
        return redirect(route("mentor.franchise.driver",$cek->first()->pemilik_id));
      }
      return view("franchise.mentor.franchise_driverform")->with(["title"=>"Ubah Driver","data"=>$cek->first()]);
    }else {
      return back();
    }
  }
  public function controlling_audit($id)
  {
    $trx = GeraiKontrol::where(["pemilik_id"=>$id]);
    $data = $trx->get();
    $gerailist = Pengguna::where(["pengguna_id"=>session()->get("id_pengguna"),"id_pengguna"=>$id])->get();
    $c = ["title"=>"Audit Gerai","data"=>$data,"gerai"=>$gerailist];
    return view("franchise.mentor.controlling_audit")->with($c);
  }
  public function kontrol($id)
  {
    $up = GeraiKontrol::where(["id"=>$id])->update(["status_kontrol"=>1]);
    return back();
  }
  public function controlling_auditpost(Request $req,$id)
  {
    $data = $req->all();
    if ($data["status_evaluasi"] == "") {
      unset($data["status_evaluasi"]);
    }
    $data["mentor_id"] = session()->get("id_pengguna");
    $data["pemilik_id"] = $id;
    $ins = GeraiKontrol::create($data);
    return back();
  }
  public function laporankeuangan($id)
  {
    $d = GeraiOrder::where(["pemilik_id"=>$id,"status_order"=>6]);
    if ($d->count() > 0) {
      $data =$d->get();
      return view("franchise.gerai.keuangan")->with(["title"=>"Laporan Keuangan","data"=>$data]);
    }else {
      return back();
    }
  }
  public function laporanbarang($id)
  {
    $d = GeraiBarang::where(["pemilik_id"=>$id]);
    $data = $d->get();
    $c = ["title"=>"Laporan Data Barang","data"=>$data];
    return view("franchise.gerai.laporanbarang")->with($c);
  }
  public function laporanpesanan($id)
  {
    $d = GeraiOrder::where(["pemilik_id"=>$id])->get();
    $data = ["title"=>"Laporan Pesanan","data"=>$d];
    return view("franchise.gerai.lappesanan")->with($data);
  }
  public function controlling()
  {
    $frs = Pengguna::where(["pengguna_id"=>session()->get("id_pengguna")])->get();
    return view("franchise.mentor.controlling")->with(["title"=>"Data Controlling","frs"=>$frs]);
  }
  public function franchise_layanan($id)
  {
    $c = Pengguna::where(["pengguna_id"=>session()->get("id_pengguna"),"id_pengguna"=>$id]);
    if ($c->count() > 0) {
      $d = $c->first();
      return view("franchise.mentor.franchise_layanan")->with(["title"=>"Manajemen Layanan MITRA","data"=>$d]);
    }else {
      return back()->withErrors(["msg"=>"Data Tidak Ditemukan"]);
    }
  }
  public function franchise_layananadd(Request $req,$id)
  {
    if ($req->has("nama")) {
      $req->validate([
        "harga"=>"required|numeric",
        "nama"=>"required",
      ]);
      $d = $req->all();
      $d["pemilik_id"] = $id;
      $ins = GeraiLayanan::create($d);
      return redirect(route("mentor.franchise.layanan",$id));
    }
    return view("franchise.mentor.franchise_layananform")->with(["title"=>"Tambah Layanan"]);
  }
  public function franchise_layananedit(Request $req,$id,$ids)
  {
    if ($req->has("nama")) {
      $req->validate([
        "harga"=>"required|numeric",
        "nama"=>"required",
      ]);
      $d = $req->all();
      $d["pemilik_id"] = $id;
      unset($d["_token"]);
      $ins = GeraiLayanan::where(["id"=>$ids])->update($d);
      return redirect(route("mentor.franchise.layanan",$id));
    }
    $data = GeraiLayanan::where(["id"=>$ids]);
    if ($data->count() > 0) {
      return view("franchise.mentor.franchise_layananform")->with(["title"=>"Edit Layanan","data"=>$data->first()]);
    }else {
      return back();
    }
  }
  public function franchise()
  {
    $frs = Pengguna::where(["pengguna_id"=>session()->get("id_pengguna")])->get();
    return view("franchise.mentor.franchise")->with(["title"=>"Data Franchise","frs"=>$frs]);
  }
  public function franchise_barang($id)
  {
    $c = Pengguna::where(["pengguna_id"=>session()->get("id_pengguna"),"id_pengguna"=>$id]);
    if ($c->count() > 0) {
      $d = $c->first();
      return view("franchise.mentor.franchise_barang")->with(["title"=>"Manajemen Barang MITRA","data"=>$d]);
    }else {
      return back()->withErrors(["msg"=>"Data Tidak Ditemukan"]);
    }
  }
  public function franchise_barangmasuk(Request $req,$id = null)
  {
    $rs = GeraiBarang::where(["id"=>$id])->first();
    $row = MasterProduk::where(["id_produk"=>$rs->id_produk]);
    if (isset($_POST["qty"])) {
      $data = $req->all();
      $rsa = $row->first();
      if ($rsa->stok < $req->qty) {
        return back();
      }
      $c = ($rsa->stok - $req->qty);
      $row->update(["stok"=>$c]);
      $data["gerai_barang_id"] = $id;
      $data["jenis"] = "masuk";
      $ins = GeraiBarangDetail::create($data);
      return back();
    }
    $data = GeraiBarang::where(["id"=>$id])->first();
    return view("franchise.mentor.franchise_barangmasuk")->with(["title"=>"Tambah Barang Masuk","data"=>$data,"recent_stok"=>$row->first()->stok]);
  }
  public function franchise_barangadd(Request $req,$id = null)
  {

    $listBarang = MasterProduk::where("stok",">=","stok_minimum")->get();
    if (isset($_POST["id_produk"])) {
      $id_p = $req->id_produk;
      $r = MasterProduk::where(["id_produk"=>$id_p])->first();
      $data["nama_barang"] = $r->nama_produk;
      $data["id_produk"] = $id_p;
      $data["deskripsi"] = $r->deskripsi;
      $data["pemilik_id"] = $id;
      $data["mentor_id"] = session()->get("id_pengguna");
      $ins = GeraiBarang::create($data);
      return redirect(route("mentor.franchise.barang",$id));
    }
    return view("franchise.mentor.franchise_barangform")->with(["title"=>"Tambah Barang","list"=>$listBarang]);
  }
}
