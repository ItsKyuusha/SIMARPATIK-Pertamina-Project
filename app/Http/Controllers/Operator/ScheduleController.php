<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $employee = auth()->user()->employee;

        $schedules = Schedule::with('shift')
            ->where('employee_id', $employee->id)
            ->latest()
            ->get();

        return view('operator.schedule.index', compact('schedules'));
    }
}
