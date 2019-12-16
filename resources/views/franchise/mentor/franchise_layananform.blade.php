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
                  <label>Nama Layanan</label>
                  <input type="text" class="form-control" name="nama" value="{{@$data->nama}}">
                </div>
                <div class="form-group">
                  <label>Harga</label>
                  <input type="text" class="form-control" name="harga" value="{{@$data->harga}}">
                </div>
                <div class="form-group">
                  <label>Jenis</label>
                  <select class="form-control" name="jenis">
                    <option value="{{@$data->jenis}}" selected>{{@ucfirst($data->jenis)}}</option>
                    <option value="tas">Tas</option>
                    <option value="sepatu">Sepatu</option>
                    <option value="helm">Helm</option>
                  </select>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-success">Simpan Data</button>
                </div>
              </form>
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

  });
</script>
@endsection
