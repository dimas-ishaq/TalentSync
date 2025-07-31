<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Penggajian;
use Carbon\Carbon;

class PenggajianController extends Controller
{
    public function showAdminPenggajian(Request $request)
    {
        // 1. Inisialisasi bulan dan tahun yang dipilih (default ke bulan/tahun saat ini)
        $selectedBulan = $request->input('bulan', Carbon::now()->month);
        $selectedTahun = $request->input('tahun', Carbon::now()->year);
        $searchKeywords = $request->input('search');
        $selectedStatus = $request->input('status', 'belum_diproses');

        // 2. Mulai membangun query untuk Karyawan
        $karyawansQuery = Karyawan::with(['jabatan', 'department']);

        // 3. Terapkan filter untuk mengambil karyawan yang belum diproses gajinya
        //    Ini akan mencari karyawan yang TIDAK memiliki catatan penggajian
        //    untuk bulan dan tahun yang dipilih.
        if ($selectedStatus == 'belum_diproses') {
            $karyawansQuery->whereDoesntHave('penggajians', function ($query) use ($selectedBulan, $selectedTahun) {
                $query->whereMonth('periode_mulai', $selectedBulan)
                    ->whereYear('periode_mulai', $selectedTahun);
            });
        }

        if ($selectedStatus != 'belum_diproses') {
            $karyawansQuery->whereHas('penggajians', function ($query) use ($selectedBulan, $selectedTahun, $selectedStatus) {
                $query->whereMonth('periode_mulai', $selectedBulan)
                    ->whereYear('periode_mulai', $selectedTahun)
                    ->where('status_pembayaran', $selectedStatus);
            });
        }

        if ($searchKeywords) {
            $karyawansQuery->where(function ($query) use ($searchKeywords) {
                // Pencarian di kolom nama karyawan
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

        // 4. Paginate hasilnya dan tambahkan parameter query yang ada ke tautan paginasi
        $karyawans = $karyawansQuery->paginate(10)->appends(request()->query());

        // 5. Kembalikan view dengan data karyawan yang sudah difilter dan parameter bulan/tahun
        return view('admin.penggajian.dashboard', compact('karyawans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id' => 'required|string|max:255',
            'gaji_pokok' => 'required|numeric|min:1000000',
            'tunjangan_tetap' => 'required|numeric|min:100000',
            'tunjangan_tidak_tetap' => 'required|numeric|min:100000',
            'pot_bpjs_kesehatan' => 'required|numeric|min:0',
            'pot_bpjs_ketenagakerjaan' => 'required|numeric|min:0',
            'pot_pph21' => 'required|numeric|min:0',
            'pot_pinjaman' => 'required|numeric|min:0',
            'pot_denda' => 'required|numeric|min:0',
            'periode_mulai' => 'required|date',
            'periode_selesai' => 'required|date|after:periode_mulai',
            'tanggal_pembayaran' => 'nullable|date',
            'status_pembayaran' => 'required|in:pending,dibayar'
        ]);


        $penggajian = new Penggajian();
        $penggajian->karyawan_id = $request->input('karyawan_id');
        $penggajian->gaji_pokok = $request->input('gaji_pokok');
        $penggajian->tunjangan_tetap = $request->input('tunjangan_tetap');
        $penggajian->tunjangan_tidak_tetap = $request->input('tunjangan_tidak_tetap');
        $penggajian->pot_bpjs_kesehatan = $request->input('pot_bpjs_kesehatan');
        $penggajian->pot_bpjs_ketenagakerjaan = $request->input('pot_bpjs_ketenagakerjaan');
        $penggajian->pot_pph21 = $request->input('pot_pph21');
        $penggajian->pot_pinjaman = $request->input('pot_pinjaman');
        $penggajian->pot_denda = $request->input('pot_denda');
        $total_pendapatan = ($request->input('gaji_pokok')
            + $request->input('tunjangan_tetap') +
            $request->input('tunjangan_tidak_tetap'));
        $total_potongan = ($request->input('pot_bpjs_kesehatan')
            + $request->input('pot_bpjs_ketenagakerjaan')
            + $request->input('pot_pph21')
            + $request->input('pot_pinjaman')
            + $request->input('pot_denda'));
        $penggajian->total_pendapatan = $total_pendapatan;
        $penggajian->total_potongan = $total_potongan;
        $penggajian->gaji_bersih = ($total_pendapatan - $total_potongan);
        $penggajian->periode_mulai = $request->input('periode_mulai');
        $penggajian->periode_selesai = $request->input('periode_selesai');
        $penggajian->tanggal_pembayaran = $request->input('tanggal_pembayaran');
        $penggajian->status_pembayaran = $request->input('status_pembayaran');
        $penggajian->save();

        return redirect()->route('admin.penggajian.dashboard')->with('toast', [
            'type' => 'success',
            'message' => 'Penggajian berhasil dibuat'
        ]);
    }

    public function show($id)
    {
        $penggajian = Penggajian::with(["karyawan.jabatan", "karyawan.department",])->findOrFail($id);
        return response()->json($penggajian);
    }
    public function update(Request $request, $id)
    {
        $request->validate(([
            'gaji_pokok' => 'required|numeric|min:1000000',
            'tunjangan_tetap' => 'required|numeric|min:100000',
            'tunjangan_tidak_tetap' => 'required|numeric|min:100000',
            'pot_bpjs_kesehatan' => 'required|numeric|min:0',
            'pot_bpjs_ketenagakerjaan' => 'required|numeric|min:0',
            'pot_pph21' => 'required|numeric|min:0',
            'pot_pinjaman' => 'required|numeric|min:0',
            'pot_denda' => 'required|numeric|min:0',
            'periode_mulai' => 'required|date',
            'periode_selesai' => 'required|date|after:periode_mulai',
            'tanggal_pembayaran' => 'nullable|date',
            'status_pembayaran' => 'required|in:pending,dibayar'
        ]));

        $penggajian = Penggajian::findOrFail($id);
        $penggajian->gaji_pokok = $request->input('gaji_pokok');
        $penggajian->tunjangan_tetap = $request->input('tunjangan_tetap');
        $penggajian->tunjangan_tidak_tetap = $request->input('tunjangan_tidak_tetap');
        $penggajian->pot_bpjs_kesehatan = $request->input('pot_bpjs_kesehatan');
        $penggajian->pot_bpjs_ketenagakerjaan = $request->input('pot_bpjs_ketenagakerjaan');
        $penggajian->pot_pph21 = $request->input('pot_pph21');
        $penggajian->pot_pinjaman = $request->input('pot_pinjaman');
        $penggajian->pot_denda = $request->input('pot_denda');
        $total_pendapatan = ($request->input('gaji_pokok')
            + $request->input('tunjangan_tetap') +
            $request->input('tunjangan_tidak_tetap'));
        $total_potongan = ($request->input('pot_bpjs_kesehatan')
            + $request->input('pot_bpjs_ketenagakerjaan')
            + $request->input('pot_pph21')
            + $request->input('pot_pinjaman')
            + $request->input('pot_denda'));
        $penggajian->total_pendapatan = $total_pendapatan;
        $penggajian->total_potongan = $total_potongan;
        $penggajian->gaji_bersih = ($total_pendapatan - $total_potongan);
        $penggajian->periode_mulai = $request->input('periode_mulai');
        $penggajian->periode_selesai = $request->input('periode_selesai');
        $penggajian->tanggal_pembayaran = $request->input('tanggal_pembayaran');
        $penggajian->status_pembayaran = $request->input('status_pembayaran');
        $penggajian->save();

        return redirect()->route('admin.penggajian.dashboard')->with(
            'toast',
            [
                'type' => 'success',
                'message' => 'Penggajian berhasil diupdate'
            ]
        );
    }
}
