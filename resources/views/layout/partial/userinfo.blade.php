<div class="dropdown d-none d-md-flex">
  <a class="nav-link icon" data-toggle="dropdown">
    <i class="fe fe-bell"></i>
    <span class="nav-unread"></span>
  </a>
  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
    <a href="#" class="dropdown-item d-flex">
      <span class="avatar mr-3 align-self-center" style="background-image: url(demo/faces/male/41.jpg)"></span>
      <div>
        <strong>Nathan</strong> pushed new commit: Fix page load performance issue.
        <div class="small text-muted">10 minutes ago</div>
      </div>
    </a>
    <a href="#" class="dropdown-item d-flex">
      <span class="avatar mr-3 align-self-center" style="background-image: url(demo/faces/female/1.jpg)"></span>
      <div>
        <strong>Alice</strong> started new task: Tabler UI design.
        <div class="small text-muted">1 hour ago</div>
      </div>
    </a>
    <a href="#" class="dropdown-item d-flex">
      <span class="avatar mr-3 align-self-center" style="background-image: url(demo/faces/female/18.jpg)"></span>
      <div>
        <strong>Rose</strong> deployed new version of NodeJS REST Api V3
        <div class="small text-muted">2 hours ago</div>
      </div>
    </a>
    <div class="dropdown-divider"></div>
    <a href="#" class="dropdown-item text-center text-muted-dark">Mark all as read</a>
  </div>
</div>
<div class="dropdown">
  <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
    <span class="avatar" style="background-image: url(./demo/faces/female/25.jpg)"></span>
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
