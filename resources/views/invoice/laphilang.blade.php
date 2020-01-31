<html>
  <head>
    <title>LAPORAN DATA KEHILANGAN STOK</title>
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
    <h2 align="center">LAPORAN DATA KEHILANGAN STOK</h2>
    <h5 align="center">PERIODE : {{date("d-m-Y",strtotime($req["dari"]))}} - {{date("d-m-Y",strtotime($req["sampai"]))}}</h5>
    <table class='table_po'>
      <tr style="font-weight:bold">
        <td>No</td>
        <td>Kode Kehilangan</td>
        <td>Nama Produk / Bahan Baku</td>
        <td>Jumlah Hilang</td>
        <td>Estimasi Kerugian</td>
        <td>Keterangan</td>
        <td>Tanggal Dibuat</td>
      </tr>
      @foreach($data as $key => $value)
      <tr>
        <td>{{($key+1)}}</td>
        <td>{{$value->kode_penyusutan}}</td>
        <td>{{(($value->id_bb == null)?$value->master_produk->nama_produk:$value->master_bb->nama)}}</td>
        <td>{{$value->total_barang}} {{(($value->id_bb == null)?$value->master_produk->master_satuan->nama_satuan:$value->master_bb->master_satuan->nama_satuan)}}</td>
        <td>Rp. {{number_format($value->estimasi_kerugian)}}</td>
        <td>{{($value->ket)}}</td>
        <td>{{($value->tgl_register->format("d/m/Y"))}}</td>
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
