<!DOCTYPE html>
<html>
  <head>
    <title>Laporan Bahan Baku</title>
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
    <h2 align="center">LAPORAN DATA BAHAN BAKU</h2>
    <h5 align="center">PERIODE : {{date("d-m-Y",strtotime($req["dari"]))}} - {{date("d-m-Y",strtotime($req["sampai"]))}}</h5>
    <table class='table_po'>
      <tr style="font-weight:bold">
        <th>No</th>
        <th>Kode Bahan Baku</th>
        <th>Nama Bahan Baku</th>
        <th>Stok</th>
        <th>Stok Minimum</th>
        <th>Harga</th>
        <th>Total Masuk</th>
        <th>Total Keluar</th>
        <th>Total Keluar (Hilang)</th>
        <th>Tanggal Dibuat</th>
      </tr>
      @foreach($data as $key => $value)
      <tr>
        <td>{{($key+1)}}</td>
        <td>{{$value->id_bb}}</td>
        <td>{{$value->nama}}</td>
        <td>{{number_format($value->stok)}} {{$value->master_satuan->nama_satuan}}</td>
        <td>{{number_format($value->stok_minimum)}} {{$value->master_satuan->nama_satuan}}</td>
        <td>Rp. {{number_format($value->harga)}}</td>
        <td>{{number_format($value->total_masuk($value->id_bb,date("d-m-Y",strtotime($req["dari"])),date("Y-m-d",strtotime($req["sampai"]))))}}</td>
        <td>{{number_format($value->total_keluar($value->id_bb,date("d-m-Y",strtotime($req["dari"])),date("Y-m-d",strtotime($req["sampai"]))))}}</td>
        <td>{{number_format($value->total_keluar_hilang($value->id_bb,date("d-m-Y",strtotime($req["dari"])),date("Y-m-d",strtotime($req["sampai"]))))}}</td>
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
        <td align="center">Bandung, 29 September 2020</td>
      </tr>
       <tr>
        <td align="center">Bag. Gudang</td>
      </tr>
       <tr>
        <td align="center" height="100px">
          <center>
            <img src="{{(\App\Models\Pengguna::where(['level'=>"gudang"])->first()->ttd)}}" style="width:200px;height: auto;" alt="">
          </center>
        </td>
      </tr>
       <tr>
        <td align="center">{{session()->get("nama")}}</td>
      </tr>
    </table>

  </body>
</html>
