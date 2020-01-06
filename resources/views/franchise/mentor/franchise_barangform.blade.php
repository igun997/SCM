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
                  <label>Pilih Barang</label>
                  <select class="form-control" name="id_produk">
                    <option>== Pilih ==</option>
                    @foreach($list as $k => $v)
                    <option value="{{$v->id_produk}}">[{{$v->id_produk}}] {{$v->nama_produk}} ({{$v->stok}})</option>
                    @endforeach
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
