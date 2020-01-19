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
          <h5 class="m-0">Data Pesanan</h5>
        </div>
        <div class="card-body">
          <a href="{{route("gerai.pesanan.set")}}" class="btn btn-success m-2">Tambah Transaksi</a>
          <div class="table-responsive">
            <table id="dtable" class="table table-bordered">
             <thead>
               <th>No</th>
               <th>Kode</th>
               <th>Nama Pelanggan</th>
               <th>Status Order</th>
               <th>Diantar</th>
               <th>Catatan</th>
               <th>Total Harga</th>
               <th>Dibuat</th>
               <th>Opsi</th>
             </thead>
             <tbody>
               @foreach($data as $k => $v)
               <tr>
                 <td>{{($k+1)}}</td>
                 <td>#{{str_pad($v->id,3,0,STR_PAD_LEFT)}}</td>
                 <td>
                   {{$v->gerai_pelanggan->nama}}
                 </td>
                 <td>
                   @if($v->status_order == 6)
                   <span class="badge badge-success">
                     {{$v->status_format($v->status_order)}}
                   </span>
                   @elseif( $v->status_order == 7)
                   <span class="badge badge-danger">
                     {{$v->status_format($v->status_order)}}
                   </span>
                   @else
                   <span class="badge badge-warning">
                     {{$v->status_format($v->status_order)}}
                   </span>
                   @endif
                 </td>
                 <td>{!!$v->booleanQuestion($v->dijemput)!!}</td>
                 <td>{{$v->catatan}}</td>
                 <td>Rp. {{number_format(($v->totalharga))}}</td>
                 <td>{{date("d-m-Y",strtotime($v->dibuat))}}</td>
                 <td>
                   <button type="button" class="btn btn-primary m-2 detail" data-id="{{$v->id}}">Detail Pesanan</button>
                   @if($v->dijemput == 1 && $v->status_order != 6)
                   <a href="{{route("gerai.layanan_selesai",$v->id)}}" class="btn btn-success m-2 selesaikan">Selesaikan</a>
                   @elseif($v->status_order == 1)
                   <a href="{{route("gerai.layanan_diterima",$v->id)}}" class="btn btn-success m-2 selesaikan">Diterima</a>
                   @elseif($v->status_order == 2)
                   <a href="{{route("gerai.layanan_cuci",$v->id)}}" class="btn btn-success m-2 selesaikan">Cuci Sekarang</a>
                   @elseif($v->status_order == 3)
                   @if(strtotime("+3 days",strtotime($v->dibuat)) >= strtotime(date("Y-m-d")))
                   <a href="{{route("gerai.layanan_cuciselesai",$v->id)}}" class="btn btn-success m-2 selesaikan">Pencucian Selesai</a>
                   @endif
                   @elseif($v->status_order == 5)
                   <a href="{{route("gerai.layanan_selesaikanorder",$v->id)}}" class="btn btn-success m-2 selesaikan">Selesaikan Order</a>
                   @elseif($v->status_order == 4 && $v->dijemput == 0 )
                   <a href="{{route("gerai.layanan_selesaikanorder",$v->id)}}" class="btn btn-success m-2 selesaikan">Selesaikan Order</a>
                   @elseif($v->status_order == 7)
                   <a href="{{route("gerai.layanan_selesaikanorder",$v->id)}}" class="btn btn-success m-2 selesaikan">Selesaikan Order</a>
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
    <!-- /.col-md-6 -->
  </div>
@endsection

