@extends('layouts.app')

@section('content')
<h2 class="text-2xl font-bold text-gray-800 mb-6">
    Management Dashboard
</h2>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">

    <div class="bg-blue-500 text-white p-5 rounded-xl shadow">
        <p class="text-sm">Total User</p>
        <h3 class="text-3xl font-bold mt-2">100</h3>
    </div>

    <div class="bg-green-500 text-white p-5 rounded-xl shadow">
        <p class="text-sm">Total Revenue</p>
        <h3 class="text-3xl font-bold mt-2">Rp 10jt</h3>
    </div>

    <div class="bg-purple-500 text-white p-5 rounded-xl shadow">
        <p class="text-sm">Active Session</p>
        <h3 class="text-3xl font-bold mt-2">25</h3>
    </div>

</div>

<!-- Section tambahan -->
<div class="mt-8 bg-white p-5 rounded-xl shadow">
    <h3 class="font-semibold text-gray-700 mb-2">Overview</h3>
    <p class="text-sm text-gray-500">
        Monitoring keseluruhan sistem dan performa user.
    </p>
</div>
@endsection