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
                        <li class="breadcrumb-item ">Operasional</li>
                        <li class="breadcrumb-item active" aria-current="page">Penilaian</li>
                    </ol>
                </nav>
            </div>
            <div class="col d-flex justify-content-end">
                <h5 class="fs-5">Manajemen Penilaian Karyawan</h5>
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col">
                <div class="card shadow-lg">
                    <div class="card-header">
                        <div class="row mt-4">
                            <div class="col">
                                <form action="" method="get" class="row flex-column flex-lg-row">
                                    <div class="col-6 input-group input-group-sm mb-3">
                                        <span class="input-group-text">Bulan</span>
                                        <select name="bulan" id="bulan" class="form-select">
                                            @php
                                                $bulanIni = now()->month;
                                                $pilihBulan = request('bulan', $bulanIni);
                                            @endphp
                                            @foreach (range(1, 12) as $bln)
                                                <option value="{{ $bln }}"
                                                    {{ $pilihBulan == $bln ? 'selected' : '' }}>{{ getNamaBulan($bln) }}
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
                                                    {{ $pilihTahun == $thn ? 'selected' : '' }}>{{ $thn }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col input-group input-group-sm mb-3">
                                        <span class="input-group-text">Status</span>
                                        <select name="status" id="status" class="form-select">
                                            @php
                                                $pilihStatus = request('status', 'belum_diproses');
                                                $statusOptions = [
                                                    'Belum diproses' => 'belum_diproses',
                                                    'Draft' => 'draft',
                                                    'Selesai' => 'selesai',
                                                ];
                                            @endphp
                                            @foreach ($statusOptions as $label => $status)
                                                <option value="{{ $status }}"
                                                    {{ $pilihStatus == $status ? 'selected' : '' }}>{{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col input-group input-group-sm mb-3">
                                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                                        <input type="text" name="search" id="search" class="form-control"
                                            placeholder="cari nama, jabatan, department">
                                        <button type="submit" class="btn btn-secondary btn-sm ms-2"><i
                                                class="bi bi-funnel"></i>
                                            Filter</button>
                                    </div>
                                </form>
                                <div class="d-flex justify-content-start">
                                    <a href="#" class="btn btn-success btn-sm"><i
                                            class="bi bi-file-earmark-spreadsheet"></i>
                                        Export</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Department</th>
                                    <th>Status</th>
                                    <th>Rata-Rata</th>
                                    <th>Aksi</th>
                                </tr>
                            <tbody>
                                @foreach ($karyawans as $karyawan)
                                    <tr>
                                        <td>{{ 'ID' }}</td>
                                        <td>{{ $karyawan->nama }}</td>
                                        <td>{{ $karyawan->jabatan->nama }}</td>
                                        <td>{{ $karyawan->department->nama }}</td>
                                        <td>{{ $karyawan->penilaians->first()->status ?? 'Belum diproses' }}</td>
                                        <td>{{ $karyawan->penilaians->first()->rata_rata ?? '0.0' }}</td>
                                        <td>
                                            @php
                                                // Ambil objek penilaian yang relevan untuk karyawan ini pada periode yang difilter.
                                                // Jika tidak ada penilaian yang cocok, $currentPenilaian akan null.
                                                $currentPenilaian = $karyawan->penilaians->first(); // Mengambil item pertama dari Collection
                                            @endphp

                                            @if ($currentPenilaian)
                                                {{-- Kondisi 1: Ada penilaian untuk periode ini --}}
                                                @if ($currentPenilaian->status === 'draft')
                                                    {{-- Jika statusnya 'draft', tampilkan tombol Edit --}}
                                                    <button type="button" class="btn btn-warning " data-bs-toggle="modal"
                                                        data-bs-target="#editPenilaianModal" id="btnEditPenilaian"
                                                        data-id="{{ $currentPenilaian->id }}">Edit</button>
                                                @elseif ($currentPenilaian->status === 'selesai')
                                                    {{-- Jika statusnya 'selesai', tampilkan tombol Lihat --}}
                                                    {{-- Asumsi Anda memiliki route 'show' untuk melihat detail penilaian --}}
                                                    <a href="{{ '#' }}" class="btn btn-info ">Lihat</a>
                                                @else
                                                    {{-- Ini adalah fallback jika ada status lain yang tidak ditangani --}}
                                                    <span class="badge bg-secondary">Status Tidak Dikenal</span>
                                                @endif
                                            @else
                                                {{-- Kondisi 2: Belum ada penilaian untuk periode ini --}}
                                                {{-- Tampilkan tombol Proses (karena belum diproses sama sekali) --}}
                                                {{-- Pastikan Anda meneruskan karyawan_id, bulan, dan tahun ke route create --}}
                                                <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                                    data-bs-target="#prosesPenilaianModal" id="btnProsesPenilaian"
                                                    data-id="{{ $karyawan->id }}">Proses</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            </thead>
                        </table>
                        {{ $karyawans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('admin.penilaian.create')
@include('admin.penilaian.edit')
@push('script')
    @vite('resources/js/pages/admin/penilaian/penilaian.js')
@endpush
