<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\Karyawan;
use App\Models\PengajuanTukarShift;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $hariIni = Carbon::today();

        $jadwalHariIni = Jadwal::with([
            'shift',
            'leader.karyawan',
            'operator.karyawan'
        ])
        ->whereDate('tanggal_kerja', $hariIni)
        ->get();

        $totalKaryawan = Karyawan::count();

        $totalLeader = Karyawan::whereHas('user', function ($query) {
            $query->where('role', 'leader');
        })->count();

        $totalOperator = Karyawan::whereHas('user', function ($query) {
            $query->where('role', 'operator');
        })->count();

        $totalHadirHariIni = Absensi::whereDate('created_at', $hariIni)
            ->whereIn('status', ['hadir', 'terlambat'])
            ->count();

        $pendingPengajuan = PengajuanTukarShift::where('status', 'pending')
            ->count();

        return view('management.dashboard.index', compact(
            'jadwalHariIni',
            'totalKaryawan',
            'totalLeader',
            'totalOperator',
            'totalHadirHariIni',
            'pendingPengajuan'
        ));
    }
}