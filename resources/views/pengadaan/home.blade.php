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
  require(['datatables','sweetalert2','c3', 'jquery','jbox','select2','datatables.button'], function (datatables,Swal,c3, $,jbox,select2) {
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
      $("#mastersatuan").on('click',function(event) {
        event.preventDefault();
        tabel_satuan = table(["No","Nama Satuan",""],[],"mastersatuan_table");
        var mastersatuan_table = null;
        var master_satuan = new jBox('Modal', {
          title: 'Data Satuan',
          overlay: false,
          width: '500px',
          responsiveWidth:true,
          height: 'auto',
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
              ajax:"{{route("pengadaan.api.master_satuan_read")}}",
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
                          height: 'auto',
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
                                url: '{{route("pengadaan.api.master_satuan_update")}}/'+id,
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
                                url: '{{route("pengadaan.api.master_satuan_insert")}}',
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
                height: 'auto',
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
                      url: '{{route("pengadaan.api.master_satuan_update")}}/'+id,
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
                      url: '{{route("pengadaan.api.master_satuan_insert")}}',
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
          height: 'auto',
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
              ajax:"{{route("pengadaan.api.master_bb_read")}}",
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
                          height: 'auto',
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
                            $.get("{{route("pengadaan.api.master_satuan_read")}}/all",function(rs){
                              selectbuilder(rs,html.find("#id_satuan"))
                            });
                            html.find("#update").on('submit',function(event) {
                              event.preventDefault();
                              dform = $(this).serializeArray();
                              id = html.find("#id").val();
                              console.log(dform);
                              on();
                              $.ajax({
                                url: '{{route("pengadaan.api.master_bb_update")}}/'+id,
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
                                url: '{{route("pengadaan.api.master_bb_insert")}}',
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
              $.get("{{route("pengadaan.api.master_bb_read")}}/"+id,function(rs){
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
                  height: 'auto',
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
                    $.get("{{route("pengadaan.api.master_satuan_read")}}/all",function(rsa){
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
                        url: '{{route("pengadaan.api.master_bb_update")}}/'+id,
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
          height: 'auto',
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
              ajax:"{{route("pengadaan.api.master_suplier_read")}}",
              dom: 'Bfrtip',
              buttons: [
                  {
                      className: "btn btn-success",
                      text: 'Tambah Suplier',
                      action: function ( e, dt, node, config ) {
                        frm = [
                          [
                            {
                              label:"Nama Suplier",
                              type:"text",
                              name:"nama_suplier"
                            },{
                              label:"No Kontak",
                              type:"text",
                              name:"no_kontak"
                            },{
                              label:"Email",
                              type:"email",
                              name:"email"
                            },{
                              label:"Alamat",
                              type:"textarea",
                              name:"alamat"
                            },{
                              label:"Keterangan",
                              type:"textarea",
                              name:"ket"
                            }
                          ]
                        ];
                        btn = {name:"Simpan",class:"success",type:"submit"};
                        formSatuan = builder(frm,btn,"create",true,12);
                        set = new jBox('Modal', {
                          title: 'Tambah Suplier',
                          overlay: false,
                          width: '500px',
                          responsiveWidth:true,
                          height: 'auto',
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
                            mastersuplier_table.ajax.reload();
                          },
                          onCreated:function(){
                            console.log("Initialize");
                            html = this.content;
                            html.find("#create").on('submit',function(event) {
                              event.preventDefault();
                              dform = $(this).serializeArray();
                              console.log(dform);
                              on();
                              $.ajax({
                                url: '{{route("pengadaan.api.master_suplier_insert")}}',
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
            content.find("#mastersuplier_table").on('click','.edit',function(event) {
              event.preventDefault();
              id = $(this).data("id");
              $.get("{{route("pengadaan.api.master_suplier_read")}}/"+id,function(rs){
                frm = [
                  [
                    {
                      label:"Nama Suplier",
                      type:"text",
                      name:"nama_suplier",
                      value:rs.nama_suplier
                    },{
                      label:"No Kontak",
                      type:"text",
                      name:"no_kontak",
                      value:rs.no_kontak
                    },{
                      label:"Email",
                      type:"email",
                      name:"email",
                      value:rs.email
                    },{
                      label:"Alamat",
                      type:"textarea",
                      name:"alamat",
                      value:rs.alamat
                    },{
                      label:"Keterangan",
                      type:"textarea",
                      name:"ket",
                      value:rs.ket
                    }
                  ]
                ];
                btn = {name:"Ubah",class:"warning",type:"submit"};
                formSatuan = builder(frm,btn,"update",true,12);
                set = new jBox('Modal', {
                  title: 'Ubah Suplier',
                  overlay: false,
                  width: '500px',
                  responsiveWidth:true,
                  height: 'auto',
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
                    mastersuplier_table.ajax.reload();
                  },
                  onCreated:function(){
                    console.log("Initialize");
                    html = this.content;

                    html.find("#update").on('submit',function(event) {
                      event.preventDefault();
                      dform = $(this).serializeArray();
                      console.log(dform);
                      on();
                      $.ajax({
                        url: '{{route("pengadaan.api.master_suplier_update")}}/'+id,
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
          height: 'auto',
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
              ajax:"{{route("pengadaan.api.master_produk_read")}}"
            });
            content.find("#masterproduk_table").on('click','.edit',function(event) {
              new jBox('Notice', {content: 'Anda tidak berhak untuk mengakses/mengubah data ini',showCountdown:true, color: 'red'});
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
                height: 'auto',
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
                    ajax:"{{route("pengadaan.api.master_komposisi_read")}}/"+id
                  });
                  content_komposisi.find("#masterkomposisi_table").on('click', '.hapus', function(event) {
                    event.preventDefault();
                      new jBox('Notice', {content: 'Anda tidak berhak untuk mengakses/mengubah data ini',showCountdown:true, color: 'red'});
                  });
                }
              });
              set_start.open();
              // $.get("{{route("pengadaan.api.master_komposisi_read")}}/"+id,function(rs){
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
          height: 'auto',
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
              ajax:"{{route("pengadaan.api.pbahanabaku_read")}}",
              dom: 'Bfrtip',
              buttons: [
                  {
                      className: "btn btn-success",
                      text: 'Ajukan Pengadaan Bahan Baku',
                      action: function ( e, dt, node, config ) {
                        tabel_pengajuan = table(["Kode","Nama","Stok","Stok Minimum","Harga"],[],"pbahanbakuajukan_table");
                        buildform = [
                          "<div class='row'>",
                          "<div class='col-md-12'>",
                          "<h4>Data Bahan</h4>",
                          "<div class='form-group'>",
                          "<button class='btn btn-primary m-2' id='cek_prioritas'>Pilih Pengajuan Diprioritaskan</button>",
                          "<button class='btn btn-primary m-2' id='reset_pilihan'>Reset Semua Pilihan</button>",
                          "</div>",
                          tabel_pengajuan,
                          "</div>",
                          "<div class='col-md-12'>",
                          "<div class='form-group'>",
                          "<button class='btn btn-primary' id='ajukan'>Ajukan Pengadaan</button>",
                          "</div>",
                          "</div>",
                          "</div>",
                        ];
                        var set = new jBox('Modal', {
                          title: 'Pengajuan Pengadaan Bahan Baku',
                          overlay: false,
                          width: '100%',
                          responsiveWidth:true,
                          height: 'auto',
                          createOnInit: true,
                          content: buildform.join(""),
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
                            set.destroy();
                          },
                          onCreated:function(rs){
                            content = this.content;
                            dform_bahan = [];
                            dform_pengadaan = [];
                            content.find("#pbahanbakuajukan_table").DataTable({
                              ajax:"{{route("pengadaan.api.pengandaan_bahanabaku_read")}}",
                                "columns": [
                                  {"orderDataType": "dom-checkbox"},
                                  null,
                                  null,
                                  null,
                                  null,
                                ],
                                order:[[0,"desc"]]
                            });
                            content.find("#cek_prioritas").on('click', function(event) {
                              event.preventDefault();
                              $.each(content.find("#pbahanbakuajukan_table .listcheck"),function(index, el) {
                                if ($(el).data("priority") == 1) {
                                  $(el).attr('checked', true);
                                }
                              });
                              new jBox('Notice', {content: 'Pengajuan Bahan Prioritas Telah Dipilih',showCountdown:true, color: 'blue'});
                            });
                            content.find("#reset_pilihan").on('click', function(event) {
                              event.preventDefault();
                              $.each(content.find("#pbahanbakuajukan_table .listcheck"),function(index, el) {
                                $(el).removeAttr('checked');
                              });
                              new jBox('Notice', {content: 'Pilihan Telah Di Reset',showCountdown:true, color: 'blue'});
                            });
                            content.find("#ajukan").on('click',function(event) {
                              event.preventDefault();
                              dform_bahan = [];
                              var index_col = 0;
                              $.each(content.find("#pbahanbakuajukan_table .listcheck"),function(index, el) {
                                obj = $(el);
                                cek = obj.is(':checked');
                                if (cek) {
                                  dform_bahan.push({id:obj.data("id"),nama:obj.data("nama"),stok:obj.data("stok"),harga:obj.data("harga")});
                                }
                              });
                              var tabel_ajukanlah = null;
                              frm_a = [
                                [
                                  {
                                    label:"Kode Pengajuan",
                                    type:"readonly",
                                    name:"id_pengadaan_bb",
                                    id:"id_pengadaan_bb",
                                  },{
                                    label:"Suplier",
                                    type:"text",
                                    name:"",
                                    id:"cari",
                                    value:"Cari Suplier"
                                  },{
                                    label:"",
                                    type:"select2",
                                    name:"id_suplier",
                                    id:"id_suplier",
                                  },{
                                    label:"Keterangan Suplier",
                                    type:"textarea",
                                    name:"",
                                    id:"keterangan_suplier",
                                  },{
                                    label:"Catatan Pengadaan",
                                    type:"textarea",
                                    name:"catatan_pengadaan",
                                    id:"catatan_pengadaan",
                                  }
                                ]
                              ];
                              btn_a = {name:"Ajukan Pengadaan",class:"success",type:"submit"};
                              dta = [];
                              for (var i = 0; i < dform_bahan.length; i++) {
                                input = "<input class='form-control jml' data-id='"+dform_bahan[i].id+"' data-harga='"+dform_bahan[i].harga+"' placeholder='Jumlah Pemesanan'>";
                                dta[i] = [dform_bahan[i].id,dform_bahan[i].nama,dform_bahan[i].stok,dform_bahan[i].harga,input];
                              }
                              console.log(dta);
                              tabel_pengajua_a = table(["Kode Bahan","Nama Bahan","Stok","Harga","Jumlah"],dta,"ajukanwe");
                              form_ajukanlah = builder(frm_a,btn_a,"ajukanatuh",true,12);
                              var html_ajukanlah = [
                                "<div class='row'>",
                                "<div class='col-md-12'>",
                                "<h4>Data Pengadaan</h4>",
                                tabel_pengajua_a,
                                "<h4>Total : <span id='total'>0</span></h4>",
                                "<hr>",
                                "</div>",
                                "<div class='col-md-12'>",
                                form_ajukanlah,
                                "</div>",
                                "</div>",
                              ];
                              var ajukanlah = new jBox('Modal', {
                                title: 'Formulir Pengajuan Bahan Baku',
                                overlay: false,
                                width: '50%',
                                responsiveWidth:true,
                                height: 'auto',
                                createOnInit: true,
                                content: html_ajukanlah.join(""),
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
                                  tabel_ajukanlah.destroy();
                                },
                                onCreated:function(rs){
                                  ajukankontent = this.content;
                                  ajukankontent.find("#keterangan_suplier").attr("readonly",true);
                                  $.get("{{route("pengadaan.api.kode_pbb")}}",function(r){
                                    ajukankontent.find("#id_pengadaan_bb").val(r.kode);
                                  });
                                  $.get("{{route("pengadaan.api.master_suplier_read")}}/all",function(rs){
                                    st12 = []
                                    for (var i = 0; i < rs.length; i++) {
                                      st12[i] = {value:rs[i].id_suplier,text:rs[i].id_suplier+" - "+rs[i].nama_suplier};
                                    }
                                    selectbuilder(st12,ajukankontent.find("#id_suplier"));
                                    ajukankontent.find("#id_suplier").trigger('change');
                                  });
                                  ajukankontent.find("#cari").on('change', function(event) {
                                    event.preventDefault();
                                    console.log("Keypresed");
                                    ajukankontent.find("#id_suplier").html("");
                                    console.log($("#cari").val());
                                    $.get("{{route("pengadaan.api.master_suplier_read")}}/all",function(rs){
                                      st12 = []
                                      for (var i = 0; i < rs.length; i++) {
                                        st12[i] = {value:rs[i].id_suplier,text:rs[i].id_suplier+" - "+rs[i].nama_suplier};
                                      }
                                      selectbuilder(st12,ajukankontent.find("#id_suplier"));
                                      ajukankontent.find("#id_suplier").trigger('change');
                                    }).fail(function(){
                                      new jBox('Notice', {content: 'Hey, Server Meledak',showCountdown:true, color: 'red'});
                                    });
                                  });
                                  ajukankontent.find("#id_suplier").on('change',function(event) {
                                    event.preventDefault();
                                    id = $(this).val();
                                    $.get("{{route("pengadaan.api.master_suplier_read")}}/"+id,function(rs){
                                      ajukankontent.find("#keterangan_suplier").val(rs.ket);
                                    });
                                  });
                                  tabel_ajukanlah = ajukankontent.find("#ajukanwe").DataTable({

                                  });
                                  ajukankontent.find("#ajukanwe .jml").on('change', function(event) {
                                    event.preventDefault();
                                    uTotal = ajukankontent.find("#total").html();
                                    uHarga = $(this).data("harga");
                                    uJumlah = $(this).val();
                                    jumlah = parseFloat(uJumlah);
                                    harga = parseFloat(uHarga);
                                    total = parseFloat(uTotal);
                                    console.log("Total = "+total);
                                    ajukankontent.find("#total").html(total+(harga*uJumlah));
                                  });
                                  ajukankontent.find("#ajukanatuh").on('submit',  function(event) {
                                    event.preventDefault();
                                    cekzero = true;
                                    dform_pengadaan = [];
                                    dform_bahan2 = [];
                                    dform_harga = [];
                                    $.each(ajukankontent.find("#ajukanwe .jml"),function(index, el) {
                                      obj = $(el);
                                      if (obj.val() == 0 || obj.val() == "" || obj.val() == undefined) {
                                        cekzero = false;
                                        return false;
                                      }else {
                                        dform_bahan2[index] = {value:obj.val(),name:"jumlah["+obj.data("id")+"]"};
                                        dform_harga[index] = {value:obj.data('harga'),name:"harga["+obj.data("id")+"]"};
                                      }

                                    });
                                    if (cekzero == false) {
                                      new jBox('Notice', {content: 'Tolong isi jumlah pengadaan bahan lebih dari 0',showCountdown:true, color: 'red'});
                                    }else {
                                      dform_pengadaan = $(this).serializeArray();
                                      console.log("Data Terkumpul");
                                      console.log(dform_bahan2);
                                      console.log(dform_pengadaan);
                                      console.log(dform_harga);
                                      join = [];
                                      $.each(dform_bahan2,function(index, el) {
                                        join[join.length] = el;
                                      });
                                      $.each(dform_pengadaan,function(index, el) {
                                        join[join.length] = el;
                                      });
                                      $.each(dform_harga,function(index, el) {
                                        join[join.length] = el;
                                      });
                                      on();
                                      $.ajax({
                                        url: '{{route("pengadaan.api.pengandaan_bahanabaku_insert")}}',
                                        type: 'post',
                                        dataType: 'json',
                                        data: join
                                      })
                                      .done(function(rs) {
                                        console.log(rs);
                                        if (rs.status == 1) {
                                          new jBox('Notice', {content: rs.msg,showCountdown:true, color: 'green'});
                                          ajukanlah.close();
                                          set.close();
                                          mastersatuan_table.ajax.reload();
                                        }else {
                                          new jBox('Notice', {content: rs.msg,showCountdown:true, color: 'red'});
                                          ajukanlah.close();
                                          set.close();
                                          mastersatuan_table.ajax.reload();
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

                                    }
                                  });
                                }
                              });
                              ajukanlah.open();
                            });
                          }
                        });
                        instance1 = set.open();
                      }
                    }
                  ]
            });
            content.find("#pbahanbaku_table").on('click','.rincian',function(event) {
              event.preventDefault();
              id = $(this).data("id");
              console.log("Rincian ID "+id);
              on();
              $.ajax({
                url: '{{route("pengadaan.api.pbahanabaku_read")}}/'+id,
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
                    height: 'auto',
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
            content.find("#pbahanbaku_table").on('click', '.batalkan', function(event) {
              event.preventDefault();
              console.log($(this).data("id"));
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
                  $.get("{{route("pengadaan.api.pengandaan_bahanabaku_batal")}}/"+$(this).data("id"),function(rs){
                    if (rs.status == 1) {
                      new jBox('Notice', {content: 'Pengadaan Sukses Dibatalkan',showCountdown:true, color: 'green'});
                    }else {
                      new jBox('Notice', {content: 'Gagal Membatalkan Pengadaan',showCountdown:true, color: 'red'});
                    }
                    mastersatuan_table.ajax.reload();
                  }).fail(function(){
                    new jBox('Notice', {content: 'Hey, Server Meledak',showCountdown:true, color: 'red'});
                  });
                }
              })
            });
          }
        });
        instance = master_satuan.open();

      });
      $("#pproduk").on('click', function(event) {
        event.preventDefault();

      });
    });
  });
</script>
@endpush
