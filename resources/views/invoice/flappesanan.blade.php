<html>
  <head>
    <title>Laporan Pesanan</title>
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
    <h2 align="center">LAPORAN PESANAN</h2>
    <h5 align="center">PERIODE : {{date("d-m-Y",strtotime($req["dari"]))}} - {{date("d-m-Y",strtotime($req["sampai"]))}}</h5>
    <table class='table_po'>
      <tr style="font-weight:bold">
        <td>No</td>
        <td>Nama Pelanggan</td>
        <td>Layanan</td>
        <td>Status Order</td>
        <td>Diantar</td>
        <td>Driver Penjemputan</td>
        <td>Driver Pengantaran</td>
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
        <td>{{$v->status_format($v->status_order)}}</td>
        <td>{!!$v->booleanQuestion($v->dijemput)!!}</td>
        <td>
          @if($v->gerai_driver_id != null)
          {{$v->gerai_driver_jemput->nama}}
          @endif
        </td>
        <td>
          @if($v->gerai_driver_id_antar != null)
          {{$v->gerai_driver_antar->nama}}
          @endif
        </td>
        <td>Rp. {{number_format(($v->totalharga)+($v->jarak*5000))}}</td>
        <td>{{date("Y-m-d",strtotime($v->dibuat))}}</td>
      </tr>
      @endforeach
    </table>
    <br>
    <br>

  </body>
</html>
