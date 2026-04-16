@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold text-gray-800 mb-6">
    Leader Dashboard
</h2>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="bg-yellow-500 text-white p-5 rounded-xl shadow">
        <p class="text-sm">Jumlah Tim</p>
        <h3 class="text-3xl font-bold mt-2">5</h3>
    </div>

    <div class="bg-blue-500 text-white p-5 rounded-xl shadow">
        <p class="text-sm">Laporan Hari Ini</p>
        <h3 class="text-3xl font-bold mt-2">12</h3>
    </div>

    <div class="bg-green-500 text-white p-5 rounded-xl shadow">
        <p class="text-sm">Progress</p>
        <h3 class="text-3xl font-bold mt-2">80%</h3>
    </div>

</div>

<div class="mt-8 bg-white p-5 rounded-xl shadow">
    <h3 class="font-semibold text-gray-700 mb-2">Team Summary</h3>
    <p class="text-sm text-gray-500">
        Pantau performa tim dan laporan harian.
    </p>
</div>
@endsection