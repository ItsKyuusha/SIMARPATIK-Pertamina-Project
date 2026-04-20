<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\ShiftHistory;

class ShiftHistoryController extends Controller
{
    public function index()
    {
        $histories = ShiftHistory::with(['employee', 'shift'])->latest()->get();

        return view('management.histories.index', compact('histories'));
    }
}