<?php

namespace App\Http\Controllers\Leader;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index(Request $request)
    {
        $leader = auth()->user()->employee;

        $date = $request->date ?? Carbon::today()->toDateString();

        // 🔥 Ambil semua anggota tim
        $team = Employee::where('leader_id', $leader->id)->pluck('id');

        // 🔥 Jadwal berdasarkan tanggal
        $schedules = Schedule::with(['employee', 'shift'])
            ->whereIn('employee_id', $team)
            ->whereDate('tanggal', $date)
            ->get();

        return view('leader.team.index', compact('schedules', 'date'));
    }
}
