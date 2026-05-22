@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Detail Jadwal Shift
            </h1>

            <p class="text-gray-500 mt-1">
                Detail lengkap jadwal kerja leader dan operator.
            </p>
        </div>

        <a href="{{ route('management.jadwal.index') }}"
           class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">
            Kembali
        </a>
    </div>

    {{-- INFORMASI JADWAL --}}
    <div class="bg-white rounded-xl shadow p-6">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div>
                <p class="text-sm text-gray-500 mb-1">
                    Tanggal Kerja
                </p>

                <h2 class="text-lg font-semibold text-gray-800">
                    {{ $jadwal->tanggal_kerja }}
                </h2>
            </div>

            <div>
                <p class="text-sm text-gray-500 mb-1">
                    Shift
                </p>

                <h2 class="text-lg font-semibold text-gray-800">
                    {{ $jadwal->shift->nama_shift }}
                </h2>
            </div>

            <div>
                <p class="text-sm text-gray-500 mb-1">
                    Jam Shift
                </p>

                <h2 class="text-lg font-semibold text-gray-800">
                    {{ $jadwal->shift->jam_masuk }}
                    -
                    {{ $jadwal->shift->jam_keluar }}
                </h2>
            </div>

        </div>

        @if($jadwal->catatan)
            <div class="mt-6">

                <p class="text-sm text-gray-500 mb-2">
                    Catatan
                </p>

                <div class="bg-gray-50 border rounded-lg p-4 text-sm text-gray-700">
                    {{ $jadwal->catatan }}
                </div>
            </div>
        @endif

    </div>

    {{-- LEADER --}}
    <div class="bg-white rounded-xl shadow overflow-hidden">

        <div class="p-5 border-b flex items-center justify-between">

            <div>
                <h2 class="text-lg font-semibold text-gray-800">
                    Leader Bertugas
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Total {{ $jadwal->leader->count() }} leader
                </p>
            </div>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left">Kode</th>
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">Jabatan</th>
                        <th class="px-4 py-3 text-left">No Telepon</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($jadwal->leader as $item)
                        <tr class="border-b">

                            <td class="px-4 py-3">
                                {{ $item->karyawan->kode_karyawan }}
                            </td>

                            <td class="px-4 py-3 font-medium">
                                {{ $item->karyawan->nama_lengkap }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $item->karyawan->jabatan }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $item->karyawan->no_telp ?? '-' }}
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4"
                                class="text-center py-6 text-gray-500">
                                Tidak ada leader
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>

    {{-- OPERATOR --}}
    <div class="bg-white rounded-xl shadow overflow-hidden">

        <div class="p-5 border-b flex items-center justify-between">

            <div>
                <h2 class="text-lg font-semibold text-gray-800">
                    Operator Bertugas
                </h2>

                <p class="text-sm text-gray-500 mt-1">
                    Total {{ $jadwal->operator->count() }} operator
                </p>
            </div>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left">Kode</th>
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">Jabatan</th>
                        <th class="px-4 py-3 text-left">Status Kehadiran</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($jadwal->operator as $item)
                        <tr class="border-b">

                            <td class="px-4 py-3">
                                {{ $item->karyawan->kode_karyawan }}
                            </td>

                            <td class="px-4 py-3 font-medium">
                                {{ $item->karyawan->nama_lengkap }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $item->karyawan->jabatan }}
                            </td>

                            <td class="px-4 py-3">

                                <span class="px-3 py-1 rounded-full text-xs
                                    @if($item->status_kehadiran == 'hadir')
                                        bg-green-100 text-green-700
                                    @elseif($item->status_kehadiran == 'terlambat')
                                        bg-yellow-100 text-yellow-700
                                    @elseif($item->status_kehadiran == 'izin')
                                        bg-blue-100 text-blue-700
                                    @elseif($item->status_kehadiran == 'alpha')
                                        bg-red-100 text-red-700
                                    @else
                                        bg-gray-100 text-gray-700
                                    @endif
                                ">
                                    {{ $item->status_kehadiran ?? 'belum absensi' }}
                                </span>

                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="4"
                                class="text-center py-6 text-gray-500">
                                Tidak ada operator
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>

</div>
@endsection