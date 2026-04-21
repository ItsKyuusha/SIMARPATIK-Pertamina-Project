@extends('layouts.app')

@section('title', 'Tukar Shift')

@section('content')
<div>

    <div class="flex justify-between mb-4">
        <h1 class="text-xl font-bold">Tukar Shift</h1>

        <a href="/operator/swap/create"
           class="bg-blue-500 text-white px-4 py-2 rounded">
            + Ajukan
        </a>
    </div>

    <table class="w-full bg-white rounded shadow text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2">Target</th>
                <th>Shift</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse($swaps as $swap)
            <tr class="border-t">
                <td class="p-2">{{ $swap->target->nama }}</td>
                <td>{{ $swap->schedule->shift->kode_shift }}</td>
                <td>{{ $swap->schedule->tanggal }}</td>
                <td>
                    <span class="px-2 py-1 text-xs rounded
                        {{ $swap->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                        {{ $swap->status == 'approved_leader' ? 'bg-blue-100 text-blue-700' : '' }}
                        {{ $swap->status == 'approved_management' ? 'bg-green-100 text-green-700' : '' }}
                        {{ $swap->status == 'rejected' ? 'bg-red-100 text-red-700' : '' }}
                    ">
                        {{ $swap->status }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center p-4 text-gray-500">
                    Belum ada pengajuan
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection