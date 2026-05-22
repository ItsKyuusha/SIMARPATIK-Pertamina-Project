@extends('layouts.app')

@section('content')
<div class="p-6">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">
                Data Karyawan
            </h1>

            <p class="text-gray-500 mt-1">
                Management data karyawan SiMerpatik.
            </p>
        </div>

        <a href="{{ route('management.karyawan.create') }}"
           class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Tambah Karyawan
        </a>
    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">

        <!-- Horizontal Scroll -->
        <div class="overflow-x-auto">

            <!-- min width supaya scrollbar muncul -->
            <table class="w-full min-w-[1400px] text-sm">

                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-3 text-left">No</th>
                        <th class="px-4 py-3 text-left">Nama Lengkap</th>
                        <th class="px-4 py-3 text-left">Username</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-left">Role</th>
                        <th class="px-4 py-3 text-left">Kode Karyawan</th>
                        <th class="px-4 py-3 text-left">NIP</th>
                        <th class="px-4 py-3 text-left">Jenis Kelamin</th>
                        <th class="px-4 py-3 text-left">No Telepon</th>
                        <th class="px-4 py-3 text-left">Jabatan</th>
                        <th class="px-4 py-3 text-left">Tanggal Masuk</th>
                        <th class="px-4 py-3 text-left">Kontrak</th>
                        <th class="px-4 py-3 text-left">Alamat</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($karyawan as $item)
                        <tr class="border-b hover:bg-gray-50">

                            <td class="px-4 py-3">
                                {{ $loop->iteration }}
                            </td>

                            <td class="px-4 py-3 font-medium whitespace-nowrap">
                                {{ $item->nama_lengkap }}
                            </td>

                            <td class="px-4 py-3 whitespace-nowrap">
                                {{ $item->user->username }}
                            </td>

                            <td class="px-4 py-3 whitespace-nowrap">
                                {{ $item->user->email }}
                            </td>

                            <td class="px-4 py-3 capitalize whitespace-nowrap">
                                {{ $item->user->role }}
                            </td>

                            <td class="px-4 py-3 whitespace-nowrap">
                                {{ $item->kode_karyawan }}
                            </td>

                            <td class="px-4 py-3 whitespace-nowrap">
                                {{ $item->nip }}
                            </td>

                            <td class="px-4 py-3 whitespace-nowrap">
                                {{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                            </td>

                            <td class="px-4 py-3 whitespace-nowrap">
                                {{ $item->no_telp }}
                            </td>

                            <td class="px-4 py-3 whitespace-nowrap">
                                {{ $item->jabatan }}
                            </td>

                            <td class="px-4 py-3 whitespace-nowrap">
                                {{ $item->tanggal_masuk }}
                            </td>

                            <td class="px-4 py-3 whitespace-nowrap">
                                {{ $item->kontrak->nama_kontrak ?? '-' }}
                            </td>

                            <td class="px-4 py-3 min-w-[250px]">
                                {{ $item->alamat }}
                            </td>

                            <td class="px-4 py-3">
                                <div class="flex items-center justify-center gap-2">

                                    <a href="{{ route('management.karyawan.edit', $item->id) }}"
                                       class="px-3 py-1 bg-yellow-500 text-white rounded-md text-xs hover:bg-yellow-600 whitespace-nowrap">
                                        Edit
                                    </a>

                                    <form action="{{ route('management.karyawan.destroy', $item->id) }}"
                                          method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                onclick="return confirm('Hapus data?')"
                                                class="px-3 py-1 bg-red-600 text-white rounded-md text-xs hover:bg-red-700 whitespace-nowrap">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="14"
                                class="text-center py-6 text-gray-500">
                                Data karyawan kosong
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

        <div class="p-4 border-t">
            {{ $karyawan->links() }}
        </div>

    </div>

</div>
@endsection