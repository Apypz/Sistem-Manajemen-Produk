<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Produk - @yield('title', 'Dashboard')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Tidak perlu script toggle lagi -->
</head>
<body class="bg-gray-100 flex">
    <!-- Sidebar Kiri (Statis, selalu visible, fixed lebar 64) -->
    <aside id="sidebar" class="bg-gray-800 text-white w-60 min-h-screen p-4 fixed left-0 top-0 overflow-y-auto z-50">
        <!-- Logo/Header Sidebar -->
        <div class="mb-8">
            <h1 class="text-xl font-bold">Dashboard Produk</h1>
        </div>

        <!-- Navigasi dengan Menu Utama dan Sub-Menu (tetap sama seperti sebelumnya) -->
        <nav class="space-y-4">
            <a href="{{ route('products.index') }}" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-700 text-white">
                <span class="mr-3"></span> Dashboard
            </a>

            <a href="" class="flex items-center px-4 py-2 rounded-lg hover:bg-gray-700 text-white">
                <span class="mr-3"></span> Laporan
            </a>
            <form class="logout-form" method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
        </nav>
    </aside>

    <!-- Main Content (Selalu offset sidebar dengan ml-64) -->
    <main class="flex-1 ml-64 p-6">
        <!-- Header Atas -->
        <div class="bg-white shadow-md rounded-lg p-4 mb-6">
            <h2 class="text-2xl font-bold text-gray-800">@yield('header', 'Dashboard')</h2>
        </div>

        <!-- Alert Success -->
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 mb-4 rounded-lg shadow-md">
                {{ session('success') }}
            </div>
        @endif

        <!-- Konten Halaman -->
        @yield('content')
    </main>
</body>
</html>
