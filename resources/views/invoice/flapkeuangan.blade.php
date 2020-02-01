<html>
  <head>
    <title>Laporan Keuangan</title>
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
    <h2 align="center">LAPORAN KEUANGAN</h2>
    <h5 align="center">PERIODE : {{date("d-m-Y",strtotime($req["dari"]))}} - {{date("d-m-Y",strtotime($req["sampai"]))}}</h5>
    <table class='table_po'>
      <tr style="font-weight:bold">
        <td>No</td>
        <td>Nama </td>
        <td>Layanan</td>
        <td>Total Harga</td>
        <td>Dibuat</td>
      </tr>
      @foreach($data->get() as $k => $v)
      <tr>
        <td>{{($k+1)}}</td>
        <td>{{$v->gerai_pelanggan->nama}}</td>
        <td>
          @foreach($v->gerai_order_details as $obj)
          <p>
            [{{strtoupper($obj->gerai_layanan->jenis)}}] {{$obj->gerai_layanan->nama}} x  {{$obj->qty}}
          </p>
          @endforeach
        </td>
        <td>Rp. {{number_format($v->totalharga)}}</td>
        <td>{{date("Y-m-d",strtotime($v->dibuat))}}</td>
      </tr>
      @endforeach
    </table>
    <br>
    <br>

  </body>
</html>
