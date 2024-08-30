<nav id="sidebar" class="">
    <div class="custom-menu">
        <button type="button" id="sidebarCollapse" class="btn-side">
            <i class="fa fa-bars"></i>
            <span class="sr-only">Toggle Menu</span>
        </button>
    </div>
    <div class="p-4">
        <h1><a href="" class="logo">Sistem Informasi <span>Inventarisasi</span></a></h1>
        <ul class="list-unstyled components mb-5">
            <li class="{{ Request::is('home') ? 'active' : '' }}">
                <a href="/home"><span class="fa fa-home mr-3"></span>Home</a>
            </li>
            <li
                class="sidebar-item {{ Request::is('data_k*') || Request::is('detail*') || Request::is('add*') || Request::is('edit/*') || Request::is('edit-*') ? 'active' : '' }}">
                <a href="#" class="sidebar-link collapsed" data-bs-target="#data" data-bs-toggle="collapse"
                    aria-expanded="false">
                    <i class="fa fa-file mr-3" style="color:#65B789"></i> Data KIB</a>
                <ul id="data" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li
                        class="sidebar-item {{ Request::is('data_kiba') || Request::is('detail/*') || Request::is('add') || Request::is('edit/*') ? 'active' : '' }}">
                        <a href="/data_kiba" class="sidebar-link">Data KIB A</a>
                    </li>
                    <li
                        class="sidebar-item {{ Request::is('data_kibb') || Request::is('add-b') || Request::is('detail-b/*') || Request::is('edit-b/*') ? 'active' : '' }}">
                        <a href="/data_kibb" class="sidebar-link">Data KIB B</a>
                    </li>
                    <li
                        class="sidebar-item {{ Request::is('data_kibc') || Request::is('add-c') || Request::is('detail-c/*') || Request::is('edit-c/*') ? 'active' : '' }}">
                        <a href="/data_kibc" class="sidebar-link">Data KIB C</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item {{ Request::is('search*') ? 'active' : '' }}">
                <a href="#" class="sidebar-link collapsed" data-bs-target="#cari" data-bs-toggle="collapse"
                    aria-expanded="false" aria-controls="cari">
                    <i class="fa fa-search mr-3" style="color:#65B789"></i>Cari Data
                </a>
                <ul id="cari"
                    class="sidebar-dropdown list-unstyled collapse {{ Request::is('search*') ? 'show' : '' }}"
                    data-bs-parent="#sidebar">
                    <li class="sidebar-item {{ Request::is('search-a') ? 'active' : '' }}">
                        <a href="/search-a" class="sidebar-link">Cari Data KIB A</a>
                    </li>
                    <li class="sidebar-item {{ Request::is('search-b') ? 'active' : '' }}">
                        <a href="/search-b" class="sidebar-link">Cari Data KIB B</a>
                    </li>
                    <li class="sidebar-item {{ Request::is('search-c') ? 'active' : '' }}">
                        <a href="/search-c" class="sidebar-link">Cari Data KIB C</a>
                    </li>
                </ul>
            </li>
            <li class="{{ Request::is('rekapkoordinat-a') ? 'active' : '' }}">
                <a href="/rekapkoordinat-a"><i class="fa fa-map mr-3" style="color:#65B789"></i>Rekap Koordinat</a>
            </li>
            <li class="{{ Request::is('arsip*') ? 'active' : '' }}">
                <a href="/arsip"><span class="fas fa-box-open mr-3"></span></span>Arsip Lainnya</a>
            </li>
            <li
                class="{{ Request::is('data_user') || Request::is('tambah-user') || Request::is('edit_user/*') ? 'active' : '' }}">
                <a href="/data_user"><span class="fa fa-user mr-4"></span>Data User</a>
            </li>
            <li>
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout p-0">
                        <span class="fa fa-sign-out-alt mr-4 icon-logout"></span>Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>
