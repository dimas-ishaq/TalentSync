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
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('no_telepon', 20)->nullable();
            $table->foreignId('jabatan_id')->constrained('jabatans')->onDelete('cascade');
            $table->foreignId('department_id')->constrained('departments')->onDelete('cascade');
            $table->date('tanggal_masuk')->nullable();
            $table->text('alamat')->nullable();
            $table->string('foto')->nullable();
            $table->string('status')->default('aktif');
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->enum('agama', ['Islam', 'Kristen', 'Hindu', 'Budha', 'Konghucu'])->nullable();
            $table->enum('pendidikan_terakhir', ['SD', 'SMP', 'SMA/SMK', 'D1', 'D2', 'D3', 'S1', 'S2'])->nullable();
            $table->text('pengalaman_kerja')->nullable();
            $table->text('keterampilan')->nullable();
            $table->enum('status_pernikahan', [
                'Belum Menikah',
                'Menikah',
                'Cerai Hidup',
                'Cerai Mati',
            ])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawans');
    }
};
