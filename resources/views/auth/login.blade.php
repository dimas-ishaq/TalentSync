@extends('layouts.login.app')
@section('content')
    <section>
        <div class="row min-vh-100 g-0">
            <div class="col-md-6 d-flex align-items-center justify-content-center bg-custom-1">
                <div class="card w-75 p-5 shadow-lg ">
                    <h2 class="text-center mb-4">Masuk</h2>
                    <form action="{{ route('login.post') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" placeholder="avelineyn@mail.com" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="********">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember" checked>
                            <label class="form-check-label" for="remember">Ingat saya</label>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Masuk</button>
                        <p class="mt-3 text-center">Belum memiliki akun? <a class="text-decoration-none"
                                href="{{ route('register') }}">Daftar Sekarang</a></p>
                    </form>
                </div>
            </div>
            <div class="col-md-6 d-none d-md-block bg-primary">
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const inputEmail = document.getElementById('email');
            const inputPassword = document.getElementById('password');


            function clearValidationFeedback(inputElement) {
                inputElement.classList.remove('is-invalid');
                let feedbackElement = inputElement.nextElementSibling;
                if (feedbackElement && feedbackElement.classList.contains('invalid-feedback')) {
                    feedbackElement.style.display = 'none';
                }
            }

            if (inputEmail) {
                inputEmail.addEventListener('input', () => {
                    clearValidationFeedback(inputEmail);
                });
            }

            if (inputPassword) {
                inputPassword.addEventListener('input', () => {
                    clearValidationFeedback(inputPassword);
                });
            }

            const allInvalidFeedbacks = document.querySelectorAll('.invalid-feedback');
            allInvalidFeedbacks.forEach(feedback => {
                feedback.style.display = 'block';
            });
        });
    </script>
@endpush
