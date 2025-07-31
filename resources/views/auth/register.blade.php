@extends('layouts.register.app')
@section('content')
    <section>
        <div class="row" style="height: 100vh">
            <div class="col align-self-center">
                <h2 class="text-center mb-4">Daftar</h2>
                <form action={{ route('register.post') }} method="POST" class="w-75 mx-auto">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" placeholder="Avelinelyn de Guzman">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" placeholder="avelinelyn_dgz@mail.com">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('email') is-invalid @enderror" id="password"
                            name="password" placeholder="**********">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control @error('email') is-invalid @enderror"
                            id="password_confirmation" name="password_confirmation" placeholder="**********">
                        @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Daftar</button>
                    <p class="mt-3 text-center">Sudah memiliki akun? <a href={{ route('login') }}>Masuk</a></p>
                </form>
            </div>
            <div class="col d-none d-md-block bg-primary">
            </div>
        </div>
    </section>
@endsection
