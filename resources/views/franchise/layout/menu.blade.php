<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      @if(session()->get("level") == "gerai")
      <li class="nav-item">
        <a href="{{session()->get("url")}}" class="nav-link">
          <i class="nav-icon fas fa-home"></i>
          <p>Beranda</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route("gerai.barang")}}" class="nav-link">
          <i class="nav-icon fas fa-file"></i>
          <p>Data Barang</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route("gerai.layanan")}}" class="nav-link">
          <i class="nav-icon fas fa-file"></i>
          <p>Data Layanan</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route("gerai.pesanan")}}" class="nav-link">
          <i class="nav-icon fas fa-file"></i>
          <p>Pesanan</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route("gerai.keuangan")}}" class="nav-link">
          <i class="nav-icon fas fa-file"></i>
          <p>Laporan Keuangan</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route("gerai.lapbarang")}}" class="nav-link">
          <i class="nav-icon fas fa-file"></i>
          <p>Laporan Barang</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route("gerai.lappesanan")}}" class="nav-link">
          <i class="nav-icon fas fa-file"></i>
          <p>Laporan Pesanan</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route("public.normal.logout")}}" class="nav-link">
          <i class="nav-icon fas fa-sign-out-alt"></i>
          <p>Logout</p>
        </a>
      </li>
      @elseif(session()->get("level") == "mentor")
      <li class="nav-item">
        <a href="{{session()->get("url")}}" class="nav-link">
          <i class="nav-icon fas fa-home"></i>
          <p>Beranda</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route("mentor.franchise")}}" class="nav-link">
          <i class="nav-icon fas fa-file"></i>
          <p>Data Franchise</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="" class="nav-link">
          <i class="nav-icon fas fa-file"></i>
          <p>Controlling</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="" class="nav-link">
          <i class="nav-icon fas fa-file"></i>
          <p>Bagi Hasil</p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{route("public.normal.logout")}}" class="nav-link">
          <i class="nav-icon fas fa-sign-out-alt"></i>
          <p>Logout</p>
        </a>
      </li>
      @else
        <li class="nav-item">
          <a href="{{route("public.normal.login")}}" class="nav-link">
            <i class="nav-icon fas fa-sign-in-alt"></i>
            <p>Login</p>
          </a>
        </li>
      @endif
  </ul>
</nav>
