@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Tukar Shift Operator
            </h1>

            <p class="text-gray-500 mt-1">
                Pengajuan pertukaran shift operator.
            </p>
        </div>

        <a href="{{ route('operator.tukar-shift.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Ajukan Tukar Shift
        </a>
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left">Shift Saya</th>
                        <th class="px-4 py-3 text-left">Operator Tujuan</th>
                        <th class="px-4 py-3 text-left">Shift Tujuan</th>
                        <th class="px-4 py-3 text-left">Alasan</th>
                        <th class="px-4 py-3 text-left">Status</th>
                    </tr>
                </thead>

                 <tbody>
                    @forelse($pengajuan as $item)
                        <tr class="border-b">

                            <td class="px-4 py-3">
                                {{ $item->pengaju->jadwal->shift->nama_shift }}
                                -
                                {{ $item->pengaju->jadwal->tanggal_kerja }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $item->tujuan->karyawan->nama_lengkap }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $item->tujuan->jadwal->shift->nama_shift }}
                                -
                                {{ $item->tujuan->jadwal->tanggal_kerja }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $item->alasan }}
                            </td>

                            <td class="px-4 py-3 capitalize">
                                <span class="px-3 py-1 rounded-full text-xs
                                    @if($item->status == 'pending')
                                        bg-yellow-100 text-yellow-700
                                    @elseif($item->status == 'disetujui')
                                        bg-green-100 text-green-700
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
                                Belum ada pengajuan shift
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t">
            {{ $pengajuan->links() }}
        </div>
    </div>
</div>
@endsection