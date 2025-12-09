@extends('layouts.app')

@section('content')
<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    @include('layouts.sidebar')

    {{-- MAIN --}}
    <main class="flex-1 p-6 md:p-10 bg-gray-100">

        {{-- TOP BAR --}}
        <div class="flex items-center gap-4 mb-8">

            {{-- Tombol kembali --}}
            <a href="/dashboard"
               class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center
                      text-gray-700 hover:bg-gray-300 transition text-xl font-bold">
                ←
            </a>

            <h1 class="text-2xl font-bold">Profil Saya</h1>
        </div>

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        {{-- FORM WRAPPER DI TENGAH --}}
        <div class="flex justify-center">
            <div class="bg-white p-6 md:p-8 rounded-lg shadow max-w-xl w-full">

                <h2 class="text-xl font-semibold mb-6 text-center">Ubah Data Profil</h2>

                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf

                    <div class="space-y-4">

                        {{-- Username --}}
                        <div>
                            <label class="font-semibold">Username</label>
                            <input type="text" name="username"
                                   value="{{ old('username', $jamaah->username) }}"
                                   class="mt-1 w-full p-2 border rounded focus:ring focus:ring-blue-200">
                        </div>

                        {{-- Nama lengkap --}}
                        <div>
                            <label class="font-semibold">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap"
                                   value="{{ old('nama_lengkap', $jamaah->nama_lengkap) }}"
                                   class="mt-1 w-full p-2 border rounded focus:ring focus:ring-blue-200">
                        </div>

                        {{-- Tanggal lahir --}}
                        <div>
                            <label class="font-semibold">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir"
                                   value="{{ old('tanggal_lahir', $jamaah->tanggal_lahir) }}"
                                   class="mt-1 w-full p-2 border rounded focus:ring focus:ring-blue-200">
                        </div>

                        {{-- No HP --}}
                        <div>
                            <label class="font-semibold">No Handphone</label>
                            <input type="text" name="no_handphone"
                                   value="{{ old('no_handphone', $jamaah->no_handphone) }}"
                                   class="mt-1 w-full p-2 border rounded focus:ring focus:ring-blue-200">
                        </div>

                        {{-- Alamat --}}
                        <div>
                            <label class="font-semibold">Alamat</label>
                            <textarea name="alamat" rows="3"
                                      class="mt-1 w-full p-2 border rounded focus:ring focus:ring-blue-200">{{ old('alamat', $jamaah->alamat) }}</textarea>
                        </div>

                        {{-- Kata Sandi --}}
                        <div>
                            <label class="font-semibold">Kata Sandi (Opsional)</label>
                            <input type="password" name="kata_sandi"
                                   placeholder="Kosongkan jika tidak mengubah"
                                   class="mt-1 w-full p-2 border rounded focus:ring focus:ring-blue-200">
                        </div>

                    </div>

                    <button
                        class="mt-6 w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 rounded transition">
                        Simpan Perubahan
                    </button>
                </form>

            </div>
        </div>

    </main>
</div>
@endsection
