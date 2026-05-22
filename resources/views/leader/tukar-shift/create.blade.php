@extends('layouts.app')

@section('content')
<div class="p-6 max-w-5xl mx-auto space-y-6">

    <div>
        <h1 class="text-2xl font-bold text-gray-800">
            Ajukan Tukar Shift
        </h1>

        <p class="text-gray-500 mt-1">
            Pengajuan pertukaran jadwal antar leader.
        </p>
    </div>

    <form action="{{ route('leader.tukar-shift.store') }}"
          method="POST"
          class="bg-white rounded-xl shadow p-6 space-y-6">

        @csrf

        <div>
            <label class="block text-sm mb-2">
                Jadwal Anda
            </label>

            <select name="anggota_pengaju_id"
                    class="w-full border rounded-lg px-4 py-2">

                @foreach($leaderAktif as $item)
                    <option value="{{ $item->id }}">
                        {{ $item->jadwal->shift->nama_shift }}
                        -
                        {{ $item->jadwal->tanggal_kerja }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm mb-2">
                Pilih Leader Tujuan
            </label>

            <select name="anggota_tujuan_id"
                    class="w-full border rounded-lg px-4 py-2">

                @foreach($leaderTujuan as $item)
                    <option value="{{ $item->id }}">
                        {{ $item->karyawan->nama_lengkap }}
                        -
                        {{ $item->jadwal->shift->nama_shift }}
                        -
                        {{ $item->jadwal->tanggal_kerja }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm mb-2">
                Alasan
            </label>

            <textarea name="alasan"
                      rows="5"
                      class="w-full border rounded-lg px-4 py-2"></textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Ajukan Tukar Shift
            </button>
        </div>

    </form>
</div>
@endsection