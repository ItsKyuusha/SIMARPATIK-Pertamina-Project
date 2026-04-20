<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Employee;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $activeShift = Schedule::with(['employee', 'shift'])
            ->whereDate('tanggal', $today)
            ->get();

        $totalOperator = Employee::count();

        return view('management.dashboard', compact(
            'activeShift',
            'totalOperator'
        ));
    }
}
