<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use App\Models\Pengajuan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CutiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $karyawans = Karyawan::all();
        if ($karyawans->isEmpty()) {
            $this->command->warn('Tidak ada karyawan ditemukan. Buat karyawan terlebih dahulu sebelum menjalankan seeder ini.');
            return;
        }

        foreach ($karyawans as $karyawan) {
            for ($i = 0; $i < 3; $i++) {
                $jenis = collect(['cuti', 'izin', 'sakit'])->random();
                $tanggalMulai = now()->subDays(rand(1, 30));
                $tanggalBerakhir = clone $tanggalMulai->addDays(rand(1, 5));


                Pengajuan::create([
                    'karyawan_id'          => $karyawan->id,
                    'jenis'            => $jenis,
                    'tanggal_mulai'    => $tanggalMulai->toDateString(),
                    'tanggal_berakhir' => $tanggalBerakhir?->toDateString(),
                    'alasan'           => fake()->sentence(10),
                    'lampiran'         => rand(0, 1) ? 'lampiran_' . Str::random(5) . '.pdf' : null,
                    'status'           => collect(['pending', 'disetujui', 'ditolak'])->random(),
                ]);
            }
        }
    }
}
