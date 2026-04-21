@extends('layouts.app')

@section('title', 'Ajukan Tukar Shift')

@section('content')
<div class="max-w-lg">

    <h1 class="text-xl font-bold mb-4">Ajukan Tukar Shift</h1>

    <form method="POST" action="/operator/swap/store" class="space-y-4">
        @csrf

        <!-- Pilih Jadwal -->
        <div>
            <label class="block text-sm mb-1">Jadwal Saya</label>
            <select name="schedule_id" class="w-full border p-2 rounded">
                @foreach($schedules as $s)
                    <option value="{{ $s->id }}">
                        {{ $s->tanggal }} - {{ $s->shift->kode_shift }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Target Operator -->
        <div>
            <label class="block text-sm mb-1">Tukar Dengan</label>
            <select name="target_id" class="w-full border p-2 rounded">
                @foreach($operators as $op)
                    <option value="{{ $op->id }}">
                        {{ $op->nama }}
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