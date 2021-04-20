<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('pemilik.dashboard') }}">
                <img src="{{ asset('img/Shervie.png') }}" class="img-fluid align-self-center" width="50px" height="50px" alt="Logo">
                <span class="align-self-center">Shervie Juice</span>
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('pemilik.dashboard') }}">
                <img src="{{ asset('img/Shervie.png') }}" class="img-fluid" width="50px" height="50px" alt="Logo">
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="mt-2 {{ request()->routeIs('pemilik.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('pemilik.dashboard') }}"><i class="fas fa-fire"></i>
                    <span>Dashboard</span></a>
            </li>
            <li class="menu-header">Master Data</li>
            <li
                class="nav-item dropdown {{ request()->routeIs('pegawai.index', 'supplier.index') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i>
                    <span>Data</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('pegawai.index') ? 'active' : '' }}"><a class="nav-link "
                            href="{{ route('pegawai.index') }}"><i class="fas fa-user"></i>Pegawai</a></li>
                    <li class="{{ request()->routeIs('supplier.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('supplier.index') }}"><i class="fas fa-user-tie"></i>Supplier</a></li>
                </ul>
            </li>
            <li
                class="nav-item dropdown {{ request()->routeIs('kategori.index', 'produk.index', 'produkMasuk.index') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-cubes"></i>
                    <span>Produk</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ request()->routeIs('kategori.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('kategori.index') }}"><i class="fas fa-clipboard"></i>Kategori</a></li>
                    <li class="{{ request()->routeIs('produk.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('produk.index') }}"><i class="fas fa-boxes"></i>
                            Stok
                        </a>
                    </li>
                    {{-- <li class="{{ request()->routeIs('produkMasuk.index') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('produkMasuk.index') }}"><i class="fas fa-dolly-flatbed"></i>Stok Masuk</a>
                    </li> --}}
                </ul>
            </li>
            <li class="menu-header">Transaksi</li>
            <li class="{{ request()->routeIs('transaksi.index') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('transaksi.index') }}"><i class="fas fa-history"></i>
                    <span>Riwayat Transaksi</span></a></li>
            <li class="{{ request()->routeIs('keuangan.index') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('keuangan.index') }}"><i class="fas fa-chart-line"></i>
                    <span>Laporan Keuangan</span></a></li>
        </ul>
    </aside>
</div>
