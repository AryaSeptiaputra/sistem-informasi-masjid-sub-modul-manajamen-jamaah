<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Masjid' }}</title>

    {{-- TailwindCSS --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- AlpineJS (untuk toggle menu) --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700" rel="stylesheet" />

    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-gray-100">

<div class="flex h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-white border-r shadow-sm">
        <div class="p-6 border-b text-center font-bold text-xl">
            LOGO 
        </div>

        <nav class="p-4 space-y-3 text-gray-700">

            <a href="/dashboard"
               class="block py-2 font-semibold hover:text-blue-600">
                Dashboard
            </a>

            {{-- DROPDOWN RIWAYAT --}}
            <div x-data="{ open: false }" class="space-y-1">
                <button @click="open = !open"
                        class="w-full flex justify-between items-center py-2 font-semibold hover:text-blue-600">
                    Riwayat
                    <span x-text="open ? '▴' : '▾'"></span>
                </button>

                <div x-show="open" x-transition class="pl-4 space-y-2 text-sm">
                    <a href="/riwayat/donasi" class="block hover:text-blue-500">Riwayat Donasi</a>
                    <a href="/riwayat/kegiatan" class="block hover:text-blue-500">Riwayat Kegiatan</a>
                </div>
            </div>

        </nav>
    </aside>

    {{-- MAIN CONTENT --}}
    <main class="flex-1 p-6">

        {{-- TOPBAR --}}
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold">{{ $title ?? 'Dashboard' }}</h1>

            <div class="flex items-center space-x-4">

                {{-- USER PROFILE --}}
                <a href="/profile"
                    class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-white font-semibold hover:bg-gray-600">
                    {{ strtoupper(Auth::user()->nama_lengkap[0] ?? 'U') }}
                </a>

                {{-- LOGOUT --}}
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="text-red-600 hover:text-red-800">Logout</button>
                </form>
            </div>
        </div>

        {{-- PAGE CONTENT --}}
        @yield('content')

    </main>

</div>

</body>
</html>
