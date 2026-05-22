@extends('layouts.app')

@section('content')
@if ($errors->any())
    <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="p-6 max-w-5xl mx-auto">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Tambah Karyawan
        </h1>
    </div>

    <form action="{{ route('management.karyawan.store') }}"
          method="POST"
          class="bg-white rounded-xl shadow p-6 space-y-5">

        @csrf

        <!-- Scroll Horizontal Wrapper -->
        <div class="overflow-x-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 min-w-[700px]">

                <div>
                    <label class="block text-sm mb-2">Role</label>
                    <select name="role"
                            class="w-full border rounded-lg px-4 py-2">
                        <option value="management">Management</option>
                        <option value="leader">Leader</option>
                        <option value="operator">Operator</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm mb-2">Nama Lengkap</label>
                    <input type="text"
                           name="nama_lengkap"
                           class="w-full border rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="block text-sm mb-2">Username</label>
                    <input type="text"
                           name="username"
                           class="w-full border rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="block text-sm mb-2">Email</label>
                    <input type="email"
                           name="email"
                           class="w-full border rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="block text-sm mb-2">Password</label>
                    <input type="password"
                           name="password"
                           class="w-full border rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="block text-sm mb-2">Kode Karyawan</label>
                    <input type="text"
                           name="kode_karyawan"
                           class="w-full border rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="block text-sm mb-2">NIP</label>
                    <input type="text"
                           name="nip"
                           class="w-full border rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="block text-sm mb-2">Jenis Kelamin</label>
                    <select name="jenis_kelamin"
                            class="w-full border rounded-lg px-4 py-2">
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm mb-2">No Telepon</label>
                    <input type="text"
                           name="no_telp"
                           class="w-full border rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="block text-sm mb-2">Jabatan</label>
                    <input type="text"
                           name="jabatan"
                           class="w-full border rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="block text-sm mb-2">Tanggal Masuk</label>
                    <input type="date"
                           name="tanggal_masuk"
                           class="w-full border rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="block text-sm mb-2">Jenis Kontrak</label>

                    <select name="kontrak_id"
                            class="w-full border rounded-lg px-4 py-2">

                        @foreach($kontrak as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->nama_kontrak }}
                            </option>
                        @endforeach

                    </select>
                </div>

            </div>
        </div>

        <div>
            <label class="block text-sm mb-2">Alamat</label>

            <textarea name="alamat"
                      rows="4"
                      class="w-full border rounded-lg px-4 py-2"></textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Simpan
            </button>
        </div>

    </form>
</div>
@endsection