<aside class="sidebar mt-3">
    <div class="sidebar-main mt-4 ">
        <ul class="navbar-nav flex-column ps-4">
            <li class="nav-item">
                <a class="nav-link active" href={{ route('admin.dashboard') }}>
                    <i class="bi bi-grid-1x2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href={{ route('admin.karyawan.dashboard') }}>
                    <i class="bi bi-people"></i> Karyawan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href={{ route('admin.department.dashboard') }}>
                    <i class="bi bi-building"></i> Department
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href={{ route('admin.jabatan.dashboard') }}>
                    <i class="bi bi-person-badge"></i> Jabatan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href={{ route('admin.user.dashboard') }}>
                    <i class="bi bi-person-gear"></i> User </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-calendar-check"></i> Kehadiran
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="bi bi-file-earmark-text"></i> Laporan
                </a>
            </li>
        </ul>
    </div>
    <div class="sidebar-footer">
        <ul class="navbar-nav flex-column ps-4">
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-gear"></i> Pengaturan
                </a>
            </li>
            <li class="nav-item">
                <a href={{ route('logout') }} class="nav-link">
                    <i class="bi bi-box-arrow-right"></i> Keluar
                </a>
            </li>
        </ul>

    </div>
</aside>
