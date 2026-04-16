<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-500 to-cyan-400">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">

        <!-- Title -->
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Welcome Back</h1>
            <p class="text-sm text-gray-500">Login ke sistem kamu</p>
        </div>

        <!-- Error -->
        @if(session('error'))
            <div class="mb-4 p-3 rounded-lg bg-red-100 text-red-600 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="/login" class="space-y-4">
            @csrf

            <!-- Email -->
            <div>
                <label class="block text-sm text-gray-600 mb-1">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    required
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none transition"
                    placeholder="you@example.com"
                >
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm text-gray-600 mb-1">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    required
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none transition"
                    placeholder="••••••••"
                >
            </div>

            <!-- Button -->
            <button 
                type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg font-semibold transition"
            >
                Login
            </button>
        </form>

    </div>

</body>
</html>