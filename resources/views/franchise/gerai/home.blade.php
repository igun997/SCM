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
          <h5 class="m-0">Data Kontrol</h5>
        </div>
        <div class="card-body">
          <table id="dtable" class="table table-bordered">
            <thead>
              <th>No</th>
              <th>C. Keuangan</th>
              <th>C. Pesanan</th>
              <th>C. Barang</th>
              <th>C. Evaluasi</th>
              <th>Status Kontrol</th>
              <th>Status Evaluasi</th>
              <th>Dibuat</th>
              <th>Opsi</th>
            </thead>
             <tbody>
               @foreach($data as $k => $v)
               <tr>
                 <td>{{($k+1)}}</td>
                 <td>{{$v->catatan_keuangan}}</td>
                 <td>{{$v->catatan_keuangan}}</td>
                 <td>{{$v->catatan_pelayanan}}</td>
                 <td>{{$v->catatan_evaluasi}}</td>
                 <td>
                   @if($v->status_kontrol == 1)
                   <span class="badge badge-success">Sudah Di Kontrol</span>
                   @else
                   <span class="badge badge-danger">Belum di Kontrol</span>
                   @endif
                 </td>
                 <td>
                   @if($v->status_evaluasi === 0 )
                   <span class="badge badge-danger">Belum di Evaluasi</span>
                   @elseif($v->status_evaluasi == 1)
                   <span class="badge badge-success">Sudah di Evaluasi</span>
                   @else
                   <span class="badge badge-primary">Tidak Ada Evaluasi</span>
                   @endif
                 </td>
                 <td>{{$v->dibuat}}</td>
                 <td>
                   @if($v->status_evaluasi === 0 )
                     <a href="{{route("gerai.home.fixing",$v->id)}}" class="btn btn-success">Sudah Di Perbaiki</a>
                   @endif
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
