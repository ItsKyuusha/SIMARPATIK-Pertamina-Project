<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\AnggotaJadwal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $jadwalHariIni = AnggotaJadwal::with([
            'jadwal.shift'
        ])
        ->where('tipe_role', 'operator')
        ->whereHas('karyawan', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->whereHas('jadwal', function ($query) {
            $query->whereDate('tanggal_kerja', Carbon::today());
        })
        ->get();

        $riwayatAbsensi = Absensi::with([
            'anggotaJadwal.jadwal.shift'
        ])
        ->whereHas('anggotaJadwal.karyawan', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->latest()
        ->paginate(10);

        return view('operator.absensi.index', compact(
            'jadwalHariIni',
            'riwayatAbsensi'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_jadwal_id' => 'required|exists:anggota_jadwal,id',
        ]);

        $sudahAbsensi = Absensi::where('anggota_jadwal_id', $request->anggota_jadwal_id)
            ->whereDate('created_at', Carbon::today())
            ->exists();

        if ($sudahAbsensi) {
            return back()->with('error', 'Anda sudah melakukan absensi hari ini');
        }

        $anggotaJadwal = AnggotaJadwal::with('jadwal.shift')
            ->findOrFail($request->anggota_jadwal_id);

        $jamMasukShift = Carbon::parse(
            $anggotaJadwal->jadwal->shift->jam_masuk
        );

        $jamSekarang = Carbon::now();

        $status = $jamSekarang->greaterThan($jamMasukShift)
            ? 'terlambat'
            : 'hadir';

        Absensi::create([
            'anggota_jadwal_id' => $request->anggota_jadwal_id,
            'jam_masuk' => now(),
            'status' => $status,
        ]);

        $anggotaJadwal->update([
            'status_kehadiran' => $status
        ]);

        return back()->with('success', 'Absensi berhasil dilakukan');
    }
    
    public function checkout(Absensi $absensi)
    {
        $absensi->update([
            'jam_keluar' => now(),
        ]);

        return back()->with('success', 'Checkout berhasil');
    }
}