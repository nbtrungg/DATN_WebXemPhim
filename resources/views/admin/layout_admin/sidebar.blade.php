<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="/assets/images/logotrung.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Admin</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      
      <div class="info">
        <a href="#" class="d-block">{{$user->name}}</a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item menu-open">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Bảng Diều Khiển
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('danh-muc.create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Danh Mục Phim</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('the-loai.create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Thể Loại</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('quoc-gia.create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Quốc Gia</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('phim.create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Phim</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('tap-phim.create')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Tập Phim</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <div class="sidebar-custom" style="padding-top: 10px; text-align: center;">
    <a href="{{route('logout_admin')}}" class="btn btn-secondary" style=" width: 94%">Đăng Xuất<i class="fas fa-sign-out-alt" style="margin-left: 10px"></i></a>
  </div>
  <!-- /.sidebar -->
</aside>