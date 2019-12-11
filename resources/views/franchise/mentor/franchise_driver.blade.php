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
              <a href="{{route("mentor.franchise.driveradd",$data->id_pengguna)}}" class="btn btn-primary m-2">Tambah Driver</a>
            </div>
            <div class="col-12">
              <table id="dtable" class="table table-bordered">
             <thead>
               <th>No</th>
               <th>Nama Driver</th>
               <th>Alamat</th>
               <th>Username</th>
               <th>Status</th>
               <th>Opsi</th>
             </thead>
             <tbody>
               @foreach($data->gerai_drivers as $k => $v)
                  <tr>
                    <td>{{$k+1}}</td>
                    <td>{{$v->nama}}</td>
                    <td>{{$v->alamat}}</td>
                    <td>{{$v->username}}</td>
                    <td>{{($v->status == 1)?"Aktif":"Tidak Aktif"}}</td>
                    <td>
                      <a href="#" class="btn btn-warning">Ubah</a>
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
