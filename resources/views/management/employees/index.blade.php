@extends('layouts.app')

@section('title', 'Data Karyawan')

@section('content')
<div class="p-6">

    <!-- Header -->
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-xl font-bold">Data Karyawan</h1>

        <a href="{{ route('employees.create') }}"
           class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
            + Tambah
        </a>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full bg-white rounded-xl shadow text-sm">

            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="p-3">Nama</th>
                    <th>NIP</th>
                    <th>Jabatan</th>
                    <th>Gender</th>
                    <th>No Telp</th>
                    <th>Kontrak</th>
                    <th>Leader Hari Ini</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($employees as $emp)
                <tr class="border-t hover:bg-gray-50">

                    <td class="p-3 font-medium">
                        {{ $emp->nama }}
                    </td>

                    <td>{{ $emp->nip }}</td>

                    <td>
                        <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-700">
                            {{ $emp->jabatan }}
                        </span>
                    </td>

                    <td>
                        {{ $emp->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}
                    </td>

                    <td>{{ $emp->notelp }}</td>

                    <td>
                        <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">
                            {{ $emp->jenisKontrak->nama_kontrak ?? '-' }}
                        </span>
                    </td>

                    <td>
                        @php
                            $todaySchedule = $emp->schedules->first();
                        @endphp

                        @if($todaySchedule && $todaySchedule->leader)
                            <span class="px-2 py-1 text-xs rounded bg-purple-100 text-purple-700">
                                {{ $todaySchedule->leader->nama }}
                            </span>
                        @else
                            <span class="text-gray-400 text-xs">-</span>
                        @endif
                    </td>

                    <td class="flex gap-2">

                        <a href="{{ route('employees.edit',$emp) }}"
                           class="text-blue-500 hover:underline">
                            Edit
                        </a>

                        <form action="{{ route('employees.destroy',$emp) }}" method="POST">
                            @csrf @method('DELETE')
                            <button class="text-red-500 hover:underline">
                                Hapus
                            </button>
                        </form>

                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center p-4 text-gray-500">
                        Tidak ada data karyawan
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

</div>
@endsection