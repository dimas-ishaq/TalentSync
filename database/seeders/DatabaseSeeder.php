<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            DepartmentSeeder::class,
            JabatanSeeder::class,
            KaryawanSeeder::class,
            UserSeeder::class,
            AbsensiSeeder::class,
            CutiSeeder::class,
        ]);

        // Uncomment the line below to seed the Karyawan model
        // \App\Models\Karyawan::factory(10)->create();
    }
}
