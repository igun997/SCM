<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pengadaan Produk</title>
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
      <h1 align="center">Laporan Pengadaan Produk</h1>
      <h3  align="center">
        Periode {{date("d-m-Y",strtotime($req["dari"]))}} - {{date("d-m-Y",strtotime($req["sampai"]))}}
      </h3>
      <br>
        <table>
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Pengadaan</th>
                <th>Suplier</th>
                <th>Status</th>
                <th>Konf. Direktur</th>
                <th>Konf. Gudang</th>
                <th>Biaya Pengadaan</th>
                <th>Tanggal Diterima</th>
                <th>Tanggal Dibuat</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data->get() as $key => $value)
              <tr>
                <td>{{($key+1)}}</td>
                <td>{{$value->id_pengadaan_produk}}</td>
                <td>{{$value->master_suplier->nama_suplier}}</td>
                <td>{{status_pengadaan($value->status_pengadaan)}}</td>
                <td>{{konfirmasi($value->konfirmasi_direktur)}}</td>
                <td>{{konfirmasi($value->konfirmasi_gudang)}}</td>
                <td>Rp. {{number_format(\App\Models\PengadaanProdukDetail::where(["id_pengadaan_produk"=>$value->id_pengadaan_produk])->select(\DB::raw("SUM(jumlah*harga) as total"))->first()->total)}}</td>
                <td>{{(($value->tgl_diterima == null)?"-":date("d-m-Y",strtotime($value->tgl_diterima)))}}</td>
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
                <td colspan="3" style="height:100px">

                </td>
                <td colspan="3"></td>
                <td colspan="3"  style="height:100px">

                </td>
              </tr>
              <tr>
                <th colspan="3" align="center">Jatra Novianto</th>
                <td colspan="3"></td>
                <th colspan="3" align="center">Agus Herdian</th>
              </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>
