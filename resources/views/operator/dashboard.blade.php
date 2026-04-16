@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold text-gray-800 mb-6">
    Operator Dashboard
</h2>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="bg-indigo-500 text-white p-5 rounded-xl shadow">
        <p class="text-sm">Task Hari Ini</p>
        <h3 class="text-3xl font-bold mt-2">8</h3>
    </div>

    <div class="bg-green-500 text-white p-5 rounded-xl shadow">
        <p class="text-sm">Task Selesai</p>
        <h3 class="text-3xl font-bold mt-2">5</h3>
    </div>

    <div class="bg-red-500 text-white p-5 rounded-xl shadow">
        <p class="text-sm">Task Pending</p>
        <h3 class="text-3xl font-bold mt-2">3</h3>
    </div>

</div>

<div class="mt-8 bg-white p-5 rounded-xl shadow">
    <h3 class="font-semibold text-gray-700 mb-2">Activity</h3>
    <p class="text-sm text-gray-500">
        Kelola dan selesaikan task harian.
    </p>
</div>
@endsection