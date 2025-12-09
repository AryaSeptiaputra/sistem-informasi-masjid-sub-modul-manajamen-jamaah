<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }}</title>

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Alpine.js untuk toggle menu --}}
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-white border-r shadow-sm">
        <div class="p-6 border-b text-center font-bold text-xl">
            LOGO
        </div>

        <nav class="p-4 space-y-4 text-gray-700">

            <a href="/dashboard" class="block font-semibold hover:text-blue-600">
                Dashboard
            </a>

            <div x-data="{ open: false }">
                <button @click="open = !open"
                    class="w-full flex justify-between items-center font-semibold hover:text-blue-600">
                    Riwayat
                    <span x-text="open ? '▴' : '▾'"></span>
                </button>

                <div x-show="open" class="ml-4 mt-2 space-y-2 text-sm text-gray-600">
                    <a href="/riwayat/donasi" class="hover:text-blue-600 block">Riwayat Donasi</a>
                    <a href="/riwayat/kegiatan" class="hover:text-blue-600 block">Riwayat Kegiatan</a>
                </div>
            </div>

        </nav>
    </aside>

    {{-- MAIN SECTION --}}
    <main class="flex-1 p-8">

        {{-- TOP BAR --}}
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold">{{ $title ?? '' }}</h1>

            <div class="flex items-center gap-4">
                <a href="/profile"
                   class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center text-white font-semibold">
                    U
                </a>

                <form action="/logout" method="POST">
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
