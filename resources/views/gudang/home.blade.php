@extends('layout.app')
@section("title",$title)
@section("content")
<div class="page-header">
  <h1 class="page-title">
    Dashboard
  </h1>
</div>
<div class="row row-cards">
  <div class="col-6 col-sm-4 col-lg-2">
    <div class="card">
      <div class="card-body p-3 text-center">
        <div class="h1 m-0">{{\App\Models\MasterBb::count()}}</div>
        <div class="text-muted mb-4">Bahan Baku</div>
      </div>
    </div>
  </div>
  <div class="col-6 col-sm-4 col-lg-2">
    <div class="card">
      <div class="card-body p-3 text-center">
        <div class="h1 m-0">{{\App\Models\MasterProduk::count()}}</div>
        <div class="text-muted mb-4">Produk</div>
      </div>
    </div>
  </div>
  <div class="col-6 col-sm-4 col-lg-2">
    <div class="card">
      <div class="card-body p-3 text-center">
        <div class="h1 m-0">{{\App\Models\MasterTransportasi::count()}}</div>
        <div class="text-muted mb-4">Transportasi</div>
      </div>
    </div>
  </div>
  <div class="col-6 col-sm-4 col-lg-2">
    <div class="card">
      <div class="card-body p-3 text-center">
        <div class="h1 m-0">{{\App\Models\MasterSuplier::count()}}</div>
        <div class="text-muted mb-4">Suplier</div>
      </div>
    </div>
  </div>
  <div class="col-6 col-sm-4 col-lg-2">
    <div class="card">
      <div class="card-body p-3 text-center">
        <div class="h1 m-0">{{\App\Models\MasterPelanggan::count()}}</div>
        <div class="text-muted mb-4">Pelanggan</div>
      </div>
    </div>
  </div>
  <div class="col-6 col-sm-4 col-lg-2">
    <div class="card">
      <div class="card-body p-3 text-center">
        <div class="h1 m-0">{{\App\Models\Pengguna::count()}}</div>
        <div class="text-muted mb-4">Akun SCM</div>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Aktivitas Pengadaan</h3>
      </div>
      <div id="chart-development-activity" style="height: 10rem"></div>
      <div class="table-responsive">
        <table class="table card-table table-striped table-vcenter">
          <thead>
            <tr>
              <th colspan="2">Kode Pengadaan</th>
              <th>Status</th>
              <th>Tanggal</th>
              <th></th>
            </tr>
          </thead>
          <tbody>

          </tbody>
        </table>
      </div>
    </div>

  </div>
  <div class="col-md-6">
    <div class="row">
        <div class="card p-3">
          <div class="d-flex align-items-center">
            <span class="stamp stamp-md bg-blue mr-3">
              <i class="fe fe-dollar-sign"></i>
            </span>
            <div>
              <h4 class="m-0"><a href="javascript:void(0)">132 <small>Penjualan</small></a></h4>
              <small class="text-muted">12 Menunggu Pembayaran</small>
            </div>
          </div>
        </div>
        <div class="card p-3">
          <div class="d-flex align-items-center">
            <span class="stamp stamp-md bg-green mr-3">
              <i class="fe fe-shopping-cart"></i>
            </span>
            <div>
              <h4 class="m-0"><a href="javascript:void(0)">78 <small>Pemesanan</small></a></h4>
              <small class="text-muted">32 Diselesaikan</small>
            </div>
          </div>
        </div>
        <div class="card p-3">
      <div class="d-flex align-items-center">
        <span class="stamp stamp-md bg-yellow mr-3">
          <i class="fe fe-copy"></i>
        </span>
        <div>
          <h4 class="m-0"><a href="javascript:void(0)">132 <small>Produksi</small></a></h4>
          <small class="text-muted">16 Selesai</small>
        </div>
      </div>
    </div>
    </div>
  </div>
