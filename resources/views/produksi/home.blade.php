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
        <h3 class="card-title">Aktivitas Produksi</h3>
      </div>
      <div id="chart-development-activity" style="height: 10rem"></div>
    </div>

  </div>
  <div class="col-md-6">
    <div class="row">
        <div class="card p-3">
          <div class="d-flex align-items-center">
            <span class="stamp stamp-md bg-blue mr-3">
              <i class="fa fa-product-hunt"></i>
            </span>
            <div>
              <h4 class="m-0"><a href="javascript:void(0)" id="st_pengadaan">0 </a> <small>Pengadaan</small></h4>
              <small class="text-muted" id="st_pengadaan_s">0 Selesai</small>
            </div>
          </div>
        </div>
        <div class="card p-3">
          <div class="d-flex align-items-center">
            <span class="stamp stamp-md bg-green mr-3">
              <i class="fe fe-shopping-cart"></i>
            </span>
            <div>
              <h4 class="m-0"><a href="javascript:void(0)" id="st_penjualan">0 </a> <small>Penjualan</small></h4>
              <small class="text-muted" id="st_penjualan_s">0 Selesai</small>
            </div>
          </div>
        </div>
        <div class="card p-3">
      <div class="d-flex align-items-center">
        <span class="stamp stamp-md bg-yellow mr-3">
          <i class="fe fe-copy"></i>
        </span>
        <div>
          <h4 class="m-0"><a href="javascript:void(0)" id="st_produksi">0 </a> <small>Produksi</small></h4>
          <small class="text-muted" id="st_produksi_s">0 Selesai</small>
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
          'data1': 'Produksi'
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
    async function stat() {
      res = await $.post("{{route("chart")}}",{stat:true}).then();
      $("#st_pengadaan").html(res.pengadaan[0]);
      $("#st_pengadaan_s").html(res.pengadaan[1]+" Selesai");
      $("#st_produksi").html(res.produksi[0]);
      $("#st_produksi_s").html(res.produksi[1]+" Selesai");
      $("#st_penjualan").html(res.pemasaran[0]);
      $("#st_penjualan_s").html(res.pemasaran[1]+" Selesai");
    }
    stat();
    $("#lapproduksi").on('click',  function(event) {
      event.preventDefault();
      console.log("lapproduksi");
      console.log("Laporan Pengadaan");
      var form = [
        "<div class=row>",
        "<div class=col-md-12>",
        "<div class=form-group>",
        "<label>Tanggal Dari</label>",
        "<input class='form-control date' id='dari' type='text' />",
        "</div>",
        "<div class=form-group>",
        "<label>Tanggal Sampai</label>",
        "<input class='form-control date' id='sampai' type='text' />",
        "</div>",
        "<div class=form-group>",
        "<button type='button' class='btn btn-large btn-primary btn-block' id='get'>Download Laporan</button>",
        "</div>",
        "</div>",
        "</div>",
      ]
      modal = new jBox('Modal', {
                  title: 'Laporan Produksi',
                  overlay: false,
                  width: '400px',
                  responsiveWidth:true,
                  height: '300px',
                  createOnInit: true,
                  content: form.join(""),
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
                    g = this.content;
                    g.find(".date").datepicker({

                    });
                    g.find("#get").on('click', function(event) {
                      event.preventDefault();
                      dform = {dari:g.find("#dari").val(),sampai:g.find("#sampai").val()};
                      console.log(dform);
                      window.open(
                        '{{route("laporan.produksi")}}/?dari='+dform.dari+'&sampai='+dform.sampai,
                        '_blank'
                      );
                    });
                  }
            });
        modal.open();

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
            ajax:"{{route("produksi.api.master_bb_read")}}",
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
                          $.get("{{route("produksi.api.master_satuan_read")}}/all",function(rs){
                            selectbuilder(rs,html.find("#id_satuan"))
                          });
                          html.find("#update").on('submit',function(event) {
                            event.preventDefault();
                            dform = $(this).serializeArray();
                            id = html.find("#id").val();
                            console.log(dform);
                            on();
                            $.ajax({
                              url: '{{route("produksi.api.master_bb_update")}}/'+id,
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
                              url: '{{route("produksi.api.master_bb_insert")}}',
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
            $.get("{{route("produksi.api.master_bb_read")}}/"+id,function(rs){
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
                  $.get("{{route("produksi.api.master_satuan_read")}}/all",function(rsa){
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
                      url: '{{route("produksi.api.master_bb_update")}}/'+id,
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
            ajax:"{{route("produksi.api.master_produk_read")}}",
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

                          $.get("{{route("produksi.api.master_satuan_read")}}/all",function(rs){
                            selectbuilder(rs,html.find("#id_satuan"))
                          });
                          html.find("#create").on('submit',function(event) {
                            event.preventDefault();
                            dform = $(this).serializeArray();
                            console.log(dform);
                            on();
                            $.ajax({
                              url: '{{route("produksi.api.master_produk_insert")}}',
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
            $.get("{{route("produksi.api.master_produk_read")}}/"+id,function(rs){
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
                  $.get("{{route("produksi.api.master_satuan_read")}}/all",function(rsa){
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
                      url: '{{route("produksi.api.master_produk_update")}}/'+id,
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
                  ajax:"{{route("produksi.api.master_komposisi_read")}}/"+id,
                  dom: 'Bfrtip',
                  buttons: [
                    {
                        className: "btn btn-success",
                        text: 'Tambah Komposisi',
                        action: function ( e, dt, node, config ) {
                          frm = [
                            [
                              {
                                label:"Cari Bahan",
                                type:"text",
                                name:"",
                                id:"cari",
                                value:"",
                              },{
                                label:"Kode Bahan",
                                type:"select2",
                                name:"id_bb",
                                id:"id_bb",
                              },{
                                label:"Harga Bahan",
                                type:"readonly",
                                name:"harga_bahan",
                                id:"harga_bahan",
                              },{
                                label:"Rasio Ukuran Bahan",
                                type:"number",
                                name:"rasio",
                                id:"rasio",
                                step:"0.000001",
                              },{
                                label:"Jumlah Bahan",
                                type:"number",
                                name:"jumlah",
                                id:"jumlah",
                              },{
                                label:"Harga Produksi",
                                type:"disabled",
                                name:"",
                                id:"harga_produksi",
                              },
                            ]
                          ];
                          btn = {name:"Simpan",class:"success",type:"submit"};
                          formSatuan = builder(frm,btn,"update",true,12);
                          setan = new jBox('Modal', {
                            title: 'Tambah Komposisi',
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
                              masterkomposisi_table.ajax.reload();
                              masterproduk_table.ajax.reload();
                            },
                            onCreated:function(){
                              console.log("Initialize");
                              html = this.content;
                              st = [];
                              $.get("{{route("produksi.api.master_bb_read")}}/all",function(rs){
                                for (var i = 0; i < rs.length; i++) {
                                  st[i] = {value:rs[i].id_bb,text:rs[i].id_bb+" - "+rs[i].nama};
                                }
                                selectbuilder(st,html.find("#id_bb"));
                                html.find("#id_bb").trigger("change");
                              }).fail(function(){
                                new jBox('Notice', {content: 'Hey, Server Meledak',showCountdown:true, color: 'red'});
                              })
                              html.find("#cari").on('change', function(event) {
                                event.preventDefault();
                                console.log("Keypresed");
                                html.find("#id_bb").html("");
                                console.log($("#cari").val());
                                $.get("{{route("produksi.api.master_bb_read")}}/all?q="+$(this).val(),function(rs){
                                  st12 = []
                                  for (var i = 0; i < rs.length; i++) {
                                    st12[i] = {value:rs[i].id_bb,text:rs[i].id_bb+" - "+rs[i].nama};
                                  }
                                  selectbuilder(st12,html.find("#id_bb"));
                                  html.find("#id_bb").trigger('change');
                                }).fail(function(){
                                  new jBox('Notice', {content: 'Hey, Server Meledak',showCountdown:true, color: 'red'});
                                })
                              });
                              html.find("#rasio").on('change',function(event) {
                                event.preventDefault();
                                html.find("#jumlah").trigger('change');
                              });
                              html.find("#id_bb").on('change',function(event) {
                                event.preventDefault();
                                if ($(this).val() == null) {
                                  $.get("{{route("produksi.api.master_bb_read")}}/all",function(rs){
                                    html.find("#harga_bahan").val(rs.harga+"/"+rs.nama_satuan);
                                  }).fail(function(){
                                    new jBox('Notice', {content: 'Hey, Server Meledak',showCountdown:true, color: 'red'});
                                  })
                                }else {
                                  $.get("{{route("produksi.api.master_bb_read")}}/"+$(this).val(),function(rs){
                                    html.find("#harga_bahan").val(rs.harga+"/"+rs.nama_satuan);
                                  }).fail(function(){
                                    new jBox('Notice', {content: 'Hey, Server Meledak',showCountdown:true, color: 'red'});
                                  })
                                }
                              });

                              html.find("#jumlah").on('change', function(event) {
                                event.preventDefault();
                                console.log($("#rasio").val());
                                console.log($("#harga_bahan").val());
                                console.log($(this).val());
                                rs = konversi(parseFloat($("#rasio").val()),parseFloat($(this).val()),parseFloat((($("#harga_bahan").val()).split("/"))[0]));
                                html.find("#harga_produksi").val(rs.harga);
                              });
                              // html.find("#id_bb").select2();
                              html.find("#update").on('submit',function(event) {
                                event.preventDefault();
                                dform = $(this).serializeArray();
                                console.log(dform);
                                dform[dform.length] = {value:id,name:"id_produk"};
                                on();
                                $.ajax({
                                  url: '{{route("produksi.api.master_komposisi_insert")}}',
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
                                  setan.close();
                                });

                              });
                            }
                          });
                          setan.open();
                        }
                      }
                    ]
                });
                content_komposisi.find("#masterkomposisi_table").on('click', '.hapus', function(event) {
                  event.preventDefault();
                  id_komposisi = $(this).data("id");
                  Swal.fire({
                    title: 'Apakah Anda Yakin ? ',
                    text: "Data Sebelumnya tidak bisa di kembalikan",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya'
                  }).then((result) => {
                    if (result.value) {
                      $.get("{{route("produksi.api.master_komposisi_hapus")}}/"+id_komposisi,function(rs){
                        if (rs.status == 1) {
                          new jBox('Notice', {content: 'Data Sukses Terhapus',showCountdown:true, color: 'green'});
                        }else {
                          new jBox('Notice', {content: 'Gagal Hapus Data',showCountdown:true, color: 'red'});
                        }
                        masterkomposisi_table.ajax.reload();
                        masterproduk_table.ajax.reload();
                      }).fail(function(){
                        new jBox('Notice', {content: 'Hey, Server Meledak',showCountdown:true, color: 'red'});
                      });
                    }
                  })
                });
              }
            });
            set_start.open();
            // $.get("{{route("produksi.api.master_komposisi_read")}}/"+id,function(rs){
            //
            // });
          });
        }
      });
      instance = masterproduk.open();
    });
    $("#produksi").on("click", function(event) {
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
            if (konf_perencanaan == "Belum Diverifikasi") {
              item.push('<a class="dropdown-item batalkan" href="javascript:void(0)" data-id="'+id+'">Batalkan Produksi</a>');
            }else if (konf_perencanaan == "Sudah Diverifikasi" && status_produksi == "Produksi Disetujui Direktur") {
              item.push('<a class="dropdown-item batalkan" href="javascript:void(0)" data-id="'+id+'">Batalkan Produksi</a>');
              item.push('<a class="dropdown-item proses" href="javascript:void(0)" data-id="'+id+'">Proses Produksi</a>');
            }else if (status_produksi == "Sedang Diproses") {
              item.push('<a class="dropdown-item batalkan" href="javascript:void(0)" data-id="'+id+'">Batalkan Produksi</a>');
              item.push('<a class="dropdown-item selesai" href="javascript:void(0)" data-id="'+id+'">Produksi Selesai</a>');
            }else if (status_produksi == "Produksi Diterima Bag. Gudang") {
              item.push('<a class="dropdown-item finallisasi" href="javascript:void(0)" data-id="'+id+'">Tutup Transaksi</a>');
            }
            return '<button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle"></button><div class="dropdown-menu dropdown-menu-right">'+item.join("")+'</div>';
          };
          console.log(content);
          function add_produksi(data = []) {

            var formAdd = [
                '<form method=post onsubmit="return false" id=padd>',
                '<div class=row>',
                '<div class=col-md-12>',
                '<div class=form-group>',
                '<label>Kode Produksi</label>',
                '<input class="form-control" name="id_produksi" id=id_produksi readonly>',
                '</div>',
                '<div class=form-group>',
                '<label>Alasan Perencanaan</label>',
                '<textarea class=form-control name=alasan_perencanaan></textarea>',
                '</div>',
                '<div class=form-group>',
                '<label>Catatan Produksi</label>',
                '<textarea class=form-control name=catatan_produksi></textarea>',
                '</div>',
                '<div class=form-group>',
                '<button type="submit" class="btn btn-primary">Simpan Data Perencanaan Produksi</button>',
                '</div>',
                '</div>',
                '<div class=col-md-12>',
                '<div class=table-resposive>',
                table(["Kode","Nama Produk","Stok","Stok Minimum","Jumlah Produksi",""],[],"produklist"),
                '</div>',
                '</div>',
                '</div>',
                '</form>',
            ]
            var model = new jBox('Modal', {
              title: 'Data Produksi',
              overlay: false,
              width: '900px',
              responsiveWidth:true,
              height: '600px',
              createOnInit: true,
              content: formAdd.join(""),
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
              onCreated:async function(rs){
                k = this.content;
                k.find("#produklist").DataTable({
                  ajax:"{{route("produksi.api.produksi_listproduk")}}",
                  createdRow:function(r,d,i){
                    if (data.length > 0) {
                      $.each(data,function(index, el) {
                        if (el.id == d[5]) {
                          var btn = '<div class="custom-controls-stacked"><label class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input listcheck"  data-id="'+d[5]+'" ><span class="custom-control-label">'+d[5]+'</span></label></div>';
                          var inputjumlah = "<input class='form-control' name='jumlah_produksi["+d[0]+"]' max='"+d[4]+"' min=1 value='"+el.jumlah+"' required type='number' disabled/><p>Maksimal Produksi : <span class='badge badge-danger'>"+d[4]+"</span></p>";
                          if (parseFloat(d[2]) <= parseFloat(d[3])) {
                            var btn = '<div class="custom-controls-stacked"><label class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input listcheck"  data-id="'+d[5]+'" checked><span class="custom-control-label">'+d[5]+'</span></label></div>';
                            var inputjumlah = "<input class='form-control' name='jumlah_produksi["+d[0]+"]' max='"+d[4]+"' value='"+el.jumlah+"' min=1 required type='number' /><p>Maksimal Produksi : <span class='badge badge-danger'>"+d[4]+"</span></p>";
                          }
                          $("td",r).eq(0).html(btn);
                          $("td",r).eq(5).html("<button class='btn btn-primary detail' data-id='"+d[5]+"' type='button'><li class='fa fa-search'></li></button>");
                          $("td",r).eq(4).html(inputjumlah);
                          return true;
                        }
                      });
                    }else {
                      var btn = '<div class="custom-controls-stacked"><label class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input listcheck"  data-id="'+d[5]+'" ><span class="custom-control-label">'+d[5]+'</span></label></div>';
                      var inputjumlah = "<input class='form-control' name='jumlah_produksi["+d[0]+"]' max='"+d[4]+"' min=1 required type='number' disabled/><p>Maksimal Produksi : <span class='badge badge-danger'>"+d[4]+"</span></p>";
                      if (parseFloat(d[2]) <= parseFloat(d[3])) {
                        var btn = '<div class="custom-controls-stacked"><label class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input listcheck"  data-id="'+d[5]+'" checked><span class="custom-control-label">'+d[5]+'</span></label></div>';
                        var inputjumlah = "<input class='form-control' name='jumlah_produksi["+d[0]+"]' max='"+d[4]+"' min=1 required type='number' /><p>Maksimal Produksi : <span class='badge badge-danger'>"+d[4]+"</span></p>";
                      }
                      $("td",r).eq(0).html(btn);
                      $("td",r).eq(5).html("<button class='btn btn-primary detail' data-id='"+d[5]+"' type='button'><li class='fa fa-search'></li></button>");
                      $("td",r).eq(4).html(inputjumlah);
                    }
                  }
                })
                kode = await $.get("{{route("produksi.api.kode_produksi")}}").then();
                k.find("#id_produksi").val(kode.kode);
                k.find("#produklist").on("click", ".detail", function(event) {
                  id = $(this).data("id");
                  $.get("{{route("produksi.api.master_produk_read")}}/"+id,function(rs){
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
                    formSatuan = builder(frm,null,"update",true,12);
                    set = new jBox('Modal', {
                      title: 'Detail Produk',
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
                      },
                      onCreated:function(){
                        console.log("Initialize");
                        html = this.content;
                        selectIt = null;
                        $.get("{{route("produksi.api.master_satuan_read")}}/all",function(rsa){
                          var namanya = "Tidak Diketahui";
                          for (var i = 0; i < rsa.length; i++) {
                            if(rsa[i].value == rs.id_satuan){
                              var namanya = rsa[i].text;
                              break;
                            }
                          }
                          selectbuilder(rsa,html.find("#id_satuan"),[{value:rs.id_satuan,text:namanya}])
                        });
                        html.find("input").attr("disabled",true);
                        html.find("select").attr("disabled",true);
                        html.find("textarea").attr("disabled",true);
                      }
                    });
                    set.open();
                  });
                });
                k.find("#padd").on("submit", function(event) {
                  Swal.fire({
                    title: 'Apakah Anda Yakin ? ',
                    text: "Data Perencanaan Produksi Tidak Akan Bisa Diubah Setelah Tersimpan",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya'
                  }).then( async (result) => {
                    if (result.value) {
                      console.log("Submit");
                      dform = $(this).serializeArray();
                      console.log(dform);
                      var cb = k.find("#produklist .listcheck");
                      var i = 0;
                      $.each(cb, function(index, val) {
                        nobj = $(val);
                        is = nobj.is(":checked");
                        if (is) {
                          i++;
                          console.log("Checked");
                          id = nobj.data("id");
                          dform.push({name:"item[]",value:id});
                        }
                      });
                      if (i > 0) {
                        console.log(dform);
                        res = await $.post("{{route("produksi.api.produksi_insert")}}",dform).then();
                        if (res.status == 1) {
                          new jBox('Notice', {content: 'Sukses Simpan Data Produksi',showCountdown:true, color: 'green'});
                          model.close()
                        }else {
                          new jBox('Notice', {content: res.msg,showCountdown:true, color: 'red'});
                        }
                      }else {
                        new jBox('Notice', {content: 'Tolong Pilih Minimal 1 Produk Untuk di Produksi',showCountdown:true, color: 'red'});
                      }
                    }
                  });
                })
                $("#produklist").on("click", ".listcheck", function(event) {
                  id = $(this).data("id");
                  if ($(this).is(":checked")) {
                    $("input[name='jumlah_produksi["+id+"]']").val("");
                    $("input[name='jumlah_produksi["+id+"]']").attr("disabled",false);
                  }else {
                    $("input[name='jumlah_produksi["+id+"]']").val("");
                    $("input[name='jumlah_produksi["+id+"]']").attr("disabled",true);
                  }
                })
              }
            });
            model.open();
          }
          produksi_table = content.find("#produksi_table").DataTable({
            dom: 'Bfrtip',
            ajax:"{{route("produksi.api.produksi_read")}}",
            buttons: [
                {
                    className: "btn btn-success",
                    text: 'Tambah Produksi',
                    action: function ( e, dt, node, config ) {
                      add_produksi();
                    }
                  },{
                    className: "btn btn-primary",
                    text: 'Peramalan Produksi',
                    action: function ( e, dt, node, config ) {
                      console.log("Peramalan");
                      var form = [
                        "<div class=row>",
                        "<div class=col-md-12>",
                        "<div class=form-group>",
                        "<label>Data Latih (Bulan Sebelumnya)</label>",
                        "<input class='form-control' id='latih'  type='number' />",
                        "</div>",
                        "<div class=form-group>",
                        "<label>Peramalan Untuk Periode</label>",
                        "<input class='form-control date' id='periode' type='text' />",
                        "</div>",
                        "<div class=form-group id=afterIt>",
                        "<button type='button' class='btn btn-large btn-primary btn-block' id='get'>Hitung Peramalan</button>",
                        "</div>",
                        "</div>",
                        "</div>",
                        "<div class=row>",
                        "<div class=col-md-12>",
                        "<div class=table-responsive>",
                        table(["Kode","Nama Produk","Prediksi Produksi"],[],"tb"),
                        "</div>",
                        "</div>",
                        "</div>",
                      ]
                      modal = new jBox('Modal', {
                                  title: 'Peramalan Produksi',
                                  overlay: false,
                                  width: '600px',
                                  responsiveWidth:true,
                                  height: '400px',
                                  createOnInit: true,
                                  content: form.join(""),
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
                                  onCreated: function(x){
                                    g = this.content;
                                    var dt = g.find("#tb").DataTable({

                                    });
                                    g.find(".date").datepicker({
                                      format: "yyyy-mm-dd",
                                       viewMode: "months",
                                       minViewMode: "months"
                                    });
                                    g.find("#get").on('click', async function(event) {
                                      event.preventDefault();
                                      dform = {periode:g.find("#periode").val(),latih:g.find("#latih").val()};
                                      console.log(dform);
                                      datares = [];
                                      list =  await $.get("{{route("listproduk")}}").then();
                                      for (var i = 0; i < list.length; i++) {
                                        res = await $.get("{{route("peramalan")}}/produksi?latih="+dform.latih+"&periode="+dform.periode+"&id="+list[i].id_produk).then();
                                        res.id = list[i].id_produk;
                                        res.for = dform.periode;
                                        res.nama_produk = list[i].nama_produk;
                                        datares.push(res);
                                      }
                                      var isTrue = true;
                                      dt.clear().draw();
                                      $.each(datares,function(index, el) {
                                        if (el.status == 1) {
                                          var rowNode = dt
                                          .row.add( [ el.id,el.nama_produk, el.jumlah ] )
                                          .draw()
                                          .node();
                                          $( rowNode )
                                          .animate( { color: 'black' } );
                                        }else if (el.status == 2) {
                                          isTrue = false;
                                          var rowNode = dt
                                          .row.add( [ el.id,el.nama_produk, "<button class='btn btn-primary btn-small prakira' data-id='"+el.id+"' data-periode='"+el.for+"' data-latih='"+dform.latih+"'>Isi Prakira Manual</button>" ] )
                                          .draw()
                                          .node();
                                          $( rowNode )
                                          .animate( { color: 'black' } );
                                        }
                                      });
                                      g.find("#tb").on('click', '.prakira', async function(event) {
                                        id = $(this).data("id");
                                        console.log(id);
                                        var select;
                                        ra = [];
                                        $.each(datares,function(index, el) {
                                          if (el.status == 2) {
                                            if (el.id == id) {
                                              select = el.data;
                                              return false;
                                            }
                                          }
                                        });
                                        for (var i = 0; i < select.length; i++) {
                                          c = prompt("Isi Prakira Harga Untuk Tanggal "+select[i].date);
                                          if (c != null) {
                                            fr = {id_produk:id,prakira:c,tgl_dibuat:select[i].date,jenis:"manual"};
                                            s = await $.post("{{route("prakira_insert")}}",fr).then();
                                            ra.push(s);
                                          }
                                        }
                                        g.find("#get").trigger('click');
                                      });
                                      if (isTrue) {
                                        g.find("#afterIt").after("<div class='form-group'><button type='button' class='btn btn-large btn-primary btn-block' id='go_produksi'>Lakukan Produksi</button><div class='form-group'>");
                                        g.find("#go_produksi").on('click', async function(event) {
                                          event.preventDefault();
                                          modal.close();
                                          $.each(datares,async function(index, el) {
                                            fr = {id_produk:el.id,prakira:el.jumlah,tgl_dibuat:dform.periode,jenis:"algoritma"};
                                            s = await $.post("{{route("prakira_insert")}}",fr).then();
                                          });
                                          add_produksi(datares);
                                        });
                                      }
                                    });
                                  }
                            });
                      modal.open();

                    }
                  }
            ],
            createdRow:function(r,d,i){
              $("td",r).eq(8).html(btn(d[8],d[3],d[6]));
            }
          });
          $("#produksi_table").on("click", ".detail", async function(event) {
            id = $(this).data("id");
            res = await $.get("{{route("produksi.api.produksi_read")}}/"+id).then();
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
              table(["Kode Produk","Nama Produk","Jumlah Produksi","Biaya Produksi",""],[],"list_produksi"),
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
                  dt.push([el.master_produk.id_produk,el.master_produk.nama_produk,el.jumlah,number_format(total),"<button class='btn btn-small btn-primary detail_produksi' data-id='"+el.id_pd+"'><li class='fa fa-search'></li></button>"]);
                });
                kt.find("#list_produksi").attr("width","100%");
                kt.find("#list_produksi").DataTable({
                  data:dt
                })
                kt.find("#list_produksi").on('click', '.detail_produksi', function(event) {
                  event.preventDefault();
                  id = $(this).data("id");
                  tb = [
                    "<div class=row>",
                    "<div class=col-md-12>",
                    "<div class=table-responsive>",
                    table(["Kode Bahan Baku","Nama Bahan","Harga Bahan","Rasio","Jumlah Bahan","Jml * Rasio","Harga Produksi Per Produk","Biaya Produksi"],[],"tb_detil"),
                    "</div>",
                    "</div>",
                    "</div>",
                  ]
                  console.log(id);
                  ms = new jBox('Modal', {
                    title: 'Detail Penggunaan Bahan Baku',
                    overlay: false,
                    width: '50%',
                    responsiveWidth:true,
                    height: '600px',
                    createOnInit: true,
                    content: tb.join(""),
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
                    onCreated:function(rs){
                      var s = this.content.find("#tb_detil").DataTable({
                        ajax:"{{route("produksi.api.detailbiayaproduksi")}}/"+id
                      })
                    }
                  });
                  ms.open();
                });
              }});
              m.open();
          });
          $("#produksi_table").on("click", ".batalkan", function(event) {
            id = $(this).data("id");
            // produksi.api.produksi_update
            Swal.fire({
              title: 'Apakah Anda Yakin ? ',
              text: "Data Perencanaan Produksi Tidak Akan Bisa Diubah Setelah Dibatalkan",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya'
            }).then( async (result) => {
              if (result.value) {
                res = await $.post("{{route("produksi.api.produksi_update")}}/"+id,{konfirmasi_perencanaan:2,status_produksi:2}).then();
                if (res.status == 1) {
                  new jBox('Notice', {content: "Sukses Update Status",showCountdown:true, color: 'green'});
                }else {
                  new jBox('Notice', {content: "Gagal Update Status",showCountdown:true, color: 'red'});
                }
                produksi_table.ajax.reload();
              }
            });
          });
          $("#produksi_table").on("click", ".selesai", function(event) {
            id = $(this).data("id");
            console.log(id);
            // produksi.api.produksi_update
            Swal.fire({
              title: 'Apakah Anda Yakin ? ',
              text: "Data Perencanaan Produksi Tidak Akan Bisa Diubah Setelah Diselesaikan",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya'
            }).then( async (result) => {
              if (result.value) {
                res = await $.post("{{route("produksi.api.produksi_update")}}/"+id,{status_produksi:7}).then();
                if (res.status == 1) {
                  new jBox('Notice', {content: "Sukses Update Status",showCountdown:true, color: 'green'});
                }else {
                  new jBox('Notice', {content: "Gagal Update Status",showCountdown:true, color: 'red'});
                }
                produksi_table.ajax.reload();
              }
            });
          });
          $("#produksi_table").on("click", ".finallisasi", function(event) {
            id = $(this).data("id");
            console.log(id);
            // produksi.api.produksi_update
            Swal.fire({
              title: 'Apakah Anda Yakin ? ',
              text: "Data Produksi Akan Di Selesaikan, Perubahan Tidak Bisa Dikembalikan",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya'
            }).then( async (result) => {
              if (result.value) {
                res = await $.post("{{route("produksi.api.produksi_update")}}/"+id,{status_produksi:3,tgl_selesai_produksi:"{{date("Y-m-d")}}"}).then();
                if (res.status == 1) {
                  new jBox('Notice', {content: "Sukses Update Status",showCountdown:true, color: 'green'});
                }else {
                  new jBox('Notice', {content: "Gagal Update Status",showCountdown:true, color: 'red'});
                }
                produksi_table.ajax.reload();
              }
            });
          });


          $("#produksi_table").on("click", ".proses", function(event) {
            id = $(this).data("id");
            console.log(id);
            // produksi.api.produksi_update
            Swal.fire({
              title: 'Apakah Anda Yakin ? ',
              text: "Data Perencanaan Produksi Tidak Akan Bisa Diubah Setelah Diproses",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Ya'
            }).then( async (result) => {
              if (result.value) {
                res = await $.post("{{route("produksi.api.produksi_update")}}/"+id,{status_produksi:1,change_bahan:1}).then();
                if (res.status == 1) {
                  new jBox('Notice', {content: "Sukses Update Status",showCountdown:true, color: 'green'});
                }else {
                  new jBox('Notice', {content: res.msg,showCountdown:true, color: 'red'});
                }
                produksi_table.ajax.reload();
              }
            });
          });
        }
      });
      instance = produksi.open();

    })

  });
});
</script>
@endpush
