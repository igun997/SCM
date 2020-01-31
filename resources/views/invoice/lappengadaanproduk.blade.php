
<!DOCTYPE html>
<html>
  <head>
    <title>Laporan Pengadaan</title>
    <style>
      td {
        padding:3px 3px 3px;
      }
      .table_po {
        padding:3px 3px 3px;
        border-collapse: collapse;
        border:1px solid;
        width:100%
      }
      .table_po tr td{
        border:1px solid;
        text-align:center;
      }
    </style>
  </head>
  <body>
    @include("invoice.head")
    <h2 align="center">LAPORAN DATA PENGADAAN PRODUK</h2>
    <h5 align="center">PERIODE : {{date("d-m-Y",strtotime($req["dari"]))}} - {{date("d-m-Y",strtotime($req["sampai"]))}}</h5>
    <table class='table_po'>
      <tr style="font-weight:bold">
        <td>No</td>
        <td>Kode Pengadaan</td>
        <td>Suplier</td>
        <td>Status</td>
        <td>Konf. Direktur</td>
        <td>Konf. Gudang</td>
        <td>Biaya Pengadaan</td>
        <td>Tanggal Diterima</td>
        <td>Tanggal Dibuat</td>
      </tr>
      @foreach($data->get() as $key => $value)
      <tr>
        <td>{{($key+1)}}</td>
        <td>{{$value->id_pengadaan_produk}}</td>
        <td>{{$value->master_suplier->nama_suplier}}</td>
        <td>{{status_pengadaan($value->status_pengadaan)}}</td>
        <td>{{konfirmasi($value->konfirmasi_direktur)}}</td>
        <td>{{konfirmasi($value->konfirmasi_gudang)}}</td>
        <td>Rp. {{number_format(\App\Models\PengadaanProdukDetail::where(["id_pengadaan_produk"=>$value->id_pengadaan_produk])->select(\DB::raw("SUM(jumlah*harga) as total"))->first()->total)}}</td>
        <td>{{(($value->tgl_diterima == null)?"-":date("d-m-Y",strtotime($value->tgl_diterima)))}}</td>
        <td>{{(($value->tgl_register == null)?"-":date("d-m-Y",strtotime($value->tgl_register)))}}</td>
      </tr>
      @endforeach
    </table>
    <br>
    <br>
    <table width="200px" style="float:left;">
      <tr>
        <td align="center"></td>
      </tr>
       <tr>
        <td align="center">Direktur</td>
      </tr>
       <tr>
        <td align="center" height="100px">
          <center>
            <img src="{{(\App\Models\Pengguna::where(['level'=>"direktur"])->first()->ttd)}}" style="width:200px;height: auto;" alt="">
          </center>
        </td>
      </tr>
       <tr>
        <td align="center">Jatra Novianto</td>
      </tr>
    </table>
    <table width="200px" style="float:right">
      <tr>
        <td align="center">Bandung, {{date("d-m-Y")}}</td>
      </tr>
       <tr>
        <td align="center">Bag. Pengadaan</td>
      </tr>
       <tr>
        <td align="center" height="100px">
          <center>
            <img src="{{(\App\Models\Pengguna::where(['level'=>"pengadaan"])->first()->ttd)}}" style="width:200px;height: auto;" alt="">
          </center>
        </td>
      </tr>
       <tr>
        <td align="center">{{session()->get("nama")}}</td>
      </tr>
    </table>

  </body>
</html>
