@extends('franchise.layout.app')

@section('title',$title)

@section('css')

@endsection

@section('url',session()->get("url"))

@section('konten')
  <div class="row">
    <div class="col-12 col-offset-6">
      <div class="card">
        <div class="card-header">
          <h5 class="m-0">Tambah Pesanan</h5>
        </div>
        <div class="card-body">
          <form  onsubmit="return  false" id="myForm" method="post">
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label>Nama Pemesan</label>
                <input type="text" class="form-control" name="nama"   value="">
              </div>
              <div class="form-group">
                <label>Jenis Kelamin</label>
                <select class="form-control" name="jk">
                  <option value="0">Laki - Laki</option>
                  <option value="1">Perempuan</option>
                </select>
              </div>
              <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" rows="8" cols="80"></textarea>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label>No HP</label>
                <input type="text" class="form-control" name="no_hp"   value="">
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="text" readonly class="form-control" name="email"   value="{{$randomize}}@wenow.id">
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="text" readonly class="form-control" name="password"   value="{{$randomize}}">
              </div>
              <div class="form-group">
                <label>Catatan Pemesanan</label>
                <textarea name="catatan" class="form-control" rows="8" cols="80"></textarea>
              </div>
            </div>
            <div class="col-6">
              <h4 align="center">Data Layanan</h4>
              <div class="list-group">
                @foreach($layanan as $k => $v)
                <div class="list-group-item list-group-item-action flex-column align-items-start">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{$v->nama}} - Rp.{{number_format($v->harga)}}</h5>
                    <small>{{strtoupper($v->jenis)}}</small>
                  </div>
                  <p class="mb-1">
                    <input type="number" class="check" data-harga="{{$v->harga}}" name="qty[{{$v->id}}]" value="" required>
                  </p>
                </div>
                @endforeach
              </div>
            </div>
            <div class="col-6">
              <div class="form-group mt-3">
                <label>Total Harga</label>
                <input type="text" readonly name="totalharga" id="totalharga" class="form-control" value="">
              </div>
              <div class="form-group mt-3">
                <label></label>
                <button type="submit" class="btn btn-success btn-block " >Simpan Data</button>
              </div>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
    <!-- /.col-md-6 -->
  </div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-input-spinner@1.13.3/src/bootstrap-input-spinner.min.js" charset="utf-8"></script>
<script type="text/javascript">
  $(document).ready(function() {
     $("input[type='number']").inputSpinner()
     $(".check").on("change", function(event) {
       obj = $("#totalharga");
       totalharga = 0;
       $.each($("input[type=number]"), function(index, val) {
        console.log(($(val).val() != ""));
        if ($(val).val() != "") {
          harga = (parseFloat($(val).data("harga"))*parseFloat($(val).val()));
          totalharga = totalharga + harga;
        }
        // console.log(harga);
       });
       obj.val(totalharga);
       // console.log(harga);
       // console.log("Harga");
     })
     $("#myForm").on("submit", function(event) {
       dform = $(this).serializeArray();
       $.post("{{route("gerai.pesanan.set.save")}}",dform,function(r){
         if (r.status == 1) {
           toastr.success("Sukses Input Pesanan");
           setTimeout(function () {
             location.href = "{{route("gerai.pesanan")}}";
           }, 1000);
         }else {
           toastr.warning("Gagal Input Pesanan");
         }
       })
     })
  });

</script>
@endsection
