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
                        <li class="breadcrumb-item"><a class="text-decoration-none"
                                href="{{ route('admin.pengajuan.dashboard') }}">Cuti</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Riwayat</li>
                    </ol>
                </nav>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-md-end">
                <h5 class="fs-5">Riwayat Pengajuan Izin</h5>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card shadow-lg">
                    <div class="card-header">

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
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pengajuans as $pengajuan)
                                    <tr>
                                        <td>#{{ $pengajuan->id }}</td>
                                        <td>{{ $pengajuan->karyawan->nama }}</td>
                                        <td>{{ ucfirst($pengajuan->jenis) }}</td>
                                        <td>{{ explode(' ', $pengajuan->tanggal_mulai)[0] }}</td>
                                        <td>{{ explode(' ', $pengajuan->tanggal_berakhir)[0] }}</td>
                                        <td>{{ ucfirst($pengajuan->status) }}</td>
                                        <td>
                                            {{-- <a target="_blank"
                                                href="{{ route('admin.pengajuan.lampiran', ['filename' => basename($pengajuan->lampiran)]) }}"
                                                class="text-decoration-none">Lihat</a> --}}
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
