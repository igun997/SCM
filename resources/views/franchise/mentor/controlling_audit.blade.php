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
          <h5 class="m-0">Audit Gerai</h5>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12" id="displaynone">

              <form action="" method="post">
                @csrf
                <div class="form-group">
                  <label>Nama Gerai</label>
                  <select class="form-control" readonly name="pemilik_id" id="pemilik_id">
                    @foreach($gerai as $k => $v)
                    <option value="{{$v->id_pengguna}}" selected>{{$v->nama_pengguna}}</option>
                    @endforeach
                  </select>
                  <a href="#" class="btn btn-primary m-2" id="lb" target="_blank">Laporan Barang</a>
                  <a href="#" class="btn btn-primary m-2" id="lk" target="_blank">Laporan Keuangan</a>
                  <a href="#" class="btn btn-primary m-2" id="lp" target="_blank">Laporan Pelayanan</a>
                </div>
                <div class="form-group">
                  <label>Catatan Keuangan</label>
                  <textarea name="catatan_keuangan" class='form-control' rows="8" cols="80"></textarea>
                </div>
                <div class="form-group">
                  <label>Catatan Pelayanan</label>
                  <textarea name="catatan_pelayanan" class='form-control' rows="8" cols="80"></textarea>
                </div>
                <div class="form-group">
                  <label>Catatan Barang</label>
                  <textarea name="catatan_barang" class='form-control' rows="8" cols="80"></textarea>
                </div>
                <div class="form-group">
                  <label>Perlu Evaluasi</label>
                  <select class="form-control" name="status_evaluasi">
                    <option value="">Tidak</option>
                    <option value="0">Ya</option>
                  </select>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-success">Simpan Data Kontrol</button>
                </div>
              </form>
            </div>
            <div class="col-12">
              <div class="table-responsive">
                <table id="dtable" class="table table-bordered">
                  <thead>
                    <th>No</th>
                    <th>Nama Gerai</th>
                    <th>C. Keuangan</th>
                    <th>C. Pelanggan</th>
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
                      <td>{{$v->pemilik->nama_pengguna}}</td>
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
                        @if($v->status_kontrol === 0 && $v->status_evaluasi == 1)
                          <a href="{{route("mentor.kontrol.done",$v->id)}}" class="btn btn-success">Sudah Di Kontrol</a>
                        @endif
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

    $("#pemilik_id").on("change",function(event) {
      id = $(this).val();
      console.log(id);
      $("#lb").attr("href","{{route("mentor.lapbarang")}}/"+id);
      $("#lk").attr("href","{{route("mentor.lapkeuangan")}}/"+id);
      $("#lp").attr("href","{{route("mentor.lappesanan")}}/"+id);
    })
    setTimeout(function () {
        $("#pemilik_id").trigger("change");
    }, 10);
  });
</script>
@endsection
