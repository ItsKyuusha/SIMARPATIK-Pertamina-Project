@extends('layouts.app')

@section('title', 'Riwayat Shift')

@section('content')
<div>

    <h1 class="text-xl font-bold mb-4">Riwayat Shift</h1>

    <table class="w-full bg-white rounded shadow text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2">Tanggal</th>
                <th>Shift</th>
                <th>Keterangan</th>
            </tr>
        </thead>

        <tbody>
            @forelse($histories as $h)
            <tr class="border-t">
                <td class="p-2">{{ $h->tanggal }}</td>
                <td>{{ $h->shift->kode_shift }}</td>
                <td>{{ $h->keterangan ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center p-4 text-gray-500">
                    Tidak ada riwayat
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection