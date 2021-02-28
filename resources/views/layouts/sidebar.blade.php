<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('dashboard') }}">
                <div class="sidebar-brand-icon ">
                    <img src="{{ asset('icon.svg') }}" width="40px" height="auto" alt="">
                </div>
                <div class="sidebar-brand-text mx-3" ">Tabungan siswa</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                     <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
           
        @if (Auth::user()->IsAdmin == TRUE)
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('kelas') }}">
                    <i class="fas fa-chalkboard"></i>
                     <span>Kelas</span>
                </a>
            </li>
            
             <li class="nav-item active">
                <a class="nav-link" href="{{ url('siswa') }}">
                     <i class="fas fa-user-graduate"></i>
                     <span>Siswa</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <i class="fas fa-university"></i>
                    <span>Tabungan</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar" style="">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ url('tabungan') }}">Tabungan </a>
                        <a class="collapse-item" href="{{ url('tabungan_masuk_admin') }}">Tabungan Masuk</a>
                        <a class="collapse-item" href="{{ url('tabungan_keluar_admin') }}">Tabungan Keluar</a>
                    </div>
                </div>
            </li>

            


        @else
    

             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <i class="fas fa-university"></i>
                    <span>Tabungan</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar" style="">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ url('tabungan') }}">Tabungan </a>
                        <a class="collapse-item" href="{{ url('tabungan_masuk') }}">Riwayat Tabungan Masuk</a>
                        <a class="collapse-item" href="{{ url('tabungan_keluar') }}">Riwayat Tabungan Keluar</a>
                    </div>
                </div>
            </li>


        @endif
          

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
           

        </ul>