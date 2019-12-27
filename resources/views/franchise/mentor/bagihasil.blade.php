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
          <h5 class="m-0">Bagi Hasil</h5>
        </div>
        <div class="card-body">
          <table id="dtable" class="table table-bordered">
             <thead>
               <th>No</th>
               <th>Nama Gerai</th>
               <th>No Kontak</th>
               <th>Alamat</th>
               <th>Dibuat</th>
               <th>Opsi</th>
             </thead>
             <tbody>
               @foreach($frs as $k => $v)
               <tr>
                 <td>{{($k+1)}}</td>
                 <td>{{$v->nama_pengguna}}</td>
                 <td>{{$v->no_kontak}}</td>
                 <td>{{$v->alamat}}</td>
                 <td>{{date("d-m-Y",strtotime($v->tgl_register))}}</td>
                 <td>
                   <a href="{{route("mentor.bagihasil.list",$v->id_pengguna)}}" class="btn btn-primary m-1">
                     Bagi Hasil
                   </a>
                 </td>
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
