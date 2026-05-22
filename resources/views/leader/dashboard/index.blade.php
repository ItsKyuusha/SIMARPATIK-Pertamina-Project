@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    <div>
        <h1 class="text-2xl font-bold text-gray-800">
            Dashboard Leader
        </h1>

        <p class="text-gray-500 mt-1">
            Monitoring operasional shift dan operator.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">

        <div class="bg-white rounded-xl shadow p-5">
            <p class="text-sm text-gray-500">
                Operator Hadir Hari Ini
            </p>

            <h2 class="text-3xl font-bold mt-2 text-green-600">
                {{ $totalOperatorHadir }}
            </h2>
        </div>

        <div class="bg-white rounded-xl shadow p-5">
            <p class="text-sm text-gray-500">
                Pending Approval Operator
            </p>

            <h2 class="text-3xl font-bold mt-2 text-yellow-500">
                {{ $pendingApprovalOperator }}
            </h2>
        </div>

        <div class="bg-white rounded-xl shadow p-5">
            <p class="text-sm text-gray-500">
                Total Shift Hari Ini
            </p>

            <h2 class="text-3xl font-bold mt-2 text-blue-600">
                {{ $jadwalHariIni->count() }}
            </h2>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">

        <div class="p-5 border-b">
            <h2 class="text-lg font-semibold">
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
                            <td colspan="4"
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