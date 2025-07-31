<aside class="mt-2 position-relative">
    <a class="position-absolute custom-arrow-position" role="button" id="sidebarToggle">
        <i class="bi bi-arrow-left-circle" style="font-size: 1.5rem"></i>
    </a>

    <div class="col d-flex align-items-center">
        <img src="{{ asset('images/profile.png') }}" alt="Profile Picture" class="rounded-circle" width="40"
            height="40">
        @if (Auth::check())
            <div class="d-flex flex-column ms-4">
                <span class="fw-semibold nav-text ">{{ Auth::user()->name }}</span>
                <span class="nav-text ">{{ Auth::user()->email }}</span>
            </div>
        @endif
    </div>

    <div class="mt-4 d-flex flex-column align-items-start justify-content-between">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link  d-flex px-4 {{ Route::is('admin.dashboard') ? 'active text-bg-primary rounded-1 ' : '' }}"
                    href={{ route('admin.dashboard') }}>
                    <i class="bi bi-grid-1x2"></i> <span class="nav-text ms-2 ">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a role="button" class="nav-link  d-flex px-4" data-bs-toggle="collapse" href="#collapseMasterData">
                    <i class="bi bi-database"></i>
                    <span class="nav-text ms-2 ">Manajemen SDM &nbsp; <i class="bi bi-chevron-down ms-auto"></i></span>
                </a>
                <div class="collapse {{ Route::is('admin.karyawan.dashboard') ||
                Route::is('admin.absensi.index') ||
                Route::is('admin.pengajuan.dashboard') ||
                Route::is('admin.pengajuan.riwayat') ||
                Route::is('admin.penggajian.dashboard') ||
                Route::is('admin.penilaian.dashboard') ||
                Route::is('admin.user.dashboard')
                    ? 'show'
                    : '' }}"
                    id="collapseMasterData">
                    <ul class="navbar-nav sub-menu">
                        <li class="nav-item">
                            <a class="nav-link d-flex px-4 {{ Route::is('admin.karyawan.dashboard') ? 'active text-bg-primary rounded-1 ' : '' }}"
                                href={{ route('admin.karyawan.dashboard') }}>
                                <i class="bi bi-people"></i> <span class="nav-text ms-2 ">Karyawan</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  d-flex px-4 {{ Route::is('admin.absensi.index') ? 'active text-bg-primary rounded-1 ' : '' }}"
                                href={{ route('admin.absensi.index') }}>
                                <i class="bi bi-calendar-check"></i> <span class="nav-text ms-2 ">Absensi</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  d-flex px-4 {{ Route::is('admin.pengajuan.dashboard') || Route::is('admin.pengajuan.riwayat') ? 'active text-bg-primary rounded-1 ' : '' }}"
                                href="{{ route('admin.pengajuan.dashboard') }}">
                                <i class="bi bi-calendar2-x"></i> <span class="nav-text ms-2 ">Cuti</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.penggajian.dashboard') }}"
                                class="nav-link  d-flex px-4 {{ Route::is('admin.penggajian.dashboard') ? 'active text-bg-primary rounded-1 ' : '' }}">
                                <i class="bi bi-credit-card"></i> <span class="nav-text ms-2 ">Penggajian</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.penilaian.dashboard') }}"
                                class="nav-link  d-flex px-4 {{ Route::is('admin.penilaian.dashboard') ? 'active text-bg-primary rounded-1 ' : '' }}">
                                <i class="bi bi-clipboard-pulse"></i></i> <span class="nav-text ms-2 ">Penilaian</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  d-flex px-4 {{ Route::is('admin.user.dashboard') ? 'active text-bg-primary rounded-1 ' : '' }}"
                                href={{ route('admin.user.dashboard') }}>
                                <i class="bi bi-person-gear"></i> <span class="nav-text ms-2 ">User</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a role="button" class="nav-link  d-flex px-4" data-bs-toggle="collapse"
                    href="#collapseManajemenOrganisasi">
                    <i class="bi bi-person-workspace"></i>
                    <span class="nav-text ms-2 ">Manajemen Organisasi &nbsp; <i
                            class="bi bi-chevron-down ms-auto"></i></span>

                </a>
                <div class="collapse {{ Route::is('admin.pengajuan.dashboard') ||
                Route::is('admin.department.dashboard') ||
                Route::is('admin.jabatan.dashboard')
                    ? 'show'
                    : '' }}"
                    id="collapseManajemenOrganisasi">
                    <ul class="navbar-nav sub-menu">
                        <li class="nav-item">
                            <a class="nav-link  d-flex px-4 {{ Route::is('admin.department.dashboard') ? 'active text-bg-primary rounded-1 ' : '' }}"
                                href={{ route('admin.department.dashboard') }}>
                                <i class="bi bi-building"></i> <span class="nav-text ms-2 ">Department</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  d-flex px-4 {{ Route::is('admin.jabatan.dashboard') ? 'active text-bg-primary rounded-1 ' : '' }}"
                                href={{ route('admin.jabatan.dashboard') }}>
                                <i class="bi bi-person-badge"></i> <span class="nav-text ms-2 ">Jabatan</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link  d-flex px-4 {{ Route::is('admin.laporan.dashboard') ? 'active text-bg-primary rounded-1 ' : '' }}"
                    href="#">
                    <i class="bi bi-file-earmark-text"></i> <span class="nav-text ms-2 ">Laporan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  d-flex px-4 {{ Route::is('admin.laporan.dashboard') ? 'active text-bg-primary rounded-1 ' : '' }}"
                    href="#">
                    <i class="bi bi-headset"></i> <span class="nav-text ms-2 ">Bantuan</span>
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
