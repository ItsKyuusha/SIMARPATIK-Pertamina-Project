@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-xl font-bold mb-4">Riwayat Shift</h1>

    <table class="w-full bg-white shadow rounded">
        @foreach($histories as $h)
        <tr class="border-t">
            <td class="p-2">{{ $h->employee->nama }}</td>
            <td>{{ $h->shift->kode_shift }}</td>
            <td>{{ $h->tanggal }}</td>
            <td>{{ $h->keterangan }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection