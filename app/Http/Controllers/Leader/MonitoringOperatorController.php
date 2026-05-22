<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Carbon\Carbon;

class MonitoringOperatorController extends Controller
{
    public function index()
    {
        $hariIni = Carbon::today();

        $absensi = Absensi::with([
            'anggotaJadwal.karyawan',
            'anggotaJadwal.jadwal.shift'
        ])
        ->whereDate('created_at', $hariIni)
        ->whereHas('anggotaJadwal', function ($query) {
            $query->where('tipe_role', 'operator');
        })
        ->latest()
        ->paginate(20);
        
        return view('leader.monitoring-operator.index', compact('absensi'));
    }
}