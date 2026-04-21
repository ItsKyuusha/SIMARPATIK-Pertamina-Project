@extends('layouts.app')

@section('title', 'Dashboard Leader')

@section('content')
<div class="space-y-6">

    <!-- Statistik -->
    <div class="grid grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-xl shadow border">
            <h2 class="text-gray-500 text-sm">Total Tim</h2>
            <p class="text-3xl font-bold">{{ $totalTeam }}</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow border">
            <h2 class="text-gray-500 text-sm">Shift Hari Ini</h2>
            <p class="text-3xl font-bold">{{ $todaySchedules->count() }}</p>
        </div>
    </div>

    <!-- Jadwal Hari Ini -->
    <div class="bg-white p-6 rounded-xl shadow border">
        <h2 class="font-bold mb-4">Jadwal Hari Ini</h2>

        <table class="w-full text-sm">
            <thead>
                <tr class="text-left border-b">
                    <th class="p-2">Nama</th>
                    <th>Shift</th>
                    <th>Jam</th>
                </tr>
            </thead>

            <tbody>
                @forelse($todaySchedules as $item)
                <tr class="border-t">
                    <td class="p-2">{{ $item->employee->nama }}</td>
                    <td>{{ $item->shift->kode_shift }}</td>
                    <td>
                        {{ $item->shift->jam_masuk }} - {{ $item->shift->jam_keluar }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="p-4 text-center text-gray-500">
                        Tidak ada jadwal hari ini
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection