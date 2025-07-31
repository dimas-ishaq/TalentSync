@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid mt-4">

        <div class="row">
            <div class="col-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}"
                                class="badge text-bg-secondary text-decoration-none">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="badge text-bg-secondary">Jabatan</span>
                        </li>
                        <li class="breadcrumb-item active">
                            <span class="badge text-bg-secondary">Edit</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card mb-3">
                    <div class="card-header text-bg-primary ">Edit Jabatan</div>
                    <div class="card-body text-bg-light">
                        <form action="{{ route('admin.jabatan.update', $jabatan->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control"
                                    value="{{ $jabatan->nama }}">
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <input type="text" name="deskripsi" id="deskripsi" class="form-control"
                                    value="{{ $jabatan->deskripsi }}">
                            </div>
                            <div class="d-flex gap-2 align-items-center">
                                <button type="submit" class="btn btn-primary w-100">Simpan</button>
                                <a href="{{ route('admin.jabatan.dashboard') }}" class="btn btn-danger">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
