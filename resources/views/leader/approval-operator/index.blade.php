@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    <div>
        <h1 class="text-2xl font-bold text-gray-800">
            Approval Tukar Shift Operator
        </h1>

        <p class="text-gray-500 mt-1">
            Persetujuan pengajuan tukar shift operator.
        </p>
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left">Operator Pengaju</th>
                        <th class="px-4 py-3 text-left">Operator Tujuan</th>
                        <th class="px-4 py-3 text-left">Shift Pengaju</th>
                        <th class="px-4 py-3 text-left">Shift Tujuan</th>
                        <th class="px-4 py-3 text-left">Alasan</th>
                        <th class="px-4 py-3 text-left">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pengajuan as $item)
                        <tr class="border-b">

                            <td class="px-4 py-3">
                                {{ $item->pengaju->karyawan->nama_lengkap }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $item->tujuan->karyawan->nama_lengkap }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $item->pengaju->jadwal->shift->nama_shift }}
                                -
                                {{ $item->pengaju->jadwal->tanggal_kerja }}
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
                                {{ $item->status }}
                            </td>

                            <td class="px-4 py-3">

                                @if($item->status == 'pending')
                                    <div class="flex justify-center gap-2">

                                        <form action="{{ route('leader.approval-operator.approve', $item->id) }}"
                                              method="POST">
                                            @csrf

                                            <button type="submit"
                                                    class="px-3 py-1 bg-green-600 text-white rounded-md text-xs">
                                                Approve
                                            </button>
                                        </form>

                                        <form action="{{ route('leader.approval-operator.reject', $item->id) }}"
                                              method="POST">
                                            @csrf

                                            <button type="submit"
                                                    class="px-3 py-1 bg-red-600 text-white rounded-md text-xs">
                                                Reject
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-gray-400 text-xs">
                                        Selesai
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7"
                                class="text-center py-6 text-gray-500">
                                Belum ada pengajuan operator
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