<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function showAdminDashboard()
    {
        // Logic to retrieve and display admin dashboard data
        return view('admin.dashboard');
    }
}
