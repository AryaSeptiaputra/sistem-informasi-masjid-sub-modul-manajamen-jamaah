<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Jamaah</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white rounded-2xl shadow-lg w-full max-w-md p-8">

        {{-- HEADER GAMBAR --}}
        <div class="w-full h-36 bg-gray-200 rounded-xl flex items-center justify-center mb-6">
            <p class="text-gray-600 text-center">Gambar Utama dan Logo<br>Aplikasi Jamaah</p>
        </div>

        {{-- TITLE --}}
        <h1 class="text-2xl font-bold text-center">Selamat Datang</h1>
        <p class="text-gray-500 text-center mb-6">Masuk ke akun anda</p>

        {{-- FORM LOGIN --}}
        <form action="{{ url('/login') }}" method="POST" class="space-y-4">
            @csrf

            {{-- Username --}}
            <div class="flex items-center bg-gray-100 rounded-full px-4 py-3">
                <span class="material-icons text-gray-500 mr-2">person</span>
                <input type="text" name="username" placeholder="Username"
                       class="bg-transparent w-full focus:outline-none">
            </div>

            {{-- Password --}}
            <div class="flex items-center bg-gray-100 rounded-full px-4 py-3">
                <span class="material-icons text-gray-500 mr-2">lock</span>
                <input type="password" name="kata_sandi" placeholder="Kata Sandi"
                       class="bg-transparent w-full focus:outline-none">
            </div>

            {{-- ERROR --}}
            @if(session('error'))
                <p class="text-red-500 text-sm text-center">{{ session('error') }}</p>
            @endif

            {{-- LOGIN BUTTON --}}
            <button type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-full mt-2 hover:bg-blue-700 transition">
                Login
            </button>

            {{-- REGISTER LINK --}}
            <p class="text-center text-sm text-gray-600 mt-3">
                Tidak memiliki akun?
                <a href="/register" class="text-blue-600 hover:underline">Daftar Akun</a>
            </p>

        </form>
    </div>

</body>
</html>
