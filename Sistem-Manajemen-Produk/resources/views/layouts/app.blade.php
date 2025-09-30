<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 p-4 text-white">
        <h1 class="text-2xl">Sistem Manajemen Produk</h1>
    </nav>
    <div class="container mx-auto p-6">
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 mb-4 rounded">{{ session('success') }}</div>
        @endif
        @yield('content')
    </div>
</body>
</html>