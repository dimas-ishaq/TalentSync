@extends('layouts.admin.app')
@section('content')
    <div class="container-fluid my-4">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a class="text-decoration-none" href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">Operasional</li>
                        <li class="breadcrumb-item active" aria-current="page">Penggajian</li>
                    </ol>
                </nav>
            </div>
            <div class="col d-flex justify-content-end">
                <h5 class="fs-5">Manajemen Penggajian Karyawan</h5>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card shadow-lg">
                    <div class="card-header">
                        <div class="row mt-4">
                            <div class="col">
                                <form action="{{ route('admin.penggajian.dashboard') }}" method="get"
                                    class="row flex-column flex-lg-row">
                                    <div class="col-6 mb-3 input-group-sm input-group ">
                                        <span class="input-group-text">Bulan</span>
                                        <select name="bulan" id="bulan" class="form-select">
                                            @php
                                                $bulanIni = now()->month;
                                                $pilihBulan = request('bulan', $bulanIni);
                                            @endphp
                                            @foreach (range(1, 12) as $bln)
                                                <option value="{{ $bln }}"
                                                    {{ $pilihBulan == $bln ? 'selected' : '' }}>
                                                    {{ getNamaBulan($bln) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <span class="input-group-text">Tahun</span>
                                        <select name="tahun" id="tahun" class="form-select">
                                            @php
                                                $tahunIni = now()->year;
                                                $pilihTahun = request('tahun', $tahunIni);
                                            @endphp
                                            @foreach (range(now()->subYears(5)->year, now()->year + 1) as $thn)
                                                <option value="{{ $thn }}"
                                                    {{ $pilihTahun == $thn ? 'selected' : '' }}>
                                                    {{ $thn }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col mb-3 input-group-sm input-group">
                                        <span class="input-group-text">Status</span>
                                        <select name="status" id="status" class="form-select">
                                            @php
                                                $statusOptions = [
                                                    'belum_diproses' => 'Belum Diproses',
                                                    'pending' => 'Pending',
                                                    'dibayar' => 'Dibayar',
                                                ];
                                            @endphp
                                            @foreach ($statusOptions as $value => $label)
                                                <option value="{{ $value }}"
                                                    {{ request('status') == $value ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col mb-3 input-group-sm input-group">
                                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                                        <input type="text" name="search" id="search"
                                            placeholder="cari nama, jabatan, department" class="form-control "
                                            value="{{ request('search') }}">
                                        <button type="submit" class="btn btn-secondary btn-sm ms-2"><i
                                                class="bi bi-funnel"></i>
                                            Filter</button>
                                    </div>
                                </form>
                                <div class="d-flex justify-content-start">
                                    <a href="#" class="btn btn-success btn-sm border "> <i
                                            class="bi bi-file-earmark-spreadsheet"></i>
                                        Export</a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-body overflow-auto table-responsive">
                        <table class="table table-hover align-middle table-sm">
                            <thead>
                                <tr>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Department</th>
                                    <th>Status</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($karyawans as $karyawan)
                                    <tr>
                                        <td>{{ $karyawan->id }}</td>
                                        <td>{{ $karyawan->nama }}</td>
                                        <td>{{ $karyawan->jabatan->nama }}</td>
                                        <td>{{ $karyawan->department->nama }}</td>
                                        <td>{{ $karyawan->penggajians->first()->status_pembayaran ?? 'Belum diproses' }}
                                        </td>
                                        <td>{{ $karyawan->penggajians->first()->tanggal_pembayaran ?? 'Belum dibayar' }}
                                        </td>
                                        <td>
                                            @php
                                                $penggajian = $karyawan->penggajians->first();
                                            @endphp
                                            @if ($penggajian)
                                                <button class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#editPenggajianModal" id="btnEditPenggajian"
                                                    data-id="{{ $penggajian->id }}">Edit</button>
                                            @else
                                                <button class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#prosesPenggajianModal" id="btnProsesPenggajian"
                                                    data-id="{{ $karyawan->id }}">
                                                    Proses
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $karyawans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('admin.penggajian.create')
@include('admin.penggajian.edit')
@push('script')
    @vite('resources/js/pages/admin/penggajian/penggajian.js')
@endpush
