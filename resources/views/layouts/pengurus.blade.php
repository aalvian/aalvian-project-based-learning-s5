<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item @if (request()->routeIs('pendaftaran', 'detail-terima', 'detail-tolak', 'detail-pendaftaran')) active @endif">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
        aria-controls="collapseTwo">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Pendaftaran</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('admin-pendaftaran') }}">Data Pendaftar</a>
            <a class="collapse-item" href="{{ route('admin-pendaftaran-terima') }}">Diterima</a>
            <a class="collapse-item" href="{{ route('admin-pendaftaran-tolak') }}">Ditolak</a>
        </div>
    </div>
</li>

<li class="nav-item @if (request()->routeIs('aktif-presensi')) active @endif">
    <a class="nav-link" href="{{ route('aktif-presensi') }}">
        <i class="fas fa-fw fa-calendar-check"></i>
        <span>Aktifasi</span></a>
</li>


<li class="nav-item @if (request()->routeIs('presensi',)) active @endif">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse" aria-expanded="true"
        aria-controls="collapse">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Data Presensi</span>
    </a>
    <div id="collapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('data-presensi') }}">Data Presensi</a>
            <a class="collapse-item" href="{{ route('data-presensi-valid') }}">Valid</a>
            <a class="collapse-item" href="{{ route('data-presensi-invalid') }}">Invalid</a>
        </div>
    </div>
</li>




<hr class="sidebar-divider my-0">



<!-- Nav Item - Pages Collapse Menu -->

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item @if (request()->routeIs('peminjaman', 'pengembalian')) active @endif">
    <a class="nav-link collapsed " data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
        aria-controls="collapsePages">
        <i class="fas fa-fw fa-folder"></i>
        <span>Transaksi</span>
    </a>
    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">

            <a class="collapse-item" href="{{ route('peminjaman') }}">Peminjaman Alat</a>
            <a class="collapse-item" href="{{ route('pengembalian') }}">Pengembalian Alat</a>
        </div>
    </div>
</li>
