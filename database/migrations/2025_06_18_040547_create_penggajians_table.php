<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penggajians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id')->constrained('karyawans', 'id')->onDelete('cascade');

            // Komponen Gaji
            $table->decimal('gaji_pokok', 15, 2);
            $table->decimal('tunjangan_tetap', 15, 2)->default(0);
            $table->decimal('tunjangan_tidak_tetap', 15, 2)->default(0);

            // Potongan
            $table->decimal('pot_bpjs_kesehatan', 15, 2)->default(0);
            $table->decimal('pot_bpjs_ketenagakerjaan', 15, 2)->default(0);
            $table->decimal('pot_pph21', 15, 2)->default(0);
            $table->decimal('pot_pinjaman', 15, 2)->default(0);
            $table->decimal('pot_denda', 15, 2)->default(0);

            // Total dan Take Home Pay
            $table->decimal('total_pendapatan', 15, 2);
            $table->decimal('total_potongan', 15, 2);
            $table->decimal('gaji_bersih', 15, 2);

            // Periode Gaji
            $table->date('periode_mulai');
            $table->date('periode_selesai');

            // Tanggal Gaji dikirimkan 
            $table->date('tanggal_pembayaran')->nullable();
            $table->enum('status_pembayaran', ['pending', 'dibayar'])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggajians');
    }
};
