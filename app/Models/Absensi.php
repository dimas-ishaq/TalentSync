<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $table = 'absensis';
    protected $fillable = [
        'karyawan_id',
        'tanggal',
        'jam_masuk',
        'jam_keluar',
        'foto_masuk',
        'foto_keluar',
        'latitude_masuk',
        'latitude_keluar',
        'longitude_masuk',
        'longitude_keluar',
        'lokasi',
        'status',
        'catatan'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
