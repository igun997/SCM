@extends('franchise.layout.app')

@section('title',$title)

@section('css')

@endsection

@section('url',session()->get("url"))

@section('konten')
  <div class="row">
    <div class="col-lg-8 offset-2">
      <div class="card">
        <div class="card-header">
          <h5 class="m-0">{{$title}}</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-4">
              <a href="{{route("mentor.franchise.layananadd",$data->id_pengguna)}}" class="btn btn-primary m-2">Tambah Layanan</a>
            </div>
            <div class="col-12">
            <table id="dtable" class="table table-bordered">
             <thead>
               <th>No</th>
               <th>Nama Layanan</th>
               <th>Harga</th>
               <th>Total Transaksi</th>
               <th>Dibuat</th>
               <th>Opsi</th>
             </thead>
             <tbody>
               @foreach($data->gerai_layanans as $k => $v)
               <tr>
                 <td>{{($k+1)}}</td>
                 <td>{{$v->nama}}</td>
                 <td>Rp. {{number_format($v->harga)}}</td>
                 <td>{{$v->gerai_orders->count()}}</td>
                 <td>{{date("d-m-Y",strtotime($v->dibuat))}}</td>
                 <td>
                   <a href="{{route("mentor.franchise.layananedit",[$data->id_pengguna,$v->id])}}" class="btn btn-warning m-2">Edit</a>
                 </td>
               </tr>
               @endforeach
             </tbody>
          </table>
            </div>
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
