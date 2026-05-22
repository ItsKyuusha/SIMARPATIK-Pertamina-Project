<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\AnggotaJadwal;
use App\Models\PengajuanTukarShift;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $hariIni = Carbon::today();

        $user = Auth::user();

        $jadwalHariIni = AnggotaJadwal::with([
            'jadwal.shift',
            'jadwal.leader.karyawan'
        ])
        ->where('tipe_role', 'operator')
        ->whereHas('karyawan', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->whereHas('jadwal', function ($query) use ($hariIni) {
            $query->whereDate('tanggal_kerja', $hariIni);
        })
        ->get();

        $totalAbsensi = Absensi::whereHas('anggotaJadwal.karyawan', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->count();

        $pendingPengajuan = PengajuanTukarShift::whereHas('pengaju.karyawan', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->where('status', 'pending')
        ->count();

        return view('operator.dashboard.index', compact(
            'jadwalHariIni',
            'totalAbsensi',
            'pendingPengajuan'
        ));
    }
}