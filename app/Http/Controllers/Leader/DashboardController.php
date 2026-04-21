<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Schedule;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $leader = $user->employee;

        $today = Carbon::today();

        // 🔥 Ambil tim (operator di bawah leader)
        $teamIds = Employee::where('leader_id', $leader->id)->pluck('id');

        // 🔥 Jadwal hari ini
        $todaySchedules = Schedule::with(['employee', 'shift'])
            ->whereIn('employee_id', $teamIds)
            ->whereDate('tanggal', $today)
            ->get();

        $totalTeam = $teamIds->count();

        return view('leader.dashboard', compact(
            'todaySchedules',
            'totalTeam'
        ));
    }
}
