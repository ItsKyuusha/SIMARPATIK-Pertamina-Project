<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\ShiftSwap;
use Illuminate\Http\Request;

class ShiftSwapController extends Controller
{
    public function index()
    {
        $swaps = ShiftSwap::with(['requester', 'target', 'schedule'])
            ->latest()
            ->get();

        return view('management.swaps.index', compact('swaps'));
    }

    public function approve($id)
    {
        $swap = ShiftSwap::findOrFail($id);

        $swap->update([
            'status' => 'approved_management',
            'approved_by_management' => auth()->id()
        ]);

        return back()->with('success', 'Disetujui');
    }

    public function reject($id)
    {
        $swap = ShiftSwap::findOrFail($id);

        $swap->update([
            'status' => 'rejected'
        ]);

        return back()->with('success', 'Ditolak');
    }
}