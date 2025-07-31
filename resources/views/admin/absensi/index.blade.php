@extends('layouts.admin.app')
@section('content')
    <div class="container-fluid my-4">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a class="text-decoration-none"
                                href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item">Manajemen SDM</li>
                        <li class="breadcrumb-item active" aria-current="page">Absensi</li>
                    </ol>
                </nav>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-end ">
                <h5 class="fs-5">Manajemen Data Absensi</h5>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card shadow-lg">
                    <div class="card-header">
                        <div class="row my-3 flex-column gap-3 gap-md-0">
                            <div class="col">
                                <form action="" method="get" class="row flex-column gap-2  flex-md-row">
                                    <div class="col input-group input-group-sm">
                                        <span class="input-group-text">Status</span>
                                        @php
                                            $status_options = ['semua', 'hadir', 'terlambat'];
                                        @endphp
                                        <select name="status" id="status" class="form-select">
                                            @foreach ($status_options as $status)
                                                <option value="{{ $status }}"
                                                    {{ request()->query('status') == $status ? 'selected' : '' }}>
                                                    {{ ucfirst($status) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col input-group input-group-sm">
                                        <span class="input-group-text">Periode</span>
                                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" class="form-control"
                                            value="{{ request()->query('tanggal_mulai') }}">
                                        <input type="date" name="tanggal_berakhir" id="tanggal_berakhir"
                                            class="form-control" value="{{ request()->query('tanggal_berakhir') }}">
                                    </div>

                                    <div class="col-12 input-group input-group-sm">
                                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                                        <input type="text" name="search" id="search" class="form-control"
                                            placeholder="cari nama karyawan" value="{{ request()->query('search') }}">
                                        <button type="submit" class="btn btn-secondary btn-sm"> <i
                                                class="bi bi-funnel"></i> Filter</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col">
                                <a href="#" class="btn btn-success btn-sm"> <i
                                        class="bi bi-file-earmark-spreadsheet"></i>
                                    Export</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body overflow-auto table-responsive">
                        <table class="table-sm table align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Karyawan</th>
                                    <th>Tanggal</th>
                                    <th>Jam Masuk</th>
                                    <th>Jam Keluar</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($absensis as $absensi)
                                    <tr>
                                        <td>{{ $absensi->id }}</td>
                                        <td>{{ $absensi->karyawan->nama }}</td>
                                        <td>{{ $absensi->tanggal }}</td>
                                        <td>{{ $absensi->jam_masuk }}</td>
                                        <td>{{ $absensi->jam_keluar }}</td>
                                        <td>
                                            @if ($absensi->status == 'hadir')
                                                <span class="badge text-bg-success">{{ $absensi->status }}</span>
                                            @elseif($absensi->status == 'terlambat')
                                                <span class="badge text-bg-warning">{{ $absensi->status }}</span>
                                            @else
                                                <span class="badge text-bg-dark">{{ $absensi->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="button">
                                                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                    data-bs-target="#detailAbsensi" data-id="{{ $absensi->id }}"
                                                    id="btnDetailAbsensi">
                                                    <i class="bi bi-eye-fill"></i>
                                                </button>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#editAbsensi" data-id="{{ $absensi->id }}"
                                                    id="btnEditAbsensi">
                                                    <i class="bi bi-pencil-square"></i>
                                                </button>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $absensis->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('admin.absensi.detail')
@include('admin.absensi.edit')

@push('script')
    @vite('resources/js/pages/admin/absensi/absensi.js')
@endpush
