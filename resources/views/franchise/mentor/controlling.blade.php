@extends('franchise.layout.app')

@section('title',$title)

@section('css')
<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js" integrity="sha256-nZaxPHA2uAaquixjSDX19TmIlbRNCOrf5HO1oHl5p70=" crossorigin="anonymous"></script>
@endsection

@section('url',session()->get("url"))

@section('konten')
  <div class="row">

      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h5 class="m-0">Statistik Transaksi {{date("Y")}}</h5>
          </div>
          <div class="card-body">
            <div id="container" style="width: 100%;">
          		<canvas id="canvas"></canvas>
          	</div>
          </div>
        </div>
      </div>
      <!-- /.col-md-6 -->
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h5 class="m-0">Data Kontrol</h5>
        </div>
        <div class="card-body">
          <table id="dtable" class="table table-bordered">
             <thead>
               <th>No</th>
               <th>Nama Gerai</th>
               <th>No Kontak</th>
               <th>Alamat</th>
               <th>Dibuat</th>
               <th>Opsi</th>
             </thead>
             <tbody>
               @foreach($frs as $k => $v)
               <tr>
                 <td>{{($k+1)}}</td>
                 <td>{{$v->nama_pengguna}}</td>
                 <td>{{$v->no_kontak}}</td>
                 <td>{{$v->alamat}}</td>
                 <td>{{date("d-m-Y",strtotime($v->tgl_register))}}</td>
                 <td>
                   <a href="{{route("mentor.controlling.audit",$v->id_pengguna)}}" class="btn btn-primary m-1">
                     Audit Gerai
                   </a>
                 </td>
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
<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>
<script type="text/javascript">
  $(document).ready(function() {
    console.log("Well Done");
    $("#dtable").DataTable({

    });
    $.get("{{route("mentor.chart",date("Y"))}}",function(s){
      console.log(s);
      var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
      var color = Chart.helpers.color;
      var barChartData = {
        labels: MONTHS,
        datasets: s

      };

        var ctx = document.getElementById('canvas').getContext('2d');
        new Chart(ctx, {
          type: 'bar',
          data: barChartData,
          options: {
            responsive: true,
            legend: {
              position: 'top',
            },
            title: {
              display: true,

            }
          }
        });

    });
  });
</script>
@endsection
