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
               <th>Jumlah Sepatu</th>
               <th>Dijemput</th>
               <th>Driver</th>
               <th>Jarak</th>
               <th>Total Harga</th>
               <th>Dibuat</th>
             </thead>
             <tbody>
               @foreach($data as $k => $v)
               <tr>
                 <td>{{($k+1)}}</td>
                 <td>{{$v->gerai_pelanggan->nama}}</td>
                 <td>{{$v->gerai_layanan->nama}}</td>
                 <td>{{$v->status_format($v->status_order)}}</td>
                 <td>{{$v->qty}}</td>
                 <td>{!!$v->booleanQuestion($v->dijemput)!!}</td>
                 <td>
                   @if($v->gerai_driver_id != null)
                   {{$v->gerai_driver->nama}}
                   @endif
                 </td>
                 <td>{{number_format($v->jarak)}} KM</td>
                 <td>Rp. {{number_format($v->totalharga)}}</td>
                 <td>{{date("d-m-Y",strtotime($v->dibuat))}}</td>
               </tr>
               @endforeach
             </tbody>
          </table>
          </div>
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
