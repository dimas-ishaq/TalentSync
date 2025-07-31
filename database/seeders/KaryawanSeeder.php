<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agamaList = ['Islam', 'Kristen', 'Hindu', 'Budha', 'Konghucu'];
        $pendidikanList = ['SD', 'SMP', 'SMA/SMK', 'D1', 'D2', 'D3', 'S1', 'S2'];
        $statusPernikahanList = ['Belum Menikah', 'Menikah', 'Cerai Hidup', 'Cerai Mati'];

        for ($i = 1; $i <= 20; $i++) {
            DB::table('karyawans')->insert([
                'nama' => 'Karyawan ' . $i,
                'email' => 'karyawan' . $i . '@example.com',
                'no_telepon' => '08' . rand(111111111, 999999999),
                'jabatan_id' => rand(1, 5), // pastikan id ini ada di tabel jabatans
                'department_id' => rand(1, 3), // pastikan id ini ada di tabel departments
                'tanggal_masuk' => now()->subDays(rand(30, 1000)),
                'alamat' => 'Jl. Contoh Alamat No. ' . $i,
                'foto' => null,
                'status' => 'aktif',
                'jenis_kelamin' => ['L', 'P'][rand(0, 1)],
                'agama' => $agamaList[array_rand($agamaList)],
                'pendidikan_terakhir' => $pendidikanList[array_rand($pendidikanList)],
                'pengalaman_kerja' => 'Pengalaman kerja ' . $i . ' tahun di perusahaan XYZ.',
                'keterampilan' => 'Microsoft Office, Public Speaking, Leadership',
                'status_pernikahan' => $statusPernikahanList[array_rand($statusPernikahanList)],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
