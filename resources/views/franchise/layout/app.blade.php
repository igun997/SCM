<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield("title")</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{url("assets2/plugins/fontawesome-free/css/all.min.css")}}">
  <link rel="stylesheet" href="{{url("assets2/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css")}}">
  <link rel="stylesheet" href="{{url("assets2/plugins/toastr/toastr.css")}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url("assets2/css/adminlte.min.css")}}">
  <link href="{{url("assets2/plugins/select2/css/select2.min.css")}}" rel="stylesheet" />
  <link href="{{url("assets2/plugins/select2-bootstrap4-theme/select2-bootstrap4-theme.min.css")}}" rel="stylesheet" />
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" />

  <!-- Google Font: Source Sans Pro -->
  <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="//cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
  @yield("css")
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="@yield("url")" class="brand-link">
      <img src="{{url("assets/images/logo.png")}}" alt="WENOW" class="brand-image"
           style="opacity: .8">
      <span class="brand-text font-weight-light">WENOW</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      @include("franchise.layout.menu")
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      @yield("konten")
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        @yield("content",null)
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
    WENOW
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; {{date("Y")}} <a href="{{url("")}}">WENOW</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{url("assets2/plugins/jquery/jquery.min.js")}}"></script>
<script type="text/javascript">
$.ajaxSetup({
  headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
</script>
<!-- Bootstrap 4 -->
<script src="{{url("assets2/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<script src="{{url("assets2/plugins/datatables/jquery.dataTables.min.js")}}"></script>

<script src="{{url("assets2/plugins/datatables-bs4/js/dataTables.bootstrap4.js")}}"></script>
<script src="{{url("assets2/plugins/toastr/toastr.min.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{url("assets2/js/adminlte.min.js")}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.3.2/bootbox.min.js" integrity="sha256-s87nschhfp/x1/4+QUtIa99el2ot5IMQLrumROuHZbc=" crossorigin="anonymous"></script>
<script src="{{url("assets2/plugins/select2/js/select2.min.js")}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

<script src="//cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js " charset="utf-8"></script>
<script src="//cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js" charset="utf-8"></script>
<script type="text/javascript">

</script>
@yield("js")
</body>
</html>
