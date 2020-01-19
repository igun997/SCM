<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Produksi</title>
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
        <h1 align="center">Laporan Produksi</h1>
        <h3  align="center">
          Periode {{date("d-m-Y",strtotime($req["dari"]))}} - {{date("d-m-Y",strtotime($req["sampai"]))}}
        </h3>
        <br>
        <table>
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Produksi</th>
                <th>Jenis</th>
                <th>Status</th>
                <th>Konf. Direktur</th>
                <th>Konf. Gudang</th>
                <th>Biaya Produksi</th>
                <th>Tanggal Diterima</th>
                <th>Tanggal Selesai</th>
                <th>Tanggal Dibuat</th>
              </tr>
            </thead>
            <tbody>
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
            </tbody>
            <tfoot>
              <tr>
                <th colspan="4" align="center">Ketua Divisi WENOW</th>
                <td colspan="2"></td>
                <th colspan="4" align="center">Bag. Produksi</th>
              </tr>
              <tr>
                <td colspan="4" style="height:100px">
                  <center>
                    <img src="{{(\App\Models\Pengguna::where(['level'=>"direktur"])->first()->ttd)}}" style="width:200px;height: auto;" alt="">
                  </center>
                </td>
                <td colspan="2"></td>
                <td colspan="4"  style="height:100px">
                  <center>
                    <img src="{{(\App\Models\Pengguna::where(['level'=>"produksi"])->first()->ttd)}}" style="width:200px;height: auto;" alt="">
                  </center>
                </td>
              </tr>
              <tr>
                <th colspan="4" align="center">Jatra Novianto</th>
                <td colspan="2"></td>
                <th colspan="4" align="center">{{session()->get("nama")}}</th>
              </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>
