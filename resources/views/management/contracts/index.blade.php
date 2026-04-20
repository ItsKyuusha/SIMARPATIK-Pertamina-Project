@extends('layouts.app')

@section('content')
<div>
    <h1 class="text-xl font-bold mb-4">Manajemen Kontrak</h1>

    <!-- FORM TAMBAH -->
    <form method="POST" action="{{ route('contracts.store') }}" class="flex gap-2 mb-4">
        @csrf
        <input name="nama_kontrak" placeholder="Nama Kontrak"
               class="border p-2 rounded w-1/3">

        <input name="deskripsi" placeholder="Deskripsi"
               class="border p-2 rounded w-1/2">

        <button class="bg-blue-500 text-white px-4 rounded">Tambah</button>
    </form>

    <!-- TABLE -->
    <table class="w-full bg-white rounded shadow">
        <thead>
            <tr class="bg-gray-100">
                <th class="p-2">Nama</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($contracts as $contract)
            <tr class="border-t">
                <td class="p-2">{{ $contract->nama_kontrak }}</td>
                <td>{{ $contract->deskripsi }}</td>

                <td class="flex gap-2">
                    <!-- UPDATE -->
                    <form method="POST" action="{{ route('contracts.update',$contract) }}">
                        @csrf @method('PUT')
                        <input type="hidden" name="nama_kontrak" value="{{ $contract->nama_kontrak }}">
                        <input type="hidden" name="deskripsi" value="{{ $contract->deskripsi }}">
                        <button class="text-blue-500">Edit</button>
                    </form>

                    <!-- DELETE -->
                    <form method="POST" action="{{ route('contracts.destroy',$contract) }}">
                        @csrf @method('DELETE')
                        <button class="text-red-500">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection