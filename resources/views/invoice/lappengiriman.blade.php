<!DOCTYPE html>
<html>
  <head>
    <title>Laporan Pengiriman</title>
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
    <h2 align="center">LAPORAN DATA PENGIRIMAN</h2>
    <h5 align="center">PERIODE : {{date("d-m-Y",strtotime($req["dari"]))}} - {{date("d-m-Y",strtotime($req["sampai"]))}}</h5>
    <table class='table_po'>
      <tr style="font-weight:bold">
        <td>No</td>
        <td>Kode Pengiriman</td>
        <td>Tgl. Pengiriman</td>
        <td>Tgl. Tiba</td>
        <td>No Polisi</td>
        <td>Nama Pengemudi</td>
        <td>No Kontak</td>
        <td>Total Muatan</td>
        <td>Status</td>
        <td>Tanggal Dibuat</td>
      </tr>
      @foreach($data->get() as $key => $value)
      <tr>
        <td>{{($key+1)}}</td>
        <td>{{$value->id_pengiriman}}</td>
        <td>{{(($value->tgl_pengiriman == null)?"-":date("d-m-Y",strtotime($value->tgl_pengiriman)))}}</td>
        <td>{{(($value->tgl_kembali == null)?"-":date("d-m-Y",strtotime($value->tgl_kembali)))}}</td>
        <td>{{strtoupper($value->master_transportasi->no_polisi)}}</td>
        <td>{{$value->nama_pengemudi}}</td>
        <td>{{$value->kontak_pengemudi}}</td>
        <td>{{$value->pengiriman__details->count()}}</td>
        <td>{{status_pengiriman($value->status_pengiriman)}}</td>
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
        <td align="center">Bag. Pemasaran</td>
      </tr>
       <tr>
        <td align="center" height="100px">
          <center>
            <img src="{{(\App\Models\Pengguna::where(['level'=>"pemasaran"])->first()->ttd)}}" style="width:200px;height: auto;" alt="">
          </center>
        </td>
      </tr>
       <tr>
        <td align="center">{{session()->get("nama")}}</td>
      </tr>
    </table>

  </body>
</html>
