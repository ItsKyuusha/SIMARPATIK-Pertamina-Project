<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShiftSwap;

class ShiftSwapController extends Controller
{
    public function index()
    {
        $employee = auth()->user()->employee;

        $swaps = ShiftSwap::with(['target', 'schedule'])
            ->where('requester_id', $employee->id)
            ->latest()
            ->get();

        return view('operator.swap.index', compact('swaps'));
    }

    public function create()
    {
        $employee = auth()->user()->employee;

        $schedules = $employee->schedules()->with('shift')->get();

        $operators = \App\Models\Employee::where('leader_id', $employee->leader_id)
            ->where('id', '!=', $employee->id)
            ->get();

        return view('operator.swap.create', compact('schedules', 'operators'));
    }

    public function store(Request $request)
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

        return redirect()->route('operator.swap.index')
            ->with('success', 'Pengajuan berhasil');
    }
}
