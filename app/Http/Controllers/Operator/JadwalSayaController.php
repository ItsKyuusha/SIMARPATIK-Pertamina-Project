<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\AnggotaJadwal;
use Illuminate\Support\Facades\Auth;

class JadwalSayaController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $jadwal = AnggotaJadwal::with([
            'jadwal.shift',
            'jadwal.leader.karyawan'
        ])
        ->where('tipe_role', 'operator')
        ->whereHas('karyawan', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->latest()
        ->paginate(15);

        return view('operator.jadwal-saya.index', compact('jadwal'));
    }
}