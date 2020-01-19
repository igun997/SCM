<div class="dropdown d-none d-md-flex">
  <a class="nav-link icon" data-toggle="dropdown" id="parent_bell">
    <i class="fe fe-bell"></i>
    <span id="notif_class" class="nav-read"></span>
  </a>
  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow" id="notif_item">

  </div>
</div>
<div class="dropdown" oncli>
  <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
    <span class="avatar" style="background-image: url({{ Gravatar::src(session()->get("email")) }})"></span>
    <span class="ml-2 d-none d-lg-block">
      <span class="text-default">{{session()->get("nama")}}</span>
      <small class="text-muted d-block mt-1">{{strtoupper(session()->get("level"))}}</small>
    </span>
  </a>
  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
    <a class="dropdown-item" href="#">
      <i class="dropdown-icon fe fe-settings"></i> Settings
    </a>
    <a class="dropdown-item" href="{{route("public.normal.logout")}}">
      <i class="dropdown-icon fe fe-log-out"></i> Sign out
    </a>
  </div>
</div>
