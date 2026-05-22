@extends('layouts.app')

@section('content')
<div class="p-6">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Monitoring Kehadiran
        </h1>
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">Shift</th>
                        <th class="px-4 py-3 text-left">Jam Masuk</th>
                        <th class="px-4 py-3 text-left">Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($absensi as $item)
                        <tr class="border-b">
                            <td class="px-4 py-3">
                                {{ $item->anggotaJadwal->karyawan->nama_lengkap }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $item->anggotaJadwal->jadwal->shift->nama_shift }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $item->jam_masuk }}
                            </td>

                            <td class="px-4 py-3 capitalize">
                                {{ $item->status }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection