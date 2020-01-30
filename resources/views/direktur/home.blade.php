@extends('layout.app')
@section("title",$title)
@section("content")
<div class="page-header">
  <h1 class="page-title">
    Dashboard
  </h1>
</div>
<div class="row row-cards">
  <div class="col-6">
    <div class="card">
      <div class="card-body p-9 text-center">
        <div id="icon" class="text-right text-default">
          0%
          <i class="fe fe-minus"></i>
        </div>
        <div id="hari_ini" class="h1 m-0">Rp. 0 ,-</div>
        <div class="text-muted mb-4">Pendapatan Hari Ini</div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="row">
        <div class="card p-4">
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
        <div class="card p-4">
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
        <div class="card p-5">
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
  <div class="col-lg-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Data Penyerapan Bahan Baku</h3>
      </div>
      <div class="card-body">
          <div id="cs1" style="height: 20rem"></div>
      </div>
    </div>
  </div>
  <div class="col-lg-6">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Data Penyerapan Produk</h3>
      </div>
      <div class="card-body">
          <div id="cs2" style="height: 20rem"></div>
      </div>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Aktivitas Pemasaran</h3>
      </div>
      <div id="pemasaran" style="height: 12.2rem"></div>
    </div>
  </div>

  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Aktivitas Produksi</h3>
      </div>
      <div id="produksi" style="height: 12.2rem"></div>
    </div>
  </div>
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Aktivitas Pengadaan</h3>
      </div>
      <div id="pengadaan" style="height: 12.2rem"></div>
    </div>
  </div>
