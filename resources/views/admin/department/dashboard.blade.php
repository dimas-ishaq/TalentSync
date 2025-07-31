@extends('layouts.admin.app')
@section('content')
    <div class="container-fluid my-4">
        <div class="row ">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{ route('admin.dashboard') }}
                                class=" text-decoration-none">Dashboard</a></li>
                        <li class="breadcrumb-item ">Master Data</li>
                        <li class="breadcrumb-item active " aria-current="page">Department</li>
                    </ol>
                </nav>
            </div>
            <div class="col d-flex justify-content-end">
                <h5 class="fs-5">Manajemen Data Department</h5>
            </div>
        </div>
        @if ($departments->isEmpty())
            <div class="row">
                <div class="col ">
                    <div class="alert alert-warning d-flex justify-content-between align-items-center" role="alert">
                        <span>Department tidak ditemukan.</span>
                        <a href="{{ route('admin.department.create') }}" class="btn btn-warning align-items-center">
                            <i class="bi bi-plus-circle"></i>
                            Tambah Department</a>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col">
                    <div class="card shadow-lg">
                        <div class="card-header">
                            <div class="row mt-4">
                                <div class="col">
                                    <form action="{{ route('admin.department.dashboard') }}" method="get" class="row">
                                        <div class="col mb-3 input-group input-group-sm">
                                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                                            <input type="text" name="search" id="search" class="form-control"
                                                placeholder="cari department" value="{{ request('search') }}">
                                        </div>
                                        <div class="col">
                                            <button type="submit" class="btn btn-secondary btn-sm">
                                                <i class="bi bi-funnel"></i> Filter
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col d-flex justify-content-end align-items-start">
                                    <a href="{{ route('admin.department.create') }}" class="btn btn-primary btn-sm">
                                        <i class="bi bi-plus-circle"></i> Tambah Department
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table align-middle table-sm ">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Department</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($departments as $department)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $department->nama }}</td>
                                            <td>{{ $department->deskripsi }}</td>
                                            <td class="d-flex justify-content-center gap-2">
                                                <a href="{{ route('admin.department.edit', $department->id) }}"
                                                    class="btn btn-warning"><i class="bi bi-pencil-square"></i></a>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteDepartment{{ $department->id }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        {{-- Modal --}}
                                        <div class="modal fade" id="deleteDepartment{{ $department->id }}" tabindex="-1"
                                            aria-labelledby="deleteDepartmentLabel{{ $department->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog ">
                                                <div class="modal-content bg-info">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5"
                                                            id="deleteDepartmentLabel{{ $department->id }}">
                                                            Konfirmasi
                                                            Penghapusan
                                                            Department</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah Anda yakin ingin menghapus department
                                                            {{ $department->nama }} ini? Tindakan ini
                                                            tidak
                                                            dapat
                                                            dibatalkan dan akan
                                                            menghapus semua data terkait department tersebut.
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <form
                                                            action="{{ route('admin.department.destroy', $department->id) }}"
                                                            method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Confirm</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $departments->links() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
