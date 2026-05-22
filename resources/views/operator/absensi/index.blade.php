@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    <div>
        <h1 class="text-2xl font-bold text-gray-800">
            Absensi Kehadiran
        </h1>

        <p class="text-gray-500 mt-1">
            Checkin dan checkout kehadiran operator.
        </p>
    </div>

    <div class="bg-white rounded-xl shadow p-6">

        <h2 class="text-lg font-semibold mb-5">
            Absensi Hari Ini
        </h2>

        <div class="space-y-4">

            @forelse($jadwalHariIni as $item)
                <div class="border rounded-xl p-5 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

                    <div>
                        <h3 class="font-semibold text-gray-800">
                            {{ $item->jadwal->shift->nama_shift }}
                        </h3>

                        <p class="text-sm text-gray-500 mt-1">
                            {{ $item->jadwal->tanggal_kerja }}
                        </p>

                        <p class="text-sm text-gray-500">
                            {{ $item->jadwal->shift->jam_masuk }}
                            -
                            {{ $item->jadwal->shift->jam_keluar }}
                        </p>
                    </div>

                    <form action="{{ route('operator.absensi.store') }}"
                          method="POST">

                        @csrf

                        <input type="hidden"
                               name="anggota_jadwal_id"
                               value="{{ $item->id }}">

                        <button type="submit"
                                class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Checkin
                        </button>
                    </form>
                </div>
            @empty
                <div class="text-center py-10 text-gray-500">
                    Tidak ada jadwal hari ini
                </div>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">

        <div class="p-5 border-b">
            <h2 class="text-lg font-semibold">
                Riwayat Absensi
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
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayatAbsensi as $item)
                        <tr class="border-b">

                            <td class="px-4 py-3">
                                {{ $item->created_at->format('Y-m-d') }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $item->anggotaJadwal->jadwal->shift->nama_shift }}
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

                            <td class="px-4 py-3 text-center">

                                @if(!$item->jam_keluar)
                                    <form action="{{ route('operator.absensi.checkout', $item->id) }}"
                                          method="POST">

                                        @csrf

                                        <button type="submit"
                                                class="px-3 py-1 bg-green-600 text-white rounded-md text-xs">
                                            Checkout
                                        </button>
                                    </form>
                                @else  
                                    <span class="text-gray-400 text-xs">
                                        Selesai
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6"
                                class="text-center py-6 text-gray-500">
                                Belum ada riwayat absensi
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t">
            {{ $riwayatAbsensi->links() }}
        </div>
    </div>
</div>
@endsection