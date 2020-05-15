<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <center><span style="font-size: 30px;" class="brand-text font-weight-light"><b>TaromboBatak</b></span></center>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <a href="#" class="d-block">{{ Session::get('id_username_token') }}</a>
        </div>
        <div class="info">
          <i class="nav-icon far fa-circle text-success"></i>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <li class="nav-header">MEMBER</li>
          <li class="nav-item">
            <a href="{{ route('Member.member') }}" class="nav-link">
              <i class="nav-icon fa fa-user"></i>
              <p>
                Member Management
                <span class="badge badge-info right">6</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('Member.tambah_member') }}" class="nav-link">
              <i class="nav-icon fas fa-plus "></i>
              <p>
                Tambah Member
              </p>
            </a>
          </li>

        <li class="nav-header">DATA MASTER</li>
        <li class="nav-item">
          <a href="{{ route('Marga.tambah_marga')}}" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Tambah Marga
            </p>
          </a>
        </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
      
    </div>
    <!-- /.sidebar -->
  </aside>