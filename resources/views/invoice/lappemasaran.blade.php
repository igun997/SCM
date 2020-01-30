<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pemasaran</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
    @page {
      margin-top: 0px;
      margin-bottom: 0px;
    }
        body{
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color:#333;
            text-align:left;
            font-size:13px;
            margin:0;
        }
        .container{
            margin:0 auto;
            margin-top:35px;
            padding:40px;
            width:auto;
            height:auto;
            background-color:#fff;
        }
        caption{
            font-size:28px;
            margin-bottom:15px;
        }
        table{
            border:1px solid #333;
            border-collapse:collapse;
            margin:0 auto;
            width:auto;
        }
        td, tr, th{
            padding:12px;
            border:1px solid #333;
            width:auto;
        }
        th{
            background-color: #f0f0f0;
        }
        h4, p{
            margin:0px;
        }
    </style>
</head>
<body>
    <div class="container">
        @include("invoice.head")
        <h1 align="center">Laporan Pemasaran</h1>
        <h3  align="center">
          Periode {{date("d-m-Y",strtotime($req["dari"]))}} - {{date("d-m-Y",strtotime($req["sampai"]))}}
        </h3>
        <br>
        <table>
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Pemasaran</th>
                <th>Nama Pelanggan</th>
                <th>Status</th>
                <th>Status Pembayaran</th>
                <th>PPN</th>
                <th>Total Produk</th>
                <th>Total Harga</th>
                <th>Total + Pajak</th>
                <th>Tanggal Dibuat</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data->get() as $key => $value)
              <tr>
                <td>{{($key+1)}}</td>
                <td>{{$value->id_pemesanan}}</td>
                <td>{{ucfirst($value->master_pelanggan->nama_pelanggan)}}</td>
                <td>{{status_pesanan($value->status_pesanan)}}</td>
                <td>{{konfirmasi($value->status_pembayaran)}}</td>
                <td>Rp. {{number_format(($value->pajak*($value->totalharga($value->id_pemesanan))))}}</td>
                <td>{{number_format($value->pemesanan__details->count())}}</td>
                <td>Rp. {{number_format((($value->totalharga($value->id_pemesanan))))}}</td>
                <td>Rp. {{number_format(((($value->pajak*($value->totalharga($value->id_pemesanan))))+($value->totalharga($value->id_pemesanan))))}}</td>
                <td>{{(($value->tgl_register == null)?"-":date("d-m-Y",strtotime($value->tgl_register)))}}</td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th colspan="3" align="center">Ketua Divisi WENOW</th>
                <td colspan="3"></td>
                <th colspan="4" align="center">Bag. Pemasaran</th>
              </tr>
              <tr>
                <td colspan="3" style="height:100px">
                  <center>
                    <img src="{{(\App\Models\Pengguna::where(['level'=>"direktur"])->first()->ttd)}}" style="width:200px;height: auto;" alt="">
                  </center>
                </td>
                <td colspan="3"></td>
                <td colspan="4"  style="height:100px">
                  <center>
                    <img src="{{(\App\Models\Pengguna::where(['level'=>"pemasaran"])->first()->ttd)}}" style="width:200px;height: auto;" alt="">
                  </center>
                </td>
              </tr>
              <tr>
                <th colspan="3" align="center">Jatra Novianto</th>
                <td colspan="3"></td>
                <th colspan="4" align="center">{{session()->get("nama")}}</th>
              </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>