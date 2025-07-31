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
                        <li class="breadcrumb-item active " aria-current="page"><span class="badge text-bg-secondary">Edit
                                User</span></li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card mb-3">
                    <div class="card-header text-bg-primary">Edit User</div>
                    <div class="card-body">
                        <form action="{{ route('admin.user.update', $user->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" name="email" id="email" class="form-control">
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
                                            value="user">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
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
