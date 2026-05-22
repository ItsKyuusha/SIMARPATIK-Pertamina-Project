@extends('layouts.app')

@section('content')
<div class="p-6">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Approval Tukar Shift Leader
        </h1>
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left">Pengaju</th>
                        <th class="px-4 py-3 text-left">Tujuan</th>
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
                                {{ $item->alasan }}
                            </td>

                            <td class="px-4 py-3 capitalize">
                                {{ $item->status }}
                            </td>

                            <td class="px-4 py-3">

                                @if($item->status == 'pending')

                                    <div class="flex justify-center gap-2">

                                        <form action="{{ route('management.approval-shift.approve', $item->id) }}"
                                              method="POST">
                                            @csrf

                                            <button type="submit"
                                                    class="px-3 py-1 bg-green-600 text-white rounded-md text-xs">
                                                Approve
                                            </button>
                                        </form>

                                        <form action="{{ route('management.approval-shift.reject', $item->id) }}"
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
                            <td colspan="5"
                                class="text-center py-6 text-gray-500">
                                Belum ada pengajuan tukar shift leader
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