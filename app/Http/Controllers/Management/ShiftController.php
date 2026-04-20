<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function index()
    {
        return view('management.shifts.index', [
            'shifts' => Shift::all()
        ]);
    }

    public function store(Request $request)
    {
        Shift::create($request->all());
        return back();
    }

    public function update(Request $request, Shift $shift)
    {
        $shift->update($request->all());
        return back();
    }

    public function destroy(Shift $shift)
    {
        $shift->delete();
        return back();
    }
}