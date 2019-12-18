<div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg order-lg-first">
        <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
          @if(session()->get("level") == "direktur")
          <li class="nav-item">
            <a href="{{route("private.direktur.home")}}" class="nav-link"><i class="fe fe-home"></i> Beranda</a>
          </li>
          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-box"></i> Data Master</a>
            <div class="dropdown-menu dropdown-menu-arrow">
              <a href="" id="mastersatuan" class="dropdown-item ">Satuan</a>
              <a href="" id="masterbb" class="dropdown-item ">Bahan Baku</a>
              <a href="" id="mastertransportasi" class="dropdown-item ">Transportasi</a>
              <a href="" id="mastersuplier" class="dropdown-item ">Suplier</a>
              <a href="" id="masterpelanggan" class="dropdown-item ">Pelanggan</a>
              <a href="" id="masterproduk" class="dropdown-item ">Produk dan Komposisi</a>
              <a href="" id="pengguna" class="dropdown-item ">Akun SCM</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-eye"></i> Monitoring</a>
            <div class="dropdown-menu dropdown-menu-arrow">
              <a href="" class="dropdown-item ">Pemesanan Produk</a>
              <a href="" class="dropdown-item " id="mpengadaan">Pengadaan</a>
              <a href="" class="dropdown-item ">Pengiriman</a>
              <a href="" class="dropdown-item ">Produksi</a>
            </div>
          </li>
          <li class="nav-item">
            <a href="" id="pengaturan" class="nav-link"><i class="fe fe-settings"></i> Pengaturan Aplikasi</a>
          </li>
          @elseif(session()->get("level") == "pengadaan")
          <li class="nav-item">
            <a href="{{route("private.pengadaan.home")}}" class="nav-link"><i class="fe fe-home"></i> Beranda</a>
          </li>
          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-box"></i> Data Master</a>
            <div class="dropdown-menu dropdown-menu-arrow">
              <a href="" id="mastersatuan" class="dropdown-item ">Satuan</a>
              <a href="" id="mastersuplier" class="dropdown-item ">Suplier</a>
              <a href="" id="masterbb" class="dropdown-item ">Bahan Baku</a>
              <a href="" id="masterproduk" class="dropdown-item ">Produk</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-shopping-cart"></i> Pengadaan</a>
            <div class="dropdown-menu dropdown-menu-arrow">
              <a href="" id="pbahanbaku" class="dropdown-item ">Bahan Baku</a>
              <a href="" id="pproduk" class="dropdown-item ">Produk</a>
            </div>
          </li>
          @elseif(session()->get("level") == "gudang")
          <li class="nav-item">
            <a href="{{route("private.gudang.home")}}" class="nav-link"><i class="fe fe-home"></i> Beranda</a>
          </li>
          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-box"></i> Data Master</a>
            <div class="dropdown-menu dropdown-menu-arrow">
              <a href="" id="mastersatuan" class="dropdown-item ">Satuan</a>
              <a href="" id="mastersuplier" class="dropdown-item ">Suplier</a>
              <a href="" id="masterbb" class="dropdown-item ">Bahan Baku</a>
              <a href="" id="masterproduk" class="dropdown-item ">Produk</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-download"></i>Penerimaan Pengadaan</a>
            <div class="dropdown-menu dropdown-menu-arrow">
              <a href="" id="pbahanbaku" class="dropdown-item ">Bahan Baku</a>
              <a href="" id="pproduk" class="dropdown-item ">Produk</a>
            </div>
          </li>
          @elseif(session()->get("level") == "pemasaran")
          <li class="nav-item">
            <a href="{{route("private.pemasaran.home")}}" class="nav-link"><i class="fe fe-home"></i> Beranda</a>
          </li>
          <li class="nav-item">
            <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-box"></i> Data Master</a>
            <div class="dropdown-menu dropdown-menu-arrow">
              <a href="" id="masterpelanggan" class="dropdown-item ">Pelanggan</a>
              <a href="" id="masterproduk" class="dropdown-item ">Produk</a>
              <a href="" id="mastertransportasi" class="dropdown-item ">Transportasi</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-upload"></i>Pemasaran</a>
            <div class="dropdown-menu dropdown-menu-arrow">
              <a href="#" id="pmproduk" class="dropdown-item ">Penjualan Produk</a>
              <a href="#" id="produklist" class="dropdown-item ">Daftar Penjualan Produk</a>
              <!-- <a href="" id="manajemenpos" class="dropdown-item ">Manajemen PoS</a> -->
            </div>
          </li>
          <li class="nav-item dropdown">
            <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fa fa-spinner"></i> Marketplace Monitoring</a>
            <div class="dropdown-menu dropdown-menu-arrow">
              <a href="" id="lazada" class="dropdown-item ">Lazada</a>
              <a href="" id="shopee" class="dropdown-item ">Shopee</a>
              <a href="" id="tokopedia" class="dropdown-item ">Tokopedia</a>
              <a href="" id="bl" class="dropdown-item ">Bukalapak</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-file"></i>Laporan Pemasaran</a>
            <div class="dropdown-menu dropdown-menu-arrow">
              <a href="" id="lppmproduk" class="dropdown-item ">Pemasaran Produk</a>
            </div>
          </li>
          @endif
        </ul>
      </div>
    </div>
  </div>
</div>
