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
        <h3 class="card-title">Aktivitas Pemasaran</h3>
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
  require(['datatables','sweetalert2','c3', 'jquery','jbox','select2','datatables.button','datepicker','smartcart','jqform'], function (datatables,Swal,c3, $,jbox,select2,datepicker,smartcart,ajaxForm) {
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
            'data1': 'Pemasaran'
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
              ajax:"{{route("pemasaran.api.master_produk_read")}}",

            });
            content.find("#masterproduk_table").on('click','.edit',function(event) {
              event.preventDefault();
              new jBox('Notice', {content: 'Anda Tidak Berhak Mengakses Fitur Ini',showCountdown:true, color: 'red'});
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
                    ajax:"{{route("pemasaran.api.master_komposisi_read")}}/"+id,
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
                        $.get("{{route("pemasaran.api.master_komposisi_hapus")}}/"+id_komposisi,function(rs){
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
              // $.get("{{route("pemasaran.api.master_komposisi_read")}}/"+id,function(rs){
              //
              // });
            });
          }
        });
        instance = masterproduk.open();
      });
      $("#masterpelanggan").on('click',function(event) {
        event.preventDefault();
        tabel_pelanggan = table(["Kode","Nama","Alamat","No Kontak","Email","Tanggal Register",""],[],"masterpelanggan_table");
        var masterpelanggan_table = null;
        var masterpelanggan = new jBox('Modal', {
          title: 'Data Pelanggan',
          overlay: false,
          width: '1000px',
          responsiveWidth:true,
          height: 'auto',
          createOnInit: true,
          content: tabel_pelanggan,
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
            masterpelanggan_table.destroy();
          },
          onCreated:function(rs){
            content = this.content;
            console.log(content);
            masterpelanggan_table = content.find("#masterpelanggan_table").DataTable({
              ajax:"{{route("pemasaran.api.master_pelanggan_read")}}",
              dom: 'Bfrtip',
              buttons: [
                  {
                      className: "btn btn-success",
                      text: 'Tambah Pelanggan',
                      action: function ( e, dt, node, config ) {
                        frm = [
                          [
                            {
                              label:"Nama Pelanggan",
                              type:"text",
                              name:"nama_pelanggan"
                            },{
                              label:"Alamat",
                              type:"textarea",
                              name:"alamat"
                            },{
                              label:"No Kontak",
                              type:"text",
                              name:"no_kontak"
                            },{
                              label:"Email",
                              type:"email",
                              name:"email"
                            },{
                              label:"Password",
                              type:"password",
                              name:"password"
                            }
                          ]
                        ];
                        btn = {name:"Simpan",class:"success",type:"submit"};
                        formSatuan = builder(frm,btn,"create",true,12);
                        set = new jBox('Modal', {
                          title: 'Tambah Pelanggan',
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
                            masterpelanggan_table.ajax.reload();
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
                                url: '{{route("pemasaran.api.master_pelanggan_insert")}}',
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
            content.find("#masterpelanggan_table").on('click','.edit',function(event) {
              event.preventDefault();
              id = $(this).data("id");
              $.get("{{route("pemasaran.api.master_pelanggan_read")}}/"+id,function(rs){
              frm = [
                [
                  {
                    label:"Nama Pelanggan",
                    type:"text",
                    name:"nama_pelanggan",
                    value:rs.nama_pelanggan
                  },{
                    label:"Alamat",
                    type:"textarea",
                    name:"alamat",
                    value:rs.alamat
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
                    label:"Password",
                    type:"password",
                    name:"password",
                    value:rs.email
                  }
                ]
              ];
                btn = {name:"Ubah",class:"warning",type:"submit"};
                formSatuan = builder(frm,btn,"update",true,12);
                set = new jBox('Modal', {
                  title: 'Ubah Pelanggan',
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
                    masterpelanggan_table.ajax.reload();
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
                        url: '{{route("pemasaran.api.master_pelanggan_update")}}/'+id,
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
        instance = masterpelanggan.open();

      });
      $("#mastertransportasi").on('click',function(event) {
        event.preventDefault();
        tabel_bahanbaku = table(["Kode","Jenis Transportasi","No Polisi","Status Kendaraan","Tanggal Register",""],[],"mastertransportasi_table");
        var mastertransportasi_table = null;
        var mastertransportasi = new jBox('Modal', {
          title: 'Data Transportasi',
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
            mastertransportasi_table.destroy();
          },
          onCreated:function(rs){
            content = this.content;
            console.log(content);
            mastertransportasi_table = content.find("#mastertransportasi_table").DataTable({
              ajax:"{{route("pemasaran.api.master_transportasi_read")}}",
              dom: 'Bfrtip',
              buttons: [
                  {
                      className: "btn btn-success",
                      text: 'Tambah Moda Transportasi',
                      action: function ( e, dt, node, config ) {
                        frm = [
                          [
                            {
                              label:"Jenis Transportasi",
                              type:"select2",
                              name:"jenis_transportasi",
                              id:"jenis"
                            },{
                              label:"No Polisi",
                              type:"text",
                              name:"no_polisi"
                            },{
                              label:"Status Kendaraan",
                              type:"select2",
                              name:"status_kendaraan",
                              id:"status_kendaraan",
                            }
                          ]
                        ];
                        btn = {name:"Simpan",class:"success",type:"submit"};
                        formSatuan = builder(frm,btn,"create",true,12);
                        set = new jBox('Modal', {
                          title: 'Tambah Moda Transportasi',
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
                            mastertransportasi_table.ajax.reload();
                          },
                          onCreated:function(){
                            console.log("Initialize");
                            html = this.content;
                            // html.find("#id_satuan").select2({
                            // });

                            selectbuilder(jenis,html.find("#jenis"));
                            selectbuilder(status_kendaraan,html.find("#status_kendaraan"));
                            html.find("#create").on('submit',function(event) {
                              event.preventDefault();
                              dform = $(this).serializeArray();
                              console.log(dform);
                              on();
                              $.ajax({
                                url: '{{route("pemasaran.api.master_transportasi_insert")}}',
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
            content.find("#mastertransportasi_table").on('click','.edit',function(event) {
              event.preventDefault();
              id = $(this).data("id");
              $.get("{{route("pemasaran.api.master_transportasi_read")}}/"+id,function(rs){
                frm = [
                  [
                    {
                      label:"Jenis Transportasi",
                      type:"select2",
                      name:"jenis_transportasi",
                      id:"jenis"
                    },{
                      label:"No Polisi",
                      type:"text",
                      name:"no_polisi",
                      value:rs.no_polisi
                    },{
                      label:"Status Kendaraan",
                      type:"select2",
                      name:"status_kendaraan",
                      id:"status_kendaraan",
                    }
                  ]
                ];
                btn = {name:"Ubah",class:"warning",type:"submit"};
                formSatuan = builder(frm,btn,"update",true,12);
                set = new jBox('Modal', {
                  title: 'Ubah Transportasi',
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
                    mastertransportasi_table.ajax.reload();
                  },
                  onCreated:function(){
                    console.log("Initialize");
                    html = this.content;
                    selectbuilder(jenis,html.find("#jenis"),[{value:rs.jenis_transportasi,text:rs.jenis_transportasi}]);
                    selectIt = null;
                    for (var i = 0; i < status_kendaraan.length; i++) {
                      if (status_kendaraan[i].value == rs.status_kendaraan) {
                          selectIt = [{value:status_kendaraan[i].value,text:status_kendaraan[i].text}];
                          break;
                      }
                    }
                    selectbuilder(status_kendaraan,html.find("#status_kendaraan"),selectIt);
                    html.find("#update").on('submit',function(event) {
                      event.preventDefault();
                      dform = $(this).serializeArray();
                      console.log(dform);
                      on();
                      $.ajax({
                        url: '{{route("pemasaran.api.master_transportasi_update")}}/'+id,
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
        instance = mastertransportasi.open();

      });
      var keyword = null;
      $("#pmproduk").on('click', function(event) {
        event.preventDefault();
        function createProduct(arr = [], col = 4) {
          template = [];
          console.log(arr);
          for (var i = 0; i < arr.length; i++) {
            var k = [
              '<div class="col-'+col+'">',
              '<div class="card">',
                 '<div class="card-body">',
                  '<div class="sc-product-item thumbnail">',
                  '<img data-name="product_image" src="http://placehold.it/250x150/2aabd2/ffffff?text='+arr[i].product_name+'" alt="...">',
                  '<div class="caption m-2">',
                  '<h4 data-name="product_name">'+arr[i].product_name+'</h4>',
                  '<p>'+arr[i].product_desc+'</p>',
                  '<p>SKU : '+arr[i].product_id+'</p>',
                  '<p>Sisa : '+arr[i].stok+'</p>',
                  '<hr class="line">',
                  '<div>',
                  '<div class="form-group">',
                  '<label>Jumlah<label>',
                  '<input class="form-control sc-cart-item-qty" name="product_quantity" min="1" value="1" type="number">',
                  '</div>',
                  '<strong class="price pull-left">Rp. '+arr[i].price+'</strong>',
                  '<input name="product_price" value="'+arr[i].product_price+'" type="hidden" />',
                  '<input name="product_id" value="'+arr[i].product_id+'" type="hidden" />',
                  '<button class="sc-add-to-cart btn btn-success btn-sm pull-right" >Tambah</button>',
                  '</div>',
                  '<div class="clearfix"></div>',
                  '</div>',
                  '</div>',
                  '</div>',
                  '</div>',
                  '</div>'
             ];
             console.log(k.join(""));
             template[i] = k.join("");
          }
          return template.join("");
        }
        btn = null;
        if (keyword != null) {
          btn = '<button class="btn btn-danger" id=delfit>Hapus Filter</button>';
        }else{
          keyword = "";
        }
        var konten = [
          '<div class=row>',
          '<div class=col-md-6>',
          '<div class=form-group>',
          '<input class="form-control" id=cari value="'+keyword+'" placeholder="Cari Dengan Kode Barang"/>',
          '</div>',
          '</div>',
          '<div class=col-md-3>',
          btn,
          '</div>',
          '<div class=col-8 >',
          '<div class=row id=list>',
          '</div>',
          '</div>',
          '<div class=col-4>',
          '<form action="" method=post id=fsave onsubmit="return false">',
          '<div id=cart>',
          '</div>',
          '</form>',
          '</div>',
          '</div>',
        ];
        url = "{{route("pemasaran.api.p_produk_read")}}";
        if (keyword != null) {
          url = "{{route("pemasaran.api.p_produk_read")}}/"+keyword;
        }
        $.get(url,function(r){
        modal = new jBox('Modal', {
          title: 'Penjualan Produk',
          overlay: false,
          width: '100%',
          responsiveWidth:true,
          height: '100%',
          createOnInit: true,
          content: konten.join(""),
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
            k = this.content;
            k.find("#list").html("");
              if (r.status == 1) {
                $.each(r.data,function(index, el) {
                  data = createProduct([{product_name:el.nama_produk,product_desc:el.deskripsi,price:el.harga_distribusi,product_price:el.harga_distribusi,product_id:el.id_produk,stok:el.stok}],3);
                  k.find("#list").append(data);
                });
              }else{
                new jBox('Notice', {content: r.msg,showCountdown:true, color: 'red'});
              }
              k.find("#cart").smartCart({
                currencySettings:{
                  locales: 'id-ID',
                  currencyOptions:  {
                    style: 'currency',
                    currency: 'IDR',
                    currencyDisplay: 'symbol'
                  }
                },
                lang: { // Language variables
                  cartTitle: "Pemasaran Produk",
                  checkout: 'Bayar',
                  clear: 'Bersihkan',
                  subtotal: 'Subtotal:',
                  cartRemove: '×',
                  cartEmpty: 'Keranjang Kosong, Mohon Pilih Barang'
                },
                submitSettings: {
                  submitType: 'ajax', // form, paypal, ajax
                  ajaxURL: '{{route("pemasaran.api.p_produk_trans")}}', // Ajax submit URL
                  ajaxSettings: {
                    success:function(rs){
                      if (rs.status == 1) {
                        new jBox('Notice', {content: rs.msg,showCountdown:true, color: 'green'})
                        modal.close();
                        $("#pmproduk").trigger("click");
                      }else {
                        console.log("Data Error");
                        console.log(rs.data);
                        new jBox('Notice', {content: rs.msg,showCountdown:true, color: 'red'})
                        msg = [];
                        for (var i = 0; i < rs.data.length; i++) {
                          msg[i] = "<p>Barang Dengan ID "+rs.data[i].id+" - "+rs.data[i].msg+"</p>";
                        }
                        new jBox('Notice', {content: msg.join("") ,showCountdown:true, color: 'blue'});

                      }
                    },
                    error:function(rs){
                      console.log("Catatan Gagal");
                      new jBox('Notice', {content: 'Maaf anda tida bisa melakukan transaksi saat ini',showCountdown:true, color: 'red'})
                    }
                  } // Ajax extra settings for submit call
                },
              });
              onchart = [
                '<div class=form-group>',
                '<label>Pilih Pelanggan</label>',
                '<select class=form-control id=pelangganlist name=id_pelanggan></select>',
                '</div>',
                '<div class=form-group>',
                '<label>Catatan</label>',
                '<textarea class=form-control name=catatan_pemesanan></textarea>',
                '</div>',
              ];
              k.find("#cart").find(".sc-cart-heading").after(onchart.join(""));
              $.get("{{route("pemasaran.api.listpelanggan")}}",function(s){
                $.each(s,function(index, el) {
                  k.find("#cart").find("#pelangganlist").append("<option value='"+el.id_pelanggan+"'>"+el.nama_pelanggan+"</option>");
                });
              })
              k.find("#cart").on('cartSubmitted', function(event) {
                event.preventDefault();
                new jBox('Notice', {content: 'Transaksi Selesai',showCountdown:true, color: 'green'});
              });
              k.find("#cari").on('change', function(event) {
                event.preventDefault();
                keyword = $(this).val();
                modal.close();
                $("#pmproduk").trigger("click");
              });
              k.find("#delfit").on('click', function(event) {
                event.preventDefault();
                keyword = null;
                modal.close();
                $("#pmproduk").trigger("click");
              });
          }
        });
        modal.open();
      }).fail(function(r){
        new jBox('Notice', {content: "Anda Terputus Dengan Server",showCountdown:true, color: 'red'});
      });
      });
      $("#produklist").on("click", function(event) {
        var btn = function(id,status_pesanan,status_pembayaran){
          var item = [];
          item.push('<a class="dropdown-item detail" href="javascript:void(0)" data-id="'+id+'">Detail</a>');
          if ((status_pembayaran == "Belum Dibayar" || status_pembayaran == "Pembayaran Ditolak") && status_pesanan != "Dibatalkan") {
            item.push('<a class="dropdown-item bayar" href="javascript:void(0)" data-id="'+id+'">Bayar</a>');
          }else if (status_pesanan == "Dibatalkan" && status_pembayaran == "Pembayaran Diterima") {
            item.push('<a class="dropdown-item refund" href="javascript:void(0)" data-id="'+id+'">Refund Dana</a>');
          }
          if (status_pesanan == "Belum Diproses") {
            item.push('<a class="dropdown-item batalkan" data-id="'+id+'" href="javascript:void(0)">Batalkan Pesanan</a>');
          }
          return '<button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle"></button><div class="dropdown-menu dropdown-menu-right">'+item.join("")+'</div>';
        };
        var tempLate = [
          "<div class=row>",
          "<div class=col-md-12>",
          "<div class=table-responsive>",
          "<table class='table table-stripped' id='dtable'>",
          "<thead>",
          "<th>No</th>",
          "<th>Kode Pemesanan</th>",
          "<th>Nama Pelanggan</th>",
          "<th>Status Pemesanan</th>",
          "<th>Catatan Pemesanan</th>",
          "<th>Status Pembayaran</th>",
          "<th>Pajak</th>",
          "<th>Total + Pajak</th>",
          "<th>Tanggal</th>",
          "<th>Aksi</th>",
          "</thead>",
          "<thead>",
          "</tbody>",
          "</table>",
          "</div>",
          "</div>",
          "</div>"
        ];
        modal = new jBox('Modal', {
          title: 'Daftar Penjualan Produk',
          overlay: false,
          width: '100%',
          responsiveWidth:true,
          height: 'auto',
          createOnInit: true,
          content: tempLate.join(""),
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
            k = this.content;
            var dtable = k.find("#dtable").DataTable({
              ajax:"{{route("pemasaran.api.pemesanan_read")}}",
              createdRow:function(r,d,i){
                console.log(d);
                $("td",r).eq(9).html(btn(d[1],d[3],d[5]));
              }
            });
            k.find("#dtable").on("click", ".batalkan", function(event) {
              id = $(this).data("id");
              console.log(id);
              console.log("Batalkan");
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
                  $.post("{{route("pemasaran.api.pemesanan_update")}}/"+id,{status_pesanan:5,status_pembayaran:2},function(d){
                    if (d.status == 1) {
                      new jBox('Notice', {content: "Sukses Update Status",showCountdown:true, color: 'green'});
                    }else {
                      new jBox('Notice', {content: "Gagal Update Status",showCountdown:true, color: 'red'});
                    }
                    dtable.ajax.reload();
                  }).fail(function(r){
                    new jBox('Notice', {content: "Anda Terputus Dengan Server",showCountdown:true, color: 'red'});
                  });
                }
              })
            });
            async function uploadImage(id,d){
              const { value: file } = await Swal.fire({
                title: 'Pilih Bukti Pembayaran',
                input: 'file',
                inputAttributes: {
                  accept: 'image/*',
                  'aria-label': 'Upload Bukti Pembayaran',
                  'id':"file"
                }
              })

              if (file) {
                const reader = new FileReader()
                reader.onload = (e) => {
                  Swal.fire({
                    title: 'Apakah Anda Yakin ?',
                    imageUrl: e.target.result,
                    imageAlt: 'Bukti yang akan di upload',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya'
                  }).then(res => {
                    if (res.value) {
                      console.log(e.target.result);
                      // var form_data = new FormData();
                      // form_data.append('file', e.target.result);
                      // console.log("Ok");
                      $.post("{{route("pemasaran.api.pemesanan_update")}}/"+id,{file:e.target.result},function(d){
                        if (d.status == 1) {
                          new jBox('Notice', {content: "Bukti Pembayaran Telah Di Upload",showCountdown:true, color: 'green'});
                        }else {
                          new jBox('Notice', {content: "Data Tidak Ditemukan",showCountdown:true, color: 'yellow'});
                        }
                        dtable.ajax.reload();
                      }).fail(function(){
                        new jBox('Notice', {content: "Server Error",showCountdown:true, color: 'red'});
                      })
                    }
                  });
                }
                reader.readAsDataURL(file);
              }
            }
            k.find("#dtable").on("click", ".detail", function(event) {
              id = $(this).data("id");
              $.get("{{route("pemasaran.api.pemesanan_read")}}/"+id,function(data){
                console.log(data);
                if (data.status == 1) {
                  var row = data.data;
                  var tempLate = [
                    "<div class=row>",
                    "<div class=col-md-6>",
                    "<div class=form-group>",
                    "<label>Kode Pemesanan</label>",
                    "<input class='form-control' value='"+row.id_pemesanan+"' disabled />",
                    "</div>",
                    "<div class=form-group>",
                    "<label>Nama Pemesan</label>",
                    "<div class='row gutters-xs'>",
                    "<div class=col>",
                    "<input class='form-control' value='"+row.master_pelanggan.nama_pelanggan+"' disabled />",
                    "</div>",
                    "<span class=col-auto>",
                    "<button class='btn btn-secondary detail_pelanggan' data-id='"+row.id_pelanggan+"' type='button'><span class='fe fe-search'></span></button>",
                    "</span>",
                    "</div>",
                    "</div>",
                    "<div class=form-group>",
                    "<label>Status Pemesanan</label>",
                    "<input class='form-control' value='"+row.status_pesanan_text+"' disabled />",
                    "</div>",
                    "<div class=form-group>",
                    "<label>Status Pembayaran</label>",
                    "<input class='form-control' value='"+row.status_pembayaran_text+"' disabled />",
                    "</div>",
                    "</div>",
                    "<div class=col-md-6>",
                    "<div class=form-group>",
                    "<label>Bukti Pembayaran</label>",
                    "<img class='img-fluid' onerror='onErr(this)' src='"+row.bukti_url+"'/>",
                    "<div class=form-group>",
                    "<label>Catatan Pemesanan</label>",
                    "<textarea class='form-control' disabled >"+row.catatan_pemesanan+"</textarea>",
                    "</div>",
                    "<div class=form-group>",
                    "<label>Total Harga + Pajak</label>",
                    "<input class='form-control' value='"+row.totalharga+"' disabled />",
                    "</div>",
                    "<div class=form-group>",
                    "<label>Tangal Pemesanan</label>",
                    "<input class='form-control' value='"+row.tgl_register_text+"' disabled />",
                    "</div>",
                    "</div>",
                    "</div>",
                    "<div class=col-md-12>",
                    "<div class=table-responsive>",
                    "<table class='table table-stripped' id='dtable1' style='width:100%'>",
                    "<thead>",
                    "<th>No</th>",
                    "<th>Kode Barang</th>",
                    "<th>Nama Barang</th>",
                    "<th>Jumlah Pesan</th>",
                    "<th>Harga <span class='badge badge-danger'>Saat Pemesanan</span></th>",
                    "</thead>",
                    "<thead>",
                    "</tbody>",
                    "</table>",
                    "</div>",
                    "</div>",
                    "</div>"
                  ];
                  modal = new jBox('Modal', {
                    title: 'Detail Penjualan Produk',
                    overlay: false,
                    width: '50%',
                    responsiveWidth:true,
                    height: 'auto',
                    createOnInit: true,
                    content: tempLate.join(""),
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
                      k = this.content;
                      var data_table = [];
                      $.each(row.pemesanan__details,function(i,el) {
                        data_table.push([(i+1),el.id_produk,el.master_produk.nama_produk,el.jumlah,el.harga]);
                      });

                      var dtable1 = k.find("#dtable1").DataTable({
                        data:data_table
                      });
                      k.find(".detail_pelanggan").on('click', function(event) {
                        id = $(this).data("id");
                        console.log(id);
                        $.get("{{route("pemasaran.api.master_pelanggan_read")}}/"+id,function(rs){
                        frm = [
                          [
                            {
                              label:"Nama Pelanggan",
                              type:"disabled",
                              name:"nama_pelanggan",
                              value:rs.nama_pelanggan
                            },{
                              label:"Alamat",
                              type:"disabled",
                              name:"alamat",
                              value:rs.alamat
                            },{
                              label:"No Kontak",
                              type:"disabled",
                              name:"no_kontak",
                              value:rs.no_kontak
                            },{
                              label:"Email",
                              type:"disabled",
                              name:"email",
                              value:rs.email
                            }
                          ]
                        ];
                          formSatuan = builder(frm,null,"update",true,12);
                          set = new jBox('Modal', {
                            title: 'Data Pelanggan',
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
                            },
                            onCreated:function(){
                              console.log("Initialize");
                              html = this.content;
                            }
                          });
                          set.open();
                        });
                      })
                    }
                  });
                  modal.open();
                }else {
                  new jBox('Notice', {content: "Data Tidak Ditemukan",showCountdown:true, color: 'warning'});
                }
              }).fail(function(){
                new jBox('Notice', {content: "Server Error 500",showCountdown:true, color: 'danger'});
                console.log("Fail Sever Error");
              });
            })
            k.find("#dtable").on('click', '.bayar', function(event) {
              uploadImage($(this).data("id"));
            })
          }
        });
        modal.open();
      })
    });

  });
</script>
@endpush