@section('js')
<script src="{{url("assets2/plugins/ss/canvas2image.js")}}" charset="utf-8"></script>
<script src="{{url("assets2/plugins/ss/html2canvas.min.js")}}" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.3.4/bootbox.min.js" integrity="sha256-uX1dPz3LieQG3DzdBTKHF4e1XzZyeeHTexV6lppnaAc=" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js" integrity="sha256-gJWdmuCRBovJMD9D/TVdo4TIK8u5Sti11764sZT1DhI=" crossorigin="anonymous"></script>
<script type="text/javascript">
  $(document).ready(function() {
    var doc = new jsPDF();
    console.log("Well Done");
    $("#dtable").DataTable({

    });
    $("#dtable").on("click", ".detail_pelanggan", function(event) {
    })
    $("#dtable").on("click",".detail", function(event) {
      id = $(this).data("id");
      console.log(id);
      console.log("Detail");
      var dialog = bootbox.dialog({
          title: 'Detail Pesanan',
          message: '<p align="center"><i class="fa fa-spin fa-spinner"></i> Loading...</p>'
      });
      dialog.init(function(){
        $.get("{{route("gerai.pesanan.api.detail")}}/"+id,function(r){
          if (r.status) {
            dialog.find(".modal-title").html("Detail Pesanan <button class='btn btn-primary' id='print'><li class='fa fa-print'></li></button>");
            var tempLate = [
              "<div class=row id=printArea>",
              "<div class=col-12>",
              "<h4 align='center'>Slip Pesanan</h4>",
              "</div>",
              "<div class=col-md-6>",
              "<div class=form-group>",
              "<label>Nama Konsumen</label>",
              '<div class=input-group>',
              '<div class="input-group-prepend">',
              '<button class="btn btn-primary detail_pelanggan" data-id="'+r.data.gerai_pelanggan_id+'"><li class="fa fa-search"></li></button>',
              '</div>',
              "<input class=form-control value='"+r.data.nama_pelanggan+"' disabled>",
              '</div>',
              "</div>",
              "<div class=form-group>",
              "<label>Status Order</label>",
              "<input class=form-control value='"+r.data.order+"' disabled>",
              "</div>",
              "<div class=form-group>",
              "<label>Diantar</label>",
              "<input class=form-control value='"+((r.data.dijemput == null)?"Belum Di Tentukan":((r.data.dijemput == 1)?"Ya":"Tidak"))+"' disabled>",
              "</div>",
              "</div>",
              "<div class=col-md-6>",
              "<div class=form-group>",
              "<label>Catatan Pesanan</label>",
              "<textarea class=form-control disabled>"+((r.data.catatan != null)?r.data.catatan:"-")+"</textarea>",
              "</div>",
              "<div class=form-group>",
              "<label>Tanggal Pemesanan</label>",
              "<input class=form-control value='"+r.data.dibuat+"' disabled>",
              "</div>",
              "<div class=form-group>",
              "<label>Total Harga</label>",
              "<input class=form-control value='"+r.data.totalharga+"' disabled>",
              "</div>",
              "</div>",
              "<div class=col-md-6>",
              "<div class=form-group>",
              "<label>Driver Penjemputan</label>",
              "<input class=form-control value='"+((r.data.gerai_driver_jemput != null)?r.data.gerai_driver_jemput.nama:"-")+"' disabled>",
              "</div>",
              "<div class=form-group>",
              "<label>Ongkos Jemput</label>",
              "<input class=form-control value='"+((r.data.ongkir_jemput != null)?r.data.ongkir_jemput:"-")+"' disabled>",
              "</div>",
              "</div>",
              "<div class=col-md-6>",
              "<div class=form-group>",
              "<label>Driver Pengantaran</label>",
              "<input class=form-control value='"+((r.data.gerai_driver_antar != null)?r.data.gerai_driver_antar.nama:"-")+"' disabled>",
              "</div>",
              "<div class=form-group>",
              "<label>Ongkos Antar</label>",
              "<input class=form-control value='"+((r.data.ongkir_antar != null)?r.data.ongkir_antar:"-")+"' disabled>",
              "</div>",
              "</div>",
              "<div class='col-md-12 table-responsive'>",
              "<table class='table table-stripped' id='tbs'>",
              "<thead>",
              "<th>No</th>",
              "<th>Nama Layanan</th>",
              "<th>Jumlah Pesan</th>",
              "<th>Subtotal</th>",
              "</thead>",
              "<tbody>",
              "</tbody>",
              "</table>",
              "</div>",
              "</div>",
              ]
            dialog.find('.bootbox-body').html(tempLate.join(""));
            var seq = [];
            $.each(r.data.gerai_order_details, function(index, val) {
              seq.push([(index+1),"["+(val.gerai_layanan.jenis).toUpperCase()+"] "+val.gerai_layanan.nama,val.qty,(val.gerai_layanan.harga*val.qty)])
            });
            dialog.find("#tbs").DataTable({
              data:seq,
              ordering:false,
              searching:false,
              lengthChange:false,
              paging:false,
              bInfo:false
            });
            dialog.find(".detail_pelanggan").on("click",  function(event) {
              id = $(this).data("id");
              console.log(id);
              console.log(id);
              console.log("Detail");
              var dialog = bootbox.dialog({
                  title: 'Detail Pesanan',
                  message: '<p align="center"><i class="fa fa-spin fa-spinner"></i> Loading...</p>'
              });
              dialog.init(async function(){
                    res  = await $.get("{{route("pelanggan.detail")}}/"+id).then();
                    dialog.find(".modal-title").html("Detail Pelanggan");
                    var tempLate = [
                      "<div class=row>",
                      "<div class=col-12>",
                      "<h4 align='center'>Detail Pelanggan</h4>",
                      "</div>",
                      "<div class=col-md-6>",
                      "<div class=form-group>",
                      "<label>Nama Konsumen</label>",
                      "<input class=form-control value='"+res.data.nama+"' disabled>",
                      "</div>",
                      "<div class=form-group>",
                      "<label>Jenis Kelamin</label>",
                      "<input class=form-control value='"+((res.data.jk == 0)?"Laki - Laki":"Perempuan")+"' disabled>",
                      "</div>",
                      "<div class=form-group>",
                      "<label>Alamat</label>",
                      "<textarea disabled class='form-control'>"+res.data.alamat+"</textarea>",
                      "</div>",
                      "</div>",
                      "<div class=col-md-6>",
                      "<div class=form-group>",
                      "<label>Email</label>",
                      "<input class=form-control value='"+res.data.email+"' disabled>",
                      "</div>",
                      "<div class=form-group>",
                      "<label>No HP</label>",
                      "<input class=form-control value='"+res.data.no_hp+"' disabled>",
                      "</div>",
                      "</div>",
                      "</div>",
                      ]
                    dialog.find('.bootbox-body').html(tempLate.join(""));
              });

            })
            dialog.find("#print").on("click", function(event) {
              // printArea = dialog.find("#printArea").get(0);
              // console.log(printArea);
              // html2canvas(printArea).then(function(canvas) {
              //   var canvasWidth = canvas.width;
              //   var canvasHeight = canvas.height;
              //   var img = Canvas2Image.convertToImage(canvas, canvasWidth, canvasHeight);
              //   let type = "png";
              //   let f = "slip";
              //   Canvas2Image.saveAsImage(canvas, canvasWidth, canvasHeight, type, f);
              // });
              doc.text(33, 20, 'Struk Pencucian WENOWCLEAN');
              doc.text(20, 30, '-----------------------------------------------');
              doc.text(20, 40, 'Nama Pelanggan : '+r.data.nama_pelanggan);
              doc.text(20, 50, 'Tanggal Order : '+r.data.dibuat);
              doc.text(20, 60, '-----------------------------------------------');
              step = 10;
              init = 70;
              $.each(r.data.gerai_order_details, function(index, val) {
                // seq.push([(index+1),"["+(val.gerai_layanan.jenis).toUpperCase()+"] "+val.gerai_layanan.nama,val.qty,(val.gerai_layanan.harga*val.qty)])
                doc.text(20, init , "["+(val.gerai_layanan.jenis).toUpperCase()+"] "+val.gerai_layanan.nama+' x'+val.qty+" Rp."+(val.gerai_layanan.harga*val.qty));
                init = init + step;
              });
              init = init + step;
              doc.text(20, init, '-----------------------------------------------');
              init = init + step;
              doc.text(20, init, 'Total Harga : Rp.'+r.data.totalharga);

              // Save the PDF
              doc.save('struk.pdf');
            })
          }
        }).fail(function(){
          alert("Server Error");
        })

      });
    })
  });
</script>
@endsection
