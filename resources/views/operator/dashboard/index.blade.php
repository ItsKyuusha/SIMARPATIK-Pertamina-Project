@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    <div>
        <h1 class="text-2xl font-bold text-gray-800">
            Dashboard Operator
        </h1>

        <p class="text-gray-500 mt-1">
            Informasi jadwal dan operasional kerja.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <div class="bg-white rounded-xl shadow p-5">
            <p class="text-sm text-gray-500">
                Shift Hari Ini
            </p>

            <h2 class="text-3xl font-bold mt-2 text-blue-600">
                {{ $jadwalHariIni->count() }}
            </h2>
        </div>

        <div class="bg-white rounded-xl shadow p-5">
            <p class="text-sm text-gray-500">
                Total Absensi
            </p>

            <h2 class="text-3xl font-bold mt-2 text-green-600">
                {{ $totalAbsensi }}
            </h2>
        </div>

        <div class="bg-white rounded-xl shadow p-5">
            <p class="text-sm text-gray-500">
                Pending Pengajuan Shift
            </p>

            <h2 class="text-3xl font-bold mt-2 text-yellow-500">
                {{ $pendingPengajuan }}
            </h2>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">

        <div class="p-5 border-b">
            <h2 class="text-lg font-semibold">
                Jadwal Hari Ini
            </h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left">Tanggal</th>
                        <th class="px-4 py-3 text-left">Shift</th>
                        <th class="px-4 py-3 text-left">Jam Masuk</th>
                        <th class="px-4 py-3 text-left">Jam Keluar</th>
                        <th class="px-4 py-3 text-left">Leader Bertugas</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($jadwalHariIni as $item)
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
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5"
                                class="text-center py-6 text-gray-500">
                                Tidak ada jadwal hari ini
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection