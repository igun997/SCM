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
          <h5 class="m-0">Data Bagi Hasil</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12 m-2">
              <form action="" method="post">
                @if($form_data["status"])
                <div class="row">
                  <div class="col-3">
                    <div class="form-group">
                      <label>Nama Gerai</label>
                      <input type="text" name="nama_pengguna" class="form-control" value="{{$person->nama_pengguna}}" disabled>
                    </div>
                  </div>
                  @csrf
                  <div class="col-3">
                    <div class="form-group">
                      <label>Nama Mentor</label>
                      <input type="text" name="nama_pengguna" class="form-control" value="{{$mentor->nama_pengguna}}" disabled>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label>Total Kotor</label>
                      <input type="text" name="totalkotor" class="form-control" value="{{$form_data["data"]["totalkotor"]}}" readonly>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label>Keuntungan Gerai</label>
                      <input type="text" name="pemilik" class="form-control" value="{{$form_data["data"]["pemilik"]}}" readonly>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-3">
                    <div class="form-group">
                      <label>Keuntungan Pusat</label>
                      <input type="text" name="pusat" class="form-control" value="{{$form_data["data"]["pusat"]}}" readonly>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label>Total Pesanan</label>
                      <input type="text" name="totalpesanan" class="form-control" value="{{$form_data["data"]["totalpesanan"]}}" disabled>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group">
                      <label>Periode</label>
                      <input type="text" name="periode" class="form-control" value="{{$form_data["data"]["periode"]}}" readonly>
                    </div>
                  </div>
                  <div class="col-3">
                    <div class="form-group" style="margin-top:32px">
                      <button type="submit" class="btn btn-success btn-block">Bagi Hasil</button>
                    </div>
                  </div>
                </div>
                @else
                <div class="alert alert-danger">
                  <p align="center">Bagi Hasil Hanya Dilakukan Setiap Tanggal 14</p>
                </div>
                @endif
              </form>
            </div>
            <div class="col-md-12">
              <table id="dtable" class="table table-bordered">
               <thead>
                 <th>No</th>
                 <th>Tgl</th>
                 <th>Periode</th>
                 <th>Total Pesanan</th>
                 <th>Total Kotor</th>
                 <th>Keuntungan Pemilik</th>
                 <th>Keuntungan Pusat</th>
                 <th>Cetak</th>
               </thead>
             <tbody>
               @foreach($data as $k => $v)
               <tr>
                 <td>{{$k+1}}</td>
                 <td>{{date("d-m-Y",strtotime($v->dibuat))}}</td>
                 <td>{{$v->periode}}</td>
                 <td>{{number_format($v->totalpesanan)}}</td>
                 <td>{{number_format($v->totalkotor)}}</td>
                 <td>{{number_format($v->pemilik)}}</td>
                 <td>{{number_format($v->pusat)}}</td>
                 <td>
                   <a href="{{route("mentor.franchise.bagihasil_print",$v->id)}}"  class="btn btn-primary">Cetak Kwitansi</a>
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
