@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-xl font-bold mb-4">Shift</h1>

    <form method="POST" action="{{ route('shifts.store') }}" class="flex gap-2 mb-4">
        @csrf
        <input name="kode_shift" placeholder="Kode" class="border p-2 rounded">
        <input type="time" name="jam_masuk" class="border p-2 rounded">
        <input type="time" name="jam_keluar" class="border p-2 rounded">
        <button class="bg-green-500 text-white px-3 rounded">Tambah</button>
    </form>

    <table class="w-full bg-white shadow rounded">
        @foreach($shifts as $shift)
        <tr class="border-t">
            <td class="p-2">{{ $shift->kode_shift }}</td>
            <td>{{ $shift->jam_masuk }}</td>
            <td>{{ $shift->jam_keluar }}</td>
            <td>
                <form method="POST" action="{{ route('shifts.destroy',$shift) }}">
                    @csrf @method('DELETE')
                    <button class="text-red-500">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection