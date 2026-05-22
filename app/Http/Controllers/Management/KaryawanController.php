<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\Kontrak;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::with([
            'user',
            'kontrak'
        ])
        ->latest()
        ->paginate(10);

        return view('management.karyawan.index', compact('karyawan'));
    }

    public function create()
    {
        $kontrak = Kontrak::all();

        return view('management.karyawan.create', compact('kontrak'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'role' => 'required|in:management,leader,operator',
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'kontrak_id' => 'required|exists:kontrak,id',
            'kode_karyawan' => 'required|unique:karyawan,kode_karyawan',
            'nip' => 'required|unique:karyawan,nip',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'jabatan' => 'required',
            'tanggal_masuk' => 'required|date',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'role' => $request->role,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            Karyawan::create([
                'user_id' => $user->id,
                'kontrak_id' => $request->kontrak_id,
                'kode_karyawan' => $request->kode_karyawan,
                'nip' => $request->nip,
                'nama_lengkap' => $request->nama_lengkap,
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
                'jabatan' => $request->jabatan,
                'tanggal_masuk' => $request->tanggal_masuk,
            ]);
        });

        return redirect()
            ->route('management.karyawan.index')
            ->with('success', 'Data karyawan berhasil ditambahkan');
    }

    public function edit(Karyawan $karyawan)
    {
        $karyawan->load(['user', 'kontrak']);

        $kontrak = Kontrak::all();

        return view('management.karyawan.edit', compact(
            'karyawan',
            'kontrak'
        ));
    }

    public function update(Request $request, Karyawan $karyawan)
    {
        $request->validate([
            'role' => 'required|in:management,leader,operator',
            'username' => 'required|unique:users,username,' . $karyawan->user_id,
            'email' => 'required|email|unique:users,email,' . $karyawan->user_id,
            'kontrak_id' => 'required|exists:kontrak,id',
            'kode_karyawan' => 'required|unique:karyawan,kode_karyawan,' . $karyawan->id,
            'nip' => 'required|unique:karyawan,nip,' . $karyawan->id,
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required|in:L,P',
            'jabatan' => 'required',
            'tanggal_masuk' => 'required|date',
        ]);

        DB::transaction(function () use ($request, $karyawan) {
            $karyawan->user->update([
                'role' => $request->role,
                'username' => $request->username,
                'email' => $request->email,
            ]);

            if ($request->filled('password')) {
                $karyawan->user->update([
                    'password' => Hash::make($request->password)
                ]);
            }

            $karyawan->update([
                'kontrak_id' => $request->kontrak_id,
                'kode_karyawan' => $request->kode_karyawan,
                'nip' => $request->nip,
                'nama_lengkap' => $request->nama_lengkap,
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
                'jabatan' => $request->jabatan,
                'tanggal_masuk' => $request->tanggal_masuk,
            ]);
        });

        return redirect()
            ->route('management.karyawan.index')
            ->with('success', 'Data karyawan berhasil diperbarui');
    }

    public function destroy(Karyawan $karyawan)
    {
        $karyawan->user()->delete();

        return redirect()
            ->route('management.karyawan.index')
            ->with('success', 'Data karyawan berhasil dihapus');
    }
}