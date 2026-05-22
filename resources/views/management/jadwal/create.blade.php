 @extends('layouts.app')

@section('content')
<div class="p-6 max-w-7xl mx-auto space-y-6">

    <div>
        <h1 class="text-2xl font-bold text-gray-800">
            Tambah Jadwal Shift
        </h1>

        <p class="text-gray-500 mt-1">
            Buat jadwal baru beserta leader dan operator.
        </p>
    </div>

    <form action="{{ route('management.jadwal.store') }}"
          method="POST"
          class="bg-white rounded-xl shadow p-6 space-y-6">

        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

            <div>
                <label class="block text-sm mb-2">
                    Shift
                </label>

                <select name="shift_id"
                        class="w-full border rounded-lg px-4 py-2">

                    @foreach($shift as $item)
                        <option value="{{ $item->id }}">
                            {{ $item->nama_shift }}
                            ({{ $item->jam_masuk }} - {{ $item->jam_keluar }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm mb-2">
                    Tanggal Kerja
                </label>

                <input type="date"
                       name="tanggal_kerja"
                       class="w-full border rounded-lg px-4 py-2">
            </div>
        </div>
        <div>
            <label class="block text-sm mb-2">
                Pilih Leader (Minimal 4)
            </label>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">

                @foreach($leader as $item)
                    <label class="flex items-center gap-3 border rounded-lg p-3 cursor-pointer hover:bg-gray-50">

                        <input type="checkbox"
                               name="leader[]"
                               value="{{ $item->id }}">

                        <div>
                            <div class="font-medium text-sm">
                                {{ $item->nama_lengkap }}
                            </div>

                            <div class="text-xs text-gray-500">
                                {{ $item->kode_karyawan }}
                            </div>
                        </div>
                    </label>
                @endforeach
            </div>
        </div>
        <div>
            <label class="block text-sm mb-2">
                Pilih Operator (Minimal 20)
            </label>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3 max-h-[400px] overflow-y-auto border rounded-xl p-4">

                @foreach($operator as $item)
                    <label class="flex items-center gap-3 border rounded-lg p-3 cursor-pointer hover:bg-gray-50">

                        <input type="checkbox"
                               name="operator[]"
                               value="{{ $item->id }}">

                        <div>
                            <div class="font-medium text-sm">
                                {{ $item->nama_lengkap }}
                            </div>

                            <div class="text-xs text-gray-500">
                                {{ $item->kode_karyawan }}
                            </div>
                        </div>
                    </label>
                @endforeach
            </div>
        </div>
        <div>
            <label class="block text-sm mb-2">
                Catatan
            </label>

            <textarea name="catatan"
                      rows="4"
                      class="w-full border rounded-lg px-4 py-2"></textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Simpan Jadwal
            </button>
        </div>

    </form>
</div>
@endsection