</div>
@endsection
@push("script")
<script type="text/javascript">
  require(['datatables','sweetalert2','c3', 'jquery','jbox','select2','datatables.button','datepicker'], function (datatables,Swal,c3, $,jbox,select2,datepicker) {
    $(document).ready(function(){
      //Chart
      // Init NewPlugin
      $.fn.dataTable.ext.order['dom-checkbox'] = function  ( settings, col )
      {
          return this.api().column( col, {order:'index'} ).nodes().map( function ( td, i ) {
              return $('input', td).prop('checked') ? '1' : '0';
          } );
      }
      var chart = c3.generate({
        bindto: '#chart-development-activity', // id of chart wrapper
        data: {
          columns: [
              // each columns data
            ['data1', 0, 5, 1, 2, 7, 5, 6, 8, 24, 7, 12, 5, 6, 3, 2, 2, 6, 30, 10, 10, 15, 14, 47, 65, 55]
          ],
          type: 'area', // default type of chart
          groups: [
            [ 'data1', 'data2', 'data3']
          ],
          colors: {
            'data1': tabler.colors["blue"]
          },
          names: {
              // name of each serie
            'data1': 'Pengadaan'
          }
        },
        axis: {
          y: {
            padding: {
              bottom: 0,
            },
            show: false,
              tick: {
              outer: false
            }
          },
          x: {
            padding: {
              left: 0,
              right: 0
            },
            show: false
          }
        },
        legend: {
          position: 'inset',
          padding: 0,
          inset: {
                      anchor: 'top-left',
            x: 20,
            y: 8,
            step: 10
          }
        },
        tooltip: {
          format: {
            title: function (x) {
              return '';
            }
          }
        },
        padding: {
          bottom: 0,
          left: -1,
          right: -1
        },
        point: {
          show: false
        }
      });
      console.log("Home Excute . . . .");
      $("#produksimonitoring").on("click", function(event) {
        produksi_html = table(["No","Kode","Jenis","Konf. Perencanaan","Biaya Produksi","Total Produk","Status Produksi","Tanggal Produksi",""],[],"produksi_table");
        console.log(produksi_table);
        var produksi_table = null;
        var produksi = new jBox('Modal', {
          title: 'Data Produksi',
          overlay: false,
          width: '100%',
          responsiveWidth:true,
          height: '600px',
          createOnInit: true,
          content: produksi_html,
          draggable: false,
          adjustPosition: true,
          adjustTracker: true,
          repositionOnOpen: false,
          offset: {
            x: 0,
            y: 0
          },
          repositionOnContent: false,
          onCloseComplete:function(){
            console.log("Destruct Table");
            produksi_table.destroy();
          },
          onCreated:function(rs){
            content = this.content;
            var btn = function(id,konf_perencanaan,status_produksi){
              var item = [];
              item.push('<a class="dropdown-item detail" href="javascript:void(0)" data-id="'+id+'">Detail</a>');
              if (status_produksi == "Menunggu Konfirmasi Gudang") {
                item.push('<a class="dropdown-item terima" href="javascript:void(0)" data-id="'+id+'">Konfirmasi Penerimaan Barang</a>');
              }
              return '<button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle"></button><div class="dropdown-menu dropdown-menu-right">'+item.join("")+'</div>';
            };
            console.log(content);
            produksi_table = content.find("#produksi_table").DataTable({
              ajax:"{{route("gudang.api.produksi_read")}}",
              createdRow:function(r,d,i){
                $("td",r).eq(8).html(btn(d[8],d[3],d[6]));
              }
            });
            $("#produksi_table").on("click", ".detail", async function(event) {
              id = $(this).data("id");
              res = await $.get("{{route("gudang.api.produksi_read")}}/"+id).then();
              var produksi_detail = [
                "<div class=row>",
                "<div class=col-6>",
                "<div class=form-group>",
                "<label>Kode Produksi</label>",
                "<input class=form-control value='"+id+"' disabled/>",
                "</div>",
                "<div class=form-group>",
                "<label>Jenis</label>",
                "<input class=form-control value='"+(res.jenis).toUpperCase()+"' disabled/>",
                "</div>",
                "<div class=form-group>",
                "<label>Konfirmasi Perencanaan</label>",
                "<input class=form-control value='"+(res.konfirmasi_perencanaan_text)+"' disabled/>",
                "</div>",
                "<div class=form-group>",
                "<label>Konfirmasi Direktur</label>",
                "<input class=form-control value='"+(res.konfirmasi_direktur_text)+"' disabled/>",
                "</div>",
                "<div class=form-group>",
                "<label>Konfirmasi Gudang (Penerimaan)</label>",
                "<input class=form-control value='"+(res.konfirmasi_gudang_text)+"' disabled/>",
                "</div>",
                "<div class=form-group>",
                "<label>Status Produksi</label>",
                "<input class=form-control value='"+(res.status_produksi_text)+"' disabled/>",
                "</div>",
                "</div>",
                "<div class=col-6>",
                "<div class=form-group>",
                "<label>Catatan Perencanaan Produksi</label>",
                "<textarea disabled class=form-control>"+((res.catatan_perencanaan == null)?"":res.catatan_perencanaan)+"</textarea>",
                "</div>",
                "<div class=form-group>",
                "<label>Catatan Direktur</label>",
                "<textarea disabled class=form-control>"+((res.catatan_direktur == null)?"":res.catatan_direktur)+"</textarea>",
                "</div>",
                "<div class=form-group>",
                "<label>Catatan Bag. Gudang</label>",
                "<textarea disabled class=form-control>"+((res.catatan_gudang == null)?"":res.catatan_gudang)+"</textarea>",
                "</div>",
                "<div class=form-group>",
                "<label>Tanggal Produksi</label>",
                "<input class=form-control value='"+(res.tgl_register_text)+"' disabled/>",
                "</div>",
                "<div class=form-group>",
                "<label>Tanggal Selesai Produksi</label>",
                "<input class=form-control value='"+((res.tgl_selesai_produksi == null)?"":res.tgl_selesai_produksi)+"' disabled/>",
                "</div>",
                "</div>",
                "<div class=col-12>",
                "<div class=table-responsive>",
                table(["Kode Produk","Nama Produk","Jumlah Produksi","Biaya Produksi"],[],"list_produksi"),
                "</div>",
                "</div>",
                "</div>",
              ];
              console.log(id);
              m = new jBox('Modal', {
                title: 'Detail Produksi',
                overlay: false,
                width: '50%',
                responsiveWidth:true,
                height: '600px',
                createOnInit: true,
                content: produksi_detail.join(""),
                draggable: false,
                adjustPosition: true,
                adjustTracker: true,
                repositionOnOpen: false,
                offset: {
                  x: 0,
                  y: 0
                },
                repositionOnContent: false,
                onCloseComplete:function(){
                  console.log("Destruct Table");
                  produksi_table.ajax.reload();
                },
                onCreated:function(rs){
                  kt = this.content;
                  dt = [];
                  total = 0;
                  $.each(res.produksi__details,function(i,el) {

                  });
                  $.each(res.produksi__details,function(i,el) {
                    ttotal = 0;
                    total = 0;
                    $.each(el.master_produk.master__komposisis, function(index, val) {
                      ttotal = ttotal + ((val.harga_bahan * val.jumlah)*val.rasio);
                    });
                    total = (ttotal*el.jumlah);
                    dt.push([el.master_produk.id_produk,el.master_produk.nama_produk,el.jumlah,number_format(total)]);
                  });
                  kt.find("#list_produksi").attr("width","100%");
                  kt.find("#list_produksi").DataTable({
                    data:dt
                  })
                }});
                m.open();
            });
            $("#produksi_table").on("click", ".terima", function(event) {
              id = $(this).data("id");
              // gudang.api.produksi_update
              Swal.fire({
                title: 'Apakah Anda Yakin ? ',
                text: "Silahkan Isi Harga Distribusi (Harga Produksi + [N] % ) Dalam Bentuk Persen",
                type: 'warning',
                input:"number",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya'
              }).then( async (result) => {
                if (result.value) {
                  res = await $.post("{{route("gudang.api.produksi_update")}}/"+id+"/"+result.value,{status_produksi:5,konfirmasi_gudang:1,tgl_kon_gudang:"{{date("Y-m-d")}}"}).then();
                  if (res.status == 1) {
                    new jBox('Notice', {content: "Sukses Update Status",showCountdown:true, color: 'green'});
                  }else {
                    new jBox('Notice', {content: "Gagal Update Status",showCountdown:true, color: 'red'});
                  }
                  produksi_table.ajax.reload();
                }
              });
            });
          }
        });
        instance = produksi.open();

      })
      $("#mastersatuan").on('click',function(event) {
        event.preventDefault();
        tabel_satuan = table(["No","Nama Satuan",""],[],"mastersatuan_table");
        var mastersatuan_table = null;
        var master_satuan = new jBox('Modal', {
          title: 'Data Satuan',
          overlay: false,
          width: '500px',
          responsiveWidth:true,
          height: '500px',
          createOnInit: true,
          content: tabel_satuan,
          draggable: false,
          adjustPosition: true,
          adjustTracker: true,
          repositionOnOpen: false,
          offset: {
            x: 0,
            y: 0
          },
          repositionOnContent: false,
          onCloseComplete:function(){
            console.log("Destruct Table");
            mastersatuan_table.destroy();
          },
          onCreated:function(rs){
            content = this.content;
            mastersatuan_table = content.find("#mastersatuan_table").DataTable({
              dom: 'Bfrtip',
              ajax:"{{route("gudang.api.master_satuan_read")}}",
              buttons: [
                  {
                      className: "btn btn-success",
                      text: 'Tambah Satuan',
                      action: function ( e, dt, node, config ) {
                        frm = [
                          [
                            {
                              label:"Nama Satuan",
                              type:"text",
                              name:"nama_satuan"
                            }
                          ]
                        ];
                        btn = {name:"Simpan",class:"success",type:"submit"};
                        formSatuan = builder(frm,btn,"createSatuan",true,12);
                        set = new jBox('Modal', {
                          title: 'Tambah Satuan',
                          overlay: false,
                          width: '500px',
                          responsiveWidth:true,
                          height: '500px',
                          createOnInit: true,
                          content: formSatuan,
                          draggable: false,
                          adjustPosition: true,
                          adjustTracker: true,
                          repositionOnOpen: false,
                          offset: {
                            x: 0,
                            y: 0
                          },
                          repositionOnContent: false,
                          onCloseComplete:function(){
                            console.log("Reloading Tabel");
                            mastersatuan_table.ajax.reload();
                          },
                          onCreated:function(){
                            console.log("Initialize");
                            html = this.content;
                            html.find("#updateSatuan").on('submit',function(event) {
                              event.preventDefault();
                              dform = $(this).serializeArray();
                              id = html.find("#id").val();
                              console.log(dform);
                              on();
                              $.ajax({
                                url: '{{route("gudang.api.master_satuan_update")}}/'+id,
                                type: 'POST',
                                dataType: 'json',
                                data: dform
                              })
                              .done(function(rs) {

                                if (rs.status == 1) {
                                  new jBox('Notice', {content: 'Data Sukses Tersimpan',showCountdown:true, color: 'green'});
                                }else {
                                  new jBox('Notice', {content: 'Gagal Simpan Data',showCountdown:true, color: 'red'});
                                }
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
                              })
                              .always(function() {
                                off();
                                set.close();
                              });

                            });
                            html.find("#createSatuan").on('submit',function(event) {
                              event.preventDefault();
                              dform = $(this).serializeArray();
                              console.log(dform);
                              on();
                              $.ajax({
                                url: '{{route("gudang.api.master_satuan_insert")}}',
                                type: 'POST',
                                dataType: 'json',
                                data: dform
                              })
                              .done(function(rs) {

                                if (rs.status == 1) {
                                  new jBox('Notice', {content: 'Data Sukses Tersimpan',showCountdown:true, color: 'green'});
                                }else {
                                  new jBox('Notice', {content: 'Gagal Simpan Data',showCountdown:true, color: 'red'});
                                }
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
                              })
                              .always(function() {
                                off();
                                set.close();
                              });

                            });
                          }
                        });
                        set.open();
                      }
                  }
              ]
            });

            content.find("#mastersatuan_table").on('click','.edit',function(event) {
              event.preventDefault();
              id = $(this).data("id");
              nama = $(this).data("nama");
              frm = [
                [
                  {
                    label:"Nama Satuan",
                    type:"text",
                    name:"nama_satuan",
                    value:nama
                  },{
                    label:"",
                    type:"hidden",
                    id:"id",
                    name:"",
                    value:id
                  }
                ]
              ];
              btn = {name:"Ubah",class:"warning",type:"submit"};
              formSatuan = builder(frm,btn,"updateSatuan",true,12);
              set = new jBox('Modal', {
                title: 'Ubah Satuan',
                overlay: false,
                width: '500px',
                responsiveWidth:true,
                height: '500px',
                createOnInit: true,
                content: formSatuan,
                draggable: false,
                adjustPosition: true,
                adjustTracker: true,
                repositionOnOpen: false,
                offset: {
                  x: 0,
                  y: 0
                },
                repositionOnContent: false,
                onCloseComplete:function(){
                  console.log("Reloading Tabel");
                  mastersatuan_table.ajax.reload();
                },
                onCreated:function(){
                  console.log("Initialize");
                  html = this.content;
                  html.find("#updateSatuan").on('submit',function(event) {
                    event.preventDefault();
                    dform = $(this).serializeArray();
                    id = html.find("#id").val();
                    console.log(dform);
                    on();
                    $.ajax({
                      url: '{{route("gudang.api.master_satuan_update")}}/'+id,
                      type: 'POST',
                      dataType: 'json',
                      data: dform
                    })
                    .done(function(rs) {

                      if (rs.status == 1) {
                        new jBox('Notice', {content: 'Data Sukses Tersimpan',showCountdown:true, color: 'green'});
                      }else {
                        new jBox('Notice', {content: 'Gagal Simpan Data',showCountdown:true, color: 'red'});
                      }
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
                    })
                    .always(function() {
                      off();
                      set.close();
                    });

                  });
                  html.find("#createSatuan").on('submit',function(event) {
                    event.preventDefault();
                    dform = $(this).serializeArray();
                    console.log(dform);
                    on();
                    $.ajax({
                      url: '{{route("gudang.api.master_satuan_insert")}}',
                      type: 'POST',
                      dataType: 'json',
                      data: dform
                    })
                    .done(function(rs) {

                      if (rs.status == 1) {
                        new jBox('Notice', {content: 'Data Sukses Tersimpan',showCountdown:true, color: 'green'});
                      }else {
                        new jBox('Notice', {content: 'Gagal Simpan Data',showCountdown:true, color: 'red'});
                      }
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
                    })
                    .always(function() {
                      off();
                      set.close();
                    });

                  });
                }
              });
              set.open();
            });
          }
        });
        instance = master_satuan.open();

      });
      $("#masterbb").on('click',function(event) {
        event.preventDefault();
        tabel_bahanbaku = table(["Kode","Nama","Stok","Stok Minimum","Harga","Tanggal Register",""],[],"masterbb_table");
        var masterbb_table = null;
        var master_bb = new jBox('Modal', {
          title: 'Data Bahan Baku',
          overlay: false,
          width: '1000px',
          responsiveWidth:true,
          height: '500px',
          createOnInit: true,
          content: tabel_bahanbaku,
          draggable: false,
          adjustPosition: true,
          adjustTracker: true,
          repositionOnOpen: false,
          offset: {
            x: 0,
            y: 0
          },
          repositionOnContent: false,
          onCloseComplete:function(){
            console.log("Destruct Table");
            masterbb_table.destroy();
          },
          onCreated:function(rs){
            content = this.content;
            console.log(content);
            masterbb_table = content.find("#masterbb_table").DataTable({
              ajax:"{{route("gudang.api.master_bb_read")}}",
              dom: 'Bfrtip',
              buttons: [
                  {
                      className: "btn btn-success",
                      text: 'Tambah Bahan Baku',
                      action: function ( e, dt, node, config ) {
                        frm = [
                          [
                            {
                              label:"Nama Bahan",
                              type:"text",
                              name:"nama"
                            },{
                              label:"Stok Minimum",
                              type:"text",
                              name:"stok_minimum"
                            },{
                              label:"Harga",
                              type:"text",
                              name:"harga"
                            },{
                              label:"Satuan",
                              type:"select2",
                              name:"id_satuan",
                              id:"id_satuan",
                            }
                          ]
                        ];
                        btn = {name:"Simpan",class:"success",type:"submit"};
                        formSatuan = builder(frm,btn,"create",true,12);
                        set = new jBox('Modal', {
                          title: 'Tambah Bahan Baku',
                          overlay: false,
                          width: '500px',
                          responsiveWidth:true,
                          height: '500px',
                          createOnInit: true,
                          content: formSatuan,
                          draggable: false,
                          adjustPosition: true,
                          adjustTracker: true,
                          repositionOnOpen: false,
                          offset: {
                            x: 0,
                            y: 0
                          },
                          repositionOnContent: false,
                          onCloseComplete:function(){
                            console.log("Reloading Tabel");
                            masterbb_table.ajax.reload();
                          },
                          onCreated:function(){
                            console.log("Initialize");
                            html = this.content;
                            // html.find("#id_satuan").select2({
                            // });
                            $.get("{{route("gudang.api.master_satuan_read")}}/all",function(rs){
                              selectbuilder(rs,html.find("#id_satuan"))
                            });
                            html.find("#update").on('submit',function(event) {
                              event.preventDefault();
                              dform = $(this).serializeArray();
                              id = html.find("#id").val();
                              console.log(dform);
                              on();
                              $.ajax({
                                url: '{{route("gudang.api.master_bb_update")}}/'+id,
                                type: 'POST',
                                dataType: 'json',
                                data: dform
                              })
                              .done(function(rs) {

                                if (rs.status == 1) {
                                  new jBox('Notice', {content: 'Data Sukses Tersimpan',showCountdown:true, color: 'green'});
                                }else {
                                  new jBox('Notice', {content: 'Gagal Simpan Data',showCountdown:true, color: 'red'});
                                }
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
                              })
                              .always(function() {
                                off();
                                set.close();
                              });

                            });
                            html.find("#create").on('submit',function(event) {
                              event.preventDefault();
                              dform = $(this).serializeArray();
                              console.log(dform);
                              on();
                              $.ajax({
                                url: '{{route("gudang.api.master_bb_insert")}}',
                                type: 'POST',
                                dataType: 'json',
                                data: dform
                              })
                              .done(function(rs) {

                                if (rs.status == 1) {
                                  new jBox('Notice', {content: 'Data Sukses Tersimpan',showCountdown:true, color: 'green'});
                                }else {
                                  new jBox('Notice', {content: 'Gagal Simpan Data',showCountdown:true, color: 'red'});
                                }
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
                              })
                              .always(function() {
                                off();
                                set.close();
                              });

                            });

                          }
                        });
                        set.open();
                      }
                  }
              ]
            });
            content.find("#masterbb_table").on('click','.edit',function(event) {
              event.preventDefault();
              id = $(this).data("id");
              $.get("{{route("gudang.api.master_bb_read")}}/"+id,function(rs){
                frm = [
                  [
                    {
                      label:"Nama Bahan",
                      type:"text",
                      name:"nama",
                      value:rs.nama
                    },{
                      label:"Stok Minimum",
                      type:"text",
                      name:"stok_minimum",
                      value:rs.stok_minimum
                    },{
                      label:"Harga",
                      type:"text",
                      name:"harga",
                      value:rs.harga
                    },{
                      label:"Satuan",
                      type:"select2",
                      name:"id_satuan",
                      id:"id_satuan"
                    }
                  ]
                ];
                btn = {name:"Ubah",class:"warning",type:"submit"};
                formSatuan = builder(frm,btn,"update",true,12);
                set = new jBox('Modal', {
                  title: 'Ubah Bahan Baku',
                  overlay: false,
                  width: '500px',
                  responsiveWidth:true,
                  height: '500px',
                  createOnInit: true,
                  content: formSatuan,
                  draggable: false,
                  adjustPosition: true,
                  adjustTracker: true,
                  repositionOnOpen: false,
                  offset: {
                    x: 0,
                    y: 0
                  },
                  repositionOnContent: false,
                  onCloseComplete:function(){
                    console.log("Reloading Tabel");
                    masterbb_table.ajax.reload();
                  },
                  onCreated:function(){
                    console.log("Initialize");
                    html = this.content;
                    $.get("{{route("gudang.api.master_satuan_read")}}/all",function(rsa){
                      itsMe = {};
                      for (var i = 0; i < rsa.length; i++) {
                        if (rs.id_satuan == rsa[i].value) {
                          itsMe = {value:rs.id_satuan,text:rsa[i].value};
                          break;
                        }
                      }
                      selectbuilder(rsa,html.find("#id_satuan"),itsMe);
                    });
                    html.find("#update").on('submit',function(event) {
                      event.preventDefault();
                      dform = $(this).serializeArray();
                      console.log(dform);
                      on();
                      $.ajax({
                        url: '{{route("gudang.api.master_bb_update")}}/'+id,
                        type: 'POST',
                        dataType: 'json',
                        data: dform
                      })
                      .done(function(rs) {

                        if (rs.status == 1) {
                          new jBox('Notice', {content: 'Data Sukses Tersimpan',showCountdown:true, color: 'green'});
                        }else {
                          new jBox('Notice', {content: 'Gagal Simpan Data',showCountdown:true, color: 'red'});
                        }
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
                      })
                      .always(function() {
                        off();
                        set.close();
                      });

                    });
                  }
                });
                set.open();
              });
            });
          }
        });
        instance = master_bb.open();

      });
      $("#mastersuplier").on('click',function(event) {
        event.preventDefault();
          tabel_suplier = table(["Kode","Nama Suplier","No Kontak","Email","Alamat","Ket","Tanggal Buat",""],[],"mastersuplier_table");
        var mastersuplier_table = null;
        var mastersuplier = new jBox('Modal', {
          title: 'Data Suplier',
          overlay: false,
          width: '1200px',
          responsiveWidth:true,
          height: '500px',
          createOnInit: true,
          content: tabel_suplier,
          draggable: false,
          adjustPosition: true,
          adjustTracker: true,
          repositionOnOpen: false,
          offset: {
            x: 0,
            y: 0
          },
          repositionOnContent: false,
          onCloseComplete:function(){
            console.log("Destruct Table");
            mastersuplier_table.destroy();
          },
          onCreated:function(rs){
            content = this.content;
            console.log(content);
            mastersuplier_table = content.find("#mastersuplier_table").DataTable({
              ajax:"{{route("gudang.api.master_suplier_read")}}",

            });
            content.find("#mastersuplier_table").on('click','.edit',function(event) {
              event.preventDefault();
              new jBox('Notice', {content: 'Anda Tidak Berhak Mengakses Fitur Ini',showCountdown:true, color: 'red'});
            });
          }
        });
        instance = mastersuplier.open();

      });
      $("#masterproduk").on('click',function(event) {
        event.preventDefault();
        tabel_suplier = table(["Kode","Nama Produk","Stok","Stok Minimum","Deskripsi","Harga Produksi","Harga Distribusi","Tanggal Perubahan","Tanggal Register",""],[],"masterproduk_table");
        var masterproduk_table = null;
        var masterproduk = new jBox('Modal', {
          title: 'Data Produk',
          overlay: false,
          width: '1400px',
          responsiveWidth:true,
          height: '500px',
          createOnInit: true,
          content: tabel_suplier,
          draggable: false,
          adjustPosition: true,
          adjustTracker: true,
          repositionOnOpen: false,
          offset: {
            x: 0,
            y: 0
          },
          repositionOnContent: false,
          onCloseComplete:function(){
            console.log("Destruct Table");
            masterproduk_table.destroy();
          },
          onCreated:function(rs){
            content = this.content;
            console.log(content);
            masterproduk_table = content.find("#masterproduk_table").DataTable({
              ajax:"{{route("gudang.api.master_produk_read")}}",
              dom: 'Bfrtip',
              buttons: [
                  {
                      className: "btn btn-success",
                      text: 'Tambah Produk',
                      action: function ( e, dt, node, config ) {
                        frm = [
                          [
                            {
                              label:"Nama Produk",
                              type:"text",
                              name:"nama_produk",
                            },{
                              label:"Stok Awal",
                              type:"text",
                              name:"stok",
                            },{
                              label:"Stok Minimum",
                              type:"text",
                              name:"stok_minimum",
                            },{
                              label:"Harga Produksi / Modal",
                              type:"text",
                              name:"harga_produksi",
                            },{
                              label:"Harga Distribusi / Jual",
                              type:"text",
                              name:"harga_distribusi",
                            },{
                              label:"Deskripsi",
                              type:"textarea",
                              name:"deskripsi",
                            },{
                              label:"Satuan",
                              type:"select2",
                              name:"id_satuan",
                              id:"id_satuan",
                            }
                          ]
                        ];

                        btn = {name:"Simpan",class:"success",type:"submit"};
                        formSatuan = builder(frm,btn,"create",true,12);
                        set = new jBox('Modal', {
                          title: 'Tambah Produk',
                          overlay: false,
                          width: '500px',
                          responsiveWidth:true,
                          height: '500px',
                          createOnInit: true,
                          content: formSatuan,
                          draggable: false,
                          adjustPosition: true,
                          adjustTracker: true,
                          repositionOnOpen: false,
                          offset: {
                            x: 0,
                            y: 0
                          },
                          repositionOnContent: false,
                          onCloseComplete:function(){
                            console.log("Reloading Tabel");
                            masterproduk_table.ajax.reload();
                          },
                          onCreated:function(){
                            console.log("Initialize");
                            html = this.content;
                            // html.find("#id_satuan").select2({
                            // });

                            $.get("{{route("gudang.api.master_satuan_read")}}/all",function(rs){
                              selectbuilder(rs,html.find("#id_satuan"))
                            });
                            html.find("#create").on('submit',function(event) {
                              event.preventDefault();
                              dform = $(this).serializeArray();
                              console.log(dform);
                              on();
                              $.ajax({
                                url: '{{route("gudang.api.master_produk_insert")}}',
                                type: 'POST',
                                dataType: 'json',
                                data: dform
                              })
                              .done(function(rs) {

                                if (rs.status == 1) {
                                  new jBox('Notice', {content: 'Data Sukses Tersimpan',showCountdown:true, color: 'green'});
                                }else {
                                  new jBox('Notice', {content: 'Gagal Simpan Data',showCountdown:true, color: 'red'});
                                }
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
                              })
                              .always(function() {
                                off();
                                set.close();
                              });

                            });

                          }
                        });
                        set.open();
                      }
                  }
              ]
            });
            content.find("#masterproduk_table").on('click','.edit',function(event) {
              event.preventDefault();
              id = $(this).data("id");
              $.get("{{route("gudang.api.master_produk_read")}}/"+id,function(rs){
                frm = [
                  [
                    {
                      label:"Nama Produk",
                      type:"text",
                      name:"nama_produk",
                      value:rs.nama_produk
                    },{
                      label:"Stok Minimum",
                      type:"text",
                      name:"stok_minimum",
                      value:rs.stok_minimum
                    },{
                      label:"Deskripsi",
                      type:"textarea",
                      name:"deskripsi",
                      value:rs.deskripsi
                    },{
                      label:"Harga Produksi / Modal",
                      type:"text",
                      name:"harga_produksi",
                      value:rs.harga_produksi
                    },{
                      label:"Harga Distribusi / Jual",
                      type:"text",
                      name:"harga_distribusi",
                      value:rs.harga_distribusi
                    },{
                      label:"Satuan",
                      type:"select2",
                      name:"id_satuan",
                      id:"id_satuan",
                    }
                  ]
                ];
                btn = {name:"Ubah",class:"warning",type:"submit"};
                formSatuan = builder(frm,btn,"update",true,12);
                set = new jBox('Modal', {
                  title: 'Ubah Produk',
                  overlay: false,
                  width: '500px',
                  responsiveWidth:true,
                  height: '500px',
                  createOnInit: true,
                  content: formSatuan,
                  draggable: false,
                  adjustPosition: true,
                  adjustTracker: true,
                  repositionOnOpen: false,
                  offset: {
                    x: 0,
                    y: 0
                  },
                  repositionOnContent: false,
                  onCloseComplete:function(){
                    console.log("Reloading Tabel");
                    masterproduk_table.ajax.reload();
                  },
                  onCreated:function(){
                    console.log("Initialize");
                    html = this.content;
                    selectIt = null;
                    $.get("{{route("gudang.api.master_satuan_read")}}/all",function(rsa){
                      var namanya = "Tidak Diketahui";
                      for (var i = 0; i < rsa.length; i++) {
                        if(rsa[i].value == rs.id_satuan){
                          var namanya = rsa[i].text;
                          break;
                        }
                      }
                      selectbuilder(rsa,html.find("#id_satuan"),[{value:rs.id_satuan,text:namanya}])
                    });
                    html.find("#update").on('submit',function(event) {
                      event.preventDefault();
                      dform = $(this).serializeArray();
                      console.log(dform);
                      on();
                      $.ajax({
                        url: '{{route("gudang.api.master_produk_update")}}/'+id,
                        type: 'POST',
                        dataType: 'json',
                        data: dform
                      })
                      .done(function(rs) {
                        if (rs.status == 1) {
                          new jBox('Notice', {content: 'Data Sukses Tersimpan',showCountdown:true, color: 'green'});
                        }else {
                          new jBox('Notice', {content: 'Gagal Simpan Data',showCountdown:true, color: 'red'});
                        }
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
                      })
                      .always(function() {
                        off();
                        set.close();
                      });

                    });
                  }
                });
                set.open();
              });
            });
            content.find("#masterproduk_table").on('click','.komposisi',function(event) {
              event.preventDefault();
              id = $(this).data("id");
              var masterkomposisi_table = null;
              var tabel_komposisi =  table(["No","Nama Bahan","Jumlah Bahan","Rasio","Total Harga","Tanggal Register",""],[],"masterkomposisi_table");
              set_start =  new jBox('Modal', {
                title: 'Data Komposisi Produk',
                overlay: false,
                width: '1400px',
                responsiveWidth:true,
                height: '500px',
                createOnInit: true,
                content: tabel_komposisi,
                draggable: false,
                adjustPosition: true,
                adjustTracker: true,
                repositionOnOpen: false,
                offset: {
                  x: 0,
                  y: 0
                },
                repositionOnContent: false,
                onCloseComplete:function(){
                  console.log("Destruct Table");
                  masterkomposisi_table.destroy();
                },
                onCreated:function(rs){
                  content_komposisi = this.content;
                  console.log(content_komposisi);
                  masterkomposisi_table = content_komposisi.find("#masterkomposisi_table").DataTable({
                    ajax:"{{route("gudang.api.master_komposisi_read")}}/"+id,
                  });
                  content_komposisi.find("#masterkomposisi_table").on('click', '.hapus', function(event) {
                    event.preventDefault();
                    new jBox('Notice', {content: 'Anda Tidak Bisa Mengakses Fitur Ini',showCountdown:true, color: 'red'});
                  });
                }
              });
              set_start.open();
              // $.get("{{route("gudang.api.master_komposisi_read")}}/"+id,function(rs){
              //
              // });
            });
          }
        });
        instance = masterproduk.open();
      });

      $("#pbahanbaku").on('click', function(event) {
        event.preventDefault();
        tabel_satuan = table(["No","Kode","Suplier","Status Pengadaan","Konf. Direktur","Konf. Gudang","Catatan Gudang","Catatan Direktur","Tgl Dibuat","Tgl Diubah",""],[],"pbahanbaku_table");
        var mastersatuan_table = null;
        var master_satuan = new jBox('Modal', {
          title: 'Data Pengadaan Bahan Baku',
          overlay: false,
          width: '100%',
          responsiveWidth:true,
          height: '500px',
          createOnInit: true,
          content: tabel_satuan,
          draggable: false,
          adjustPosition: true,
          adjustTracker: true,
          repositionOnOpen: false,
          offset: {
            x: 0,
            y: 0
          },
          repositionOnContent: false,
          onCloseComplete:function(){
            console.log("Destruct Table");
            mastersatuan_table.destroy();
          },
          onCreated:function(rs){
            content = this.content;
            mastersatuan_table = content.find("#pbahanbaku_table").DataTable({
              ajax:"{{route("gudang.api.pbahanabaku_read")}}",
            });
            content.find("#pbahanbaku_table").on('click','.rincian',function(event) {
              event.preventDefault();
              id = $(this).data("id");
              console.log("Rincian ID "+id);
              on();
              $.ajax({
                url: '{{route("gudang.api.pbahanabaku_read")}}/'+id,
                type: 'GET',
                dataType: 'JSON'
              })
              .done(function(rs) {
                if (rs.status == 1) {
                  modal = new jBox('Modal', {
                    title: 'Rincian Pengadaan ['+rs.data.id_pengadaan_bb+']',
                    overlay: false,
                    width: '100%',
                    responsiveWidth:true,
                    height: '500px',
                    createOnInit: true,
                    content: null,
                    draggable: false,
                    adjustPosition: true,
                    adjustTracker: true,
                    repositionOnOpen: false,
                    offset: {
                      x: 0,
                      y: 0
                    },
                    repositionOnContent: false,
                    onCloseComplete:function(){
                      console.log("Destruct Table");

                    },
                    onCreated:function(x){
                      var subtotal = 0;
                      for (var i = 0; i < rs.data.pengadaan__bb_details.length; i++) {
                        subtotal = subtotal + (rs.data.pengadaan__bb_details[i].harga*rs.data.pengadaan__bb_details[i].jumlah);
                      }
                      frm = [
                        [
                          {
                            label:"Kode Pengadaaan",
                            type:"readonly",
                            value:rs.data.id_pengadaan_bb
                          },{
                            label:"Suplier",
                            type:"readonly",
                            value:"["+rs.data.id_suplier+"] "+rs.data.master_suplier.nama_suplier
                          },{
                            label:"Keterangan Suplier",
                            type:"textarea",
                            value:rs.data.master_suplier.ket
                          },{
                            label:"Status Pengadaan",
                            type:"readonly",
                            value:status_pengadaan(rs.data.status_pengadaan)
                          },{
                            label:"Tanggal Dibuat",
                            type:"readonly",
                            value:rs.data.tgl_register
                          },{
                            label:"Perkiraan Tiba",
                            type:"readonly",
                            value:rs.data.perkiraan_tiba
                          },{
                            label:"Tanggal Penerimaan Barang",
                            type:"readonly",
                            value:rs.data.tgl_diterima
                          }
                        ],[
                          {
                            label:"Konfirmasi Direktur",
                            type:"readonly",
                            value:konfirmasi(rs.data.konfirmasi_direktur)
                          },{
                            label:"Konfirmasi Gudang",
                            type:"readonly",
                            value:konfirmasi(rs.data.konfirmasi_gudang)
                          },{
                              label:"Catatan Gudang",
                              type:"textarea",
                              value:rs.data.catatan_gudang
                            },{
                              label:"Catatan Pengadaan",
                              type:"textarea",
                              value:rs.data.catatan_pengadaan
                            },{
                              label:"Catatan Direktur",
                              type:"textarea",
                              value:rs.data.catatan_direktur
                            },{
                              label:"Perkiraan Tiba",
                              type:"readonly",
                              value:rs.data.perkiraan_tiba
                            },{
                              label:"Subtotal Pemesanan",
                              type:"readonly",
                              value:"Rp. "+subtotal
                            },
                        ]
                      ];
                      build_frm = builder(frm,null,"rincian_display",true,6);
                      dtas = [];
                      for (var i = 0; i < rs.data.pengadaan__bb_details.length; i++) {
                        dtas[i] = [rs.data.pengadaan__bb_details[i].id_bb,rs.data.pengadaan__bb_details[i].master_bb.nama,rs.data.pengadaan__bb_details[i].master_bb.stok+" "+rs.data.pengadaan__bb_details[i].master_bb.master_satuan.nama_satuan,rs.data.pengadaan__bb_details[i].harga,rs.data.pengadaan__bb_details[i].jumlah];
                      }
                      console.log(dtas);
                      tabel_bahanbaku_isi = table(["Kode Bahan","Nama Bahan","Stok","Harga","Jumlah"],dtas,"tbl_s");
                      build_frm = "<div class='row'><div class='col-md-12'>"+build_frm+"</div><div class='col-md-12'><hr><h4>Data Bahan</h4></div><div class='col-md-12'>"+tabel_bahanbaku_isi+"</div></div>"
                      this.setContent(build_frm);
                      konten = this.content;
                      konten.find("textarea").attr("disabled",true);
                      konten.find("#tbl_s").DataTable({

                      });
                    }
                  });
                  modal.open();
                }else {
                  new jBox('Notice', {content: 'Data Tidak Ditemukan',showCountdown:true, color: 'red'});
                }
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
              })
              .always(function() {
                off();
                mastersatuan_table.ajax.reload();
              });

            });
            content.find("#pbahanbaku_table").on('click', '.terima_barang', function(event) {
              event.preventDefault();
              console.log($(this).data("id"));
              var id = $(this).data("id");
              var tibalah = $(this).data("tiba");
              html = [
                "<form class=form-horizontal method=post onsubmit=return false >",
                "<div class=form-group>",
                "<label>Tanggal Penerimaan *</label>",
                "<input class=form-control name=tgl_penerimaan id=datepicker value={{date("Y-m-d")}} required />",
                "</div>",
                "</form>"
              ]
              Swal.fire({
                title: 'Isilah Bidang Yang Diperlukan',
                type: 'warning',
                html: html.join(""),
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Konfirmasi',
                onOpen: function() {
                    var date_start = tibalah;
                    console.log("Waktu Restrict = "+date_start);
                    $('#datepicker').datepicker({
                      startDate: date_start,
                      format:"yyyy-m-d"
                    });
                },
              }).then((result) => {
                if (result.value) {
                  date = $("#datepicker").val();
                  console.log("Date Assigned : "+date);
                  Swal.fire({
                    title:"Harap Diperhatikan",
                    type:"warning",
                    html:"<p align=center style=color:red>Penerimaan Barang Harus Memiliki Kuantitas Yang Sama Dengan Rincian Pengadaan ! Tidak ada penerimaan sebagian terkecuali ada kondisi khusus, silahkan isi catatan kondisi khusus di bawah ini</p><div class=form-group><textarea class=form-control id=alasan ></textarea>",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya Saya Mengerti',
                  }).then((res)=>{
                    if (res.value) {
                      catatan = $("#alasan").val();
                      console.log("Catatan "+catatan);
                      var postdata = {tgl_diterima:date,status_pengadaan:6,dibaca_direktur:0,dibaca_pengadaan:0,konfirmasi_gudang:1,catatan_gudang:catatan,tgl_perubahan:"{{date("Y-m-d")}}"};
                      console.log(postdata);
                      on();
                      $.post("{{route("gudang.api.pbahanabaku_konfirmasi")}}/"+id,postdata,function(r){
                        if (r.status == 1) {
                          new jBox('Notice', {content: r.msg,showCountdown:true, color: 'green'});
                          var msg = "";
                          $.each(r.fail,function(index,item){
                            msg += item.nama+" Dengan ID "+item.id+" "+item.msg+"<br>";
                          });
                          if (r.fail.length > 0) {
                            Swal.fire({
                              type: 'error',
                              title: 'Beberapa Barang Bermasalah . . ',
                              html: msg,
                              footer: '<a href>Laporkan Error</a>'
                            })
                          }
                          off();
                          mastersatuan_table.ajax.reload();
                        }else {
                          new jBox('Notice', {content: r.msg,showCountdown:true, color: 'red'});
                          off();
                          mastersatuan_table.ajax.reload();
                        }
                      }).fail(function(rs){
                        off();
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
                      });
                    }
                  });
                  // Swal.fire(
                  //   'Deleted!',
                  //   'Your file has been deleted.',
                  //   'success'
                  // )

                }
              })
            });
            content.find("#pbahanbaku_table").on('click', '.retur', function(event) {
              event.preventDefault();
                  idpo = $(this).data("id");
                  console.log(idpo);
                  on();
                  function creator() {
                    tbl_init = table(["Kode Barang","Nama Barang","Total Pesan"],[],"tbl_init");
                    frm = [
                      "<div class=row>",
                      "<div class=col-md-12>",
                      "<div class=form-group>",
                      "<button class='btn btn-primary' id=returkan>Ajukan Retur</button>",
                      "</div>",
                      "<div class=table-responsive>",
                      tbl_init,
                      "<div>",
                      "</div>",
                      "</div>",
                    ];
                    modal = new jBox('Modal', {
                      title: 'Formulir Retur Barang ['+idpo+']',
                      overlay: false,
                      width: '600px',
                      responsiveWidth:true,
                      height: '500px',
                      createOnInit: true,
                      content: frm.join(""),
                      draggable: false,
                      adjustPosition: true,
                      adjustTracker: true,
                      repositionOnOpen: false,
                      offset: {
                        x: 0,
                        y: 0
                      },
                      repositionOnContent: false,
                      onCloseComplete:function(){
                        console.log("Destruct Table");
                        nginit.destroy();
                      },
                      onCreated:function(x){
                        konte = this.content;
                        nginit = konte.find("#tbl_init").DataTable({
                          ajax:'{{route("gudang.api.pbahanbakugudangretur_poread")}}/'+idpo
                        });
                        konte.find("#returkan").on('click', function(event) {
                          event.preventDefault();
                          dform_bahan = [];
                          $.each(konte.find("#tbl_init .listcheck"),function(index, el) {
                            obj = $(el);
                            cek = obj.is(':checked');
                            if (cek) {
                              dform_bahan.push({id_pbb:obj.data("id"),nama:obj.data("nama"),jumlah:obj.data("jumlah"),kode_barang:obj.data("kode_barang")});
                            }
                          });
                          console.log(dform_bahan);
                          modal.close();
                          compact = [];
                          $.each(dform_bahan,function(index, el) {
                            compact[index] = [el.kode_barang,el.nama,el.jumlah,"<input hidden  name=id_pbb[] value="+el.id_pbb+" required /><input class=form-control  name=total_retur[] type=number min=1 max="+el.jumlah+" required />","<textarea class=form-control name=rincian_retur[] ></textarea>"];
                          });
                          tbl_init2 = table(["Kode Barang","Nama Barang","Total Pesan","Jumlah Retur","Rincian Retur"],compact,"tbl_init2");
                          $.get("{{route("gudang.api.kode_pbahanbakugudangretur")}}",function(rs){
                            frm2 = [
                              "<div class=row>",
                              "<div class=col-md-12>",
                              "<form id=frm method=post onsubmit='return false'>",
                              "<div class=form-group>",
                              "<label>Kode Retur Barang</label>",
                              "<input class=form-control name=id_pengadaan_bb_retur readonly value='"+rs+"'>",
                              "</div>",
                              "<div class=form-group>",
                              "<label>Tanggal Retur Barang</label>",
                              "<input class=form-control name=tanggal_retur readonly value='{{date("Y-m-d")}}'>",
                              "</div>",
                              "<div class=table-responsive>",
                              tbl_init2,
                              "<div class=form-group>",
                              "<button class='btn btn-primary btn-block' type=submit>Proses Retur Barang</button>",
                              "</div>",
                              "</form>",
                              "</div>",
                              "</div>",
                              "</div>",
                            ];
                            mset = new jBox('Modal', {
                              title: 'Rincian Retur Barang',
                              overlay: false,
                              width: '600px',
                              responsiveWidth:true,
                              height: '500px',
                              createOnInit: true,
                              content: frm2.join(""),
                              draggable: false,
                              adjustPosition: true,
                              adjustTracker: true,
                              repositionOnOpen: false,
                              offset: {
                                x: 0,
                                y: 0
                              },
                              repositionOnContent: false,
                              onCloseComplete:function(){
                                console.log("Destruct Table");
                                mastersatuan_table.ajax.reload();
                              },
                              onCreated:function(x){
                                this.content.find("#tbl_init2").DataTable({

                                });
                                con = this.content;
                                con.find("#frm").on('submit', function(event) {
                                  event.preventDefault();
                                  dform = $(this).serializeArray();
                                  console.log(dform);
                                  on();
                                  $.ajax({
                                    url: '{{route("gudang.api.pbahanbakugudangretur_ajukan")}}/'+idpo,
                                    type: 'POST',
                                    dataType: 'JSON',
                                    data:dform
                                  })
                                  .done(function(rs) {
                                    console.log(rs);
                                    if (rs.status == 1) {
                                      new jBox('Notice', {content: 'Retur Barang Telah Diajukan',showCountdown:true, color: 'green'});
                                      mset.close();
                                    }else {
                                      new jBox('Notice', {content: 'Gagal Mengajukan Retur',showCountdown:true, color: 'red'});
                                    }
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
                                  })
                                  .always(function() {
                                    off();
                                  });

                                });
                              }
                            });
                            mset.open();
                          }).fail(function(){
                            new jBox('Notice', {content: 'Gagal Melakukan Komunikasi Dengan Server',showCountdown:true, color: 'red'});
                          })
                        });
                      }
                    });
                    modal.open();
                  }
                  function view(id) {
                    console.log(id);
                    $.get("{{route("gudang.api.pbahanbakugudangretur_detailretur")}}/"+id,function(rs){
                      if (rs.status == 1) {
                        compact = [];
                        $.each(rs.data.pengadaan__bb_retur_details,function(index, el) {
                          compact[index] = [el.pengadaan_bb_detail.master_bb.id_bb,el.pengadaan_bb_detail.master_bb.nama,el.pengadaan_bb_detail.jumlah,el.total_retur,el.catatan_retur];
                        });
                        tbls_init = table(["Kode Barang","Nama Barang","Total Pesan","Total Retur","Catatan Retur"],compact,"tbls_init");
                        html = [
                          "<div class=row>",
                          "<div class=col-md-6>",
                          "<div class=form-group>",
                          "<label>Kode Pengadaan</label>",
                          "<input class=form-control value="+id+" disabled/>",
                          "</div>",
                          "<div class=form-group>",
                          "<label>Kode Retur Barang</label>",
                          "<input class=form-control value="+rs.data.id_pengadaan_bb_retur+" disabled/>",
                          "</div>",
                          "<div class=form-group>",
                          "<label>Tanggal Retur</label>",
                          "<input class=form-control value="+rs.data.tanggal_retur+" disabled/>",
                          "</div>",
                          "<div class=form-group>",
                          "<label>Tanggal Selesai</label>",
                          "<input class=form-control value='"+((rs.data.tanggal_selesai == null)?"":rs.data.tanggal_selesai)+"' disabled/>",
                          "</div>",
                          "<div class=form-group>",
                          "<label>Status Retur</label>",
                          "<input class=form-control value='"+(status_retur(rs.data.status_retur))+"' disabled/>",
                          "</div>",
                          "</div>",
                          "<div class=col-md-6>",
                          "<div class=form-group>",
                          "<label>Konfirmasi Pengadaan</label>",
                          "<input class=form-control value="+((rs.data.konfirmasi_pengadaan)?"Sudah":"Belum")+" disabled/>",
                          "</div>",
                          "<div class=form-group>",
                          "<label>Konfirmasi Direktur</label>",
                          "<input class=form-control value="+((rs.data.konfirmasi_direktur)?"Sudah":"Belum")+" disabled/>",
                          "</div>",
                          "<div class=form-group>",
                          "<label>Catatan Direktur</label>",
                          "<textarea class=form-control disabled>"+((rs.data.catatan_direktur == null)?"":rs.data.catatan_direktur)+"</textarea>",
                          "</div>",
                          "<div class=form-group>",
                          "<label>Catatan Pengadaan</label>",
                          "<textarea class=form-control disabled>"+((rs.data.catatan_pengadaan == null)?"":rs.data.catatan_pengadaan)+"</textarea>",
                          "</div>",
                          "</div>",
                          "<div class=col-md-12>",
                          tbls_init,
                          "</div>",
                          "</div>",
                        ];
                        modal = new jBox('Modal', {
                          title: 'Rincian Retur Barang ',
                          overlay: false,
                          width: '700px',
                          responsiveWidth:true,
                          height: '500px',
                          createOnInit: true,
                          content: html.join(""),
                          draggable: false,
                          adjustPosition: true,
                          adjustTracker: true,
                          repositionOnOpen: false,
                          offset: {
                            x: 0,
                            y: 0
                          },
                          repositionOnContent: false,
                          onCloseComplete:function(){
                            console.log("Destruct Table");
                            nginit.destroy();
                          },
                          onCreated:function(x){
                            konten = this.content;
                            nginit = konten.find("#tbls_init").DataTable({

                            });
                          }
                        });
                        modal.open();

                      }else {
                        new jBox('Notice', {content: 'Data Tidak Ditemukan',showCountdown:true, color: 'red'});
                      }
                    }).fail(function(){
                        new jBox('Notice', {content: 'Koneksi Dengan Server Terputus',showCountdown:true, color: 'red'});
                    })
                  }
                  $.ajax({
                    url: '{{route("gudang.api.pbahanbakugudangretur_check")}}/'+idpo,
                    type: 'GET',
                    dataType: 'json'
                  })
                  .done(function(rs) {
                    console.log(rs);
                    if (rs.status == 1) {
                      console.log("After Created");
                      view(idpo);
                    }else {
                      console.log("Before Created");
                      creator();
                    }
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
                  })
                  .always(function() {
                    off();
                  });

            });
          }
        });
        instance = master_satuan.open();

      });
      $("#pproduk").on('click', function(event) {
        event.preventDefault();
        tabel_satuan = table(["No","Kode","Suplier","Status Pengadaan","Konf. Direktur","Konf. Gudang","Catatan Gudang","Catatan Direktur","Tgl Dibuat","Tgl Diubah",""],[],"pproduk_table");
        var mastersatuan_table = null;
        var master_satuan = new jBox('Modal', {
          title: 'Data Pengadaan Produk',
          overlay: false,
          width: '100%',
          responsiveWidth:true,
          height: '500px',
          createOnInit: true,
          content: tabel_satuan,
          draggable: false,
          adjustPosition: true,
          adjustTracker: true,
          repositionOnOpen: false,
          offset: {
            x: 0,
            y: 0
          },
          repositionOnContent: false,
          onCloseComplete:function(){
            console.log("Destruct Table");
            mastersatuan_table.destroy();
          },
          onCreated:function(rs){
            content = this.content;
            mastersatuan_table = content.find("#pproduk_table").DataTable({
              ajax:"{{route("gudang.api.pproduk_read")}}",
            });
            content.find("#pproduk_table").on('click','.rincian',function(event) {
              event.preventDefault();
              id = $(this).data("id");
              console.log("Rincian ID "+id);
              on();
              $.ajax({
                url: '{{route("gudang.api.pproduk_read")}}/'+id,
                type: 'GET',
                dataType: 'JSON'
              })
              .done(function(rs) {
                if (rs.status == 1) {
                  modal = new jBox('Modal', {
                    title: 'Rincian Pengadaan ['+rs.data.id_pengadaan_produk+']',
                    overlay: false,
                    width: '100%',
                    responsiveWidth:true,
                    height: '500px',
                    createOnInit: true,
                    content: null,
                    draggable: false,
                    adjustPosition: true,
                    adjustTracker: true,
                    repositionOnOpen: false,
                    offset: {
                      x: 0,
                      y: 0
                    },
                    repositionOnContent: false,
                    onCloseComplete:function(){
                      console.log("Destruct Table");

                    },
                    onCreated:function(x){
                      var subtotal = 0;
                      for (var i = 0; i < rs.data.pengadaan__produk_details.length; i++) {
                        subtotal = subtotal + (rs.data.pengadaan__produk_details[i].harga*rs.data.pengadaan__produk_details[i].jumlah);
                      }
                      frm = [
                        [
                          {
                            label:"Kode Pengadaaan",
                            type:"readonly",
                            value:rs.data.id_pengadaan_produk
                          },{
                            label:"Suplier",
                            type:"readonly",
                            value:"["+rs.data.id_suplier+"] "+rs.data.master_suplier.nama_suplier
                          },{
                            label:"Keterangan Suplier",
                            type:"textarea",
                            value:rs.data.master_suplier.ket
                          },{
                            label:"Status Pengadaan",
                            type:"readonly",
                            value:status_pengadaan(rs.data.status_pengadaan)
                          },{
                            label:"Tanggal Dibuat",
                            type:"readonly",
                            value:rs.data.tgl_register
                          },{
                            label:"Perkiraan Tiba",
                            type:"readonly",
                            value:rs.data.perkiraan_tiba
                          },{
                            label:"Tanggal Penerimaan Barang",
                            type:"readonly",
                            value:rs.data.tgl_diterima
                          }
                        ],[
                          {
                            label:"Konfirmasi Direktur",
                            type:"readonly",
                            value:konfirmasi(rs.data.konfirmasi_direktur)
                          },{
                            label:"Konfirmasi Gudang",
                            type:"readonly",
                            value:konfirmasi(rs.data.konfirmasi_gudang)
                          },{
                              label:"Catatan Gudang",
                              type:"textarea",
                              value:rs.data.catatan_gudang
                            },{
                              label:"Catatan Pengadaan",
                              type:"textarea",
                              value:rs.data.catatan_pengadaan
                            },{
                              label:"Catatan Direktur",
                              type:"textarea",
                              value:rs.data.catatan_direktur
                            },{
                              label:"Perkiraan Tiba",
                              type:"readonly",
                              value:rs.data.perkiraan_tiba
                            },{
                              label:"Subtotal Pemesanan",
                              type:"readonly",
                              value:"Rp. "+subtotal
                            },
                        ]
                      ];
                      build_frm = builder(frm,null,"rincian_display",true,6);
                      dtas = [];
                      for (var i = 0; i < rs.data.pengadaan__produk_details.length; i++) {
                        dtas[i] = [rs.data.pengadaan__produk_details[i].id_produk,rs.data.pengadaan__produk_details[i].master_produk.nama_produk,rs.data.pengadaan__produk_details[i].master_produk.stok+" "+rs.data.pengadaan__produk_details[i].master_produk.master_satuan.nama_satuan,rs.data.pengadaan__produk_details[i].harga,rs.data.pengadaan__produk_details[i].jumlah];
                      }
                      console.log(dtas);
                      tabel_produk_isi = table(["Kode Bahan","Nama Bahan","Stok","Harga","Jumlah"],dtas,"tbl_s");
                      build_frm = "<div class='row'><div class='col-md-12'>"+build_frm+"</div><div class='col-md-12'><hr><h4>Data Bahan</h4></div><div class='col-md-12'>"+tabel_produk_isi+"</div></div>"
                      this.setContent(build_frm);
                      konten = this.content;
                      konten.find("textarea").attr("disabled",true);
                      konten.find("#tbl_s").DataTable({

                      });
                    }
                  });
                  modal.open();
                }else {
                  new jBox('Notice', {content: 'Data Tidak Ditemukan',showCountdown:true, color: 'red'});
                }
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
              })
              .always(function() {
                off();
                mastersatuan_table.ajax.reload();
              });

            });
            content.find("#pproduk_table").on('click', '.terima_barang', function(event) {
              event.preventDefault();
              console.log($(this).data("id"));
              var id = $(this).data("id");
              var tibalah = $(this).data("tiba");
              html = [
                "<form class=form-horizontal method=post onsubmit=return false >",
                "<div class=form-group>",
                "<label>Tanggal Penerimaan *</label>",
                "<input class=form-control name=tgl_penerimaan id=datepicker value={{date("Y-m-d")}} required />",
                "</div>",
                "</form>"
              ]
              Swal.fire({
                title: 'Isilah Bidang Yang Diperlukan',
                type: 'warning',
                html: html.join(""),
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Konfirmasi',
                onOpen: function() {
                    var date_start = tibalah;
                    console.log("Waktu Restrict = "+date_start);
                    $('#datepicker').datepicker({
                      startDate: date_start,
                      format:"yyyy-m-d"
                    });
                },
              }).then((result) => {
                if (result.value) {
                  date = $("#datepicker").val();
                  console.log("Date Assigned : "+date);
                  Swal.fire({
                    title:"Harap Diperhatikan",
                    type:"warning",
                    html:"<p align=center style=color:red>Penerimaan Barang Harus Memiliki Kuantitas Yang Sama Dengan Rincian Pengadaan ! Tidak ada penerimaan sebagian terkecuali ada kondisi khusus, silahkan isi catatan kondisi khusus di bawah ini</p><div class=form-group><textarea class=form-control id=alasan ></textarea>",
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya Saya Mengerti',
                  }).then((res)=>{
                    if (res.value) {
                      catatan = $("#alasan").val();
                      console.log("Catatan "+catatan);
                      var postdata = {tgl_diterima:date,status_pengadaan:6,dibaca_direktur:0,dibaca_pengadaan:0,konfirmasi_gudang:1,catatan_gudang:catatan,tgl_perubahan:"{{date("Y-m-d")}}"};
                      console.log(postdata);
                      on();
                      $.post("{{route("gudang.api.pproduk_konfirmasi")}}/"+id,postdata,function(r){
                        if (r.status == 1) {
                          new jBox('Notice', {content: r.msg,showCountdown:true, color: 'green'});
                          var msg = "";
                          $.each(r.fail,function(index,item){
                            msg += item.nama+" Dengan ID "+item.id+" "+item.msg+"<br>";
                          });
                          if (r.fail.length > 0) {
                            Swal.fire({
                              type: 'error',
                              title: 'Beberapa Barang Bermasalah . . ',
                              html: msg,
                              footer: '<a href>Laporkan Error</a>'
                            })
                          }
                          off();
                          mastersatuan_table.ajax.reload();
                        }else {
                          new jBox('Notice', {content: r.msg,showCountdown:true, color: 'red'});
                          off();
                          mastersatuan_table.ajax.reload();
                        }
                      }).fail(function(rs){
                        off();
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
                      });
                    }
                  });
                  // Swal.fire(
                  //   'Deleted!',
                  //   'Your file has been deleted.',
                  //   'success'
                  // )

                }
              })
            });
            content.find("#pproduk_table").on('click', '.retur', function(event) {
              event.preventDefault();
                  idpo = $(this).data("id");
                  console.log(idpo);
                  on();
                  function creator() {
                    tbl_init = table(["Kode Barang","Nama Barang","Total Pesan"],[],"tbl_init");
                    frm = [
                      "<div class=row>",
                      "<div class=col-md-12>",
                      "<div class=form-group>",
                      "<button class='btn btn-primary' id=returkan>Ajukan Retur</button>",
                      "</div>",
                      "<div class=table-responsive>",
                      tbl_init,
                      "<div>",
                      "</div>",
                      "</div>",
                    ];
                    modal = new jBox('Modal', {
                      title: 'Formulir Retur Barang ['+idpo+']',
                      overlay: false,
                      width: '600px',
                      responsiveWidth:true,
                      height: '500px',
                      createOnInit: true,
                      content: frm.join(""),
                      draggable: false,
                      adjustPosition: true,
                      adjustTracker: true,
                      repositionOnOpen: false,
                      offset: {
                        x: 0,
                        y: 0
                      },
                      repositionOnContent: false,
                      onCloseComplete:function(){
                        console.log("Destruct Table");
                        nginit.destroy();
                      },
                      onCreated:function(x){
                        konte = this.content;
                        nginit = konte.find("#tbl_init").DataTable({
                          ajax:'{{route("gudang.api.pprodukgudangretur_poread")}}/'+idpo
                        });
                        konte.find("#returkan").on('click', function(event) {
                          event.preventDefault();
                          dform_bahan = [];
                          $.each(konte.find("#tbl_init .listcheck"),function(index, el) {
                            obj = $(el);
                            cek = obj.is(':checked');
                            if (cek) {
                              dform_bahan.push({id_pbb:obj.data("id"),nama:obj.data("nama"),jumlah:obj.data("jumlah"),kode_barang:obj.data("kode_barang")});
                            }
                          });
                          console.log(dform_bahan);
                          modal.close();
                          compact = [];
                          $.each(dform_bahan,function(index, el) {
                            compact[index] = [el.kode_barang,el.nama,el.jumlah,"<input hidden  name=id_pbb[] value="+el.id_pbb+" required /><input class=form-control  name=total_retur[] type=number min=1 max="+el.jumlah+" required />","<textarea class=form-control name=rincian_retur[] ></textarea>"];
                          });
                          tbl_init2 = table(["Kode Barang","Nama Barang","Total Pesan","Jumlah Retur","Rincian Retur"],compact,"tbl_init2");
                          $.get("{{route("gudang.api.kode_pprodukgudangretur")}}",function(rs){
                            frm2 = [
                              "<div class=row>",
                              "<div class=col-md-12>",
                              "<form id=frm method=post onsubmit='return false'>",
                              "<div class=form-group>",
                              "<label>Kode Retur Barang</label>",
                              "<input class=form-control name=id_pengadaan_produk_retur readonly value='"+rs+"'>",
                              "</div>",
                              "<div class=form-group>",
                              "<label>Tanggal Retur Barang</label>",
                              "<input class=form-control name=tanggal_retur readonly value='{{date("Y-m-d")}}'>",
                              "</div>",
                              "<div class=table-responsive>",
                              tbl_init2,
                              "<div class=form-group>",
                              "<button class='btn btn-primary btn-block' type=submit>Proses Retur Barang</button>",
                              "</div>",
                              "</form>",
                              "</div>",
                              "</div>",
                              "</div>",
                            ];
                            mset = new jBox('Modal', {
                              title: 'Rincian Retur Barang',
                              overlay: false,
                              width: '600px',
                              responsiveWidth:true,
                              height: '500px',
                              createOnInit: true,
                              content: frm2.join(""),
                              draggable: false,
                              adjustPosition: true,
                              adjustTracker: true,
                              repositionOnOpen: false,
                              offset: {
                                x: 0,
                                y: 0
                              },
                              repositionOnContent: false,
                              onCloseComplete:function(){
                                console.log("Destruct Table");
                                mastersatuan_table.ajax.reload();
                              },
                              onCreated:function(x){
                                this.content.find("#tbl_init2").DataTable({

                                });
                                con = this.content;
                                con.find("#frm").on('submit', function(event) {
                                  event.preventDefault();
                                  dform = $(this).serializeArray();
                                  console.log(dform);
                                  on();
                                  $.ajax({
                                    url: '{{route("gudang.api.pprodukgudangretur_ajukan")}}/'+idpo,
                                    type: 'POST',
                                    dataType: 'JSON',
                                    data:dform
                                  })
                                  .done(function(rs) {
                                    console.log(rs);
                                    if (rs.status == 1) {
                                      new jBox('Notice', {content: 'Retur Barang Telah Diajukan',showCountdown:true, color: 'green'});
                                      mset.close();
                                    }else {
                                      new jBox('Notice', {content: 'Gagal Mengajukan Retur',showCountdown:true, color: 'red'});
                                    }
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
                                  })
                                  .always(function() {
                                    off();
                                  });

                                });
                              }
                            });
                            mset.open();
                          }).fail(function(){
                            new jBox('Notice', {content: 'Gagal Melakukan Komunikasi Dengan Server',showCountdown:true, color: 'red'});
                          })
                        });
                      }
                    });
                    modal.open();
                  }
                  function view(id) {
                    console.log(id);
                    $.get("{{route("gudang.api.pprodukgudangretur_detailretur")}}/"+id,function(rs){
                      if (rs.status == 1) {
                        compact = [];
                        $.each(rs.data.pengadaan__produk_retur_details,function(index, el) {
                          compact[index] = [el.pengadaan_produk_detail.master_produk.id_produk,el.pengadaan_produk_detail.master_produk.nama,el.pengadaan_produk_detail.jumlah,el.total_retur,el.catatan_retur];
                        });
                        tbls_init = table(["Kode Barang","Nama Barang","Total Pesan","Total Retur","Catatan Retur"],compact,"tbls_init");
                        html = [
                          "<div class=row>",
                          "<div class=col-md-6>",
                          "<div class=form-group>",
                          "<label>Kode Pengadaan</label>",
                          "<input class=form-control value="+id+" disabled/>",
                          "</div>",
                          "<div class=form-group>",
                          "<label>Kode Retur Barang</label>",
                          "<input class=form-control value="+rs.data.id_pengadaan_produk_retur+" disabled/>",
                          "</div>",
                          "<div class=form-group>",
                          "<label>Tanggal Retur</label>",
                          "<input class=form-control value="+rs.data.tanggal_retur+" disabled/>",
                          "</div>",
                          "<div class=form-group>",
                          "<label>Tanggal Selesai</label>",
                          "<input class=form-control value='"+((rs.data.tanggal_selesai == null)?"":rs.data.tanggal_selesai)+"' disabled/>",
                          "</div>",
                          "<div class=form-group>",
                          "<label>Status Retur</label>",
                          "<input class=form-control value='"+(status_retur(rs.data.status_retur))+"' disabled/>",
                          "</div>",
                          "</div>",
                          "<div class=col-md-6>",
                          "<div class=form-group>",
                          "<label>Konfirmasi Pengadaan</label>",
                          "<input class=form-control value="+((rs.data.konfirmasi_pengadaan)?"Sudah":"Belum")+" disabled/>",
                          "</div>",
                          "<div class=form-group>",
                          "<label>Konfirmasi Direktur</label>",
                          "<input class=form-control value="+((rs.data.konfirmasi_direktur)?"Sudah":"Belum")+" disabled/>",
                          "</div>",
                          "<div class=form-group>",
                          "<label>Catatan Direktur</label>",
                          "<textarea class=form-control disabled>"+((rs.data.catatan_direktur == null)?"":rs.data.catatan_direktur)+"</textarea>",
                          "</div>",
                          "<div class=form-group>",
                          "<label>Catatan Pengadaan</label>",
                          "<textarea class=form-control disabled>"+((rs.data.catatan_pengadaan == null)?"":rs.data.catatan_pengadaan)+"</textarea>",
                          "</div>",
                          "</div>",
                          "<div class=col-md-12>",
                          tbls_init,
                          "</div>",
                          "</div>",
                        ];
                        modal = new jBox('Modal', {
                          title: 'Rincian Retur Barang ',
                          overlay: false,
                          width: '700px',
                          responsiveWidth:true,
                          height: '500px',
                          createOnInit: true,
                          content: html.join(""),
                          draggable: false,
                          adjustPosition: true,
                          adjustTracker: true,
                          repositionOnOpen: false,
                          offset: {
                            x: 0,
                            y: 0
                          },
                          repositionOnContent: false,
                          onCloseComplete:function(){
                            console.log("Destruct Table");
                            nginit.destroy();
                          },
                          onCreated:function(x){
                            konten = this.content;
                            nginit = konten.find("#tbls_init").DataTable({

                            });
                          }
                        });
                        modal.open();

                      }else {
                        new jBox('Notice', {content: 'Data Tidak Ditemukan',showCountdown:true, color: 'red'});
                      }
                    }).fail(function(){
                        new jBox('Notice', {content: 'Koneksi Dengan Server Terputus',showCountdown:true, color: 'red'});
                    })
                  }
                  $.ajax({
                    url: '{{route("gudang.api.pprodukgudangretur_check")}}/'+idpo,
                    type: 'GET',
                    dataType: 'json'
                  })
                  .done(function(rs) {
                    console.log(rs);
                    if (rs.status == 1) {
                      console.log("After Created");
                      view(idpo);
                    }else {
                      console.log("Before Created");
                      creator();
                    }
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
                  })
                  .always(function() {
                    off();
                  });

            });
          }
        });
        instance = master_satuan.open();
      });
    });
  });
</script>
@endpush
