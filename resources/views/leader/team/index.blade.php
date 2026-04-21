@extends('layouts.app')

@section('title', 'Jadwal Tim')

@section('content')
<div>

    <div class="flex justify-between mb-4">
        <h1 class="text-xl font-bold">Jadwal Tim</h1>

        <form method="GET">
            <input type="date" name="date" value="{{ $date }}"
                   class="border p-2 rounded">
        </form>
    </div>

    <table class="w-full bg-white shadow rounded text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2">Nama</th>
                <th>Shift</th>
                <th>Jam</th>
                <th>Tanggal</th>
            </tr>
        </thead>

        <tbody>
            @forelse($schedules as $s)
            <tr class="border-t">
                <td class="p-2">{{ $s->employee->nama }}</td>
                <td>{{ $s->shift->kode_shift }}</td>
                <td>{{ $s->shift->jam_masuk }} - {{ $s->shift->jam_keluar }}</td>
                <td>{{ $s->tanggal }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center p-4 text-gray-500">
                    Tidak ada data
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection