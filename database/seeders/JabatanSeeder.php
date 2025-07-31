<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jabatans')->insert([
            [
                'nama' => 'Manager IT',
                'deskripsi' => 'Bertanggung jawab atas infrastruktur dan pengembangan sistem TI',
                'gaji_pokok' => 18000000, // Example: Higher salary for Manager
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Staff IT Support',
                'deskripsi' => 'Memberikan dukungan teknis harian kepada karyawan',
                'gaji_pokok' => 5300000, // Example: Starting point salary
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'HR Manager',
                'deskripsi' => 'Mengelola proses rekrutmen dan pengembangan SDM',
                'gaji_pokok' => 17000000, // Example: Manager level salary
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Finance Officer',
                'deskripsi' => 'Mengelola laporan keuangan dan pengeluaran perusahaan',
                'gaji_pokok' => 7500000, // Example: Mid-level staff salary
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Marketing Executive',
                'deskripsi' => 'Menjalankan strategi pemasaran produk atau jasa perusahaan',
                'gaji_pokok' => 8000000, // Example: Mid-level staff salary
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Logistik Staff',
                'deskripsi' => 'Bertanggung jawab atas pengiriman dan pergudangan barang',
                'gaji_pokok' => 6000000, // Example: Entry-level staff salary
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
