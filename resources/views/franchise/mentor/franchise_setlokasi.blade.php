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
          <div id="maps" style="width:auto;height:500px">

          </div>
        </div>
      </div>
    </div>
    <!-- /.col-md-6 -->
  </div>
@endsection

@section('js')

<script type="text/javascript" src="//maps.google.com/maps/api/js?key=AIzaSyD1cM44pjtWnEej7CgCeCVtYx5D70ImTdQ"></script>
<script src="{{url("assets2/js/gmaps.js")}}" charset="utf-8"></script>
<script type="text/javascript">
  $(document).ready(function() {
    var map = new GMaps({
      div: '#maps',
      lat: -6.903429,
      lng: 107.5030708,
      zoom:10
    });
    async function setLokasi(lat,lng){
      return await $.post("{{route("mentor.franchise.api.setlokasi",$data->id_pengguna)}}",{lat:lat,lng:lng},function(d){
        return d;
      });
    }
    map.addMarker({
        lat: {{($data->lat == null)?"-6.903429":$data->lat}},
        lng: {{($data->lng == null)?"107.5030708":$data->lng}},
        title: 'Lokasi Gerai',
        draggable: true,
        dragend: function(e) {
          var latLng = e.latLng;
          var lat = latLng.lat();
          var lng = latLng.lng();
          setLokasi(lat,lng).then(r => {
            console.log(r);
            if (r.status == 1) {
              toastr.success("Data Lokasi Telah Di Perbaharui");
            }else {
              toastr.error("Data Lokasi Gagal Di Perbaharui");
            }
          });
        }
    });
  });
</script>
@endsection
