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

    });
  });
</script>
@endpush
