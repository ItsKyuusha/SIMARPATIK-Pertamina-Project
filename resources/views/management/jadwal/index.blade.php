@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Management Jadwal
            </h1>
        </div>

        <a href="{{ route('management.jadwal.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded-lg">
            Tambah Jadwal
        </a>
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left">Tanggal</th>
                        <th class="px-4 py-3 text-left">Shift</th>
                        <th class="px-4 py-3 text-left">Leader</th>
                        <th class="px-4 py-3 text-left">Operator</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($jadwal as $item)
                        <tr class="border-b">

                            <td class="px-4 py-3">
                                {{ $item->tanggal_kerja }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $item->shift->nama_shift }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $item->leader->count() }} Leader
                            </td>

                            <td class="px-4 py-3">
                                {{ $item->operator->count() }} Operator
                            </td>

                            <td class="px-4 py-3">
                                <div class="flex items-center justify-center gap-2">

                                    <a href="{{ route('management.jadwal.show', $item->id) }}"
                                       class="px-3 py-1 bg-green-600 text-white rounded-md text-xs">
                                        Detail
                                    </a>

                                    <form action="{{ route('management.jadwal.destroy', $item->id) }}"
                                          method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="px-3 py-1 bg-red-600 text-white rounded-md text-xs">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t">
            {{ $jadwal->links() }}
        </div>
    </div>
</div>
@endsection