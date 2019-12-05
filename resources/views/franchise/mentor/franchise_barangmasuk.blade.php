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
            <form action="" method="post">
              @csrf
              <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" class="form-control" disabled value="{{$data->nama_barang}}">
              </div>
              <div class="form-group">
                <label>Deskripsi</label>
                <textarea disabled class="form-control" rows="4" cols="80">{{$data->deskripsi}}</textarea>
              </div>
              <div class="form-group">
                <label>Total Barang Masuk</label>
                <input type="text" class="form-control" name="qty" value="">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-success">Simpan Data</button>
              </div>
            </form>
          </div>
          <div class="col-12">
            <table class="table table-bordered" id="dtable">
              <thead>
                <th>No</th>
                <th>Jenis</th>
                <th>Jumlah</th>
                <th>Konf. Pemilik</th>
                <th>Tgl Konfirmasi</th>
                <th>Dibuat</th>
              </thead>
              <tbody>
                @foreach($data->gerai_barang_details as $k => $v)
                <tr>
                  <td>{{$k+1}}</td>
                  <td>
                    @if($v->jenis == "masuk")
                    <span class="badge badge-success">{{ucfirst($v->jenis)}}</span>
                    @else
                    <span class="badge badge-danger">{{ucfirst($v->jenis)}}</span>
                    @endif
                  </td>
                  <td>{{$v->qty}}</td>
                  <td>
                    @if($v->konf_pemilik == 0)
                    <span class="badge badge-danger">Belum Konfirmasi</span>
                    @else
                    <span class="badge badge-success">Sudah Konfirmasi</span>
                    @endif
                  </td>
                  <td>{{$v->tgl_konf}}</td>
                  <td>{{date("d-m-Y",strtotime($v->dibuat))}}</td>
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
