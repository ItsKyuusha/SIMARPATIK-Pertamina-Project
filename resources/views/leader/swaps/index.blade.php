@extends('layouts.app')

@section('title', 'Approval Tukar Shift Operator')

@section('content')
<div>

    <h1 class="text-xl font-bold mb-4">Approval Tukar Shift</h1>

    <table class="w-full bg-white rounded shadow text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2">Requester</th>
                <th>Target</th>
                <th>Shift</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($swaps as $swap)
            <tr class="border-t">
                <td class="p-2">{{ $swap->requester->nama }}</td>
                <td>{{ $swap->target->nama }}</td>
                <td>{{ $swap->schedule->shift->kode_shift }}</td>
                <td>
                    <span class="px-2 py-1 text-xs rounded
                        {{ $swap->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                        {{ $swap->status == 'approved_leader' ? 'bg-green-100 text-green-700' : '' }}
                        {{ $swap->status == 'rejected' ? 'bg-red-100 text-red-700' : '' }}
                    ">
                        {{ $swap->status }}
                    </span>
                </td>

                <td class="flex gap-2">
                    @if($swap->status == 'pending')
                    <form method="POST" action="/leader/swaps/{{ $swap->id }}/approve">
                        @csrf
                        <button class="text-green-600">Approve</button>
                    </form>

                    <form method="POST" action="/leader/swaps/{{ $swap->id }}/reject">
                        @csrf
                        <button class="text-red-600">Reject</button>
                    </form>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center p-4 text-gray-500">
                    Tidak ada pengajuan
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection