@extends('layouts.app')

@section('title', 'Manajemen Jadwal')

@section('content')
<div class="p-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">Data Jadwal</h1>

        <a href="{{ route('schedules.create') }}"
           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            + Tambah Jadwal
        </a>
    </div>

    <!-- Filter Tanggal -->
    <form method="GET" class="mb-4">
        <input type="date" name="tanggal"
               value="{{ request('tanggal') }}"
               onchange="this.form.submit()"
               class="border p-2 rounded">
    </form>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full bg-white rounded-xl shadow text-sm">

            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="p-3">Nama</th>
                    <th>Leader</th>
                    <th>Shift</th>
                    <th>Jam</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($schedules as $s)
                <tr class="border-t hover:bg-gray-50">

                    <td>
                        <span class="px-2 py-1 text-xs rounded bg-purple-100 text-purple-700">
                            {{ $s->leader->nama ?? '-' }}
                        </span>
                    </td>

                    <td>
                        <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-700">
                            {{ $s->shift->kode_shift }}
                        </span>
                    </td>

                    <td>
                        {{ $s->shift->jam_masuk }} - {{ $s->shift->jam_keluar }}
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($s->tanggal)->format('d M Y') }}
                    </td>

                    <td>
                        <form action="{{ route('schedules.destroy', $s) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="text-red-500 hover:underline">
                                Hapus
                            </button>
                        </form>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center p-4 text-gray-500">
                        Tidak ada jadwal
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>
@endsection