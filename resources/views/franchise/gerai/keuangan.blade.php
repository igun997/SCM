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
          <h5 class="m-0">Laporan Keuangan</h5>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="dtable" class="table table-bordered">
             <thead>
               <th>No</th>
               <th>Nama Pelanggan</th>
               <th>Layanan</th>
               <th>Total Harga</th>
               <th>Dibuat</th>
             </thead>
             <tbody>
               @foreach($data as $k => $v)
               <tr>
                 <td>{{($k+1)}}</td>
                 <td>{{$v->gerai_pelanggan->nama}}</td>
                 <td>
                   @foreach($v->gerai_order_details as $obj)
                   <p>
                     {{$obj->gerai_layanan->nama}} x  {{$obj->qty}}
                   </p>
                   @endforeach
                 </td>
                 <td>{{$v->totalharga}}</td>
                 <td>{{$v->dibuat}}</td>
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
