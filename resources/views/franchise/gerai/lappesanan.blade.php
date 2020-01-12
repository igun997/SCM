@extends('franchise.layout.app')

@section('title',$title)

@section('css')

@endsection

@section('url',session()->get("url"))

@section('konten')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h5 class="m-0">Laporan Pesanan</h5>
        </div>
        <div class="card-body">
          <div class="col-12">
            <div class="row">
              <div class="form-group col-3">
                <label>Dari</label>
                <input class="form-control" id="dari" />
              </div>
              <div class="form-group col-3">
                <label>Sampai</label>
                <input class="form-control" id="sampai" />
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table id="dtable" class="table table-bordered">
             <thead>
               <th>No</th>
               <th>Nama Pelanggan</th>
               <th>Layanan</th>
               <th>Status Order</th>
               <th>Dijemput</th>
               <th>Driver Penjemputan</th>
               <th>Driver Pengantaran</th>
               <th>Jarak</th>
               <th>Total Harga</th>
               <th>Dibuat</th>
             </thead>
             <tbody>
               @foreach($data as $k => $v)
               <tr>
                 <td>{{($k+1)}}</td>
                 <td>{{$v->gerai_pelanggan->nama}}</td>
                 <td>
                   @foreach($v->gerai_order_details as $obj)
                   <p>
                     [{{strtoupper($obj->gerai_layanan->jenis)}}] {{$obj->gerai_layanan->nama}} x  {{$obj->qty}}
                   </p>
                   @endforeach
                 </td>
                 <td>{{$v->status_format($v->status_order)}}</td>
                 <td>{!!$v->booleanQuestion($v->dijemput)!!}</td>
                 <td>
                   @if($v->gerai_driver_id != null)
                   {{$v->gerai_driver_jemput->nama}}
                   @endif
                 </td>
                 <td>
                   @if($v->gerai_driver_id_antar != null)
                   {{$v->gerai_driver_antar->nama}}
                   @endif
                 </td>
                 <td>{{number_format($v->jarak)}} KM</td>
                 <td>Rp. {{number_format(($v->totalharga)+($v->jarak*5000))}}</td>
                 <td>{{date("Y-m-d",strtotime($v->dibuat))}}</td>
               </tr>
               @endforeach
             </tbody>
          </table>
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
      dom: 'Bfrtip',
      buttons: [
          {
              extend: 'print',
              customize: function ( win ) {
                  $(win.document.body).find("h1").html("<h4 align='center'>Laporan Pesanan</h4>");
                  $(win.document.body).find( 'table' )
                      .addClass( 'compact' )
                      .css( 'font-size', 'inherit' );
              }
          }
      ]
    });
    $("#dari").datetimepicker({
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
          console.log(aData[9]);
          aData._date = new Date(aData[9]).getTime();
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
