@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    <div>
        <h1 class="text-2xl font-bold text-gray-800">
            Jadwal Saya
        </h1>

        <p class="text-gray-500 mt-1">
            Daftar seluruh jadwal kerja operator.
        </p>
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left">Tanggal</th>
                        <th class="px-4 py-3 text-left">Shift</th>
                        <th class="px-4 py-3 text-left">Jam Masuk</th>
                        <th class="px-4 py-3 text-left">Jam Keluar</th>
                        <th class="px-4 py-3 text-left">Leader</th>
                        <th class="px-4 py-3 text-left">Status Kehadiran</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($jadwal as $item)
                        <tr class="border-b">

                            <td class="px-4 py-3">
                                {{ $item->jadwal->tanggal_kerja }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $item->jadwal->shift->nama_shift }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $item->jadwal->shift->jam_masuk }}
                            </td>
                            
                             <td class="px-4 py-3">
                                {{ $item->jadwal->shift->jam_keluar }}
                            </td>

                            <td class="px-4 py-3">
                                <div class="space-y-1">
                                    @foreach($item->jadwal->leader as $leader)
                                        <div>
                                            {{ $leader->karyawan->nama_lengkap }}
                                        </div>
                                    @endforeach
                                </div>
                            </td>

                            <td class="px-4 py-3 capitalize">
                                {{ $item->status_kehadiran }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6"
                                class="text-center py-6 text-gray-500">
                                Jadwal belum tersedia
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t">
            {{ $jadwal->links() }}
        </div>
    </div>
</div>
@endsection