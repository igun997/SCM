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
            <form  action="{{route("lapbarang")}}" method="post">
            <div class="row">
                @csrf
              <div class="form-group col-3">
                <label>Dari</label>
                <input class="form-control date" name="dari" />
              </div>
              <div class="form-group col-3">
                <label>Sampai</label>
                <input class="form-control date" name="sampai" />
              </div>
              <div class="form-group col-3">
                <button type="submit" style="margin-top:32px" class="btn btn-primary">
                  <li class="fa fa-print"></li>
                </button>
              </div>
            </div>
          </form>
          </div>
          <div class="col-12">
            <table class="table table-bordered" id="dtable">
              <thead>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Jenis </th>
                <th>Total</th>
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
                      <td>{{date("Y-m-d",strtotime($vs->dibuat))}}</td>
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
    var oTable = $("#dtable").DataTable({
      
    });
    $(".date").datetimepicker({
        format:"YYYY-MM-DD"
    })
    $("#sampai").datetimepicker({
        format:"YYYY-MM-DD"
    })
    $("#dari").on("dp.change", function(e) {
      console.log("ChangeIN");
      d = e.date;
      console.log(d);
      console.log(new Date(d).getTime());
      minDateFilter = new Date(d).getTime();
      oTable.draw();
    });
    $("#sampai").on("dp.change", function(e) {
      console.log("ChangeOut");
      d = e.date;
      console.log(d);
      maxDateFilter = new Date(d).getTime();
      oTable.draw();
    });
    // Date range filter
    minDateFilter = "";
    maxDateFilter = "";
    $.fn.dataTableExt.afnFiltering.push(
      function(oSettings, aData, iDataIndex) {
        if (typeof aData._date == 'undefined') {
          aData._date = new Date(aData[4]).getTime();
        }

        if (minDateFilter && !isNaN(minDateFilter)) {
          if (aData._date < minDateFilter) {
            return false;
          }
        }

        if (maxDateFilter && !isNaN(maxDateFilter)) {
          if (aData._date > maxDateFilter) {
            return false;
          }
        }

        return true;
      }
    )
  });
</script>

@endsection
