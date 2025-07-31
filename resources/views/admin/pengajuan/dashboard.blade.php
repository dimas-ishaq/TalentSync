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
                        <li class="breadcrumb-item active">Cuti</li>
                    </ol>
                </nav>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-end">
                <h5 class="fs-5">Manajemen Pengajuan Cuti</h5>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card shadow-lg">
                    <div class="card-header">
                        <div class="row my-3 flex-column gap-3 gap-md-0">
                            <div class="col">
                                <form action="" method="get" class="row flex-column gap-2 flex-md-row">
                                    <div class="col input-group input-group-sm">
                                        <span class="input-group-text">Jenis</span>
                                        <select name="jenis" id="jenis" class="form-select">
                                            @php
                                                $cutiOptions = ['semua', 'cuti', 'izin', 'sakit'];
                                            @endphp
                                            @foreach ($cutiOptions as $option)
                                                <option
                                                    value="{{ $option }}"{{ request()->query('jenis') == $option ? 'selected' : '' }}>
                                                    {{ ucfirst($option) }}
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
                                        <span class="input-group-text">Search</span>
                                        <input type="text" name="search" id="search" placeholder="cari nama karyawan"
                                            class="form-control" value="{{ request()->query('search') }}">
                                        <button class="btn btn-secondary btn-sm"><i class="bi bi-funnel"></i>
                                            Filter</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col mt-3">
                                <a href="{{ route('admin.pengajuan.riwayat') }}" class="btn btn-dark btn-sm">
                                    <i class="bi bi-clock-history"></i> Riwayat
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body overflow-auto table-responsive">
                        <table class="table table-sm align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Karyawan</th>
                                    <th>Jenis</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Berakhir</th>
                                    <th>Status</th>
                                    <th>Lampiran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengajuans as $pengajuan)
                                    <tr>
                                        <td>{{ $pengajuan->karyawan->id }}</td>
                                        <td>{{ $pengajuan->karyawan->nama }}</td>
                                        <td>{{ ucfirst($pengajuan->jenis) }}</td>
                                        <td>{{ explode(' ', $pengajuan->tanggal_mulai)[0] }}</td>
                                        <td>{{ explode(' ', $pengajuan->tanggal_berakhir)[0] }}</td>
                                        <td>{{ ucfirst($pengajuan->status) }}</td>
                                        <td>
                                            {{-- <a href="{{ route('admin.pengajuan.lampiran', ['filename' => basename($pengajuan->lampiran)]) }}"
                                                class="text-decoration-none" target="_blank">
                                                Lihat
                                            </a> --}}
                                        </td>
                                        <td class="d-flex gap-2">
                                            <button type="button" class="btn btn-success btn-approve"
                                                data-bs-toggle="modal" data-bs-target="#approvePengajuanModal"
                                                data-name="{{ $pengajuan->karyawan->nama }}"
                                                data-id="{{ $pengajuan->id }}">
                                                Terima
                                            </button>
                                            <button type="button" class="btn btn-danger btn-reject" data-bs-toggle="modal"
                                                data-bs-target="#rejectPengajuanModal"
                                                data-name="{{ $pengajuan->karyawan->nama }}"
                                                data-id="{{ $pengajuan->id }}">
                                                Tolak
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{ $pengajuans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('admin.pengajuan.approve')
@include('admin.pengajuan.reject')
@push('script')
    @vite('resources/js/pages/admin/pengajuan/pengajuan.js')
@endpush
