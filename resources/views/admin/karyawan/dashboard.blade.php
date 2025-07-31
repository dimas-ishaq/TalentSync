@extends('layouts.admin.app')
@section('content')
    <div class="container-fluid my-4">
        <div class="row">
            <div class="col-12 col-md-6">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{ route('admin.dashboard') }}
                                class=" text-decoration-none">Dashboard</a></li>
                        <li class="breadcrumb-item ">Manajemen SDM</li>
                        <li class="breadcrumb-item active " aria-current="page">Karyawan</li>
                    </ol>
                </nav>
            </div>
            <div class="col-12 col-md-6 d-flex justify-content-md-end">
                <h5 class="fs-5">Manajemen Data Karyawan</h5>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card shadow-lg">
                    <div class="card-header">
                        <div class="row my-3 flex-column flex-md-row gap-3 gap-md-0">
                            <div class="col-12 col-md-6">
                                <form action="{{ route('admin.karyawan.dashboard') }}" method="get">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                                        <input type="text" name="search" id="search"
                                            placeholder="cari nama, jabatan, department" class="form-control"
                                            value="{{ request('search') }}">
                                        <button type="submit" class="btn btn-secondary btn-sm">
                                            <i class="bi bi-funnel"></i> Filter
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-12 col-md-6 d-flex justify-content-end align-items-start gap-2">
                                <button role="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#tambahKaryawanModal">
                                    <i class="bi bi-plus-circle"></i> Tambah Karyawan
                                </button>

                                <a href="#" class="btn btn-success btn-sm"><i
                                        class="bi bi-file-earmark-spreadsheet"></i> Export</a>

                            </div>
                        </div>
                    </div>
                    <div class="card-body overflow-auto table-responsive">
                        <table class="table table-sm align-middle">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Karyawan</th>
                                    <th>Email</th>
                                    <th>Jabatan</th>
                                    <th>Department</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($karyawans as $karyawan)
                                    <tr>
                                        <td>{{ $karyawan->id }}</td>
                                        <td>{{ $karyawan->nama }}</td>
                                        <td>{{ $karyawan->email }}</td>
                                        <td>{{ $karyawan->jabatan->nama }}</td>
                                        <td>{{ $karyawan->department->nama }}</td>
                                        <td>
                                            @if ($karyawan->status == 'aktif')
                                                <span class="badge text-bg-success">aktif</span>
                                            @elseif($karyawan->status == 'nonaktif')
                                                <span class="badge text-bg-danger">nonaktif</span>
                                            @else
                                                <span class="badge text-bg-dark">{{ $karyawan->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" role="button" id="btnShowKaryawan"
                                                    data-id={{ $karyawan->id }} data-bs-toggle="modal"
                                                    data-bs-target="#detailKaryawan" class="btn btn-info"><i
                                                        class="bi bi-eye-fill"></i>
                                                </button>

                                                <button type="button" role="button" id="btnEditKaryawan"
                                                    data-id={{ $karyawan->id }} data-bs-toggle="modal"
                                                    data-bs-target="#editKaryawan" class="btn btn-warning"><i
                                                        class="bi bi-pencil-square"></i>
                                                </button>

                                                <button type="button" class="btn btn-danger" id="btnDeleteKaryawan"
                                                    data-id={{ $karyawan->id }} data-nama="{{ $karyawan->nama }}"
                                                    data-bs-toggle="modal" data-bs-target="#deleteKaryawanModal">
                                                    <i class="bi bi-trash"></i>
                                                </button>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $karyawans->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.karyawan.detail')
    @include('admin.karyawan.edit')
    @include('admin.karyawan.delete')
    @include('admin.karyawan.create')
@endsection

@push('script')
    @vite('resources/js/pages/admin/karyawan/karyawan.js')
@endpush
