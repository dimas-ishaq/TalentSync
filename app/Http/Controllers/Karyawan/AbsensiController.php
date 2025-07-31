<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AbsensiController extends Controller
{
    public function showKaryawanAbsensi()
    {
        $user = auth()->user();
        $today = Carbon::now('Asia/Jakarta')->toDateString();

        // Cek apakah user sudah check-in hari ini
        $checkIn = Absensi::where('karyawan_id', $user->id)
            ->where('tanggal', $today)
            ->first();

        $absensis = Absensi::with('karyawan.jabatan', 'karyawan.department')->where('karyawan_id', $user->id)->paginate(10);
        return view('karyawan.absensi.dashboard', compact(['checkIn', 'absensis']));
    }

    public function checkIn(Request $request)
    {
        // 1. Validasi Input dari Client
        $request->validate([
            'foto_masuk' => 'required|string|starts_with:data:image/',
            'latitude_masuk' => 'required|numeric|between:-90,90',
            'longitude_masuk' => 'required|numeric|between:-180,180',
            'lokasi' => 'required|string|max:255',
            'check_in_time_client' => 'required|date', // Waktu dari client (misal: ISO string)
            'user_timezone' => 'required|string',    // Timezone dari client (misal: Asia/Jakarta)
        ]);

        $user = auth()->user();
        $today = now()->toDateString(); // Tanggal berdasarkan waktu server (umumnya aman)

        // Ambil waktu dari client dan ubah ke objek Carbon
        // Jika check_in_time_client adalah ISO string (hasil toISOString() dari JS),
        // Carbon akan otomatis menginterpretasikannya sebagai UTC.
        $clientCheckInTimeUTC = Carbon::parse($request->input('check_in_time_client'));

        // Konversi waktu client ke timezone lokal aplikasi (Asia/Jakarta) untuk perbandingan
        // Ini penting agar perbandingan dengan '08:00:00' dan '08:15:00' sesuai konteks lokal.
        try {
            $clientCheckInTimeUserTZ = $clientCheckInTimeUTC->timezone($request->input('user_timezone'));

            // Buat objek Carbon untuk batas waktu absensi di timezone sistem
            // Mengambil tanggal yang sama dengan waktu check-in client agar perbandingan jam lebih akurat
            $jamBatasCheckIn = $clientCheckInTimeUserTZ->copy()->setTime(8, 0, 0); // Pukul 08:00:00 di timezone client
            $jamBatasTerlambat = $clientCheckInTimeUserTZ->copy()->setTime(8, 15, 0); // Pukul 08:15:00 di timezone client
            $jamBatasCheckInMax = $clientCheckInTimeUserTZ->copy()->setTime(10, 0, 0);

            // 2. Logika Batasan Waktu Check-in (Tidak Boleh Sebelum Jam 08:00)
            // Bandingkan waktu check-in client dengan jam 08:00:00 di timezone yang sama.
            if ($clientCheckInTimeUserTZ->lt($jamBatasCheckIn)) {
                return back()->with('toast', [
                    'type' => 'warning',
                    'message' => 'Check-in hanya bisa dilakukan mulai pukul 08:00.'
                ]);
            }
            // Batasan jam maksimal waktu checkin
            if ($clientCheckInTimeUserTZ->gt($jamBatasCheckInMax)) {
                return back()->with('toast', [
                    'type' => 'warning',
                    'message' => 'Anda tidak bisa check-in setelah pukul 10:00.'
                ]);
            }

            // 3. Cek Apakah Sudah Check-in Hari Ini (menggunakan tanggal server)
            if (Absensi::where('user_id', $user->id)->where('tanggal', $today)->exists()) {
                return back()->with('toast', [
                    'type' => 'warning',
                    'message' => 'Anda sudah check-in hari ini.'
                ]);
            }

            // 4. Mengolah dan Menyimpan Gambar Base64
            $base64Image = $request->input('foto_masuk');
            $filePath = null; // Inisialisasi filePath

            if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
                $imageData = substr($base64Image, strpos($base64Image, ',') + 1);
                $type = strtolower($type[1]);

                if (!in_array($type, ['jpeg', 'jpg', 'png', 'gif', 'webp'])) {
                    return back()->with('toast', [
                        'type' => 'danger',
                        'message' => 'Format gambar tidak didukung.'
                    ]);
                }

                $imageData = base64_decode($imageData);

                if ($imageData === false) {
                    return back()->with('toast', [
                        'type' => 'danger',
                        'message' => 'Gagal mendekode gambar.'
                    ]);
                }

                $fileName = 'checkin_' . $user->id . '_' . time() . '.' . $type;
                $filePath = 'images/absensi/' . $fileName;

                Storage::disk('public')->put($filePath, $imageData);
            } else {
                return back()->with('toast', [
                    'type' => 'danger',
                    'message' => 'Format Base64 tidak valid.'
                ]);
            }

            // 5. Simpan Data Absensi ke Database
            $absensi = new Absensi();
            $absensi->user_id = $user->id;
            $absensi->tanggal = $today; // Menggunakan tanggal dari server
            // Simpan jam masuk berdasarkan waktu client (diubah ke string waktu, UTC lebih aman)
            $absensi->jam_masuk = $clientCheckInTimeUTC->toTimeString(); // Hanya simpan HH:MM:SS dalam UTC
            // Anda bisa juga menyimpan waktu penuh jika kolom database adalah DATETIME/TIMESTAMP
            // $absensi->waktu_masuk_utc = $clientCheckInTimeUTC; // Asumsi ada kolom waktu_masuk_utc DATETIME/TIMESTAMP

            // Hitung status berdasarkan waktu check-in client yang sudah disesuaikan timezone-nya
            $absensi->status = $clientCheckInTimeUserTZ->gt($jamBatasTerlambat) ? 'terlambat' : 'hadir';
            $absensi->foto_masuk = $filePath; // Path gambar yang disimpan
            $absensi->latitude_masuk = $request->latitude_masuk;
            $absensi->longitude_masuk = $request->longitude_masuk;
            $absensi->lokasi = $request->lokasi;
            $absensi->save();

            return back()->with('toast', [
                'type' => 'success',
                'message' => 'Check-in berhasil!'
            ]);
        } catch (Exception $e) {
            // Tangani jika user_timezone tidak valid, string waktu tidak bisa di-parse, atau error umum lainnya
            return back()->with('toast', [
                'type' => 'danger',
                'message' => 'Terjadi kesalahan saat memproses check-in: ' . $e->getMessage()
            ]);
        }
    }

    public function checkOut(Request $request)
    {
        // 1. Validasi Input dari Client
        $request->validate([
            'foto_keluar' => 'required|string|starts_with:data:image/', // Gambar Base64
            'latitude_keluar' => 'required|numeric|between:-90,90',
            'longitude_keluar' => 'required|numeric|between:-180,180',
            'check_out_time_client' => 'required|date',
            'user_timezone' => 'required|string',
        ]);

        $user = auth()->user();
        $today = now()->toDateString(); // Tanggal berdasarkan waktu server

        // 2. Ambil waktu dari client dan ubah ke objek Carbon
        $clientCheckOutTimeUTC = Carbon::parse($request->input('check_out_time_client'));

        try {
            $clientCheckOutTimeUserTZ = $clientCheckOutTimeUTC->timezone($request->input('user_timezone'));

            // --- PERBAIKAN: Batasan Waktu Check-out Minimal 16:00 dan Maksimal 23:00 ---
            $minimumCheckoutTime = $clientCheckOutTimeUserTZ->copy()->setTime(16, 0, 0); // Pukul 16:00:00 di timezone pengguna
            $maximumCheckoutTime = $clientCheckOutTimeUserTZ->copy()->setTime(23, 0, 0); // Pukul 23:00:00 di timezone pengguna

            if ($clientCheckOutTimeUserTZ->lt($minimumCheckoutTime)) {
                return back()->with('toast', [
                    'type' => 'warning',
                    'message' => 'Check-out hanya bisa dilakukan mulai pukul 16:00.'
                ]);
            }

            if ($clientCheckOutTimeUserTZ->gt($maximumCheckoutTime)) { // gt() = greater than
                return back()->with('toast', [
                    'type' => 'warning',
                    'message' => 'Check-out hanya bisa dilakukan sampai pukul 23:00.'
                ]);
            }
            // --- AKHIR PERBAIKAN ---

            // 3. Cek apakah absensi untuk hari ini sudah ada dan belum check-out
            $absensi = Absensi::where('user_id', $user->id)
                ->where('tanggal', $today)
                ->first();

            if (!$absensi) {
                return back()->with('toast', [
                    'type' => 'warning',
                    'message' => 'Anda belum melakukan check-in hari ini.'
                ]);
            }

            if ($absensi->jam_keluar) {
                return back()->with('toast', [
                    'type' => 'warning',
                    'message' => 'Anda sudah melakukan check-out hari ini.'
                ]);
            }

            // 4. Mengolah dan Menyimpan Gambar Base64 (foto_keluar)
            $base64Image = $request->input('foto_keluar');
            $filePath = null;

            if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
                $imageData = substr($base64Image, strpos($base64Image, ',') + 1);
                $type = strtolower($type[1]);

                if (!in_array($type, ['jpeg', 'jpg', 'png', 'gif', 'webp'])) {
                    return back()->with('toast', [
                        'type' => 'danger',
                        'message' => 'Format gambar tidak didukung.'
                    ]);
                }

                $imageData = base64_decode($imageData);

                if ($imageData === false) {
                    return back()->with('toast', [
                        'type' => 'danger',
                        'message' => 'Gagal mendekode gambar.'
                    ]);
                }

                $fileName = 'checkout_' . $user->id . '_' . time() . '.' . $type;
                $filePath = 'images/absensi/' . $fileName;

                Storage::disk('public')->put($filePath, $imageData);
            } else {
                return back()->with('toast', [
                    'type' => 'danger',
                    'message' => 'Format Base64 tidak valid.'
                ]);
            }

            // 5. Simpan Data Checkout ke Database
            $absensi->jam_keluar = $clientCheckOutTimeUTC->toTimeString();
            $absensi->foto_keluar = $filePath;
            $absensi->latitude_keluar = $request->latitude_keluar;
            $absensi->longitude_keluar = $request->longitude_keluar;

            // 6. Tentukan status berdasarkan waktu check-out client
            $checkInTimeTodayUserTZ = Carbon::createFromFormat('H:i:s', $absensi->jam_masuk, 'UTC')
                ->timezone($request->input('user_timezone'))
                ->setDateFrom($clientCheckOutTimeUserTZ);

            $eightHourMark = $checkInTimeTodayUserTZ->copy()->addHours(8);

            // Kita menggunakan $minimumCheckoutTime yang sudah didefinisikan sebelumnya (16:00).

            // Kondisi untuk status 'hadir' (tepat waktu pulang)
            if (
                $clientCheckOutTimeUserTZ->greaterThanOrEqualTo($minimumCheckoutTime) &&
                $clientCheckOutTimeUserTZ->greaterThanOrEqualTo($eightHourMark)
            ) {
                $absensi->status = 'hadir';
            } else {
                $absensi->status = 'pulang cepat';
            }

            $absensi->save();

            return back()->with('toast', [
                'type' => 'success',
                'message' => 'Check-out berhasil!'
            ]);
        } catch (\Exception $e) {
            // Tangani error parsing waktu atau timezone yang tidak valid, maupun error umum lainnya
            $errorMessage = strpos($e->getMessage(), 'DateTime') !== false
                ? 'Format waktu atau timezone yang dikirimkan tidak valid.'
                : 'Terjadi kesalahan saat memproses check-out: ' . $e->getMessage();

            return back()->with('toast', [
                'type' => 'danger',
                'message' => $errorMessage
            ]);
        }
    }

    public function showRiwayatKaryawanAbsensi()
    {
        $user = auth()->user();
        $absensis = Absensi::where('user_id', $user->id)->paginate(10);
        return view('karyawan.absensi.riwayat', compact('absensis'));
    }
}
