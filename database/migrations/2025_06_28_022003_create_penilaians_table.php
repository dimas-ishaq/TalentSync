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
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id')->constrained('karyawans', 'id')->onDelete('cascade');
            $table->date('periode');
            $table->tinyInteger('disiplin')->comment('1-10');
            $table->tinyInteger('kerja_sama')->comment('1-10');
            $table->tinyInteger('tanggung_jawab')->comment('1-10');
            $table->tinyInteger('inisiatif')->comment('1-10');
            $table->tinyInteger('etika_kerja')->comment('1-10');
            $table->tinyInteger('target_kerja')->comment('1-10');
            $table->text('catatan')->nullable();
            $table->decimal('rata_rata', 4, 2);
            $table->enum('status', ['draft', 'selesai']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaians');
    }
};
