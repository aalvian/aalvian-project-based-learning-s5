<li class="nav-item @if (request()->routeIs('pengurus')) active @endif">
    <a class="nav-link" href="{{ route('jabatan') }}">
        <i class="fas fa-user-plus"></i>
        <span>Buat Akun</span></a>
</li>

<li class="nav-item  mb-0 @if (request()->routeIs('divisi', 'create-divisi', 'edit-divisi')) active @endif">
    <a class="nav-link" href="{{ route('divisi') }}">
        <i class="fas fa-shield-alt"></i>
        <span>Divisi</span></a>
</li>

<li class="nav-item @if (request()->routeIs('alat', 'create-alat', 'edit-alat')) active @endif">
    <a class="nav-link" href="{{ route('Alat') }}">
        <i class="fas fa-fw fa-box-open "></i>
        <span>Alat</span></a>
</li>

<li class="nav-item @if (request()->routeIs('jadwal', 'create-jadwal', 'edit-jadwal')) active @endif">
    <a class="nav-link" href="{{ route('jadwal') }}">
        <i class="fas fa-calendar-alt"></i>
        <span>Jadwal Latihan</span></a>
</li>
<li class="nav-item @if (request()->routeIs('view-timeLine')) active @endif">
    <a class="nav-link" href="{{ route('view-timeLine') }}">
        <i class="fas fa-history"></i>
        <span>Time Line</span></a>
</li>

