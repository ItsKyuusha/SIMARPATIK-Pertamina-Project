@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    <div>
        <h1 class="text-2xl font-bold text-gray-800">
            Monitoring Operator
        </h1>

        <p class="text-gray-500 mt-1">
            Monitoring absensi operator realtime.
        </p>
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left">Nama Operator</th>
                        <th class="px-4 py-3 text-left">Shift</th>
                        <th class="px-4 py-3 text-left">Tanggal</th>
                        <th class="px-4 py-3 text-left">Jam Masuk</th>
                        <th class="px-4 py-3 text-left">Status</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($absensi as $item)
                        <tr class="border-b">

                            <td class="px-4 py-3 font-medium">
                                {{ $item->anggotaJadwal->karyawan->nama_lengkap }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $item->anggotaJadwal->jadwal->shift->nama_shift }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $item->anggotaJadwal->jadwal->tanggal_kerja }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $item->jam_masuk }}
                            </td>

                            <td class="px-4 py-3">
                                <span class="px-3 py-1 rounded-full text-xs
                                    @if($item->status == 'hadir')
                                        bg-green-100 text-green-700
                                    @elseif($item->status == 'terlambat')
                                        bg-yellow-100 text-yellow-700
                                    @elseif($item->status == 'izin')
                                        bg-blue-100 text-blue-700
                                    @else
                                        bg-red-100 text-red-700
                                    @endif
                                ">
                                    {{ $item->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5"
                                class="text-center py-6 text-gray-500">
                                Belum ada data absensi
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t">
            {{ $absensi->links() }}
        </div>
    </div>
</div>
@endsection