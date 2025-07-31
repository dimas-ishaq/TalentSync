@extends('layouts.admin.app')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{ route('admin.dashboard') }}
                                class="badge text-bg-secondary text-decoration-none">Dashboard</a></li>
                        <li class="breadcrumb-item " aria-current="page"><span class="badge text-bg-secondary">User</span></li>
                        <li class="breadcrumb-item active " aria-current="page"><span class="badge text-bg-secondary">Tambah
                                User</span></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card mb-3">
                    <div class="card-header text-bg-primary">Tambah User</div>
                    <div class="card-body text-bg-light">
                        <form action="{{ route('admin.user.store') }}" method="post">
                            @csrf
                            @method('POST')
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
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama</label>
                                        <select name="name" id="name" class="form-select">
                                            <option disabled selected>Pilih Karyawan</option>
                                            @foreach ($karyawans as $karyawan)
                                                <option value="{{ $karyawan->nama }}" data-email="{{ $karyawan->email }}"
                                                    data-id="{{ $karyawan->id }}">
                                                    {{ $karyawan->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="text" name="email" id="email" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <p class="form-label">Role</p>
                                <div class="col ">
                                    <div class="form-check">
                                        <label for="role_admin">Admin</label>
                                        <input type="radio" name="role" id="role_admin" class="form-check-input"
                                            value="admin">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-check">
                                        <label for="role_user">User</label>
                                        <input type="radio" name="role" id="role_user" class="form-check-input"
                                            value="user" @checked(true)>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password" id="password" class="form-control">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="password_confirmation" class="form-label">Password Confirmation</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="karyawan_id" id="karyawan_id">
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary flex-grow-1">Simpan</button>
                                <a href="{{ route('admin.user.dashboard') }}" class="btn btn-danger">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script>
        document.getElementById('name').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const email = selectedOption.getAttribute('data-email');
            const karyawan_id = selectedOption.getAttribute('data-id');
            document.getElementById('email').value = email ?? '';
            document.getElementById('karyawan_id').value = karyawan_id ?? '';
        });
    </script>
@endpush
