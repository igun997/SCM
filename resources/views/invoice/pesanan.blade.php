<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
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
        padding:16px;
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
        width:100%;
    }
    td, tr, th{
        padding:10px;
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
        <table>
            <caption>
                {{$title}}
            </caption>
            <thead>
                <tr>
                    <th colspan="3">Invoice <strong>#{{ $invoice->kode }}</strong></th>
                    <th>{{ $invoice->tgl_register->format('D, d M Y') }}</th>
                </tr>
                <tr>
                    <td colspan="2">
                        <h4>Perusahaan: </h4>
                        <p>WENOW.<br>
                            Jl. Cikalong Wetan<br>
                            085343966997<br>
                            support@wenow.id
                        </p>
                    </td>
                    <td colspan="2">
                        <h4>Pelanggan: </h4>
                        <p>{{ $invoice->master_pelanggan->nama_pelanggan }}<br>
                        {{ $invoice->master_pelanggan->alamat }}<br>
                        {{ $invoice->master_pelanggan->no_kontak }} <br>
                        {{ $invoice->master_pelanggan->email }}
                        </p>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
                @foreach ($invoice->pemesanan__details as $row)
                <tr>
                    <td>{{ $row->master_produk->nama_produk }}</td>
                    <td>Rp {{ number_format($row->harga) }}</td>
                    <td>{{ $row->jumlah }}</td>
                    <td>Rp {{ number_format($row->jumlah * $row->harga) }}</td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="3">Subtotal</th>
                    <td>Rp {{ number_format($invoice->total) }}</td>
                </tr>
                <tr>
                    <th>Pajak</th>
                    <td></td>
                    <td>{{number_format(($invoice->pajak*100))}}%</td>
                    <td>Rp {{ number_format($invoice->pajak_total) }}</td>
                </tr>
                <tr>
                  <th colspan="3">Total</th>
                  <td>Rp {{ number_format($invoice->total_price) }}</td>
                </tr>
                <tr>
                  <th colspan="3">Status Pemesanan</th>
                  <td>{{ status_pesanan($invoice->status_pesanan) }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                  <th colspan="2" align="center">Bag. Pemasaran</th>
                  <th colspan="2" align="center">Bag. Gudang</th>
                </tr>
                <tr>
                  <td colspan="2">
                    <center>
                      <img src="{{session()->get("ttd")}}" style="width:200px;height: auto;" alt="">
                    </center>
                  </td>
                  <td colspan="2">
                    <center>
                      <img src="{{(\App\Models\Pengguna::where(['level'=>"gudang"])->first()->ttd)}}" style="width:200px;height: auto;" alt="">
                    </center>
                  </td>
                </tr>
                <tr>
                  <th colspan="2" align="center">{{session()->get("nama")}}</th>
                  <th colspan="2" align="center">{{(\App\Models\Pengguna::where(['level'=>"gudang"])->first()->nama_pengguna)}}</th>
                </tr>
                <tr>
                  <th colspan="4" align="center">Direktur</th>
                </tr>
                <tr>
                  <td colspan="4">
                    <center>
                      <img src="{{(\App\Models\Pengguna::where(['level'=>"direktur"])->first()->ttd)}}" style="width:200px;height: auto;" alt="">
                    </center>
                  </td>
                </tr>
                <tr>
                  <th colspan="4" align="center">{{(\App\Models\Pengguna::where(['level'=>"direktur"])->first()->nama_pengguna)}}</th>
                </tr>

            </tfoot>
        </table>
    </div>
</body>
</html>
