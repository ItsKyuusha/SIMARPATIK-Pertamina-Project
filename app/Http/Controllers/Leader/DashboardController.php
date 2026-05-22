<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Jadwal;
use App\Models\PengajuanTukarShift;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $hariIni = Carbon::today();

        $user = Auth::user();

        $jadwalHariIni = Jadwal::with([
            'shift',
            'leader.karyawan',
            'operator.karyawan'
        ])
        ->whereDate('tanggal_kerja', $hariIni)
        ->whereHas('anggotaJadwal.karyawan', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->get();

        $totalOperatorHadir = Absensi::whereDate('created_at', $hariIni)
            ->whereIn('status', ['hadir', 'terlambat'])
            ->whereHas('anggotaJadwal', function ($query) {
                $query->where('tipe_role', 'operator');
            })
            ->count();

            $pendingApprovalOperator = PengajuanTukarShift::where(
            'tipe_pengajuan',
            'tukar_operator'
        )
        ->where('status', 'pending')
        ->count();

        return view('leader.dashboard.index', compact(
            'jadwalHariIni',
            'totalOperatorHadir',
            'pendingApprovalOperator'
        ));
    }
}