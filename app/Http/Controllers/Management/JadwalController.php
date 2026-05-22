<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\AnggotaJadwal;
use App\Models\Jadwal;
use App\Models\Karyawan;
use App\Models\Shift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::with([
            'shift',
            'leader.karyawan',
            'operator.karyawan'
        ])
        ->latest()
        ->paginate(10);

        return view('management.jadwal.index', compact('jadwal'));
    }

    public function create()
    {
        $shift = Shift::all();

        $leader = Karyawan::whereHas('user', function ($query) {
            $query->where('role', 'leader');
        })->get();

        $operator = Karyawan::whereHas('user', function ($query) {
            $query->where('role', 'operator');
        })->get();

        return view('management.jadwal.create', compact(
            'shift',
            'leader',
            'operator'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shift_id' => 'required|exists:shift,id',
            'tanggal_kerja' => 'required|date',
            'leader' => 'required|array|min:1',
            'operator' => 'required|array|min:1',
        ]);

        DB::transaction(function () use ($request) {
            $jadwal = Jadwal::create([
                'shift_id' => $request->shift_id,
                'tanggal_kerja' => $request->tanggal_kerja,
                'catatan' => $request->catatan,
                'dibuat_oleh' => Auth::id(),
            ]);

            foreach ($request->leader as $leaderId) {
                AnggotaJadwal::create([
                    'jadwal_id' => $jadwal->id,
                    'karyawan_id' => $leaderId,
                    'tipe_role' => 'leader',
                ]);
            }

            foreach ($request->operator as $operatorId) {
                AnggotaJadwal::create([
                    'jadwal_id' => $jadwal->id,
                    'karyawan_id' => $operatorId,
                    'tipe_role' => 'operator',
                ]);
            }
        });

        return redirect()
            ->route('management.jadwal.index')
            ->with('success', 'Jadwal berhasil dibuat');
    }

    public function show(Jadwal $jadwal)
    {
        $jadwal->load([
            'shift',
            'leader.karyawan',
            'operator.karyawan'
        ]);

        return view('management.jadwal.show', compact('jadwal'));
    }

    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();

        return back()->with('success', 'Jadwal berhasil dihapus');
    }
}