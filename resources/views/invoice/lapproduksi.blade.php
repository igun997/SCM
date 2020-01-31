
<html>
  <head>
    <title>Laporan Produksi</title>
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
    <h2 align="center">LAPORAN DATA PRODUKSI</h2>
    <h5 align="center">PERIODE : {{date("d-m-Y",strtotime($req["dari"]))}} - {{date("d-m-Y",strtotime($req["sampai"]))}}</h5>
    <table class='table_po'>
      <tr style="font-weight:bold">
        <td>No</td>
        <td>Kode Produksi</td>
        <td>Jenis</td>
        <td>Status</td>
        <td>Konf. Direktur</td>
        <td>Konf. Gudang</td>
        <td>Biaya Produksi</td>
        <td>Tanggal Diterima</td>
        <td>Tanggal Selesai</td>
        <td>Tanggal Dibuat</td>
      </tr>

      @foreach($data->get() as $key => $value)
      <tr>
        <td>{{($key+1)}}</td>
        <td>{{$value->id_produksi}}</td>
        <td>{{ucfirst($value->jenis)}}</td>
        <td>{{status_produksi($value->status_produksi)}}</td>
        <td>{{konfirmasi($value->konfirmasi_direktur)}}</td>
        <td>{{konfirmasi($value->konfirmasi_gudang)}}</td>
        <td>Rp. {{number_format($value->biaya_produksi($value->id_produksi))}}</td>
        <td>{{(($value->tgl_kon_gudang == null)?"-":date("d-m-Y",strtotime($value->tgl_kon_gudang)))}}</td>
        <td>{{(($value->tgl_selesai_produksi == null)?"-":date("d-m-Y",strtotime($value->tgl_selesai_produksi)))}}</td>
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
        <td align="center">Bag. Produksi</td>
      </tr>
       <tr>
        <td align="center" height="100px">
          <center>
            <img src="{{(\App\Models\Pengguna::where(['level'=>"produksi"])->first()->ttd)}}" style="width:200px;height: auto;" alt="">
          </center>
        </td>
      </tr>
       <tr>
        <td align="center">{{session()->get("nama")}}</td>
      </tr>
    </table>

  </body>
</html>
