<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;
    protected $table = 'penilaians';

    protected $fillable = [
        'karyawan_id',
        'disiplin',
        'kerja_sama',
        'tanggung_jawab',
        'inisiatif',
        'etika_kerja',
        'target_kerja',
        'periode',
        'catatan',
        'rata-rata',
        'status'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
