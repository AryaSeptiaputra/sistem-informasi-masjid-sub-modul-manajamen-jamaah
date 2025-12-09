<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="bg-white rounded-2xl shadow-lg w-full max-w-md p-8">

    {{-- BUTTON BACK --}}
    <a href="/login" class="text-gray-600 mb-4 inline-block">
        ← Kembali
    </a>

    <h1 class="text-2xl font-bold text-center">Daftar Akun</h1>
    <p class="text-gray-500 text-center mb-6">Buat Akun Barumu</p>

    <form action="{{ url('/register') }}" method="POST" class="space-y-4">
        @csrf

        <input type="text" name="username" placeholder="Username"
               class="w-full bg-gray-100 rounded-full px-4 py-3 focus:outline-none">

        <input type="text" name="nama_lengkap" placeholder="Nama Lengkap"
               class="w-full bg-gray-100 rounded-full px-4 py-3 focus:outline-none">

        <input type="text" name="no_handphone" placeholder="Nomor Telepon"
               class="w-full bg-gray-100 rounded-full px-4 py-3 focus:outline-none">

        <input type="date" name="tanggal_lahir"
               class="w-full bg-gray-100 rounded-full px-4 py-3 focus:outline-none">

        <input type="text" name="alamat" placeholder="Alamat"
               class="w-full bg-gray-100 rounded-full px-4 py-3 focus:outline-none">

        <input type="password" name="kata_sandi" placeholder="Kata Sandi"
               class="w-full bg-gray-100 rounded-full px-4 py-3 focus:outline-none">

        <input type="password" name="kata_sandi_confirmation" placeholder="Verifikasi Kata Sandi"
               class="w-full bg-gray-100 rounded-full px-4 py-3 focus:outline-none">

        {{-- REGISTER BUTTON --}}
        <button type="submit"
            class="w-full bg-blue-600 text-white py-3 rounded-full hover:bg-blue-700 transition">
            Daftar
        </button>

        {{-- LOGIN LINK --}}
        <p class="text-center text-sm text-gray-600">
            Sudah memiliki akun?
            <a href="/login" class="text-blue-600 hover:underline">Login</a>
        </p>

    </form>
</div>

</body>
</html>
