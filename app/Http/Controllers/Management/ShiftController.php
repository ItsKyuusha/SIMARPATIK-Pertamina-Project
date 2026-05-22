<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function index()
    {
        $shift = Shift::latest()->paginate(10);

        return view('management.shift.index', compact('shift'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_shift' => 'required|unique:shift,kode_shift',
            'nama_shift' => 'required',
            'jam_masuk' => 'required',
            'jam_keluar' => 'required',
        ]);

        Shift::create($request->all());

        return back()->with('success', 'Shift berhasil ditambahkan');
    }

    public function update(Request $request, Shift $shift)
    {
        $request->validate([
            'kode_shift' => 'required|unique:shift,kode_shift,' . $shift->id,
            'nama_shift' => 'required',
            'jam_masuk' => 'required',
            'jam_keluar' => 'required',
        ]);

        $shift->update($request->all());

        return back()->with('success', 'Shift berhasil diperbarui');
    }

    public function destroy(Shift $shift)
    {
        $shift->delete();

        return back()->with('success', 'Shift berhasil dihapus');
    }
}
