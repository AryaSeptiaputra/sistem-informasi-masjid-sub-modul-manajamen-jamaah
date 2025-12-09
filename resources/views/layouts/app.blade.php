<!DOCTYPE html>
<html lang="id">
<head>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Sistem Informasi Masjid' }}</title>

    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Font --}}
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700" rel="stylesheet" />
</head>

<body class="bg-gray-100 text-gray-900 font-inter">

    {{-- HEADER / NAVBAR --}}
    <nav class="bg-white shadow-sm border-b fixed w-full top-1 left-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-xl font-semibold">Sistem Informasi Masjid</h1>

            <div class="space-x-4">
                @auth
                    <a href="/dashboard" class="hover:text-blue-600">Dashboard</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button class="text-red-600 hover:text-red-800">Logout</button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    {{-- CONTENT WRAPPER: mulai di bawah header --}}
    <div class="pt-20"> {{-- ini mendorong semua konten turun dibawah navbar --}}
        @yield('content')
    </div>

</body>
</html>
