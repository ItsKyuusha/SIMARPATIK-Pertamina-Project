@extends('layouts.app')

@section('title', 'Dashboard Operator')

@section('content')
<div class="space-y-6">

    <!-- Statistik -->
    <div class="grid grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-xl shadow border">
            <h2 class="text-gray-500 text-sm">Shift Hari Ini</h2>

            @if($todaySchedule)
                <p class="text-xl font-bold">
                    {{ $todaySchedule->shift->kode_shift }}
                </p>
                <p class="text-sm text-gray-500">
                    {{ $todaySchedule->shift->jam_masuk }} - {{ $todaySchedule->shift->jam_keluar }}
                </p>
            @else
                <p class="text-gray-400">Libur / Tidak ada shift</p>
            @endif
        </div>

        <div class="bg-white p-6 rounded-xl shadow border">
            <h2 class="text-gray-500 text-sm">Total Shift Bulan Ini</h2>
            <p class="text-3xl font-bold">{{ $totalShift }}</p>
        </div>
    </div>

</div>
@endsection