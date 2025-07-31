@extends('layouts.karyawan.app')

@section('content')
    <div class="container-fluid my-4">
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
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href={{ route('admin.dashboard') }} class=" text-decoration-none">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item " aria-current="page">
                            Pengajuan
                        </li>
                    </ol>
                </nav>
            </div>
            <div class="col d-flex justify-content-end">
                <h5 class="fs-5">Riwayat Pengajuan</h5>
            </div>
        </div>
        <div class="card shadow-lg">
            <div class="card-header">
                <div class="my-3 d-flex justify-content-end">
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                        data-bs-target="#pengajuanKaryawanModal"><i class="bi bi-plus-square"></i> Buat
                        Pengajuan</button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col table-responsive">
                        <table class="table align-middle">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Jenis</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Berakhir</th>
                                    <th>Lampiran</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengajuans as $pengajuan)
                                    <tr>
                                        <td>{{ auth()->user()->name }}</td>
                                        <td>{{ ucwords($pengajuan->jenis) }}</td>
                                        <td>{{ date('Y-m-d', strtotime($pengajuan->tanggal_mulai)) }}</td>
                                        <td>{{ date('Y-m-d', strtotime($pengajuan->tanggal_berakhir)) }}</td>
                                        <td>
                                            @if ($pengajuan->lampiran)
                                                <a href="{{ route('karyawan.pengajuan.lampiran', ['filename' => basename($pengajuan->lampiran)]) }}"
                                                    target="_blank" class="btn btn-primary">
                                                    <i class="bi bi-eye-fill"></i>
                                                </a>
                                            @else
                                                <span class="text-muted">Tidak ada lampiran</span>
                                            @endif

                                        </td>
                                        <td>{{ ucwords($pengajuan->status) }}</td>
                                        <td>
                                            <button class="btn btn-danger" id="btnDeletePengajuan" data-bs-toggle="modal"
                                                data-bs-target="#deletePengajuan" data-id="{{ $pengajuan->id }}">
                                                <i class="bi bi-trash3-fill"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@include('karyawan.pengajuan.create')
@include('karyawan.pengajuan.delete')


@push('script')
    @vite('resources/js/pages/karyawan/pengajuan/pengajuan.js')
@endpush
