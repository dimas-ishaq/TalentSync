<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\Penilaian;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function showAdminPenilaian(Request $request)
    {
        $selectedBulan = $request->input('bulan', Carbon::now()->month);
        $selectedTahun = $request->input('tahun', Carbon::now()->year);
        $selectedStatus = $request->input('status', 'belum_diproses');
        $searchKeywords = $request->input('search');

        $karyawanQuery = Karyawan::with(['jabatan', 'department']);

        $karyawanQuery->with(['penilaians' => function ($query) use ($selectedBulan, $selectedTahun) {
            $query->whereMonth('periode', $selectedBulan)
                ->whereYear('periode', $selectedTahun);
        }]);

        if ($selectedStatus != 'belum_diproses') {
            $karyawanQuery->whereHas('penilaians', function ($query) use ($selectedBulan, $selectedTahun, $selectedStatus) {
                $query->whereMonth('periode', $selectedBulan)
                    ->whereYear('periode', $selectedTahun)
                    ->where('status', $selectedStatus);
            });
        } else {
            $karyawanQuery->whereDoesntHave('penilaians', function ($query) use ($selectedBulan, $selectedTahun, $selectedStatus) {
                $query->whereMonth('periode', $selectedBulan)
                    ->whereYear('periode', $selectedTahun);
            });
        }

        if ($searchKeywords) {
            $karyawanQuery->where(function ($query) use ($searchKeywords) {
                $query->where('nama', 'like', '%' . $searchKeywords . '%'); // Sesuaikan 'nama_lengkap' dengan kolom nama karyawan Anda

                // Pencarian di relasi Jabatan
                $query->orWhereHas('jabatan', function ($subQuery) use ($searchKeywords) {
                    $subQuery->where('nama', 'like', '%' . $searchKeywords . '%'); // Sesuaikan 'nama_jabatan'
                });

                // Pencarian di relasi Departemen
                $query->orWhereHas('department', function ($subQuery) use ($searchKeywords) {
                    $subQuery->where('nama', 'like', '%' . $searchKeywords . '%'); // Sesuaikan 'nama_department'
                });
            });
        }
        $karyawans = $karyawanQuery->paginate(10)->appends(request()->query());
        return view('admin.penilaian.dashboard', compact('karyawans'));
    }
    public function create($id)
    {
        $karyawan = Karyawan::findOrFail($id);
        return view('admin.penilaian.create', compact('karyawan'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|string|min:1',
            'periode' => 'required|date',
            'disiplin' => 'required|numeric|min:1|max:10',
            'kerja_sama' => 'required|numeric|min:1|max:10',
            'tanggung_jawab' => 'required|numeric|min:1|max:10',
            'inisiatif' => 'required|numeric|min:1|max:10',
            'etika_kerja' => 'required|numeric|min:1|max:10',
            'target_kerja' => 'required|numeric|min:1|max:10',
            'catatan' => 'nullable|string',
            'status' => 'required|string|in:draft,selesai'
        ]);
        $sum = $request->input('disiplin') +
            $request->input('kerja_sama') +
            $request->input('tanggung_jawab') +
            $request->input('inisiatif') +
            $request->input('etika_kerja') +
            $request->input('target_kerja');
        $count = 6;
        $rata_rata = round($sum / $count, 2);
        $penilaian = new Penilaian();
        $penilaian->karyawan_id = $request->input('karyawan_id');
        $penilaian->periode = $request->input('periode');
        $penilaian->disiplin = $request->input('disiplin');
        $penilaian->kerja_sama = $request->input('kerja_sama');
        $penilaian->tanggung_jawab = $request->input('tanggung_jawab');
        $penilaian->inisiatif = $request->input('inisiatif');
        $penilaian->etika_kerja = $request->input('etika_kerja');
        $penilaian->target_kerja = $request->input('target_kerja');
        $penilaian->catatan = $request->input('catatan');
        $penilaian->rata_rata = $rata_rata;
        $penilaian->status = $request->input('status');
        $penilaian->save();

        return redirect()->route('admin.penilaian.dashboard')->with('toast', [
            'type' => 'success',
            'message' => 'Penilaian berhasil dibuat'
        ]);
    }

    public function show($id)
    {
        $penilaian = Penilaian::with(['karyawan.jabatan', 'karyawan.department'])->findOrFail($id);
        return  response()->json($penilaian);
    }
    public function update(Request $request, $id)
    { {
            // 1. Validasi Data
            // Aturan validasi bisa sama atau disesuaikan jika ada perubahan persyaratan
            $validatedData = $request->validate([
                'periode' => 'required|date',
                'disiplin' => 'required|numeric|min:1|max:10',
                'kerja_sama' => 'required|numeric|min:1|max:10',
                'tanggung_jawab' => 'required|numeric|min:1|max:10',
                'inisiatif' => 'required|numeric|min:1|max:10',
                'etika_kerja' => 'required|numeric|min:1|max:10',
                'target_kerja' => 'required|numeric|min:1|max:10',
                'catatan' => 'nullable|string',
                'status' => 'required|string|in:draft,selesai'
            ]);

            // 2. Hitung Ulang Rata-rata
            $sum = $request->input('disiplin') +
                $request->input('kerja_sama') +
                $request->input('tanggung_jawab') +
                $request->input('inisiatif') +
                $request->input('etika_kerja') +
                $request->input('target_kerja');
            $count = 6;
            $rata_rata = round($sum / $count, 2);

            $penilaian = Penilaian::findOrFail($id);

            $penilaian->fill($validatedData); // Mengisi atribut dari validatedData
            $penilaian->rata_rata = $rata_rata; // Menimpa rata_rata dengan nilai yang dihitung

            // 4. Simpan Perubahan ke Database
            $penilaian->save();

            // 5. Redirect dengan Pesan Sukses
            return redirect()->route('admin.penilaian.dashboard')->with('toast', [
                'type' => 'success',
                'message' => 'Penilaian berhasil diperbarui'
            ]);
        }
    }
}
