<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['user', 'leader'])->get();
        return view('management.employees.index', compact('employees'));
    }

    public function create()
    {
        $users = User::doesntHave('employee')->get();
        $leaders = Employee::all();

        return view('management.employees.create', compact('users', 'leaders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'nama' => 'required',
            'nik' => 'required|unique:employees',
        ]);

        Employee::create($request->all());

        return redirect()->route('employees.index')->with('success', 'Berhasil tambah karyawan');
    }

    public function edit(Employee $employee)
    {
        $leaders = Employee::where('id', '!=', $employee->id)->get();

        return view('management.employees.edit', compact('employee', 'leaders'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'nama' => 'required',
            'nik' => 'required|unique:employees,nik,' . $employee->id,
        ]);

        $employee->update($request->all());

        return redirect()->route('employees.index')->with('success', 'Update berhasil');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return back()->with('success', 'Hapus berhasil');
    }
}
