@extends('layouts.app')

@section('content')
<div class="p-6 max-w-xl">
    <h1 class="text-xl font-bold mb-4">Tambah Karyawan</h1>

    <form method="POST" action="{{ route('employees.store') }}" class="space-y-4">
        @csrf

        <select name="user_id" class="w-full border p-2 rounded">
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>

        <input type="text" name="nama" placeholder="Nama" class="w-full border p-2 rounded">
        <input type="text" name="nik" placeholder="NIK" class="w-full border p-2 rounded">

        <select name="leader_id" class="w-full border p-2 rounded">
            <option value="">-- Leader --</option>
            @foreach($leaders as $leader)
                <option value="{{ $leader->id }}">{{ $leader->nama }}</option>
            @endforeach
        </select>

        <button class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection