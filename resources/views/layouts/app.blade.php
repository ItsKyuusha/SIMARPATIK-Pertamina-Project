<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Multi Panel App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-100">

<div class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="w-64 bg-gradient-to-b from-slate-700 to-slate-800 text-slate-100 flex flex-col shadow-lg">

        <!-- Logo -->
        <div class="p-5 border-b border-slate-600/30">
            <h2 class="text-xl font-bold tracking-wide text-white">
                APP PANEL
            </h2>
            <p class="text-xs text-slate-300">Multi Role System</p>
        </div>

        <!-- Menu -->
        <nav class="flex-1 p-4 space-y-1">

            @if(auth()->user()->role == 'management')
                <p class="text-xs text-slate-400 uppercase mt-2 mb-2">Management</p>

                <a href="/management/dashboard"
                class="block px-4 py-2 rounded-lg hover:bg-slate-600/40">
                    📊 Dashboard
                </a>

                <a href="/management/employees"
                class="block px-4 py-2 rounded-lg hover:bg-slate-600/40">
                    👤 Karyawan
                </a>

                <a href="/management/contracts"
                class="block px-4 py-2 rounded-lg hover:bg-slate-600/40">
                    📄 Kontrak
                </a>

                <a href="/management/shifts"
                class="block px-4 py-2 rounded-lg hover:bg-slate-600/40">
                    ⏰ Shift
                </a>

                <a href="/management/schedules"
                class="block px-4 py-2 rounded-lg hover:bg-slate-600/40">
                    📅 Jadwal
                </a>

                <a href="/management/swaps"
                class="block px-4 py-2 rounded-lg hover:bg-slate-600/40">
                    🔄 Approval Shift
                </a>

                <a href="/management/histories"
                class="block px-4 py-2 rounded-lg hover:bg-slate-600/40">
                    📜 Riwayat
                </a>
            @endif

            @if(auth()->user()->role == 'leader')
                <p class="text-xs text-slate-400 uppercase mt-4 mb-2">Leader Panel</p>

                <!-- Dashboard -->
                <a href="/leader/dashboard"
                class="block px-4 py-2 rounded-lg hover:bg-slate-600/40 transition {{ request()->is('leader/dashboard') ? 'bg-slate-600/50' : '' }}">
                    📊 Dashboard
                </a>

                <!-- Jadwal Tim -->
                <a href="/leader/team"
                class="block px-4 py-2 rounded-lg hover:bg-slate-600/40 transition {{ request()->is('leader/team*') ? 'bg-slate-600/50' : '' }}">
                    👥 Jadwal Tim
                </a>

                <!-- Approval Operator -->
                <a href="/leader/swaps"
                class="block px-4 py-2 rounded-lg hover:bg-slate-600/40 transition {{ request()->is('leader/swaps*') ? 'bg-slate-600/50' : '' }}">
                    🔄 Approval Operator
                </a>

                <!-- Tukar Shift Leader -->
                <a href="/leader/swap/create"
                class="block px-4 py-2 rounded-lg hover:bg-slate-600/40 transition {{ request()->is('leader/swap/create') ? 'bg-slate-600/50' : '' }}">
                    🔁 Tukar Shift Leader
                </a>

            @endif

            @if(auth()->user()->role == 'operator')
                <a href="/operator"
                   class="block px-4 py-2 rounded-lg hover:bg-slate-600/40 transition">
                    📊 Dashboard
                </a>

                <a href="#"
                   class="block px-4 py-2 rounded-lg hover:bg-slate-600/40 transition">
                    📝 Task List
                </a>
            @endif

        </nav>

        <!-- Logout -->
        <div class="p-4 border-t border-slate-600/30">
            <form method="POST" action="/logout">
                @csrf
                <button class="w-full bg-red-500 hover:bg-red-600 text-white py-2 rounded-lg transition">
                    Logout
                </button>
            </form>
        </div>

    </aside>

    <!-- Main -->
    <div class="flex-1 flex flex-col">

        <!-- Topbar -->
        <header class="bg-white shadow-sm px-6 py-4 flex justify-between items-center">

            <div>
                <h1 class="text-lg font-semibold text-slate-800">
                    Dashboard
                </h1>
                <p class="text-sm text-slate-500">
                    {{ ucfirst(auth()->user()->role) }} Panel
                </p>
            </div>

            <div class="text-right">
                <p class="text-sm font-semibold text-slate-700">
                    {{ auth()->user()->name }}
                </p>
                <p class="text-xs text-slate-500">
                    {{ auth()->user()->email }}
                </p>
            </div>

        </header>

        <!-- Content -->
        <main class="p-6">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                @yield('content')
            </div>
        </main>

    </div>

</div>

</body>
</html>