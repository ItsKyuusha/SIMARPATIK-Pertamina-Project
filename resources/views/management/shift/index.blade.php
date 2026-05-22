@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Management Shift
            </h1>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow p-6">

        <form action="{{ route('management.shift.store') }}"
              method="POST"
              class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">

            @csrf

            <input type="text"
                   name="kode_shift"
                   placeholder="Kode Shift"
                   class="border rounded-lg px-4 py-2">

            <input type="text"
                   name="nama_shift"
                   placeholder="Nama Shift"
                   class="border rounded-lg px-4 py-2">

            <input type="time"
                   name="jam_masuk"
                   class="border rounded-lg px-4 py-2">

            <input type="time"
                   name="jam_keluar"
                   class="border rounded-lg px-4 py-2">

            <button type="submit"
                    class="bg-blue-600 text-white rounded-lg px-4 py-2 md:col-span-4">
                Tambah Shift
            </button>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left">Kode</th>
                        <th class="px-4 py-3 text-left">Nama</th>
                        <th class="px-4 py-3 text-left">Jam Masuk</th>
                        <th class="px-4 py-3 text-left">Jam Keluar</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($shift as $item)
                        <tr class="border-b">
                            <td class="px-4 py-3">
                                {{ $item->kode_shift }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $item->nama_shift }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $item->jam_masuk }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $item->jam_keluar }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection