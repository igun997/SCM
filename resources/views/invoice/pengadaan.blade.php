<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body{
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            color:#333;
            text-align:left;
            font-size:18px;
            margin:0;
        }
        @page {
          margin-top: 0px;
          margin-bottom: 0px;
        }
        .container{
            margin:0 auto;
            margin-top:35px;
            padding:40px;
            width:750px;
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
            width:740px;
        }
        td, tr, th{
            padding:12px;
            border:1px solid #333;
            width:185px;
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
                        <h4>Suplier: </h4>
                        <p>{{ $invoice->master_suplier->nama_suplier }}<br>
                        {{ $invoice->master_suplier->alamat }}<br>
                        {{ $invoice->master_suplier->no_kontak  }} <br>
                        {{ $invoice->master_suplier->email }}
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
                @foreach ($invoice->pengadaan__produk_details as $row)
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
                  <th>Catatan Pengadaan</th>
                  <th colspan="1">Catatan Direktur</th>
                  <th colspan="2">Catatan Gudang</th>
                </tr>
                <tr>
                  <td>{{$invoice->catatan_pengadaan}}</td>
                  <td colspan="1">{{$invoice->catatan_direktur}}</td>
                  <td colspan="2">{{$invoice->catatan_gudang}}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total</th>
                    <td>Rp {{ number_format($invoice->total_price) }}</td>
                </tr>
                <tr>
                    <th colspan="3">Status Pengadaan</th>
                    <td>{{ status_pengadaan($invoice->status_pengadaan) }}</td>
                </tr>
                <tr>
                  <th colspan="2">Perkiraan Penerimaan</th>
                  <th colspan="2">Tanggal Penerimaan</th>
                </tr>
                <tr>
                  <td colspan="2">{{date("d-m-Y",strtotime($invoice->perkiraan_tiba))}}</td>
                  <td colspan="2">{{(($invoice->tgl_diterima == null)?"-":date("d-m-Y",strtotime($invoice->tgl_diterima)))}}</td>
                </tr>
                <tr>
                    <th colspan="3">Konfirmasi Direktur</th>
                    <td>{{ konfirmasi($invoice->konfirmasi_direktur) }}</td>
                </tr>
                <tr>
                    <th colspan="3">Konfirmasi Gudang</th>
                    <td>{{ konfirmasi($invoice->konfirmasi_gudang) }}</td>
                </tr>
            </tfoot>
        </table>
        @if($invoice->pengadaan__produk_returs->count() > 0)
        <div style="page-break-before: always;">
        </div>
        <table>
            <caption>
                INVOICE RETUR BARANG
            </caption>
            <thead>
                <tr>
                    <th colspan="3">Invoice <strong>#{{ $invoice->pengadaan__produk_returs->first()->id_pengadaan_produk_retur }}</strong></th>
                    <th>{{ $invoice->pengadaan__produk_returs->first()->tanggal_retur->format('D, d M Y') }}</th>
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
                        <h4>Suplier: </h4>
                        <p>{{ $invoice->master_suplier->nama_suplier }}<br>
                        {{ $invoice->master_suplier->alamat }}<br>
                        {{ $invoice->master_suplier->no_kontak  }} <br>
                        {{ $invoice->master_suplier->email }}
                        </p>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Ket</th>
                </tr>
                @foreach ($invoice->pengadaan__produk_returs->first()->pengadaan__produk_retur_details as $row)
                <tr>
                    <td>{{ $row->pengadaan_produk_detail->master_produk->nama_produk }}</td>
                    <td>Rp {{ number_format($row->pengadaan_produk_detail->harga) }}</td>
                    <td>{{ $row->total_retur }}</td>
                    <td>{{$row->catatan_retur}}</td>
                </tr>
                @endforeach
                <tr>
                  <th colspan="3">Status Retur</th>
                  <td>{{ status_retur($invoice->pengadaan__produk_returs->first()->status_retur) }}</td>
                </tr>
                <tr>
                  <th colspan="3">Konfirmasi Pengadaan</th>
                  <td>{{ konfirmasi($invoice->pengadaan__produk_returs->first()->konfirmasi_pengadaan) }}</td>
                </tr>
                <tr>
                  <th colspan="3">Konfirmasi Direktur</th>
                  <td>{{ konfirmasi($invoice->pengadaan__produk_returs->first()->konfirmasi_direktur) }}</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                  <th colspan="2" align="center">Bag. Pengadaan</th>
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
                  <th colspan="4" align="center">{{(\App\Models\Pengguna::where(['level'=>"gudang"])->first()->nama_pengguna)}}</th>
                </tr>

            </tfoot>
        </table>
        @endif
    </div>
</body>
</html>
