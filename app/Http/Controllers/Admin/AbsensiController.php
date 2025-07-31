<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AbsensiController extends Controller
{
    public function index(Request $request)
    {
        $selectedStatus = $request->input('status');
        $searchKeyword = $request->input('search');
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalBerakhir = $request->input('tanggal_berakhir');
        if (empty($tanggalBerakhir)) {
            $tanggalBerakhir = now()->format('Y-m-d');
        }
        $absensisQuery = Absensi::with('karyawan');

        if (!empty($selectedStatus) && $selectedStatus !== 'semua') {
            $absensisQuery->where('status', $selectedStatus);
        }
        if ($tanggalMulai && $tanggalBerakhir) {
            $absensisQuery->whereBetween('tanggal', [$tanggalMulai, $tanggalBerakhir]);
        }
        if (!empty($searchKeyword)) {
            $absensisQuery->whereHas('karyawan', function ($query) use ($searchKeyword) {
                $query->where('nama', 'like', '%' . $searchKeyword . '%');
            });
        }
        $absensis = $absensisQuery->paginate(10)->appends(request()->query());
        return view("admin.absensi.index", compact('absensis'));
    }

    public function show($id)
    {
        $absensi = Absensi::with(['karyawan'])->findOrFail($id);
        return response()->json($absensi);
    }

    public function update(Request $request, $id)
    {
        try {
            $absensi = Absensi::findOrFail($id);
            $validated = $request->validate([
                'status' => 'required|string',
                'catatan' => 'required|string|min:10'
            ]);
            $absensi->update($validated);
            return redirect()->back()->with('toast', [
                'type' => 'success',
                'message' => 'Berhasil update absensi.'
            ]);
            
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            $errorMessage = 'Terjadi kesalahan validasi.';
            if (!empty($errors)) {
                $errorMessage = $errors[0];
            }

            return redirect()->back()->with('toast', [
                'type' => 'danger',
                'message' => $errorMessage
            ]);
        }
    }
}
