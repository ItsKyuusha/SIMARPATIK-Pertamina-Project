<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Carbon\Carbon;

class MonitoringKehadiranController extends Controller
{
    public function index()
    {
        $hariIni = Carbon::today();

        $absensi = Absensi::with([
            'anggotaJadwal.karyawan',
            'anggotaJadwal.jadwal.shift'
        ])
        ->whereDate('created_at', $hariIni)
        ->latest()
        ->paginate(20);

        return view('management.monitoring-kehadiran.index', compact('absensi'));
    }
}