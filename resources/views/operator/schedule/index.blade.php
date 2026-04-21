@extends('layouts.app')

@section('title', 'Jadwal Saya')

@section('content')
<div>

    <h1 class="text-xl font-bold mb-4">Jadwal Saya</h1>

    <table class="w-full bg-white shadow rounded text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2">Tanggal</th>
                <th>Shift</th>
                <th>Jam</th>
            </tr>
        </thead>

        <tbody>
            @forelse($schedules as $s)
            <tr class="border-t">
                <td class="p-2">{{ $s->tanggal }}</td>
                <td>{{ $s->shift->kode_shift }}</td>
                <td>{{ $s->shift->jam_masuk }} - {{ $s->shift->jam_keluar }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center p-4 text-gray-500">
                    Tidak ada jadwal
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection