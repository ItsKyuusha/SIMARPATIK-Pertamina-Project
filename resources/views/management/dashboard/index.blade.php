@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    <div>
        <h1 class="text-2xl font-bold text-gray-800">
            Dashboard Management
        </h1>

        <p class="text-gray-500 mt-1">
            Monitoring operasional shift hari ini.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-4">

        <div class="bg-white rounded-xl shadow p-5">
            <p class="text-sm text-gray-500">Total Karyawan</p>
            <h2 class="text-3xl font-bold mt-2">
                {{ $totalKaryawan }}
            </h2>
        </div>

        <div class="bg-white rounded-xl shadow p-5">
            <p class="text-sm text-gray-500">Total Leader</p>
            <h2 class="text-3xl font-bold mt-2">
                {{ $totalLeader }}
            </h2>
        </div>

        <div class="bg-white rounded-xl shadow p-5">
            <p class="text-sm text-gray-500">Total Operator</p>
            <h2 class="text-3xl font-bold mt-2">
                {{ $totalOperator }}
            </h2>
        </div>

        <div class="bg-white rounded-xl shadow p-5">
            <p class="text-sm text-gray-500">Hadir Hari Ini</p>
            <h2 class="text-3xl font-bold mt-2 text-green-600">
                {{ $totalHadirHariIni }}
            </h2>
        </div>

        <div class="bg-white rounded-xl shadow p-5">
            <p class="text-sm text-gray-500">Pending Approval</p>
            <h2 class="text-3xl font-bold mt-2 text-yellow-500">
                {{ $pendingPengajuan }}
            </h2>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">

        <div class="p-5 border-b">
            <h2 class="font-semibold text-lg">
                Jadwal Shift Hari Ini
            </h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left">Tanggal</th>
                        <th class="px-4 py-3 text-left">Shift</th>
                        <th class="px-4 py-3 text-left">Leader</th>
                        <th class="px-4 py-3 text-left">Operator</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($jadwalHariIni as $item)
                        <tr class="border-b">
                            <td class="px-4 py-3">
                                {{ $item->tanggal_kerja }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $item->shift->nama_shift }}
                            </td>

                            <td class="px-4 py-3">
                                <div class="space-y-1">
                                    @foreach($item->leader as $leader)
                                        <div>
                                            {{ $leader->karyawan->nama_lengkap }}
                                        </div>
                                    @endforeach
                                </div>
                            </td>

                            <td class="px-4 py-3">
                                {{ $item->operator->count() }} Operator
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-6 text-gray-500">
                                Belum ada jadwal hari ini
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection