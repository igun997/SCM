<html>
  <head>
    <title>Laporan Produk</title>
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
    <h2 align="center">LAPORAN DATA PRODUK</h2>
    <h5 align="center">PERIODE : {{date("d-m-Y",strtotime($req["dari"]))}} - {{date("d-m-Y",strtotime($req["sampai"]))}}</h5>
    <table class='table_po'>
      <tr style="font-weight:bold">
        <td>No</td>
        <td>Kode Produk</td>
        <td>Nama</td>
        <td>Stok</td>
        <td>Stok Minimum</td>
        <td>Harga Produksi</td>
        <td>Harga Distribusi</td>
        <td>Total Masuk</td>
        <td>Total Keluar</td>
        <td>Total Keluar (Hilang)</td>
        <td>Tanggal Dibuat</td>
      </tr>
      @foreach($data as $key => $value)
      <tr>
        <td>{{($key+1)}}</td>
        <td>{{$value->id_produk}}</td>
        <td>{{$value->nama_produk}}</td>
        <td>{{number_format($value->stok)}} {{$value->master_satuan->nama_satuan}}</td>
        <td>{{number_format($value->stok_minimum)}} {{$value->master_satuan->nama_satuan}}</td>
        <td>Rp. {{number_format($value->harga_produksi)}}</td>
        <td>Rp. {{number_format($value->harga_distribusi)}}</td>
        <td>{{number_format($value->total_masuk($value->id_produk,date("d-m-Y",strtotime($req["dari"])),date("Y-m-d",strtotime($req["sampai"]))))}}</td>
        <td>{{number_format($value->total_keluar($value->id_produk,date("d-m-Y",strtotime($req["dari"])),date("Y-m-d",strtotime($req["sampai"]))))}}</td>
        <td>{{number_format($value->total_keluar_hilang($value->id_produk,date("d-m-Y",strtotime($req["dari"])),date("Y-m-d",strtotime($req["sampai"]))))}}</td>
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
