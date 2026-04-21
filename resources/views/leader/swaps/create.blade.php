@extends('layouts.app')

@section('title', 'Tukar Shift Antar Leader')

@section('content')
<div class="max-w-lg">

    <h1 class="text-xl font-bold mb-4">Ajukan Tukar Shift</h1>

    <form method="POST" action="/leader/swap/store" class="space-y-4">
        @csrf

        <!-- Target Leader -->
        <div>
            <label class="block text-sm mb-1">Pilih Leader Tujuan</label>
            <select name="target_id" class="w-full border p-2 rounded">
                @foreach($leaders as $leader)
                    <option value="{{ $leader->id }}">{{ $leader->nama }}</option>
                @endforeach
            </select>
        </div>

        <!-- Schedule -->
        <div>
            <label class="block text-sm mb-1">Pilih Jadwal</label>
            <select name="schedule_id" class="w-full border p-2 rounded">
                @foreach(auth()->user()->employee->schedules as $schedule)
                    <option value="{{ $schedule->id }}">
                        {{ $schedule->tanggal }} - {{ $schedule->shift->kode_shift }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="bg-blue-500 text-white px-4 py-2 rounded">
            Ajukan
        </button>
    </form>

</div>
@endsection