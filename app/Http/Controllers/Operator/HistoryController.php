<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\ShiftHistory;

class HistoryController extends Controller
{
    public function index()
    {
        $employee = auth()->user()->employee;

        $histories = ShiftHistory::with('shift')
            ->where('employee_id', $employee->id)
            ->latest()
            ->get();

        return view('operator.history.index', compact('histories'));
    }
}
