<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $karyawan = Karyawan::with(['jabatan', 'department'])->where('email', $user->email);
        return view('admin.profile.index', compact("karyawan"));
    }
}
