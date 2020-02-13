<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use \App\Models\{MasterBb,MasterKomposisi,MasterPelanggan,MasterProduk,MasterSatuan,MasterSuplier,MasterTransportasi,Pemesanan,PemesananDetail,PengadaanBb,PengadaanBbDetail,Pengaturan,Pengguna,Pengiriman,PengirimanDetail,Produksi,ProduksiDetail,WncGerai,WncOrder,WncPelanggan,WncProduk,PengadaanBbRetur,PengadaanBbReturDetail,PengadaanProduk,PengadaanProdukDetail,PengadaanProdukRetur,PengadaanProdukReturDetail,PeramalanProduksi,Penyusutan,Po,PosBarang,PosRegister,PosTransaksi,PosTransaksiDetail,Permintaan,PermintaanDetail};
use PDF;
use \App\Events\SCMNotif;
use \Carbon\CarbonPeriod;
class PosAPI extends Controller
{
    public function __construct()
    {
      $this->middleware('jwt.verify');
    }
    public function checkValidity()
    {
      return ["status"=>"Valid"];
    }
    public function me()
    {
      return response()->json(Auth::guard()->user());
    }
}
