@extends('layouts.app')

@section('content')
<div class="p-6 max-w-lg">
    <h1 class="text-xl font-bold mb-4">Tambah Jadwal</h1>

    <form method="POST" action="{{ route('schedules.store') }}" class="space-y-4">
        @csrf

        <select name="employee_id" class="w-full border p-2">
            @foreach($employees as $emp)
                <option value="{{ $emp->id }}">{{ $emp->nama }}</option>
            @endforeach
        </select>

        <select name="shift_id" class="w-full border p-2">
            @foreach($shifts as $shift)
                <option value="{{ $shift->id }}">{{ $shift->kode_shift }}</option>
            @endforeach
        </select>

        <input type="date" name="tanggal" class="w-full border p-2">

        <button class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection