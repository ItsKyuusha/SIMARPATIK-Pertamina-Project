<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\Models\AnggotaJadwal;
use App\Models\PengajuanTukarShift;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TukarShiftLeaderController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $pengajuan = PengajuanTukarShift::with([
            'pengaju.karyawan',
            'tujuan.karyawan',
            'pengaju.jadwal.shift',
            'tujuan.jadwal.shift',
        ])
        ->whereHas('pengaju.karyawan', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->latest()
        ->paginate(10);

        return view('leader.tukar-shift.index', compact('pengajuan'));
    }

    public function create()
    {
        $user = Auth::user();

        $leaderAktif = AnggotaJadwal::with([
            'karyawan',
            'jadwal.shift'
        ])
        ->where('tipe_role', 'leader')
        ->whereHas('karyawan', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->whereHas('jadwal', function ($query) {
            $query->whereDate('tanggal_kerja', '>=', Carbon::today());
        })
        ->get();

        $leaderTujuan = AnggotaJadwal::with([
            'karyawan',
            'jadwal.shift'
        ])
        ->where('tipe_role', 'leader')
        ->whereHas('jadwal', function ($query) {
            $query->whereDate('tanggal_kerja', '>=', Carbon::today());
        })
        ->get();

        return view('leader.tukar-shift.create', compact(
            'leaderAktif',
            'leaderTujuan'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_pengaju_id' => 'required|exists:anggota_jadwal,id',
            'anggota_tujuan_id' => 'required|exists:anggota_jadwal,id',
            'alasan' => 'required|string',
        ]);

        PengajuanTukarShift::create([
            'anggota_pengaju_id' => $request->anggota_pengaju_id,
            'anggota_tujuan_id' => $request->anggota_tujuan_id,
            'tipe_pengajuan' => 'tukar_leader',
            'alasan' => $request->alasan,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('leader.tukar-shift.index')
            ->with('success', 'Pengajuan tukar shift berhasil dibuat');
    }
}