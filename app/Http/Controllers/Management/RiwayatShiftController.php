<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\RiwayatShift;
use App\Models\Absensi;

class RiwayatShiftController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | 1. RIWAYAT TUKAR SHIFT (LAMA - TETAP DIPAKAI)
        |--------------------------------------------------------------------------
        */

        $riwayatTukarShift = RiwayatShift::with([
            'karyawan',
            'jadwalLama.shift',
            'jadwalBaru.shift',
            'pengubah'
        ])
        ->latest('created_at')
        ->paginate(10, ['*'], 'tukar_page');

        /*
        |--------------------------------------------------------------------------
        | 2. RIWAYAT KEHADIRAN (BARU - DARI ABSENSI)
        |--------------------------------------------------------------------------
        */

        $riwayatAbsensi = Absensi::with([
            'anggotaJadwal.karyawan',
            'anggotaJadwal.jadwal.shift'
        ])
        ->latest()
        ->paginate(10, ['*'], 'absensi_page');

        return view('management.riwayat-shift.index', compact(
            'riwayatTukarShift',
            'riwayatAbsensi'
        ));
    }
}