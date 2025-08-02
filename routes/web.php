<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\JabatanController;
use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\Admin\PengajuanController;
use App\Http\Controllers\Admin\PenggajianController;
use App\Http\Controllers\Admin\PenilaianController;
use App\Http\Controllers\Admin\AbsensiController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Karyawan\DashboardController as Dashboard_Karyawan_Controller;
use App\Http\Controllers\Karyawan\AbsensiController as Absensi_Karyawan_Controller;
use App\Http\Controllers\Karyawan\PengajuanController as Pengajuan_Karyawan_Controller;
use App\Http\Controllers\Karyawan\ProfileController as Profile_Karyawan_Controller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});


Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::middleware('auth')->get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/home', function () {
    $user = auth()->user();
    if ($user->role == 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($user->role == 'user') {
        return redirect()->route('karyawan.dashboard');
    }
    return redirect('/');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get(
        '/dashboard/admin',
        [DashboardController::class, 'showAdminDashboard']
    )->name('admin.dashboard');

    // Karyawan
    Route::get(
        '/dashboard/admin/karyawan',
        [KaryawanController::class, 'showAdminKaryawan']
    )->name('admin.karyawan.dashboard');

    Route::get(
        '/dashboard/admin/karyawan/{id}',
        [KaryawanController::class, 'showDetailKaryawan']
    )->name('admin.karyawan.detail');


    Route::post(
        '/dashboard/admin/karyawan',
        [KaryawanController::class, 'store']
    )->name('admin.karyawan.store');

    Route::delete(
        '/dashboard/admin/karyawan/{id}',
        [KaryawanController::class, 'destroy']
    )->name('admin.karyawan.destroy');

    Route::put(
        '/dashboard/admin/karyawan/{id}',
        [KaryawanController::class, 'update']
    )->name('admin.karyawan.update');

    // Absensi
    Route::get(
        '/dashboard/admin/absensi',
        [AbsensiController::class, 'index']
    )->name('admin.absensi.index');

    Route::get(
        '/dashboard/admin/absensi/{id}',
        [AbsensiController::class, 'show']
    )->name('admin.absensi.show');

    Route::put(
        '/dashboard/admin/absensi/{id}',
        [AbsensiController::class, 'update']
    )->name('admin.absensi.update');

    // Department
    Route::get(
        '/dashboard/admin/department',
        [DepartmentController::class, 'showAdminDepartment']
    )->name('admin.department.dashboard');

    Route::get(
        '/dashboard/admin/department/create',
        [DepartmentController::class, 'create']
    )->name('admin.department.create');

    Route::post(
        '/dashboard/admin/department',
        [DepartmentController::class, 'store']
    )->name('admin.department.store');

    Route::get(
        '/dashboard/admin/department/{id}/edit',
        [DepartmentController::class, 'edit']
    )->name('admin.department.edit');

    Route::delete(
        '/dashboard/admin/department/{id}',
        [DepartmentController::class, 'destroy']
    )->name('admin.department.destroy');

    Route::put(
        '/dashboard/admin/department/{id}',
        [DepartmentController::class, 'update']
    )->name('admin.department.update');

    // Jabatan
    Route::get(
        '/dashboard/admin/jabatan',
        [JabatanController::class, 'showAdminJabatan']
    )
        ->name('admin.jabatan.dashboard');

    Route::get(
        '/dashboard/admin/jabatan/create',
        [JabatanController::class, 'create']
    )->name('admin.jabatan.create');

    Route::post(
        '/dashboard/admin/jabatan',
        [JabatanController::class, 'store']
    )->name('admin.jabatan.store');

    Route::get(
        '/dashboard/admin/jabatan/{id}/edit',
        [JabatanController::class, 'edit']
    )
        ->name('admin.jabatan.edit');

    Route::put(
        '/dashboard/admin/jabatan/{id}',
        [JabatanController::class, 'update']
    )
        ->name('admin.jabatan.update');

    Route::delete(
        '/dashboard/admin/jabatan/{id}',
        [JabatanController::class, 'destroy']
    )
        ->name('admin.jabatan.destroy');

    // User
    Route::get(
        '/dashboard/admin/user',
        [UserController::class, 'showAdminUser']
    )->name('admin.user.dashboard');

    Route::get(
        '/dashboard/admin/user/create',
        [UserController::class, 'create']
    )->name('admin.user.create');

    Route::post(
        '/dashboard/admin/user',
        [UserController::class, 'store']
    )->name('admin.user.store');

    Route::get(
        '/dashboard/admin/user/{id}/edit',
        [UserController::class, 'edit']
    )->name('admin.user.edit');

    Route::put(
        '/dashboard/admin/user/{id}',
        [UserController::class, 'update']
    )->name('admin.user.update');

    Route::delete(
        '/dashboard/admin/user/{id}',
        [UserController::class, 'destroy']
    )->name('admin.user.destroy');

    //Pengajuan
    Route::get(
        '/dashboard/admin/pengajuan',
        [PengajuanController::class, 'showAdminPengajuan']
    )->name(('admin.pengajuan.dashboard'));

    Route::put(
        '/dashboard/admin/pengajuan/approve/{id}',
        [PengajuanController::class, 'approvePengajuan']
    )->name('admin.pengajuan.approve');

    Route::put(
        '/dashboard/admin/pengajuan/reject/{id}',
        [PengajuanController::class, 'rejectPengajuan']
    )->name('admin.pengajuan.reject');

    Route::get(
        '/dashboard/admin/pengajuan/file/{filename}',
        [PengajuanController::class, 'showFileViewer']
    )->name('admin.pengajuan.lampiran');

    Route::get(
        '/dashboard/admin/pengajuan/riwayat',
        [PengajuanController::class, 'showRiwayatPengajuan']
    )->name('admin.pengajuan.riwayat');

    // Penggajian
    Route::get(
        '/dashboard/admin/penggajian',
        [PenggajianController::class, 'showAdminPenggajian']
    )->name('admin.penggajian.dashboard');

    Route::post(
        '/dashboard/admin/penggajian',
        [PenggajianController::class, 'store']
    )->name('admin.penggajian.store');

    Route::get(
        '/dashboard/admin/penggajian/{id}',
        [PenggajianController::class, 'show']
    )->name('admin.penggajian.show');

    Route::put(
        '/dashboard/admin/penggajian/{id}',
        [PenggajianController::class, 'update']
    )->name('admin.penggajian.update');

    // Penilaian
    Route::get(
        '/dashboard/admin/penilaian',
        [PenilaianController::class, 'showAdminPenilaian']
    )->name('admin.penilaian.dashboard');

    Route::get(
        '/dashboard/admin/penilaian/{id}',
        [PenilaianController::class, 'show']
    )->name('admin.penilaian.show');

    Route::post(
        '/dashboard/admin/penilaian',
        [PenilaianController::class, 'store']
    )->name('admin.penilaian.store');

    Route::put(
        '/dashboard/admin/penilaian/{id}',
        [PenilaianController::class, 'update']
    )->name('admin.penilaian.update');

    // Profile
    Route::get(
        '/dashboard/admin/profile',
        [ProfileController::class, 'index']
    )->name('admin.profile.index');
});


Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get(
        '/dashboard/karyawan',
        [Dashboard_Karyawan_Controller::class, 'showKaryawanDashboard']
    )->name('karyawan.dashboard');

    // karyawan/absensi
    Route::get(
        '/dashboard/karyawan/absensi',
        [Absensi_Karyawan_Controller::class, 'showKaryawanAbsensi']
    )->name('karyawan.absensi.dashboard');

    Route::post(
        '/dashboard/karyawan/absensi',
        [Absensi_Karyawan_Controller::class, 'checkIn']
    )->name('karyawan.absensi.checkIn');

    Route::put(
        '/dashboard/karyawan/absensi',
        [Absensi_Karyawan_Controller::class, 'checkOut']
    )->name('karyawan.absensi.checkOut');

    Route::get(
        '/dashboard/karyawan/absensi/riwayat',
        [Absensi_Karyawan_Controller::class, 'showRiwayatKaryawanAbsensi']
    )->name('karyawan.absensi.riwayat');

    // karyawan/pengajuan

    Route::get(
        '/dashboard/karyawan/pengajuan',
        [Pengajuan_Karyawan_Controller::class, 'index']
    )->name('karyawan.pengajuan.dashboard');

    Route::post(
        '/dashboard/karyawan/pengajuan',
        [Pengajuan_Karyawan_Controller::class, 'store']
    )->name('karyawan.pengajuan.store');

    Route::get(
        '/dashboard/karyawan/pengajuan/file/{filename}',
        [Pengajuan_Karyawan_Controller::class, 'showFileViewer']
    )->name('karyawan.pengajuan.lampiran');

    Route::delete(
        '/dashboard/karyawan/pengajuan/{id}',
        [Pengajuan_Karyawan_Controller::class, 'destroy']
    )->name('karyawan.pengajuan.destroy');

    // Karyawan/penggajian

    // karyawan profile

    Route::get(
        '/dashboard/karyawan/profile',
        [Profile_Karyawan_Controller::class, 'index']
    )->name('karyawan.profile.index');
});