</div>
@endsection
@push("script")
<script type="text/javascript">
  require(['datatables','sweetalert2','c3', 'jquery','jbox','select2','datatables.button','chartjs'], function (datatables,Swal,c3, $,jbox,select2,dt,Chart) {
    $(document).ready(function(){
      console.log(Chart);
      var cs1 = c3.generate({
        bindto: '#cs1', // specify the DOM element to which the chart will be bound
        data: {
          xs: {
                setosa: 'setosa_x',
                versicolor: 'versicolor_x',
              },
              columns: [
                ['setosa_x', 3.5, 3.0, 3.2, 3.1, 3.6, 3.9, 3.4, 3.4, 2.9, 3.1, 3.7, 3.4, 3.0, 3.0, 4.0, 4.4, 3.9, 3.5, 3.8, 3.8, 3.4, 3.7, 3.6, 3.3, 3.4, 3.0, 3.4, 3.5, 3.4, 3.2, 3.1, 3.4, 4.1, 4.2, 3.1, 3.2, 3.5, 3.6, 3.0, 3.4, 3.5, 2.3, 3.2, 3.5, 3.8, 3.0, 3.8, 3.2, 3.7, 3.3],
                ['versicolor_x', 3.2, 3.2, 3.1, 2.3, 2.8, 2.8, 3.3, 2.4, 2.9, 2.7, 2.0, 3.0, 2.2, 2.9, 2.9, 3.1, 3.0, 2.7, 2.2, 2.5, 3.2, 2.8, 2.5, 2.8, 2.9, 3.0, 2.8, 3.0, 2.9, 2.6, 2.4, 2.4, 2.7, 2.7, 3.0, 3.4, 3.1, 2.3, 3.0, 2.5, 2.6, 3.0, 2.6, 2.3, 2.7, 3.0, 2.9, 2.9, 2.5, 2.8],
                ['setosa', 0.2, 0.2, 0.2, 0.2, 0.2, 0.4, 0.3, 0.2, 0.2, 0.1, 0.2, 0.2, 0.1, 0.1, 0.2, 0.4, 0.4, 0.3, 0.3, 0.3, 0.2, 0.4, 0.2, 0.5, 0.2, 0.2, 0.4, 0.2, 0.2, 0.2, 0.2, 0.4, 0.1, 0.2, 0.2, 0.2, 0.2, 0.1, 0.2, 0.2, 0.3, 0.3, 0.2, 0.6, 0.4, 0.3, 0.2, 0.2, 0.2, 0.2],
                ['versicolor', 1.4, 1.5, 1.5, 1.3, 1.5, 1.3, 1.6, 1.0, 1.3, 1.4, 1.0, 1.5, 1.0, 1.4, 1.3, 1.4, 1.5, 1.0, 1.5, 1.1, 1.8, 1.3, 1.5, 1.2, 1.3, 1.4, 1.4, 1.7, 1.5, 1.0, 1.1, 1.0, 1.2, 1.6, 1.5, 1.6, 1.5, 1.3, 1.3, 1.3, 1.2, 1.4, 1.2, 1.0, 1.3, 1.2, 1.3, 1.3, 1.1, 1.3],
              ],
          type: 'scatter'
        },
        axis: { // specify the x and y axis labels
          x: {
            label: 'Stok',
          },
          y: {
            label: 'Total Transaksi'
          }
        }
      });
      var cs2 = c3.generate({
        bindto: '#cs2', // specify the DOM element to which the chart will be bound
        data: {
          xs: {
            setosa: 'setosa_x',
            versicolor: 'versicolor_x',
          },
          columns: [
            ['setosa_x', 3.5, 3.0, 3.2, 3.1, 3.6, 3.9, 3.4, 3.4, 2.9, 3.1, 3.7, 3.4, 3.0, 3.0, 4.0, 4.4, 3.9, 3.5, 3.8, 3.8, 3.4, 3.7, 3.6, 3.3, 3.4, 3.0, 3.4, 3.5, 3.4, 3.2, 3.1, 3.4, 4.1, 4.2, 3.1, 3.2, 3.5, 3.6, 3.0, 3.4, 3.5, 2.3, 3.2, 3.5, 3.8, 3.0, 3.8, 3.2, 3.7, 3.3],
            ['versicolor_x', 3.2, 3.2, 3.1, 2.3, 2.8, 2.8, 3.3, 2.4, 2.9, 2.7, 2.0, 3.0, 2.2, 2.9, 2.9, 3.1, 3.0, 2.7, 2.2, 2.5, 3.2, 2.8, 2.5, 2.8, 2.9, 3.0, 2.8, 3.0, 2.9, 2.6, 2.4, 2.4, 2.7, 2.7, 3.0, 3.4, 3.1, 2.3, 3.0, 2.5, 2.6, 3.0, 2.6, 2.3, 2.7, 3.0, 2.9, 2.9, 2.5, 2.8],
            ['setosa', 0.2, 0.2, 0.2, 0.2, 0.2, 0.4, 0.3, 0.2, 0.2, 0.1, 0.2, 0.2, 0.1, 0.1, 0.2, 0.4, 0.4, 0.3, 0.3, 0.3, 0.2, 0.4, 0.2, 0.5, 0.2, 0.2, 0.4, 0.2, 0.2, 0.2, 0.2, 0.4, 0.1, 0.2, 0.2, 0.2, 0.2, 0.1, 0.2, 0.2, 0.3, 0.3, 0.2, 0.6, 0.4, 0.3, 0.2, 0.2, 0.2, 0.2],
            ['versicolor', 1.4, 1.5, 1.5, 1.3, 1.5, 1.3, 1.6, 1.0, 1.3, 1.4, 1.0, 1.5, 1.0, 1.4, 1.3, 1.4, 1.5, 1.0, 1.5, 1.1, 1.8, 1.3, 1.5, 1.2, 1.3, 1.4, 1.4, 1.7, 1.5, 1.0, 1.1, 1.0, 1.2, 1.6, 1.5, 1.6, 1.5, 1.3, 1.3, 1.3, 1.2, 1.4, 1.2, 1.0, 1.3, 1.2, 1.3, 1.3, 1.1, 1.3],
          ],
          type: 'scatter'
        },
        axis: { // specify the x and y axis labels
          x: {
            label: 'Stok',
          },
          y: {
            label: 'Total Transaksi'
          }
        }
      });
      cs1.unload({ ids: 'setosa' });
      cs1.unload({ ids: 'versicolor' });
      cs2.unload({ ids: 'setosa' });
      cs2.unload({ ids: 'versicolor' });
      async function persebaran() {
        res = await $.get("{{route("trend")}}").then();
        cs1.load(res);
      }
      async function persebaran_produk() {
        res = await $.get("{{route("trend_produk")}}").then();
        cs2.load(res);

      }
      persebaran();
      persebaran_produk();
      async function pemasaran() {
        obj1 = "#pemasaran";
        res = await $.post("{{route("chart")}}",{pemasaran_harian:true}).then();
        var chart1 = c3.generate({
          bindto: obj1,
          data: {
              x:"x",
              columns:res,
              type: 'line'
          },
          line: {
              width: {
                  ratio: 0.5
              }
          },
          axis: {
                  x: {
                      type: 'timeseries',
                      tick: {
                          format: '%d-%m-%Y'
                      }
                  }
              },
          tooltip: {
                  format: {
                      value: function(value) {
                          return "Rp. "+d3.format(",.2f")(value)
                      }
                  }
              }
        });
      }
      async function stat() {
        res = await $.post("{{route("chart")}}",{stat:true}).then();
        $("#st_pengadaan").html(res.pengadaan[0]);
        $("#st_pengadaan_s").html(res.pengadaan[1]+" Selesai");
        $("#st_produksi").html(res.produksi[0]);
        $("#st_produksi_s").html(res.produksi[1]+" Selesai");
        $("#st_penjualan").html(res.pemasaran[0]);
        $("#st_penjualan_s").html(res.pemasaran[1]+" Selesai");
        if (res.stat_penjualan.icon == "flat") {
          color = 'text-right text-default';
          icon = res.stat_penjualan.percent+"%<li class='fa fa-minus'></li>";
        }else if (res.stat_penjualan.icon == "up") {
          color = 'text-right text-green';
          icon = res.stat_penjualan.percent+"%<li class='fa fa-chevron-up'></li>";
        }else if (res.stat_penjualan.icon == "down") {
          color = 'text-right text-red';
          icon = res.stat_penjualan.percent+"%<li class='fa fa-chevron-down'></li>";
        }
        $("#icon").attr('class', color);
        $("#icon").html(icon);
        $("#hari_ini").html(res.stat_penjualan.pendapatan);

      }
      async function produksi() {
        obj2 = "#produksi";
        res = await $.post("{{route("chart")}}",{produksi:true}).then();
        var chart2 = c3.generate({
          bindto: obj2,
          data: {
              x:"x",
              columns:res,
              type: 'bar'
          },
          bar: {
              width: {
                  ratio: 0.5
              }
          },
          axis: {
                  x: {
                      type: 'timeseries',
                      tick: {
                          format: '%m-%Y'
                      }
                  }
              },
          tooltip: {
                  format: {
                      value: function(value) {
                          return d3.format(",.0f")(value)
                      }
                  }
              }
        });
      }
      async function pengadaan() {
        obj3 = "#pengadaan";
        res = await $.post("{{route("chart")}}",{pengadaan:true}).then();
        var chart3 = c3.generate({
          bindto: obj3,
          data: {
              x:"x",
              columns:res,
              type: 'bar'
          },
          bar: {
              width: {
                  ratio: 0.5
              }
          },
          axis: {
                  x: {
                      type: 'timeseries',
                      tick: {
                          format: '%m-%Y'
                      }
                  }
              },
          tooltip: {
                  format: {
                      value: function(value) {
                          return d3.format(",.0f")(value)
                      }
                  }
              }
        });
      }
      stat();
      pemasaran();
      produksi();
      pengadaan();
      setInterval(function () {
        stat();
        pemasaran();
        persebaran();
        persebaran_produk();
        produksi();
        pengadaan();
      }, 10000);
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
            var btn = function(id,konf_perencanaan){
              var item = [];
              item.push('<a class="dropdown-item detail" href="javascript:void(0)" data-id="'+id+'">Detail</a>');
              if (konf_perencanaan == "Belum Diverifikasi") {
                item.push('<a class="dropdown-item tidak" href="javascript:void(0)" data-id="'+id+'">Tidak Setuju</a>');
                item.push('<a class="dropdown-item setujui" href="javascript:void(0)" data-id="'+id+'">Setuju</a>');
              }
              return '<button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle"></button><div class="dropdown-menu dropdown-menu-right">'+item.join("")+'</div>';
            };
            console.log(content);
            produksi_table = content.find("#produksi_table").DataTable({
              ajax:"{{route("private.api.produksi_read")}}",
              createdRow:function(r,d,i){
                $("td",r).eq(8).html(btn(d[8],d[3],d[6]));
              }
            });
            content.find("#produksi_table").on("click", ".detail", async function(event) {
              id = $(this).data("id");
              res = await $.get("{{route("private.api.produksi_read")}}/"+id).then();
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
            content.find("#produksi_table").on("click", ".tidak", function(event) {
              id = $(this).data("id");
              // private.api.produksi_update
              Swal.fire({
                title: 'Apakah Anda Yakin ? ',
                text: "Tolong Isi Alasan Anda, Menolak Produksi",
                type: 'warning',
                input:"textarea",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya'
              }).then( async (result) => {
                if (result.value) {
                  res = await $.post("{{route("private.api.produksi_update")}}/"+id,{konfirmasi_perencanaan:2,status_produksi:4,konfirmasi_direktur:1,catatan_direktur:result.value}).then();
                  if (res.status == 1) {
                    new jBox('Notice', {content: "Sukses Update Status",showCountdown:true, color: 'green'});
                  }else {
                    new jBox('Notice', {content: "Gagal Update Status",showCountdown:true, color: 'red'});
                  }
                  produksi_table.ajax.reload();
                }
              });
            });
            content.find("#produksi_table").on("click", ".setujui", function(event) {
              id = $(this).data("id");
              // private.api.produksi_update
              Swal.fire({
                title: 'Apakah Anda Yakin ? ',
                text: "Perubahan tidak bisa dikembalikan",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya'
              }).then( async (result) => {
                if (result.value) {
                  res = await $.post("{{route("private.api.produksi_update")}}/"+id,{konfirmasi_perencanaan:1,jenis:"implementasi",status_produksi:6,konfirmasi_direktur:1}).then();
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

      $("#shippingdirektur").on("click", function(event) {
        var btn = function(id,status_pengiriman,status_pembayaran){
          var item = [];
          item.push('<a class="dropdown-item detail" href="javascript:void(0)" data-id="'+id+'">Detail</a>');
          return '<button data-toggle="dropdown" type="button" class="btn btn-primary dropdown-toggle"></button><div class="dropdown-menu dropdown-menu-right">'+item.join("")+'</div>';
        };
        var tempLate = [
          "<div class=row>",
          "<div class=col-md-12>",
          "<div class=table-responsive>",
          "<table class='table table-stripped' id='dtable'>",
          "<thead>",
          "<th>No</th>",
          "<th>Kode Pengiriman</th>",
          "<th>No Polisi</th>",
          "<th>Jenis Kendaraan</th>",
          "<th>Tanggal Pengiriman</th>",
          "<th>Tanggal Kembali</th>",
          "<th>Nama Pengemudi</th>",
          "<th>Kontak Pengemudi</th>",
          "<th>Status Pengiriman</th>",
          "<th>Tanggal Register</th>",
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
          title: 'Pengiriman Produk',
          overlay: false,
          width: '100%',
          responsiveWidth:true,
          height: '500px',
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
              ajax:"{{route("private.api.pengiriman_read")}}",
              createdRow:function(r,d,i){
                console.log(d);
                console.log(d);
                $("td",r).eq(10).html(btn(d[10],d[8]));
              }
            });
            k.find("#dtable").on("click", ".detail", function(event) {
              id = $(this).data("id");
              $.get("{{route("private.api.pengiriman_read")}}/"+id,function(data){
                console.log(data);
                if (data.status == 1) {
                  var row = data.data;
                  var tempLate = [
                    "<div class=row>",
                    "<div class=col-md-6>",
                    "<div class=form-group>",
                    "<label>Kode Pengiriman</label>",
                    "<input class='form-control' value='"+row.id_pengiriman+"' disabled />",
                    "</div>",
                    "<div class=form-group>",
                    "<label>Total Pesanan</label>",
                    "<div class='row gutters-xs'>",
                    "<div class=col>",
                    "<input class='form-control' value='"+(row.pengiriman__details).length+"' disabled />",
                    "</div>",
                    "<span class=col-auto>",
                    "<button class='btn btn-secondary detail_item' data-id='"+row.id_pengiriman+"' type='button'><span class='fe fe-search'></span></button>",
                    "</span>",
                    "</div>",
                    "</div>",
                    "<div class=form-group>",
                    "<label>Status Pengiriman</label>",
                    "<input class='form-control' value='"+row.status_pengiriman_text+"' disabled />",
                    "</div>",
                    "<div class=form-group>",
                    "<label>Tanggal Pengiriman</label>",
                    "<input class='form-control' value='"+row.tgl_pengiriman_text+"' disabled />",
                    "</div>",
                    "</div>",
                    "<div class=col-md-6>",
                    "<div class=form-group>",
                    "<label>Catatan Pengiriman</label>",
                    "<textarea class='form-control' disabled >"+row.catatan_khusus+"</textarea>",
                    "</div>",
                    "<div class=form-group>",
                    "<label>Tanggal Kembali</label>",
                    "<input class='form-control' value='"+row.tgl_kembali_text+"' disabled />",
                    "</div>",
                    "<div class=form-group>",
                    "<label>Tangal Register</label>",
                    "<input class='form-control' value='"+row.tgl_register_text+"' disabled />",
                    "</div>",
                    "</div>",
                    "</div>",
                    "</div>"
                  ];
                  detail = [
                    "<div class=row>",
                    "<div class=col-md-12>",
                    "<div class=table-responsive>",
                    "<table class='table table-stripped' id='dtable1' style='width:100%'>",
                    "<thead>",
                    "<th>No</th>",
                    "<th>Kode Pesanan</th>",
                    "<th>Nama Pelanggan</th>",
                    "<th>Alamat Tujuan</th>",
                    "<th>Status Pesanan</th>",
                    "<th>Opsi</th>",
                    "</thead>",
                    "<thead>",
                    "</tbody>",
                    "</table>",
                    "</div>",
                    "</div>",
                    "</div>",
                  ];
                  modal = new jBox('Modal', {
                    title: 'Detail Pengiriman',
                    overlay: false,
                    width: '50%',
                    responsiveWidth:true,
                    height: '500px',
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
                      dt = [];
                      detail = row.pengiriman__details;
                      $.each(detail,function(i,v) {
                        dt.push([(i+1),v.id_pemesanan,v.pemesanan.master_pelanggan.nama_pelanggan,v.alamat_tujuan,v.pemesanan.status_pesanan_text])
                      });
                      k.find(".detail_item").on('click', function(event) {
                        id = $(this).data("id");
                        detail = [
                          "<div class=row>",
                          "<div class=col-md-12>",
                          "<div class=table-responsive>",
                          "<table class='table table-stripped' id='dtable2' style='width:100%'>",
                          "<thead>",
                          "<th>No</th>",
                          "<th>Kode Pesanan</th>",
                          "<th>Nama Pelanggan</th>",
                          "<th>Alamat Tujuan</th>",
                          "<th>Status Pesanan</th>",
                          "</thead>",
                          "<thead>",
                          "</tbody>",
                          "</table>",
                          "</div>",
                          "</div>",
                          "</div>",
                        ];
                        modal2 = new jBox('Modal', {
                          title: 'Detail Pesanan',
                          overlay: false,
                          width: '50%',
                          responsiveWidth:true,
                          height: '500px',
                          createOnInit: true,
                          content: detail.join(""),
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
                            $("#dtable2").DataTable({
                              data:dt
                            });
                          }
                        });
                        modal2.open();
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

          }
        });
        modal.open();
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
              ajax:"{{route("private.api.master_satuan_read")}}",
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
                                url: '{{route("private.api.master_satuan_update")}}/'+id,
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
                                url: '{{route("private.api.master_satuan_insert")}}',
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
                      url: '{{route("private.api.master_satuan_update")}}/'+id,
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
                      url: '{{route("private.api.master_satuan_insert")}}',
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
              ajax:"{{route("private.api.master_bb_read")}}",
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
                            $.get("{{route("private.api.master_satuan_read")}}/all",function(rs){
                              selectbuilder(rs,html.find("#id_satuan"))
                            });
                            html.find("#update").on('submit',function(event) {
                              event.preventDefault();
                              dform = $(this).serializeArray();
                              id = html.find("#id").val();
                              console.log(dform);
                              on();
                              $.ajax({
                                url: '{{route("private.api.master_bb_update")}}/'+id,
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
                                url: '{{route("private.api.master_bb_insert")}}',
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
              $.get("{{route("private.api.master_bb_read")}}/"+id,function(rs){
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
                    $.get("{{route("private.api.master_satuan_read")}}/all",function(rsa){
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
                        url: '{{route("private.api.master_bb_update")}}/'+id,
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
      $("#mastertransportasi").on('click',function(event) {
        event.preventDefault();
        tabel_bahanbaku = table(["Kode","Jenis Transportasi","No Polisi","Status Kendaraan","Tanggal Register",""],[],"mastertransportasi_table");
        var mastertransportasi_table = null;
        var mastertransportasi = new jBox('Modal', {
          title: 'Data Transportasi',
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
            mastertransportasi_table.destroy();
          },
          onCreated:function(rs){
            content = this.content;
            console.log(content);
            mastertransportasi_table = content.find("#mastertransportasi_table").DataTable({
              ajax:"{{route("private.api.master_transportasi_read")}}",
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
                                url: '{{route("private.api.master_transportasi_insert")}}',
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
              $.get("{{route("private.api.master_transportasi_read")}}/"+id,function(rs){
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
                        url: '{{route("private.api.master_transportasi_update")}}/'+id,
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
              ajax:"{{route("private.api.master_suplier_read")}}",
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
                                url: '{{route("private.api.master_suplier_insert")}}',
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
              $.get("{{route("private.api.master_suplier_read")}}/"+id,function(rs){
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
                        url: '{{route("private.api.master_suplier_update")}}/'+id,
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
              ajax:"{{route("private.api.master_produk_read")}}",
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

                            $.get("{{route("private.api.master_satuan_read")}}/all",function(rs){
                              selectbuilder(rs,html.find("#id_satuan"))
                            });
                            html.find("#create").on('submit',function(event) {
                              event.preventDefault();
                              dform = $(this).serializeArray();
                              console.log(dform);
                              on();
                              $.ajax({
                                url: '{{route("private.api.master_produk_insert")}}',
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
              $.get("{{route("private.api.master_produk_read")}}/"+id,function(rs){
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
                    $.get("{{route("private.api.master_satuan_read")}}/all",function(rsa){
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
                        url: '{{route("private.api.master_produk_update")}}/'+id,
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
                    ajax:"{{route("private.api.master_komposisi_read")}}/"+id,
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
                                $.get("{{route("private.api.master_bb_read")}}/all",function(rs){
                                  for (var i = 0; i < rs.length; i++) {
                                    st[i] = {value:rs[i].id_bb,text:rs[i].id_bb+" - "+rs[i].nama};
                                  }
                                  selectbuilder(st,html.find("#id_bb"));
                                }).fail(function(){
                                  new jBox('Notice', {content: 'Hey, Server Meledak',showCountdown:true, color: 'red'});
                                })
                                html.find("#cari").on('change', function(event) {
                                  event.preventDefault();
                                  console.log("Keypresed");
                                  html.find("#id_bb").html("");
                                  console.log($("#cari").val());
                                  $.get("{{route("private.api.master_bb_read")}}/all?q="+$(this).val(),function(rs){
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
                                  $.get("{{route("private.api.master_bb_read")}}/"+$(this).val(),function(rs){
                                    html.find("#harga_bahan").val(rs.harga+"/"+rs.nama_satuan);
                                  }).fail(function(){
                                    new jBox('Notice', {content: 'Hey, Server Meledak',showCountdown:true, color: 'red'});
                                  })
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
                                    url: '{{route("private.api.master_komposisi_insert")}}',
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
                        $.get("{{route("private.api.master_komposisi_hapus")}}/"+id_komposisi,function(rs){
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
              // $.get("{{route("private.api.master_komposisi_read")}}/"+id,function(rs){
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
          height: '500px',
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
              ajax:"{{route("private.api.master_pelanggan_read")}}",
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
                                url: '{{route("private.api.master_pelanggan_insert")}}',
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
              $.get("{{route("private.api.master_pelanggan_read")}}/"+id,function(rs){
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
                        url: '{{route("private.api.master_pelanggan_update")}}/'+id,
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
      $("#pengguna").on('click',function(event) {
        event.preventDefault();
        tabel_pengguna = table(["Kode","Nama","No Kontak","Alamat","Email","Level","Status","Tanggal Register",""],[],"pengguna_table");
        var pengguna_table = null;
        var pengguna = new jBox('Modal', {
          title: 'Data Pengguna SCM',
          overlay: false,
          width: '100%',
          responsiveWidth:true,
          height: '500px',
          createOnInit: true,
          content: tabel_pengguna,
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
            pengguna_table.destroy();
          },
          onCreated:function(rs){
            content = this.content;
            console.log(content);
            pengguna_table = content.find("#pengguna_table").DataTable({
              ajax:"{{route("private.api.pengguna_read")}}",
              dom: 'Bfrtip',
              buttons: [
                  {
                      className: "btn btn-success",
                      text: 'Tambah Pengguna SCM',
                      action: function ( e, dt, node, config ) {
                        frm = [
                          [
                            {
                              label:"Nama Pengguna SCM",
                              type:"text",
                              name:"nama_pengguna"
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
                            },{
                              label:"Level",
                              type:"select2",
                              name:"level",
                              id:"level",
                            }
                          ]
                        ];
                        btn = {name:"Simpan",class:"success",type:"submit"};
                        formSatuan = builder(frm,btn,"create",true,12);
                        set = new jBox('Modal', {
                          title: 'Tambah Pengguna SCM',
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
                            pengguna_table.ajax.reload();
                          },
                          onCreated:function(){
                            console.log("Initialize");
                            html = this.content;
                            level = [
                              {
                                value:"direktur",
                                text:"Direktur"
                              },{
                                value:"produksi",
                                text:"Produksi"
                              },{
                                value:"gudang",
                                text:"Gudang"
                              },{
                                value:"pengadaan",
                                text:"Pengadaan"
                              },{
                                value:"pemasaran",
                                text:"Pemasaran"
                              },
                            ];
                            selectbuilder(level,html.find("#level"));
                            html.find("#create").on('submit',function(event) {
                              event.preventDefault();
                              dform = $(this).serializeArray();
                              console.log(dform);
                              on();
                              $.ajax({
                                url: '{{route("private.api.pengguna_insert")}}',
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
            content.find("#pengguna_table").on('click', '.aktifkan', function(event) {
              event.preventDefault();
              id_aktifkan = $(this).data("id");
              Swal.fire({
                title: 'Apakah Anda Yakin ? ',
                text: "Status Pengguna Akan di Aktifkan",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya'
              }).then((result) => {
                if (result.value) {
                  $.post("{{route("private.api.pengguna_update")}}/"+id_aktifkan+"?status=1",function(rs){
                    if (rs.status == 1) {
                      new jBox('Notice', {content: 'Data Sukses Di update',showCountdown:true, color: 'green'});
                    }else {
                      new jBox('Notice', {content: 'Gagal Update Data',showCountdown:true, color: 'red'});
                    }
                    pengguna_table.ajax.reload();
                  }).fail(function(){
                    new jBox('Notice', {content: 'Hey, Server Meledak',showCountdown:true, color: 'red'});
                  });
                }
              })
            });
            content.find("#pengguna_table").on('click', '.matikan', function(event) {
              event.preventDefault();
              id_matikan = $(this).data("id");
              Swal.fire({
                title: 'Apakah Anda Yakin ? ',
                text: "Status Pengguna Akan di Aktifkan",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya'
              }).then((result) => {
                if (result.value) {
                  $.post("{{route("private.api.pengguna_update")}}/"+id_matikan+"?status=0",function(rs){
                    if (rs.status == 1) {
                      new jBox('Notice', {content: 'Data Sukses Di update',showCountdown:true, color: 'green'});
                    }else {
                      new jBox('Notice', {content: 'Gagal Update Data',showCountdown:true, color: 'red'});
                    }
                    pengguna_table.ajax.reload();
                  }).fail(function(){
                    new jBox('Notice', {content: 'Hey, Server Meledak',showCountdown:true, color: 'red'});
                  });
                }
              })

            });
            content.find("#pengguna_table").on('click','.edit',function(event) {
              event.preventDefault();
              id = $(this).data("id");
              $.get("{{route("private.api.pengguna_read")}}/"+id,function(rs){
              frm = [
                [
                  {
                    label:"Nama Pengguna SCM",
                    type:"text",
                    name:"nama_pengguna",
                    value:rs.nama_pengguna
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
                    value:rs.password
                  },{
                    label:"Level",
                    type:"select2",
                    name:"level",
                    id:"level",
                  }
                ]
              ];
                btn = {name:"Ubah",class:"warning",type:"submit"};
                formSatuan = builder(frm,btn,"update",true,12);
                set = new jBox('Modal', {
                  title: 'Ubah Pengguna SCM',
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
                    pengguna_table.ajax.reload();
                  },
                  onCreated:function(){
                    console.log("Initialize");
                    html = this.content;
                    level = [
                      {
                        value:"direktur",
                        text:"Direktur"
                      },{
                        value:"produksi",
                        text:"Produksi"
                      },{
                        value:"gudang",
                        text:"Gudang"
                      },{
                        value:"pengadaan",
                        text:"Pengadaan"
                      },
                    ];
                    selectbuilder(level,html.find("#level"),[{value:rs.level,text:rs.level}]);
                    html.find("#update").on('submit',function(event) {
                      event.preventDefault();
                      dform = $(this).serializeArray();
                      console.log(dform);
                      on();
                      $.ajax({
                        url: '{{route("private.api.pengguna_update")}}/'+id,
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
        instance = pengguna.open();

      });
      $("#mpengadaan").on('click',function(event) {
        event.preventDefault();
        console.log("mpengadaan");
        tabel_mpengadaan = table(["No","Kode","Suplier","Status Pengadaan","Konf. Direktur","Tanggal PO",""],[],"mpengadaan_table");
        tabel_mpengadaanproduk = table(["No","Kode","Suplier","Status Pengadaan","Konf. Direktur","Tanggal PO",""],[],"mpengadaanproduk_table");
        buildRow = [
          "<div class=row>",
          "<div class=col-md-6>",
          "<div class=table-responsive>",
          tabel_mpengadaan,
          "</div>",
          "</div>",
          "<div class=col-md-6>",
          tabel_mpengadaanproduk,
          "</div>",
          "</div>",
        ];
        var mpengadaan_table = null;
        var mpengadaanproduk_table = null;
        var mpengadaan = new jBox('Modal', {
          title: 'Data Pengadaan',
          overlay: false,
          width: '100%',
          responsiveWidth:true,
          height: '500px',
          createOnInit: true,
          content: buildRow.join(""),
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
            mpengadaan_table.destroy();
            mpengadaanproduk_table.destroy();
          },
          onCreated:function(rs){
            content = this.content;
            console.log(content);

            content.find("#mpengadaan_table").before('<h4 align=center>Data Pengadaan Bahan</h4>');
            mpengadaan_table = content.find("#mpengadaan_table").DataTable({
              ajax:"{{route("private.api.pbahanbaku_read_direktur")}}"
            });
            content.find("#mpengadaanproduk_table").before('<h4 align=center>Data Pengadaan Produk</h4>');
            mpengadaanproduk_table = content.find("#mpengadaanproduk_table").DataTable({
              ajax:"{{route("private.api.pproduk_read_direktur")}}"
            });
            content.find("#mpengadaan_table").on('click','.rincian',function(event) {
              event.preventDefault();
              id = $(this).data("id");
              console.log("Rincian ID "+id);
              on();
              $.ajax({
                url: '{{route("private.api.pbahanbaku_read_direktur")}}/'+id,
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
                mpengadaan_table.ajax.reload();
              });

            });
            content.find("#mpengadaan_table").on('click', '.setujui', function(event) {
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
                  $.get("{{route("private.api.pbahanbaku_setujui_direktur")}}/"+$(this).data("id"),function(rs){
                    if (rs.status == 1) {
                      new jBox('Notice', {content: 'Pengadaan Sukses Disetujui',showCountdown:true, color: 'green'});
                    }else {
                      new jBox('Notice', {content: 'Gagal Menyetujui Pengadaan',showCountdown:true, color: 'red'});
                    }
                    mpengadaan_table.ajax.reload();
                  }).fail(function(){
                    new jBox('Notice', {content: 'Hey, Server Meledak',showCountdown:true, color: 'red'});
                  });
                }
              })
            });
            content.find("#mpengadaan_table").on('click', '.tolak', function(event) {
              event.preventDefault();
              console.log($(this).data("id"));

              Swal.fire({
                title: 'Apakah Anda Yakin ? ',
                text: "Tolong Isi Alasan Anda, Menolak Pengadaan Bahan Baku",
                type: 'warning',
                input:"textarea",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya'
              }).then((result) => {
                if (result.value) {
                  // console.log(result.value);
                  $.get("{{route("private.api.pbahanbaku_tolak_direktur")}}/"+$(this).data("id")+"/"+result.value,function(rs){
                    if (rs.status == 1) {
                      new jBox('Notice', {content: 'Pengadaan Sukses Tolak',showCountdown:true, color: 'green'});
                    }else {
                      new jBox('Notice', {content: 'Gagal Tolak Pengadaan',showCountdown:true, color: 'red'});
                    }
                    mpengadaan_table.ajax.reload();
                  }).fail(function(){
                    new jBox('Notice', {content: 'Hey, Server Meledak',showCountdown:true, color: 'red'});
                  });
                }
              })
            });
            content.find("#mpengadaan_table").on('click', '.retur', function(event) {
              event.preventDefault();
              idpo = $(this).data("id");
              console.log(idpo);
              on();
              function view(id) {
                console.log(id);
                $.get("{{route("private.api.pbahanbakugudangretur_detailretur")}}/"+id,function(rs){
                  if (rs.status == 1) {
                    compact = [];
                    $.each(rs.data.pengadaan__bb_retur_details,function(index, el) {
                      compact[index] = [el.pengadaan_bb_detail.master_bb.id_bb,el.pengadaan_bb_detail.master_bb.nama,el.pengadaan_bb_detail.jumlah,el.total_retur,el.catatan_retur];
                    });
                    tbls_init = table(["Kode Barang","Nama Barang","Total Pesan","Total Retur","Catatan Retur"],compact,"tbls_init");
                    function confirmBtn(id) {
                      if (id == null) {
                        s = [
                          "<div class=form-group>",
                          "<button class='btn btn-success m-2' id='konfirmasi'>Konfirmasi Retur</button>",
                          "<button class='btn btn-danger m-2' id='tolak'>Tolak Retur</button>",
                          "</div>",
                        ];
                        return s.join("");
                      }else {
                        return null;
                      }
                    }
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
                      "<textarea id=catatan_direktur class=form-control  "+((rs.data.catatan_direktur == null)?"":"disabled placeholder='Isi Catatan Direktur'")+">"+((rs.data.catatan_direktur == null)?"":rs.data.catatan_direktur)+"</textarea>",
                      "</div>",
                      "<div class=form-group>",
                      "<label>Catatan Pengadaan</label>",
                      "<textarea disabled id=catatan_pengadaan class=form-control >"+(rs.data.catatan_pengadaan)+"</textarea>",
                      "</div>",
                      confirmBtn(rs.data.catatan_direktur),
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
                        returid = rs.data.id_pengadaan_bb_retur;
                        function sendCatatan(catatan,status,id) {
                          if (catatan == null || catatan == "") {
                            new jBox('Notice', {content: 'Tolong Isi Catatan Direktur',showCountdown:true, color: 'red'});
                          }else {
                            on();
                            $.get("{{route("private.api.konfirmasi_retur")}}/"+status+"/"+id+"?catatan="+catatan,function(s){
                              if (s.status == 1) {
                                new jBox('Notice', {content: 'Retur Berhasil di Konfirmasi',showCountdown:true, color: 'green'});
                              }else {
                                new jBox('Notice', {content: 'Gagal Konfirmasi Retur',showCountdown:true, color: 'red'});
                              }
                              off();
                              modal.close();
                            }).fail(function(rs){
                              new jBox('Notice', {content: 'Komunikasi Dengan Server Terputus',showCountdown:true, color: 'red'});
                              off();
                            });
                          }
                        }
                        konten.find("#konfirmasi").on('click', function(event) {
                          event.preventDefault();
                          getCatatan = konten.find("#catatan_direktur").val();
                          console.log(returid);
                          sendCatatan(getCatatan,1,returid);
                        });
                        konten.find("#tolak").on('click', function(event) {
                          event.preventDefault();
                          getCatatan = konten.find("#catatan_direktur").val();
                          console.log(returid);
                          sendCatatan(getCatatan,0,returid);
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
                url: '{{route("private.api.pbahanbakugudangretur_check")}}/'+idpo,
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
                  new jBox('Notice', {content: 'Pengajuan Retur Harus Di Buat Oleh Bag. Gudang',showCountdown:true, color: 'red'});
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
            content.find("#mpengadaanproduk_table").on('click','.rincian_produk',function(event) {
              event.preventDefault();
              id = $(this).data("id");
              console.log("Rincian ID "+id);
              on();
              $.ajax({
                url: '{{route("private.api.pproduk_read_direktur")}}/'+id,
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
                      tabel_produk_isi = table(["Kode Produk","Nama Bahan","Stok","Harga","Jumlah"],dtas,"tbl_s");
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
                mpengadaanproduk_table.ajax.reload();
              });

            });
            content.find("#mpengadaanproduk_table").on('click', '.setujui_produk', function(event) {
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
                  $.get("{{route("private.api.pproduk_setujui_direktur")}}/"+$(this).data("id"),function(rs){
                    if (rs.status == 1) {
                      new jBox('Notice', {content: 'Pengadaan Sukses Disetujui',showCountdown:true, color: 'green'});
                    }else {
                      new jBox('Notice', {content: 'Gagal Menyetujui Pengadaan',showCountdown:true, color: 'red'});
                    }
                    mpengadaanproduk_table.ajax.reload();
                  }).fail(function(){
                    new jBox('Notice', {content: 'Hey, Server Meledak',showCountdown:true, color: 'red'});
                  });
                }
              })
            });
            content.find("#mpengadaanproduk_table").on('click', '.tolak_produk', function(event) {
              event.preventDefault();
              console.log($(this).data("id"));

              Swal.fire({
                title: 'Apakah Anda Yakin ? ',
                text: "Tolong Isi Alasan Anda, Menolak Pengadaan Bahan Baku",
                type: 'warning',
                input:"textarea",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya'
              }).then((result) => {
                if (result.value) {
                  // console.log(result.value);
                  $.get("{{route("private.api.pproduk_tolak_direktur")}}/"+$(this).data("id")+"/"+result.value,function(rs){
                    if (rs.status == 1) {
                      new jBox('Notice', {content: 'Pengadaan Sukses Tolak',showCountdown:true, color: 'green'});
                    }else {
                      new jBox('Notice', {content: 'Gagal Tolak Pengadaan',showCountdown:true, color: 'red'});
                    }
                    mpengadaanproduk_table.ajax.reload();
                  }).fail(function(){
                    new jBox('Notice', {content: 'Hey, Server Meledak',showCountdown:true, color: 'red'});
                  });
                }
              })
            });
            content.find("#mpengadaanproduk_table").on('click', '.retur_produk', function(event) {
              event.preventDefault();
              idpo = $(this).data("id");
              console.log(idpo);
              on();
              function view(id) {
                console.log(id);
                $.get("{{route("private.api.pprodukgudangretur_detailretur")}}/"+id,function(rs){
                  if (rs.status == 1) {
                    compact = [];
                    $.each(rs.data.pengadaan__produk_retur_details,function(index, el) {
                      compact[index] = [el.pengadaan_produk_detail.master_produk.id_produk,el.pengadaan_produk_detail.master_produk.nama_produk,el.pengadaan_produk_detail.jumlah,el.total_retur,el.catatan_retur];
                    });
                    tbls_init = table(["Kode Barang","Nama Barang","Total Pesan","Total Retur","Catatan Retur"],compact,"tbls_init");
                    function confirmBtn(id) {
                      if (id == null) {
                        s = [
                          "<div class=form-group>",
                          "<button class='btn btn-success m-2' id='konfirmasi'>Konfirmasi Retur</button>",
                          "<button class='btn btn-danger m-2' id='tolak'>Tolak Retur</button>",
                          "</div>",
                        ];
                        return s.join("");
                      }else {
                        return null;
                      }
                    }
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
                      "<textarea id=catatan_direktur class=form-control  "+((rs.data.catatan_direktur == null)?"":"disabled placeholder='Isi Catatan Direktur'")+">"+((rs.data.catatan_direktur == null)?"":rs.data.catatan_direktur)+"</textarea>",
                      "</div>",
                      "<div class=form-group>",
                      "<label>Catatan Pengadaan</label>",
                      "<textarea disabled id=catatan_pengadaan class=form-control >"+(rs.data.catatan_pengadaan)+"</textarea>",
                      "</div>",
                      confirmBtn(rs.data.catatan_direktur),
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
                        returid = rs.data.id_pengadaan_produk_retur;
                        function sendCatatan(catatan,status,id) {
                          if (catatan == null || catatan == "") {
                            new jBox('Notice', {content: 'Tolong Isi Catatan Direktur',showCountdown:true, color: 'red'});
                          }else {
                            on();
                            $.get("{{route("private.api.konfirmasi_retur_produk")}}/"+status+"/"+id+"?catatan="+catatan,function(s){
                              if (s.status == 1) {
                                new jBox('Notice', {content: 'Retur Berhasil di Konfirmasi',showCountdown:true, color: 'green'});
                              }else {
                                new jBox('Notice', {content: 'Gagal Konfirmasi Retur',showCountdown:true, color: 'red'});
                              }
                              off();
                              modal.close();
                            }).fail(function(rs){
                              new jBox('Notice', {content: 'Komunikasi Dengan Server Terputus',showCountdown:true, color: 'red'});
                              off();
                            });
                          }
                        }
                        konten.find("#konfirmasi").on('click', function(event) {
                          event.preventDefault();
                          getCatatan = konten.find("#catatan_direktur").val();
                          console.log(returid);
                          sendCatatan(getCatatan,1,returid);
                        });
                        konten.find("#tolak").on('click', function(event) {
                          event.preventDefault();
                          getCatatan = konten.find("#catatan_direktur").val();
                          console.log(returid);
                          sendCatatan(getCatatan,0,returid);
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
                url: '{{route("private.api.pprodukgudangretur_check")}}/'+idpo,
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
                  new jBox('Notice', {content: 'Pengajuan Retur Harus Di Buat Oleh Bag. Gudang',showCountdown:true, color: 'red'});
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
        instance = mpengadaan.open();
      });
      $("#pengaturan").on('click', function(event) {
        event.preventDefault();
        console.log("Menu Pengaturan");
        frm = [
          [
            {
              label:"PPn",
              type:"text",
              id:"ppn"
            },{
              label:"PPh",
              type:"text",
              id:"pph"
            }
          ]
        ];
        btn = {name:"Update",class:"warning",type:"submit"};
        frmPengaturan = builder(frm,btn,"update",true,12);
        modal = new jBox('Modal', {
                    title: 'Pengaturan Aplikasi',
                    overlay: false,
                    width: '500px',
                    responsiveWidth:true,
                    height: '500px',
                    createOnInit: true,
                    content: frmPengaturan,
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
                      f = this.content;
                      function load(){
                        $.get("{{route("private.api.pengaturan")}}/ppn",function(r){
                          tr = r;
                          $.get("{{route("private.api.pengaturan")}}/pph",function(rr){
                            trr = rr;
                            f.find("#ppn").val(tr.meta_value)
                            f.find("#pph").val(trr.meta_value)
                          })
                        })
                      }
                      load();
                      f.find("#update").on('submit',function(event) {
                        event.preventDefault();
                        console.log("Loading .. ");
                        on();
                        drm = {ppn:f.find("#ppn").val(),pph:f.find("#pph").val()};
                        console.log(drm);
                        $.ajax({
                          url: '{{route("private.api.pengaturan_update")}}',
                          type: 'POST',
                          dataType: 'JSON',
                          data: drm
                        })
                        .done(function(r) {
                          if (r.status == 1) {
                            new jBox('Notice', {content: 'Update Pengaturan Berhasil',showCountdown:true, color: 'green'});
                          }else {
                            new jBox('Notice', {content: 'Update Pengaturan Gagal',showCountdown:true, color: 'red'});
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
                          load();
                        });

                      });
                    }
                });
          modal.open();
      });
      $("#mpesanan").on("click",function(event) {
        var btn = function(id,status_pesanan,status_pembayaran){
          var item = [];
          item.push('<a class="dropdown-item detail" href="javascript:void(0)" data-id="'+id+'">Detail</a>');
          if (status_pesanan == "Belum Diproses" && status_pembayaran == "Sedang Diverifikasi") {
            item.push('<a class="dropdown-item verifikasi" href="javascript:void(0)" data-id="'+id+'">Verifikasi Pembayaran</a>');
            item.push('<a class="dropdown-item tolak_verifikasi" href="javascript:void(0)" data-id="'+id+'">Tolak Pembayaran</a>');
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
          height: '500px',
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
              ajax:"{{route("private.api.pemesanan_read")}}",
              createdRow:function(r,d,i){
                console.log(d);
                $("td",r).eq(9).html(btn(d[1],d[3],d[5]));
              }
            });
            k.find("#dtable").on("click", ".verifikasi", function(event) {
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
                  $.post("{{route("private.api.pemesanan_update")}}/"+id,{status_pembayaran:3},function(d){
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

            k.find("#dtable").on("click", ".tolak_verifikasi", function(event) {
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
                  $.post("{{route("private.api.pemesanan_update")}}/"+id,{status_pembayaran:2},function(d){
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
                      $.post("{{route("private.api.pemesanan_update")}}/"+id,{file:e.target.result},function(d){
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
              $.get("{{route("private.api.pemesanan_read")}}/"+id,function(data){
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
                    height: '500px',
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
                        $.get("{{route("private.api.master_pelanggan_read")}}/"+id,function(rs){
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
