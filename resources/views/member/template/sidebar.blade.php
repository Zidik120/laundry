<div class="sidebar">

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('member.index') }}"
                    class="nav-link {{ request()->routeIs('member.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('member.price_lists.index') }}"
                    class="nav-link {{ request()->routeIs('member.price_lists.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-list"></i>
                    <p>Daftar Harga</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('transaction_input') }}" 
                class="nav-link {{ request()->routeIs('transaction_input') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-file-invoice"></i>
                    <p>Order</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('member.transactions.index') }}"
                    class="nav-link {{ request()->routeIs('member.transactions*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-history"></i>
                    <p>Riwayat Transaksi</p>
                </a>
            <li class="nav-item">
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </a>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
