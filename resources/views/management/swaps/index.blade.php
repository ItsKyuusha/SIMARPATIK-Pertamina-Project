@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-xl font-bold mb-4">Approval Tukar Shift</h1>

    <table class="w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-100">
                <th>Requester</th>
                <th>Target</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($swaps as $swap)
            <tr class="border-t">
                <td>{{ $swap->requester->nama }}</td>
                <td>{{ $swap->target->nama }}</td>
                <td>{{ $swap->status }}</td>
                <td class="flex gap-2">
                    <form method="POST" action="/management/swaps/{{ $swap->id }}/approve">
                        @csrf
                        <button class="text-green-500">Approve</button>
                    </form>

                    <form method="POST" action="/management/swaps/{{ $swap->id }}/reject">
                        @csrf
                        <button class="text-red-500">Reject</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection