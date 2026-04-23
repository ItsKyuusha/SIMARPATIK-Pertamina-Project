<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;

use App\Models\Contract;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        $employees = Employee::with(['user', 'jenisKontrak', 'schedules' => function ($q) use ($today) {
            $q->whereDate('tanggal', $today)->with('leader');
        }])->get();

        return view('management.employees.index', compact('employees'));
    }

    public function create()
    {
        $users = User::all();
        $contracts = Contract::all();

        return view('management.employees.create', compact('users', 'contracts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            // USER
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',

            // EMPLOYEE
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:50|unique:employees,nip',
            'gender' => 'nullable|in:L,P',
            'alamat' => 'nullable|string',
            'notelp' => 'nullable|string|max:20',

            'jabatan' => 'required|in:management,leader,operator',
            'jenis_kontrak_id' => 'nullable|exists:contracts,id',
        ]);

        DB::beginTransaction();

        try {
            // 1. Insert ke tabel users
            $user = User::create([
                'username' => $request->username,
                'email' => $request->email,
                'role' => $request->jabatan, // sinkron dengan jabatan
                'password' => Hash::make($request->password),
            ]);

            // 2. Insert ke tabel employees
            Employee::create([
                'user_id' => $user->id,
                'nama' => $request->nama,
                'nip' => $request->nip,
                'gender' => $request->gender,
                'alamat' => $request->alamat,
                'notelp' => $request->notelp,
                'jabatan' => $request->jabatan,
                'jenis_kontrak_id' => $request->jenis_kontrak_id,
            ]);

            DB::commit();

            return redirect()->route('employees.index')->with('success', 'Berhasil tambah karyawan & akun user');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal tambah data: ' . $e->getMessage());
        }
    }

    public function edit(Employee $employee)
    {
        $contracts = Contract::all();

        return view('management.employees.edit', compact('employee', 'contracts'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'nama' => 'required',
            'nip' => 'required|unique:employees,nip,' . $employee->id,
        ]);

        $employee->update($request->only([
            'nama',
            'nip',
            'gender',
            'alamat',
            'notelp',
            'jabatan',
            'jenis_kontrak_id'
        ]));

        return redirect()->route('employees.index')->with('success', 'Update berhasil');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return back()->with('success', 'Hapus berhasil');
    }
}
