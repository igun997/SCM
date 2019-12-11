@extends('franchise.layout.app')

@section('title',$title)

@section('css')

@endsection

@section('url',session()->get("url"))

@section('konten')
  <div class="row">
    <div class="col-lg-12">
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
              <th>Jumlah Sepatu</th>
              <th>Dijemput</th>
              <th>Driver</th>
              <th>Jarak</th>
              <th>Alamat</th>
              <th>No HP</th>
              <th>Total Harga</th>
              <th>Dibuat</th>
              <th>Opsi</th>
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
                 <td>{{$v->gerai_pelanggan->alamat}}</td>
                 <td>{{$v->gerai_pelanggan->no_hp}}</td>
                 <td>Rp. {{number_format($v->totalharga)}}</td>
                 <td>{{date("d-m-Y",strtotime($v->dibuat))}}</td>
                 <td>
                   @if($v->dijemput == 1 && $v->status_order != 6)
                   <a href="#" class="btn btn-success m-2 antar" data-id="{{$v->id}}">Terima Antar</a>
                   @elseif($v->status_order == 0)
                   <a href="#" class="btn btn-success m-2 jemput" data-id="{{$v->id}}">Terima Jemput</a>
                   @elseif($v->status_order == 1)
                   <a href="{{route("driver.selesaiantar",$v->id)}}" class="btn btn-success m-2 accept">Selesaikan Antar</a>
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
    var order = null;
    $("#dtable").DataTable({

    });
    $("#dtable").on("click", ".jemput", function(event) {
      navigator.geolocation.getCurrentPosition(showPosition);
      order = $(this).data("id");
    })
    function showPosition(position) {
      lat = position.coords.latitude;
      lng = position.coords.longitude;
      id = "{{session()->get("id")}}";
      idorder = order;
      $.post("{{route("driver.terima")}}/"+idorder,{status_order:1,dLat:lat,dLng:lng,gerai_driver_id:id},function(d){
        if (d.status == 1) {
          toastr.warning("Sukses Ambil Order, Silahkan Menuju Lokasi");
          setTimeout(function () {
            location.reload();
          }, 1000);
        }else {
          toastr.warning("Gagal Ambil Order");
        }
      })
    }
  });
</script>
@endsection
