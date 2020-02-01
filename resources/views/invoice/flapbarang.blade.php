<html>
  <head>
    <title>Laporan Barang</title>
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
    @include("invoice.head_lap")
    <h2 align="center">LAPORAN BARANG</h2>
    <h5 align="center">PERIODE : {{date("d-m-Y",strtotime($req["dari"]))}} - {{date("d-m-Y",strtotime($req["sampai"]))}}</h5>
    <table class='table_po'>
      <tr style="font-weight:bold">
        <td>No</td>
        <td>Nama Barang</td>
        <td>Jenis</td>
        <td>Total</td>
        <td>Dibuat</td>
      </tr>
      @foreach($data->get() as $k => $v)
      @foreach($v->gerai_barang_details as $ks => $vs)
      <tr>
        <td>{{($ks+1)}}</td>
        <td>{{$v->nama_barang}}</td>
        <td>{{$vs->jenis}}</td>
        <td>
          @if($vs->jenis == "masuk")
          {{$qty = ($vs->qty*1)}}
          @else
          {{$qty = ($vs->qty*-1)}}
          @endif
        </td>
        <td>{{date("Y-m-d",strtotime($vs->dibuat))}}</td>
      </tr>
      @endforeach
      @endforeach
    </table>
    <br>
    <br>

  </body>
</html>
