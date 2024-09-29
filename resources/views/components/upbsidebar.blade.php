<div class="overlay"></div>
<nav id="sidebar">
    <div class="custom-menu">
        <button type="button" id="sidebarCollapse" class="btn-side">
            <i class="fa fa-bars"></i>
            <span class="sr-only">Toggle Menu</span>
        </button>
    </div>
    <div class="p-4">
        <h1><a href="" class="logo">Sistem Informasi <span>Penatausahaan, Inventarisasi <br>&
                    Laporan</span></a></h1>
        <ul class="list-unstyled components mb-5">
            <li class="{{ Request::is('home-upb/*') ? 'active' : '' }}">
                <a href="{{ route('home-upb', ['KODE_UPB' => Auth::user()->KODE_UPB]) }}"><span
                        class="fa fa-home mr-3"></span>Home</a>
            </li>
            <li
                class="sidebar-item {{ Request::is('halaman*') || Request::is('add-upb*') || Request::is('detail-upb*') || Request::is('edit-upb*') ? 'active' : '' }}">
                <a href="#" class="sidebar-link collapsed" data-bs-target="#data" data-bs-toggle="collapse"
                    aria-expanded="false">
                    <i class="fa fa-file mr-3" style="color:#65B789"></i> Data KIB</a>
                <ul id="data" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li
                        class="sidebar-item {{ Request::is('halaman-upb-a/*') || Request::is('add-upb-a/*') || Request::is('detail-upb-a/*') || Request::is('edit-upb-a/*') ? 'active' : '' }}">
                        <a href="{{ route('data-upb-a', ['KODE_UPB' => Auth::user()->KODE_UPB]) }}"
                            class="sidebar-link">Data KIB A</a>
                    </li>
                    <li
                        class="sidebar-item {{ Request::is('halaman-upb-b/*') || Request::is('add-upb-b/*') || Request::is('detail-upb-b/*') || Request::is('edit-upb-b/*') ? 'active' : '' }} ">
                        <a href="{{ route('data-upb-b', ['KODE_UPB' => Auth::user()->KODE_UPB]) }}"
                            class="sidebar-link">Data KIB B</a>
                    </li>
                    <li
                        class="sidebar-item {{ Request::is('halaman-upb-c/*') || Request::is('add-upb-c/*') || Request::is('detail-upb-c/*') || Request::is('edit-upb-c/*') ? 'active' : '' }}">
                        <a href="{{ route('data-upb-c', ['KODE_UPB' => Auth::user()->KODE_UPB]) }}"
                            class="sidebar-link">Data KIB C</a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-item {{ Request::is('search-upb*') ? 'active' : '' }}">
                <a href="#" class="sidebar-link collapsed" data-bs-target="#cari" data-bs-toggle="collapse"
                    aria-expanded="false" aria-controls="cari">
                    <i class="fa fa-search mr-3" style="color:#65B789"></i>Cari Data
                </a>
                <ul id="cari" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                    <li class="sidebar-item {{ Request::is('search-upb-a/*') ? 'active' : '' }}">
                        <a href="{{ route('search-upb-a', ['KODE_UPB' => Auth::user()->KODE_UPB]) }}"
                            class="sidebar-link">Cari Data KIB A</a>
                    </li>
                    <li class="sidebar-item {{ Request::is('search-upb-b/*') ? 'active' : '' }}">
                        <a href="{{ route('search-upb-b', ['KODE_UPB' => Auth::user()->KODE_UPB]) }}"
                            class="sidebar-link">Cari Data KIB B</a>
                    </li>
                    <li class="sidebar-item {{ Request::is('search-upb-c/*') ? 'active' : '' }}">
                        <a href="{{ route('search-upb-c', ['KODE_UPB' => Auth::user()->KODE_UPB]) }}"
                            class="sidebar-link">Cari Data KIB C</a>
                    </li>
                </ul>
            </li>

            <li class="{{ Request::is('koordinat-upb*') ? 'active' : '' }}">
                <a href="{{ route('koordinat-upb-a', ['KODE_UPB' => Auth::user()->KODE_UPB]) }}"><i
                        class="fa fa-map mr-3" style="color:#65B789"></i>Rekap Koordinat</a>
            </li>
            <li>
                <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout p-0">
                        <span class="fa fa-sign-out-alt mr-3 icon-logout"></span>Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>
</nav>
