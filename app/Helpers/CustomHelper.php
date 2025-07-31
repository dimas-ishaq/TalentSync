<?php
use Carbon\Carbon;

if (!function_exists('convertHari')){
    function convertHari($tanggal){
        $hariInggris = Carbon::parse($tanggal)->format('l');
        $hariIndonesia = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
        ];
        return $hariIndonesia[$hariInggris] ?? $hariInggris;
    }
}

if(!function_exists('durasiKerja')){
    function durasiKerja($jam_masuk, $jam_keluar){
        if(empty($jam_keluar)){
            $jam_keluar = Carbon::parse("16:00:00");
        }
        $mulai_kerja = Carbon::parse($jam_masuk);
        $pulang_kerja = Carbon::parse($jam_keluar);

        $total_menit = $mulai_kerja->diffInMinutes($pulang_kerja);

        $jam = floor($total_menit/60);
        $menit = $total_menit % 60;

        return "{$jam} jam {$menit} menit";
    }
}

if(!function_exists('getNamaBulan')){
    function getNamaBulan($angkaBulan){
        return Carbon::create()->month($angkaBulan)->translatedFormat('F');
    }
}

?>