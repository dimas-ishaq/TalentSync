@extends('layouts.admin.app')

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
                        <div class="row">
                            <div class="col d-flex align-items-center gap-3">
                                <img src="{{ asset('/images/profile.png') }}" alt="profile-picture">
                                <div class="d-flex flex-column">
                                    <div>{{ $karyawan->nama }}</div>
                                    <small class="text-muted">{{ $karyawan->jabatan->nama }}</small>
                                    <small class="text-muted">{{ $karyawan->department->nama }}</small>
                                    <small class="text-muted">{{ ucfirst(auth()->user()->role) }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card shadow-md">
                    <div class="card-body">
                        <h5 class="mb-3">Informasi Pribadi</h5>
                        <div class="row">
                            <div class="col">
                                <div class="text-muted">Nama Lengkap</div>
                                <div>{{ $karyawan->nama }}</div>
                            </div>
                            <div class="col">
                                <div class="text-muted">Email</div>
                                <div>{{ $karyawan->email }}</div>
                            </div>
                            <div class="col">
                                <div class="text-muted">No Telepon</div>
                                <div>{{ $karyawan->no_telepon }}</div>
                            </div>
                            <div class="col">
                                <div class="text-muted">Status</div>
                                <div>{{ ucfirst($karyawan->status) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
