<div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('admin.index') }}"
                    class="nav-link {{ request()->routeIs('admin.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.price-lists.index') }}"
                    class="nav-link {{ request()->routeIs('admin.price-lists.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-list"></i>
                    <p>Daftar Harga</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.transactions.create') }}"
                    class="nav-link {{ request()->routeIs('admin.transactions.create') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-file-invoice"></i>
                    <p> Orderan</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.transactions.index') }}"
                    class="nav-link {{ request()->routeIs('admin.transactions.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-history"></i>
                    <p>Riwayat Transaksi</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.members.index') }}"
                    class="nav-link {{ request()->routeIs('admin.members*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Daftar Member Laundry</p>
                </a>
            </li>
            <li class="nav-item">
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt mr-2"></i> Keluar
                </a>
            </li>
            
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
