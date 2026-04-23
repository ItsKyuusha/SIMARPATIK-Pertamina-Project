@extends('layouts.app')

@section('content')
<div class="p-6 max-w-xl">
    <h1 class="text-xl font-bold mb-4">Tambah Karyawan</h1>

    <form method="POST" action="{{ route('employees.store') }}" class="space-y-4">
        @csrf

        {{-- Data Login --}}
        <div class="border p-4 rounded bg-gray-50">
            <h2 class="font-semibold mb-2">Akun Login</h2>

            <input type="text" name="username" placeholder="Username"
                class="w-full border p-2 rounded mb-2" required>

            <input type="email" name="email" placeholder="Email"
                class="w-full border p-2 rounded mb-2" required>

            <input type="password" name="password" placeholder="Password"
                class="w-full border p-2 rounded" required>
        </div>

        {{-- Data dasar --}}
        <input type="text" name="nama" placeholder="Nama" class="w-full border p-2 rounded">
        <input type="text" name="nip" placeholder="NIP" class="w-full border p-2 rounded">

        {{-- Gender --}}
        <select name="gender" class="w-full border p-2 rounded">
            <option value="">-- Gender --</option>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select>

        {{-- Alamat --}}
        <textarea name="alamat" placeholder="Alamat" class="w-full border p-2 rounded"></textarea>

        {{-- No Telp --}}
        <input type="text" name="notelp" placeholder="No. Telepon" class="w-full border p-2 rounded">

        {{-- Jabatan --}}
        <select name="jabatan" class="w-full border p-2 rounded">
            <option value="">-- Jabatan --</option>
            <option value="management">Management</option>
            <option value="leader">Leader</option>
            <option value="operator">Operator</option>
        </select>

        {{-- Jenis Kontrak --}}
        <select name="jenis_kontrak_id" class="w-full border p-2 rounded">
            <option value="">-- Jenis Kontrak --</option>
            @foreach($contracts as $kontrak)
                <option value="{{ $kontrak->id }}">
                    {{ $kontrak->nama_kontrak }}
                </option>
            @endforeach
        </select>

        <button class="bg-blue-500 text-white px-4 py-2 rounded">
            Simpan
        </button>
    </form>
</div>
@endsection