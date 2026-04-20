@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-6">Dashboard Management</h1>

    <div class="grid grid-cols-3 gap-6 mb-6">
        <div class="bg-white p-4 rounded shadow">
            <h2 class="text-gray-500">Total Operator</h2>
            <p class="text-3xl font-bold">{{ $totalOperator }}</p>
        </div>

        <div class="bg-white p-4 rounded shadow col-span-2">
            <h2 class="text-gray-500 mb-2">Shift Hari Ini</h2>
            <ul>
                @foreach($activeShift as $item)
                    <li class="border-b py-2">
                        {{ $item->employee->nama }} - {{ $item->shift->kode_shift }}
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection