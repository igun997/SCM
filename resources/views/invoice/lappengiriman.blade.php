<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pengiriman</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
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
        <h1 align="center">Laporan Pengiriman</h1>
        <h3  align="center">
          Periode {{date("d-m-Y",strtotime($req["dari"]))}} - {{date("d-m-Y",strtotime($req["sampai"]))}}
        </h3>
        <br>
        <table>
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Pengiriman</th>
                <th>Tgl. Pengiriman</th>
                <th>Tgl. Tiba</th>
                <th>No Polisi</th>
                <th>Nama Pengemudi</th>
                <th>No Kontak</th>
                <th>Total Muatan</th>
                <th>Status</th>
                <th>Tanggal Dibuat</th>
              </tr>
            </thead>
            <tbody>
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
            </tbody>
            <tfoot>
              <tr>
                <th colspan="4" align="center">Ketua Divisi WENOW</th>
                <td colspan="2"></td>
                <th colspan="4" align="center">Bag. Pemasaran</th>
              </tr>
              <tr>
                <td colspan="4" style="height:100px">

                </td>
                <td colspan="2"></td>
                <td colspan="4"  style="height:100px">

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
