<!-- Sidebar -->
<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #0a312a;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <img src="{{ asset('images/home/logo-seafood.png') }}" height="50" width="50" alt="">
        </div>
        <div class="sidebar-brand-text mx-3">Sophia<sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ !empty($sidebarDashboard) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    @can('isOwner')
        <!-- Heading -->
        <div class="sidebar-heading">
            Transaksi
        </div>
        <li class="nav-item {{ !empty($sidebarTransaksi) ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTransaksi"
                aria-expanded="true" aria-controls="collapseTransaksi">
                <i class="fas fa-fw fa-hamburger"></i>
                <span>Transaksi</span>
            </a>
            <div id="collapseTransaksi" class="collapse" aria-labelledby="headingTransaksi" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Transaksi Page:</h6>
                    <a class="collapse-item" href="{{ route('meja.show.list') }}">List</a>
                    <a class="collapse-item" href="{{ route('meja.show.free') }}">New</a>
                    <a class="collapse-item" href="{{ route('meja.show.active') }}">Active</a>
                </div>
            </div>
        </li>
        <hr class="sidebar-divider d-none d-md-block">

        <li class="nav-item {{ !empty($sidebarLaporan) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('transaksi.laporan.table') }}">
                <i class="fas fa-fw fa-file-invoice-dollar"></i>
                <span>Laporan</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <li class="nav-item {{ !empty($sidebarStatistik) ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('transaksi.laporan.chart') }}">
                <i class="fas fa-fw fa-chart-pie"></i>
                <span>Statistik</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Master Data
        </div>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item {{ !empty($sidebarUser) ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true"
                aria-controls="collapseUser">
                <i class="fas fa-fw fa-user"></i>
                <span>User</span>
            </a>
            <div id="collapseUser" class="collapse" aria-labelledby="headingUser" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">User Page:</h6>
                    <a class="collapse-item" href="{{ route('user.create') }}">Add</a>
                    <a class="collapse-item" href="{{ route('user.index') }}">List</a>
                    <a class="collapse-item" href="{{ route('user.thrased') }}">Thrashed</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
    @endcan

    @can('isAdmin')
        <!-- Heading -->
        <div class="sidebar-heading">
            Transaksi
        </div>
        <li class="nav-item {{ !empty($sidebarTransaksi) ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTransaksi"
                aria-expanded="true" aria-controls="collapseTransaksi">
                <i class="fas fa-fw fa-hamburger"></i>
                <span>Transaksi</span>
            </a>
            <div id="collapseTransaksi" class="collapse" aria-labelledby="headingTransaksi" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Transaksi Page:</h6>
                    <a class="collapse-item" href="{{ route('meja.show.list') }}">List</a>
                    <a class="collapse-item" href="{{ route('meja.show.free') }}">New</a>
                    <a class="collapse-item" href="{{ route('meja.show.active') }}">Active</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Heading -->
        <div class="sidebar-heading">
            Master Data
        </div>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item {{ !empty($sidebarMenu) ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMenu" aria-expanded="true"
                aria-controls="collapseMenu">
                <i class="fas fa-fw fa-utensils"></i>
                <span>Menu</span>
            </a>
            <div id="collapseMenu" class="collapse" aria-labelledby="headingMenu" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Menu Page:</h6>
                    <a class="collapse-item" href="{{ route('menu.create') }}">Add</a>
                    <a class="collapse-item" href="{{ route('menu.index') }}">List</a>
                    <a class="collapse-item" href="{{ route('menu.thrased') }}">Thrashed</a>
                </div>
            </div>
        </li>

        <li class="nav-item {{ !empty($sidebarMeja) ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMeja" aria-expanded="true"
                aria-controls="collapseMeja">
                <i class="fas fa-fw fa-chair"></i>
                <span>Meja</span>
            </a>
            <div id="collapseMeja" class="collapse" aria-labelledby="headingMeja" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Meja Page:</h6>
                    <a class="collapse-item" href="{{ route('meja.create') }}">Add</a>
                    <a class="collapse-item" href="{{ route('meja.index') }}">List</a>
                    <a class="collapse-item" href="{{ route('meja.thrased') }}">Thrashed</a>
                </div>
            </div>
        </li>

        <li class="nav-item {{ !empty($sidebarUser) ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true"
                aria-controls="collapseUser">
                <i class="fas fa-fw fa-user"></i>
                <span>User</span>
            </a>
            <div id="collapseUser" class="collapse" aria-labelledby="headingUser" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">User Page:</h6>
                    <a class="collapse-item" href="{{ route('user.create') }}">Add</a>
                    <a class="collapse-item" href="{{ route('user.index') }}">List</a>
                    <a class="collapse-item" href="{{ route('user.thrased') }}">Thrashed</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
    @endcan

    @can('isPelayan')
        <!-- Heading -->
        <div class="sidebar-heading">
            Pelayan
        </div>
        <li class="nav-item {{ !empty($sidebarTransaksi) ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTransaksi"
                aria-expanded="true" aria-controls="collapseTransaksi">
                <i class="fas fa-fw fa-hamburger"></i>
                <span>Transaksi</span>
            </a>
            <div id="collapseTransaksi" class="collapse" aria-labelledby="headingTransaksi" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Transaksi Page:</h6>
                    <a class="collapse-item" href="{{ route('meja.show.list') }}">List</a>
                    <a class="collapse-item" href="{{ route('meja.show.free') }}">New</a>
                    <a class="collapse-item" href="{{ route('meja.show.active') }}">Active</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
    @endcan

    @can('isKasir')
        <!-- Heading -->
        <div class="sidebar-heading">
            Kasir
        </div>
        <li class="nav-item {{ !empty($sidebarTransaksi) ? 'active' : '' }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTransaksi"
                aria-expanded="true" aria-controls="collapseTransaksi">
                <i class="fas fa-fw fa-hamburger"></i>
                <span>Transaksi</span>
            </a>
            <div id="collapseTransaksi" class="collapse" aria-labelledby="headingTransaksi" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Transaksi Page:</h6>
                    <a class="collapse-item" href="{{ route('meja.show.list') }}">List</a>
                    <a class="collapse-item" href="{{ route('meja.show.free') }}">New</a>
                    <a class="collapse-item" href="{{ route('meja.show.active') }}">Active</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">
    @endcan



    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
