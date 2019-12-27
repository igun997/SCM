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
                  <label>Nama Driver</label>
                  <input type="text" class="form-control" name="nama" value="{{@$data->nama}}">
                </div>
                <div class="form-group">
                  <label>No HP</label>
                  <input type="number" class="form-control" name="no_hp" value="{{@$data->no_hp}}">
                </div>
                <div class="form-group">
                  <label>Alamat</label>
                  <textarea name="alamat" class="form-control" rows="8" cols="80">{{@$data->alamat}}</textarea>
                </div>
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" class="form-control" name="username" value="{{@$data->username}}">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" name="password" value="{{@$data->password}}">
                </div>
                <div class="form-group">
                  <label>Status</label>
                  <select class="form-control" name="status">
                    <option value="{{@$data->status}}" selected>{{(@$data->status == 0)?"Tidak Aktif":"Aktif"}}</option>
                    <option value="0">Tidak Aktif</option>
                    <option value="1">Aktif</option>
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
