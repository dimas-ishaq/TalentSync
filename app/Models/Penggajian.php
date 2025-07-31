<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggajian extends Model
{
    use HasFactory;
    protected $table = 'penggajians';
    protected $fillable = [
        'karyawan_id',
        'gaji_pokok',
        'tunjangan_tetap',
        'tunjangan_tidak_tetap',
        'pot_bpjs_kesehatan',
        'pot_bpjs_ketenagakerjaan',
        'pot_pph21',
        'pot_pinjaman',
        'pot_denda',
        'total_pendapatan',
        'total_potongan',
        'gaji_bersih',
        'periode_mulai',
        'periode_selesai',
        'tanggal_pembayaran',
        'status_pembayaran'
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class);
    }
}
