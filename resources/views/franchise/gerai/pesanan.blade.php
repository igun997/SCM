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
          <h5 class="m-0">Data Pesanan</h5>
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
               <th>Driver</th>
               <th>Jarak</th>
               <th>Total Harga</th>
               <th>Dibuat</th>
               <th>Opsi</th>
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
                   {{$v->gerai_driver->nama}}
                   @endif
                 </td>
                 <td>{{number_format($v->jarak)}} KM</td>
                 <td>Rp. {{number_format($v->totalharga)}}</td>
                 <td>{{date("d-m-Y",strtotime($v->dibuat))}}</td>
                 <td>
                   @if($v->dijemput == 1 && $v->status_order != 6)
                   <a href="{{route("gerai.layanan_selesai",$v->id)}}" class="btn btn-success m-2 selesaikan">Selesaikan</a>
                   @elseif($v->status_order == 1)
                   <a href="{{route("gerai.layanan_diterima",$v->id)}}" class="btn btn-success m-2 selesaikan">Diterima</a>
                   @elseif($v->status_order == 2)
                   <a href="{{route("gerai.layanan_cuci",$v->id)}}" class="btn btn-success m-2 selesaikan">Cuci Sekarang</a>
                   @elseif($v->status_order == 3)
                   <a href="{{route("gerai.layanan_cuciselesai",$v->id)}}" class="btn btn-success m-2 selesaikan">Pencucian Selesai</a>
                   @elseif($v->status_order == 5)
                   <a href="{{route("gerai.layanan_selesaikanorder",$v->id)}}" class="btn btn-success m-2 selesaikan">Selesaikan Order</a>
                   @endif

                 </td>
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
