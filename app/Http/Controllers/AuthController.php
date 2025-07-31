<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // validasi input pengguna
        $request->validate([
            'name' => 'required|string|min:5|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.max' => 'Nama maksimal harus 100 karakter',
            'name.min' => 'Nama minimal harus 5 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal harus 8 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // buat pengguna baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }

    public function login(Request $request)
    {

        // validasi input pengguna
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password tidak boleh kosong.',
            'password.min' => 'Password minimal harus 8 karakter.',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            // Jika user tidak ditemukan
            return back()->withErrors(['email' => 'Email belum terdaftar.'])->withInput();
        }

        if (!Hash::check($request->password, $user->password)) {
            // Jika password salah
            return back()->withErrors(['password' => 'Password belum sesuai.'])->withInput();
        }

        $remember = $request->has('remember');
        // autentikasi pengguna
        if (auth()->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            $user = auth()->user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Welcome back, Admin!');
            } else if ($user->role === 'user') {
                return redirect()->route('karyawan.dashboard')->with('success', 'Welcome back, Admin!');
            } else {
                auth()->logout();

                return back()->withErrors([
                    'email' => 'Akses tidak diizinkan untuk role ini.',
                ])->withInput();
            }
        }

        return back()->withErrors([
            'email' => 'Email belum terdaftar.',
        ])->withInput();
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/')->with('success', 'You have been logged out successfully.');
    }
}
