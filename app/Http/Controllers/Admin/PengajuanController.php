<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Storage;

class PengajuanController extends Controller
{
    public function showAdminPengajuan(Request $request)
    {
        $jenisSelected = $request->input('jenis');
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalBerakhir = $request->input('tanggal_berakhir');
        if (empty($tanggalBerakhir)) {
            $tanggalBerakhir = now()->format('Y-m-d');
        }
        $searchKeywords = $request->input('search');

        $pengajuansQuery = Pengajuan::with('karyawan')->where('status', 'pending');

        if (!empty($jenisSelected) && $jenisSelected != 'semua') {
            $pengajuansQuery->where('jenis', $jenisSelected);
        }
        if (!empty($tanggalMulai) && !empty($tanggalBerakhir)) {

            $pengajuansQuery->whereBetween('tanggal_mulai', [$tanggalMulai, $tanggalBerakhir]);
        }
        if (!empty($searchKeywords) && $searchKeywords != '') {
            $pengajuansQuery->whereHas('karyawan', function ($query) use ($searchKeywords) {
                $query->where('nama', 'like', '%' . $searchKeywords . '%');
            });
        }
        $pengajuans = $pengajuansQuery->paginate(10)->appends(request()->query());
        return view('admin.pengajuan.dashboard', compact('pengajuans'));
    }

    public function showFileViewer($filename)
    {
        $filePath = 'lampiran/' . $filename;

        if (!Storage::disk('local')->exists($filePath)) {
            abort(404, 'File not found.');
        }
        return response()->file(Storage::path($filePath));
    }

    public function approvePengajuan($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status = 'disetujui';
        $pengajuan->save();

        return redirect()->route('admin.pengajuan.dashboard')->with('toast', [
            'type' => 'success',
            'message' => 'Pengajuan berhasil disetujui.'
        ]);
    }
    public function rejectPengajuan($id)
    {
        $pengajuan = Pengajuan::findOrFail($id);
        $pengajuan->status = 'ditolak';
        $pengajuan->save();

        return redirect()->route('admin.pengajuan.dashboard')->with('toast', [
            'type' => 'success',
            'message' => 'Pengajuan berhasil ditolak.'
        ]);
    }

    public function showRiwayatPengajuan()
    {
        $pengajuans = Pengajuan::with('karyawan')->paginate(10);
        return view('admin.pengajuan.riwayat', compact('pengajuans'));
    }
}
