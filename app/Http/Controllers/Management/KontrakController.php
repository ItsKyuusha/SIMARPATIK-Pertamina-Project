<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Kontrak;
use Illuminate\Http\Request;

class KontrakController extends Controller
{
    public function index()
    {
        $kontrak = Kontrak::latest()->paginate(10);

        return view('management.kontrak.index', compact('kontrak'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kontrak' => 'required',
        ]);

        Kontrak::create($request->all());

        return back()->with('success', 'Kontrak berhasil ditambahkan');
    }

    public function update(Request $request, Kontrak $kontrak)
    {
        $request->validate([
            'nama_kontrak' => 'required',
        ]);

        $kontrak->update($request->all());

        return back()->with('success', 'Kontrak berhasil diperbarui');
    }

    public function destroy(Kontrak $kontrak)
    {
        $kontrak->delete();

        return back()->with('success', 'Kontrak berhasil dihapus');
    }
}