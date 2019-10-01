@extends('layout.app')
@section("title",$title)
@section("content")
<div class="row">
    <div class="col col-login mx-auto">
      <div class="text-center mb-6">
        <img src="{{url("assets/images/logo.png")}}" class="h-8" alt="">
      </div>
      <form class="card" action="" method="post" onsubmit="return false" id="login">
        <div class="card-body p-6">
          <div class="card-title">Selamat Datang di SCM Wenow</div>
          @if(session()->has("msg"))
          <div class="alert alert-success">
            <center>{{session()->get("msg")}}</center>
          </div>
          @endif
          @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <p><center>{{ $error }}</center></p>
                @endforeach
            </div>
           @endif
          <div class="form-group">
            <label class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label class="form-label">
              Password
            </label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
          </div>
          <div class="form-footer">
            <button type="submit" class="btn btn-primary btn-block">Sign in</button>
          </div>
        </div>
      </form>
    </div>
</div>
@endsection
@push("script")
<script type="text/javascript">
// require(['datatables','jquery'], function(datatable, $) {
//     $('.datatable').DataTable();
//   });
  require(['sweetalert2','c3', 'jquery'], function (Swal,c3, $) {
    console.log("All Loaded");
    $("#login").on('submit', function(event) {
      event.preventDefault();
      var data = $(this).serializeArray();
      on();
      console.log(data);
      $.ajax({
        url: '{{route("public.api.login")}}',
        type: 'POST',
        dataType: 'json',
        data: data
      })
      .done(function(rs) {
        if (rs.status == 1) {
          Swal.fire({
            type: 'success',
            title: 'Selamat !!',
            text: 'Username dan Password Anda Benar',
          }).then(function(){
            location.href=rs.path;
          });
        }else {
          Swal.fire({
            type: 'info',
            title: 'Kesalahan Ditemukan',
            text: 'Username dan Password Salah',
          })
        }
        off();
      })
      .fail(function(rs) {
        var msg = "";
        $.each(rs.responseJSON.errors,function(index,item){
          msg += item[0]+"<br>";
        });
        if (rs.responseJSON.errors == undefined) {
          var msg = "Kehilangan Komunikasi Dengan Server"
        }
        Swal.fire({
          type: 'error',
          title: 'Oops...',
          html: msg,
          footer: '<a href>Laporkan Error</a>'
        })
        off();
      })
      .always(function() {
        console.log("Proses Selesai");
        off();
      });

    });
  });
</script>
@endpush
