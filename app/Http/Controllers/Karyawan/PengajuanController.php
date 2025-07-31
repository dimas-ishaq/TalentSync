<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Storage;
use Exception;

class PengajuanController extends Controller
{
    public function index()
    {
        $user = auth()->user()->karyawan;
        $pengajuans = Pengajuan::where('karyawan_id', $user->id)->paginate(10);
        return view('karyawan.pengajuan.dashboard', compact('pengajuans'));
    }

    public function showFileViewer($filename)
    {
        $filePath = 'lampiran/' . $filename;

        if (!Storage::disk('local')->exists($filePath)) {
            abort(404, 'File not found.');
        }
        return response()->file(Storage::path($filePath));
    }

    public function store(Request $request)
    {

        $request->validate([
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'nullable|date|after_or_equal:tanggal_mulai',
            'jenis' => 'required|in:cuti,izin,sakit',
            'alasan' => 'required|string',
            'lampiran' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);
        Pengajuan::create([
            'karyawan_id' => auth()->user()->karyawan->id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_berakhir' => $request->tanggal_berakhir,
            'jenis' => $request->jenis,
            'alasan' => $request->alasan,
            'lampiran' => $request->file('lampiran') ? $request->file('lampiran')->store('lampiran') : null,
            'status' => 'pending',
        ]);

        return redirect()->route('karyawan.pengajuan.dashboard')->with('toast', [
            'type' => 'success',
            'message' => 'Pengajuan berhasil disimpan.'
        ]);
    }

    public function destroy(Request $request, $id)
    {
        try {
            $pengajuan = Pengajuan::findOrFail($id);

            if ($pengajuan->lampiran && Storage::exists($pengajuan->lampiran)) {
                Storage::delete($pengajuan->lampiran);
            }

            $pengajuan->delete();
            return redirect()->back()->with('toast', [
                'type' => 'success',
                'message' => 'Pengajuan berhasil dihapus'
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with(
                'toast',
                [
                    'type' => 'danger',
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]
            );
        }
    }
}
