@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Management Kontrak
            </h1>

            <p class="text-gray-500 mt-1">
                Kelola jenis kontrak karyawan.
            </p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow p-6">

        <form action="{{ route('management.kontrak.store') }}"
              method="POST"
              class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">

            @csrf

            <input type="text"
                   name="nama_kontrak"
                   placeholder="Nama Kontrak"
                   class="border rounded-lg px-4 py-2">

            <input type="text"
                   name="deskripsi"
                   placeholder="Deskripsi"
                   class="border rounded-lg px-4 py-2">

            <button type="submit"
                    class="bg-blue-600 text-white rounded-lg px-4 py-2 md:col-span-2">
                Tambah Kontrak
            </button>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">

                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left">Nama Kontrak</th>
                        <th class="px-4 py-3 text-left">Deskripsi</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($kontrak as $item)
                        <tr class="border-b">

                            <td class="px-4 py-3 font-medium">
                                {{ $item->nama_kontrak }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $item->deskripsi }}
                            </td>

                            <td class="px-4 py-3">
                                <div class="flex justify-center gap-2">

                                    <button class="px-3 py-1 bg-yellow-500 text-white rounded-md text-xs">
                                        Edit
                                    </button>

                                    <form action="{{ route('management.kontrak.destroy', $item->id) }}"
                                          method="POST">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                onclick="return confirm('Hapus kontrak?')"
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

        <div class="mt-4">
            {{ $kontrak->links() }}
        </div>
    </div>
</div>
@endsection