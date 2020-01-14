<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Bahan Baku</title>
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
        <h1 align="center">Laporan Bahan Baku</h1>
        <h3  align="center">
          Periode {{date("d-m-Y",strtotime($req["dari"]))}} - {{date("d-m-Y",strtotime($req["sampai"]))}}
        </h3>
        <br>
        <table>
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Bahan Baku</th>
                <th>Nama Bahan Baku</th>
                <th>Stok</th>
                <th>Stok Minimum</th>
                <th>Harga</th>
                <th>Total Masuk</th>
                <th>Total Keluar</th>
                <th>Tanggal Dibuat</th>
              </tr>
            </thead>
            <tbody>
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
                <td>{{(($value->tgl_register == null)?"-":date("d-m-Y",strtotime($value->tgl_register)))}}</td>
              </tr>
              @endforeach
            </tbody>
            <tfoot>
              <tr>
                <th colspan="3" align="center">Ketua Divisi WENOW</th>
                <td colspan="3"></td>
                <th colspan="3" align="center">Bag. Gudang</th>
              </tr>
              <tr>
                <td colspan="3" style="height:400px">

                </td>
                <td colspan="3"></td>
                <td colspan="3"  style="height:400px">

                </td>
              </tr>
              <tr>
                <th colspan="3" align="center">Jatra Novianto</th>
                <td colspan="3"></td>
                <th colspan="3" align="center">{{session()->get("nama")}}</th>
              </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>
