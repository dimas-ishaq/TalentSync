<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showKaryawanDashboard(){
        return view('karyawan.dashboard');
    }
}
