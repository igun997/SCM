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
          <div class="col-12">
            <table class="table table-bordered" id="dtable">
              <thead>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jenis </th>
                <th>Total</th>
                <th>Total Akhir</th>
                <th>Dibuat</th>
              </thead>
              <tbody>
                @foreach($data as $k => $v)
                    @foreach($v->gerai_barang_details as $ks => $vs)
                    <tr>
                      <td>{{($ks+1)}}</td>
                      <td>{{$v->nama_barang}}</td>
                      <td>{{$vs->jenis}}</td>
                      <td>
                        @if($vs->jenis == "masuk")
                        {{$qty = ($vs->qty*1)}}
                        @else
                        {{$qty = ($vs->qty*-1)}}
                        @endif
                      </td>
                      <td>0</td>
                      <td>{{$vs->dibuat}}</td>
                    </tr>
                    @endforeach
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
