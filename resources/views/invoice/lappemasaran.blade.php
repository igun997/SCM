<!DOCTYPE html>
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
    <h2 align="center">LAPORAN DATA PEMASARAN</h2>
    <h5 align="center">PERIODE : {{date("d-m-Y",strtotime($req["dari"]))}} - {{date("d-m-Y",strtotime($req["sampai"]))}}</h5>
    <table class='table_po'>
      <tr style="font-weight:bold">
        <td>No</td>
        <td>Kode Pemasaran</td>
        <td>Nama Pelanggan</td>
        <td>Status</td>
        <td>Status Pembayaran</td>
        <td>PPN</td>
        <td>Total Produk</td>
        <td>Total Harga</td>
        <td>Total + Pajak</td>
        <td>Tanggal Dibuat</td>
      </tr>
      @foreach($data->get() as $key => $value)
      <tr>
        <td>{{($key+1)}}</td>
        <td>{{$value->id_pemesanan}}</td>
        <td>{{ucfirst($value->master_pelanggan->nama_pelanggan)}}</td>
        <td>{{status_pesanan($value->status_pesanan)}}</td>
        <td>{{status_pembayaran($value->status_pembayaran)}}</td>
        <td>Rp. {{number_format(($value->pajak*($value->totalharga($value->id_pemesanan))))}}</td>
        <td>{{number_format($value->pemesanan__details->count())}}</td>
        <td>Rp. {{number_format((($value->totalharga($value->id_pemesanan))))}}</td>
        <td>Rp. {{number_format(((($value->pajak*($value->totalharga($value->id_pemesanan))))+($value->totalharga($value->id_pemesanan))))}}</td>
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
