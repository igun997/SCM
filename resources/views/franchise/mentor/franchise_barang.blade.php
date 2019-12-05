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
              <a href="{{route("mentor.franchise.barangadd",$data->id_pengguna)}}" class="btn btn-primary m-2">Tambah Barang</a>
            </div>
            <div class="col-12">
              <table id="dtable" class="table table-bordered">
             <thead>
               <th>No</th>
               <th>Nama Barang</th>
               <th>Deskripsi</th>
               <th>Stok</th>
               <th>Dibuat</th>
               <th>Opsi</th>
             </thead>
             <tbody>
               @foreach($data->gerai_barangs as $k => $v)
               <tr>
                 <td>{{($k+1)}}</td>
                 <td>{{$v->nama_barang}}</td>
                 <td>{{$v->deskripsi}}</td>
                 <td>{{$v->stok($v->id)}}</td>
                 <td>{{date("d-m-Y",strtotime($v->dibuat))}}</td>
                 <td>
                   <a href="{{route("mentor.franchise.barangmasuk",$v->id)}}" class="btn btn-success m-2">Tambah</a>
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
