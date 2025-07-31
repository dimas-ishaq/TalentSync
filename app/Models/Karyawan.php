<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $table = 'karyawans';

    protected $fillable = [
        'nama',
        'email',
        'no_telepon',
        'jabatan_id',
        'department_id',
        'tanggal_masuk',
        'alamat',
        'foto',
        'status',
        'jenis_kelamin',
        'agama',
        'pendidikan_terakhir',
        'pengalaman_kerja',
        'keterampilan',
        'status_pernikahan'
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }
    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function penggajians()
    {
        return $this->hasMany(Penggajian::class);
    }
    public function penilaians()
    {
        return $this->hasMany(Penilaian::class);
    }
    public function absensis()
    {
        return $this->hasMany(Absensi::class);
    }
    public function pengajuans()
    {
        return $this->hasMany(Pengajuan::class);
    }
}
