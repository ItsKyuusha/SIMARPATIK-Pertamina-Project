<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShiftSwap;
use App\Models\Employee;
use App\Models\Schedule;

class ShiftSwapController extends Controller
{
    public function index()
    {
        $leader = auth()->user()->employee;

        // 🔥 Ambil swap dari timnya
        $swaps = ShiftSwap::with(['requester', 'target', 'schedule'])
            ->whereHas('requester', function ($q) use ($leader) {
                $q->where('leader_id', $leader->id);
            })
            ->latest()
            ->get();

        return view('leader.swaps.index', compact('swaps'));
    }

    public function approve($id)
    {
        $swap = ShiftSwap::findOrFail($id);

        $swap->update([
            'status' => 'approved_leader',
            'approved_by_leader' => auth()->id()
        ]);

        return back()->with('success', 'Disetujui oleh Leader');
    }

    public function reject($id)
    {
        $swap = ShiftSwap::findOrFail($id);

        $swap->update([
            'status' => 'rejected'
        ]);

        return back()->with('success', 'Ditolak');
    }

    public function createLeaderSwap()
    {
        $leaders = Employee::whereNull('leader_id')->get();

        return view('leader.swaps.create', compact('leaders'));
    }

    public function storeLeaderSwap(Request $request)
    {
        $request->validate([
            'target_id' => 'required',
            'schedule_id' => 'required'
        ]);

        ShiftSwap::create([
            'requester_id' => auth()->user()->employee->id,
            'target_id' => $request->target_id,
            'schedule_id' => $request->schedule_id,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Pengajuan swap leader berhasil');
}
}