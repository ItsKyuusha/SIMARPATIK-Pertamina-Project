@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between mb-4">
        <h1 class="text-xl font-bold">Data Karyawan</h1>
        <a href="{{ route('employees.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
            + Tambah
        </a>
    </div>

    <table class="w-full bg-white rounded shadow">
        <thead>
            <tr class="bg-gray-100 text-left">
                <th class="p-3">Nama</th>
                <th>NIK</th>
                <th>Leader</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $emp)
            <tr class="border-t">
                <td class="p-3">{{ $emp->nama }}</td>
                <td>{{ $emp->nik }}</td>
                <td>{{ $emp->leader->nama ?? '-' }}</td>
                <td class="flex gap-2">
                    <a href="{{ route('employees.edit',$emp) }}" class="text-blue-500">Edit</a>

                    <form action="{{ route('employees.destroy',$emp) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="text-red-500">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection