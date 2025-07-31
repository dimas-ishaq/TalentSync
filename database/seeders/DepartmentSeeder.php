<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departments')->insert([
            [
                'nama' => 'IT',
                'deskripsi' => 'Departemen Teknologi Informasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'HR',
                'deskripsi' => 'Departemen Sumber Daya Manusia',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Keuangan',
                'deskripsi' => 'Departemen Keuangan dan Akuntansi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Operasional',
                'deskripsi' => 'Departemen Operasional Perusahaan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Marketing',
                'deskripsi' => 'Departemen Pemasaran dan Promosi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Logistik',
                'deskripsi' => 'Departemen Pengelolaan Barang dan Distribusi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
