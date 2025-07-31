@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col">
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
                            <span class="badge text-bg-secondary">Tambah Jabatan</span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card mb-3">
                    <div class="card-header text-bg-primary ">Tambah Jabatan</div>
                    <div class="card-body">
                        <form action="{{ route('admin.jabatan.store') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" id="nama" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <input type="text" name="deskripsi" id="deskripsi" class="form-control">
                            </div>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary flex-grow-1">Simpan</button>
                                <a href="{{route('admin.jabatan.dashboard')}}" class="btn btn-danger">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
