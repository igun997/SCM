@extends('franchise.layout.app')

@section('title',$title)

@section('css')

@endsection

@section('url',session()->get("url"))

@section('konten')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h5 class="m-0">Laporan Pesanan</h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="dtable" class="table table-bordered">
             <thead>
               <th>No</th>
               <th>Nama Pelanggan</th>
               <th>Layanan</th>
               <th>Status Order</th>
               <th>Dijemput</th>
               <th>Driver Penjemputan</th>
               <th>Driver Pengantaran</th>
               <th>Jarak</th>
               <th>Total Harga</th>
               <th>Dibuat</th>
             </thead>
             <tbody>
               @foreach($data as $k => $v)
               <tr>
                 <td>{{($k+1)}}</td>
                 <td>{{$v->gerai_pelanggan->nama}}</td>
                 <td>
                   @foreach($v->gerai_order_details as $k => $vs)
                   <p>{{$vs->gerai_layanan->nama}} x {{$vs->qty}}</p>
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
                 <td>{{number_format($v->jarak)}} KM</td>
                 <td>Rp. {{number_format(($v->totalharga)+($v->jarak*5000))}}</td>
                 <td>{{date("d-m-Y",strtotime($v->dibuat))}}</td>
               </tr>
               @endforeach
             </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- /.col-md-6 -->
  </div>
@endsection

@section('js')
<script type="text/javascript">
  $(document).ready(function() {
    console.log("Well Done");
    $("#dtable").DataTable({

    });

  });
</script>
@endsection
