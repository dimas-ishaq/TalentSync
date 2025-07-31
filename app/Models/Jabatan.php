<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    protected $table = 'jabatans';
    protected $fillable = [
        'nama',
        'deskripsi',
        'gaji_pokok'
    ];

    public function karyawans()
    {
        return $this->hasMany(Karyawan::class);
    }
}
