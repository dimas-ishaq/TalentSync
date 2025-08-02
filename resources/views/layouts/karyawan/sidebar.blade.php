<aside class="mt-2 position-relative">
    <a class="position-absolute custom-arrow-position" role="button" id="sidebarToggle">
        <i class="bi bi-arrow-left-circle" style="font-size: 1.5rem"></i>
    </a>
    <a href="{{ route('karyawan.profile.index') }}" class="text-decoration-none">
        <div class="col d-flex align-items-center">
            <img src="{{ asset('images/profile.png') }}" alt="Profile Picture" class="rounded-circle" width="40"
                height="40">
            @if (Auth::check())
                <div class="d-flex flex-column ms-4">
                    <span class="fw-semibold nav-text ">{{ Auth::user()->name }}</span>
                    <small class="nav-text text-muted ">{{ Auth::user()->email }}</small>
                </div>
            @endif
        </div>
    </a>

    <div class="mt-4 d-flex flex-column align-items-start justify-content-between">
        <ul class="navbar-nav w-100">
            <li class="nav-item">
                <a class="nav-link  d-flex px-4 {{ Route::is('karyawan.dashboard') ? 'active text-bg-primary rounded-1 ' : '' }}"
                    href={{ route('karyawan.dashboard') }}>
                    <i class="bi bi-grid-1x2"></i> <span class="nav-text ms-2 ">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex px-4 {{ Route::is('karyawan.absensi.dashboard') ? 'active text-bg-primary rounded-1 ' : '' }}"
                    href={{ route('karyawan.absensi.dashboard') }}>
                    <i class="bi bi-person-badge"></i> <span class="nav-text ms-2 ">Absensi</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  d-flex px-4 {{ Route::is('karyawan.pengajuan.dashboard') ? 'active text-bg-primary rounded-1 ' : '' }}"
                    href={{ route('karyawan.pengajuan.dashboard') }}>
                    <i class="bi bi-person-dash"></i> <span class="nav-text ms-2 ">Pengajuan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  d-flex px-4 {{ Route::is('karyawan.slip_gaji.dashboard') ? 'active text-bg-primary rounded-1 ' : '' }}"
                    href="#">
                    <i class="bi bi-credit-card-2-back-fill"></i> <span class="nav-text ms-2 ">Slip Gaji </span>
                </a>
            </li>
            <li class="nav-item">
                <a href={{ route('logout') }} class="nav-link d-flex px-4">
                    <i class="bi bi-box-arrow-right"></i> <span class="nav-text ms-2 ">Keluar</span>
                </a>
            </li>

        </ul>

    </div>
</aside>
