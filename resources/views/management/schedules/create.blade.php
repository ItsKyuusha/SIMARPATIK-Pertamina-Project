@extends('layouts.app')

@section('content')
<div class="p-6 max-w-lg">
    <h1 class="text-xl font-bold mb-4">Tambah Jadwal</h1>

    <form method="POST" action="{{ route('schedules.store') }}" class="space-y-4">
        @csrf

        <!-- Operator -->
        <select name="employee_id" class="w-full border p-2 rounded">
            @foreach($employees as $emp)
                <option value="{{ $emp->id }}">{{ $emp->nama }}</option>
            @endforeach
        </select>

        <!-- Leader -->
        <select name="leader_id" class="w-full border p-2 rounded">
            <option value="">-- Pilih Leader --</option>
            @foreach($leaders as $leader)
                <option value="{{ $leader->id }}">{{ $leader->nama }}</option>
            @endforeach
        </select>

        <!-- Shift -->
        <select name="shift_id" class="w-full border p-2 rounded">
            @foreach($shifts as $shift)
                <option value="{{ $shift->id }}">{{ $shift->kode_shift }}</option>
            @endforeach
        </select>

        <!-- Tanggal -->
        <input type="date" name="tanggal" class="w-full border p-2 rounded">

        <button class="bg-blue-500 text-white px-4 py-2 rounded">
            Simpan
        </button>
    </form>
</div>
@endsection