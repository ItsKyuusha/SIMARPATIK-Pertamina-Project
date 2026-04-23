<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\Employee;
use App\Models\Shift;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $query = Schedule::with(['employee', 'shift', 'leader']);

        if ($request->tanggal) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $schedules = $query->latest()->get();

        return view('management.schedules.index', compact('schedules'));
    }

    public function create()
    {
        return view('management.schedules.create', [
            'employees' => Employee::all(),
            'shifts' => Shift::all(),
            'leaders' => Employee::where('jabatan', 'leader')->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required',
            'shift_id' => 'required',
            'leader_id' => 'required',
            'tanggal' => 'required|date'
        ]);

        // 🔥 Cegah double jadwal
        $exists = Schedule::where('employee_id', $request->employee_id)
            ->where('tanggal', $request->tanggal)
            ->exists();

        if ($exists) {
            return back()->withErrors('Jadwal sudah ada!');
        }

        Schedule::create([
            'employee_id' => $request->employee_id,
            'shift_id' => $request->shift_id,
            'leader_id' => $request->leader_id,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('schedules.index')->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return back();
    }
}
