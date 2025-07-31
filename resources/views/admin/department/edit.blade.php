@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{ route('admin.dashboard') }}
                                class="badge text-bg-secondary text-decoration-none">Dashboard</a></li>
                        <li class="breadcrumb-item " aria-current="page"><a href={{ route('admin.department.dashboard') }}
                                class="badge text-bg-secondary text-decoration-none">Department</a></li>
                        <li class="breadcrumb-item active " aria-current="page"><span
                                class="badge text-bg-secondary">Edit</span></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card mb-3">
                    <div class="card-header text-bg-primary ">Edit Department</div>
                    <div class="card-body">
                        <form action="{{ route('admin.department.update', $department->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" id="nama" class="form-control" name="nama"
                                    value="{{ $department->nama }}">
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <input type="text" id="deskripsi" class="form-control" name="deskripsi"
                                    value="{{ $department->deskripsi }}">
                            </div>
                            <div class="d-flex gap-3">
                                <button type="submit" class="btn btn-primary w-100">Simpan</button>
                                <a href="{{route('admin.department.dashboard')}}" class="btn btn-danger">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
