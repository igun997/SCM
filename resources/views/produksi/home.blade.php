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
      <div class="table-responsive">
        <table class="table card-table table-striped table-vcenter">
          <thead>
            <tr>
              <th colspan="2">Kode Produksi</th>
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
      produksi_html = table(["Kode","Jenis","Konf. Perencanaan","Konf. Direktur","Konf. Gudang","Status Produksi",""],[],"produksi_table");
      console.log(produksi_table);
      var produksi_table = null;
      var produksi = new jBox('Modal', {
        title: 'Data Produksi',
        overlay: false,
        width: '800px',
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
          console.log(content);
          produksi_table = content.find("#produksi_table").DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    className: "btn btn-success",
                    text: 'Tambah Produksi',
                    action: function ( e, dt, node, config ) {
                      
                    }
                  }
            ]
          });
        }
      });
      instance = produksi.open();

    })
    $("#produksikontrol").on("click", function(event) {
      console.log("Produksi Kontrol");
    })
  });
});
</script>
@endpush
