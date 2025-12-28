<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Masjid - @yield('title')</title>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        blue: {
                            50: '#eef3ff',
                            100: '#d9e3ff',
                            200: '#b6c6ff',
                            300: '#93a9ff',
                            400: '#6e88f3',
                            500: '#4e73df',
                            600: '#3f63c8',
                            700: '#3451a6',
                            800: '#2b4285',
                            900: '#26386e',
                        },
                        primary: '#4e73df',
                    },
                },
            },
        }
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    @yield('content')
</body>
</html>