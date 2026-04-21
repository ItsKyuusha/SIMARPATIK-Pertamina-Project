<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $employee = auth()->user()->employee;
        $today = Carbon::today();

        // 🔥 Jadwal hari ini
        $todaySchedule = Schedule::with('shift')
            ->where('employee_id', $employee->id)
            ->whereDate('tanggal', $today)
            ->first();

        // 🔥 Total shift bulan ini
        $totalShift = Schedule::where('employee_id', $employee->id)
            ->whereMonth('tanggal', now()->month)
            ->count();

        return view('operator.dashboard', compact(
            'todaySchedule',
            'totalShift'
        ));
    }
}
