@extends('layouts.app')

@section('content')
<div class="p-6 space-y-10">

    {{-- =========================================================
        1. RIWAYAT TUKAR SHIFT (LAMA)
    ========================================================= --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-800">
            Riwayat Tukar Shift
        </h1>

        <p class="text-gray-500 mt-1 mb-4">
            Histori pertukaran shift operator & leader.
        </p>

        <div class="bg-white rounded-xl shadow overflow-hidden">

            <div class="overflow-x-auto">
                <table class="w-full text-sm">

                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left">Karyawan</th>
                            <th class="px-4 py-3 text-left">Shift Lama</th>
                            <th class="px-4 py-3 text-left">Shift Baru</th>
                            <th class="px-4 py-3 text-left">Tipe</th>
                            <th class="px-4 py-3 text-left">Diubah Oleh</th>
                            <th class="px-4 py-3 text-left">Tanggal</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($riwayatTukarShift as $item)
                            <tr class="border-b">

                                <td class="px-4 py-3 font-medium">
                                    {{ $item->karyawan->nama_lengkap }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $item->jadwalLama->shift->nama_shift ?? '-' }}
                                    -
                                    {{ $item->jadwalLama->tanggal_kerja ?? '-' }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $item->jadwalBaru->shift->nama_shift ?? '-' }}
                                    -
                                    {{ $item->jadwalBaru->tanggal_kerja ?? '-' }}
                                </td>

                                <td class="px-4 py-3 capitalize">
                                    {{ $item->tipe_perubahan }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $item->pengubah->username ?? '-' }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $item->created_at }}
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-6 text-gray-500">
                                    Belum ada riwayat tukar shift
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    {{-- =========================================================
        2. RIWAYAT KEHADIRAN (BARU DARI ABSENSI)
    ========================================================= --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-800">
            Riwayat Kehadiran (Absensi)
        </h1>

        <p class="text-gray-500 mt-1 mb-4">
            Data shift yang benar-benar dijalani berdasarkan absensi.
        </p>

        <div class="bg-white rounded-xl shadow overflow-hidden">

            <div class="overflow-x-auto">
                <table class="w-full text-sm">

                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left">Karyawan</th>
                            <th class="px-4 py-3 text-left">Shift</th>
                            <th class="px-4 py-3 text-left">Tanggal</th>
                            <th class="px-4 py-3 text-left">Jam Masuk</th>
                            <th class="px-4 py-3 text-left">Jam Keluar</th>
                            <th class="px-4 py-3 text-left">Status</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($riwayatAbsensi as $item)
                            <tr class="border-b">

                                <td class="px-4 py-3 font-medium">
                                    {{ $item->anggotaJadwal->karyawan->nama_lengkap }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $item->anggotaJadwal->jadwal->shift->nama_shift }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $item->created_at->format('Y-m-d') }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $item->jam_masuk }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $item->jam_keluar ?? '-' }}
                                </td>

                                <td class="px-4 py-3">
                                    <span class="px-3 py-1 rounded-full text-xs
                                        @if($item->status == 'hadir')
                                            bg-green-100 text-green-700
                                        @elseif($item->status == 'terlambat')
                                            bg-yellow-100 text-yellow-700
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
                                <td colspan="6" class="text-center py-6 text-gray-500">
                                    Belum ada riwayat absensi
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>
@endsection