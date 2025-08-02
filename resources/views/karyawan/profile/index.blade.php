@extends('layouts.karyawan.app')

@section('content')
    <div class="container-fluid my-4">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                class="text-decoration-none">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row flex-column gap-3">
            <div class="col">
                <div class="card shadow-md">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col d-flex align-items-center gap-3">
                                <div class="position-relative">
                                    <a class="position-absolute bottom-0 end-0 pe-auto ">
                                        <i class="bi bi-camera"></i>
                                    </a>
                                    <img src="{{ asset('/images/profile.png') }}" alt="profile-picture">
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="fs-4">{{ $karyawan->nama }}</div>
                                    <small class="text-muted">{{ $karyawan->jabatan->nama }}</small>
                                    <small class="text-muted">{{ $karyawan->department->nama }}</small>
                                </div>
                            </div>
                            <div class="col d-flex justify-content-end">
                                <button type="button" class="btn btn-warning"><i
                                        class="bi bi-pencil-square"></i>&nbsp;Update Profile</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card shadow-md">
                    <div class="card-body">
                        <h5 class="mb-3">Informasi Pribadi</h5>
                        <div class="row mb-3">
                            <div class="col">
                                <div>Nama Lengkap</div>
                                <small class="text-muted">{{ $karyawan->nama }}</small>
                            </div>
                            <div class="col">
                                <div>Email</div>
                                <small class="text-muted">{{ $karyawan->email }}</small>
                            </div>
                            <div class="col">
                                <div>No Telepon</div>
                                <small class="text-muted">{{ $karyawan->no_telepon }}</small>
                            </div>
                            <div class="col">
                                <div>Status</div>
                                <small class="text-muted">{{ ucfirst($karyawan->status) }}</small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <div>Jabatan</div>
                                <small class="text-muted">{{ $karyawan->jabatan->nama }}</small>
                            </div>
                            <div class="col">
                                <div>Department</div>
                                <small class="text-muted">{{ $karyawan->department->nama }}</small>
                            </div>
                            <div class="col">
                                <div>Tanggal Masuk</div>
                                <small class="text-muted">{{ explode(' ', $karyawan->tanggal_masuk)[0] }}</small>
                            </div>
                            <div class="col">
                                <div>Pendidikan Terakhir</div>
                                <small class="text-muted">{{ $karyawan->pendidikan_terakhir }}</small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <div>Jenis Kelamin</div>
                                <small
                                    class="text-muted">{{ $karyawan->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</small>
                            </div>
                            <div class="col">
                                <div>Status Pernikahan</div>
                                <small class="text-muted">
                                    {{ $karyawan->status_pernikahan }}
                                </small>
                            </div>
                            <div class="col">
                                <div>Agama</div>
                                <small class="text-muted">
                                    {{ $karyawan->agama }}
                                </small>
                            </div>
                            <div class="col">
                                <div>Keterampilan</div>
                                <small class="text-muted">
                                    {{ $karyawan->keterampilan }}
                                </small>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <div class="col">
                                    <div>Alamat</div>
                                    <small class="text-muted">
                                        {{ $karyawan->alamat }}
                                    </small>
                                </div>
                                <div class="col">
                                    <div>Pengalaman Kerja</div>
                                    <small class="text-muted">
                                        {{ $karyawan->pengalaman_kerja }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
