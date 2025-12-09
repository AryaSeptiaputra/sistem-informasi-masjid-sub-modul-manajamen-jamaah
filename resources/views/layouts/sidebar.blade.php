<aside class="w-64 bg-white border-r shadow-sm h-[calc(100vh-64px)] fixed left-0 top-16 z-40">
    <div class="p-6 border-b text-center font-bold text-xl">
        LOGO
    </div>

    <nav class="p-4 space-y-4 text-gray-700">

        <a href="/dashboard" class="block font-semibold hover:text-blue-600">
            Dashboard
        </a>

        {{-- Dropdown Riwayat --}}
        <div x-data="{ open: false }">
            <div class="flex justify-between items-center font-semibold cursor-pointer"
                 @click="open = !open">
                Riwayat <span x-text="open ? '▴' : '▾'"></span>
            </div>

            <div x-show="open" class="ml-4 space-y-2 text-sm mt-2">
                <a href="{{ route('riwayat.donasi') }}" class="hover:text-blue-600 block">Donasi</a>
                <a href="{{ route('riwayat.kegiatan') }}" class="hover:text-blue-600 block">Kegiatan</a>
            </div>
        </div>

        <a href="/profile" class="block font-semibold hover:text-blue-600">
            Profil Saya
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="text-red-600 hover:text-red-800 font-semibold mt-4">
                Logout
            </button>
        </form>
    </nav>
</aside>
