<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $karyawan = Karyawan::with(['jabatan', 'department'])->findOrFail($user->karyawan_id);
        return view("karyawan.profile.index", compact("karyawan"));
    }
}
