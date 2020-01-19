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
            width:100%;
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
                  <th colspan="3">Invoice <strong>#{{ $invoice->id }}</strong></th>
                    <th>{{ $invoice->dibuat->format('D, d M Y') }}</th>
                </tr>
                <tr>
                  <th colspan="3">Periode</th>
                    <th>{{ $invoice->periode }}</th>
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
                        <h4>Gerai : </h4>
                        <p>{{$pemilik->nama_pengguna}}.<br>
                            {{$pemilik->alamat}}<br>
                            {{$pemilik->no_kontak}}<br>
                            {{$pemilik->email}}
                        </p>
                    </td>
                </tr>
            </thead>
            <tbody>
              <tr>
                <th colspan="2">Keuntungan Pemilik Gerai</th>
                <th colspan="2">Keuntungan Pusat</th>
              </tr>
              <tr>
                <td colspan="2">Rp.{{number_format($invoice->pemilik)}}</td>
                <td colspan="2">Rp.{{number_format($invoice->pusat)}}</td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <th colspan="2">Tertanda Pemilik Gerai</th>
                <th colspan="2">Tertanda Mentor Pusat</th>
              </tr>
              <tr>
                <td colspan="2" style="height:80px"></td>
                <td colspan="2" style="height:80px"></td>
              </tr>
            </tfoot>
        </table>

    </div>
</body>
</html>
