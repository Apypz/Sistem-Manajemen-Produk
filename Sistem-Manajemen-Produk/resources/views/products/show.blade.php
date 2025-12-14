@extends('layouts.app')

@section('content')
<div class="flex justify-between mb-6">
    <h2 class="text-3xl font-bold text-gray-800">Detail Produk</h2>
    <a href="{{ route('products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Kembali</a>
</div>

<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg overflow-hidden">
    <!-- Gambar Produk -->
    <div class="bg-gray-100 p-8 flex justify-center">
        @if($product->photo)
            <img src="{{ $product->photo_url }}" alt="Foto Produk" class="w-64 h-64 object-cover rounded-lg shadow-md">
        @else
            <div class="w-64 h-64 bg-gray-300 rounded-lg flex items-center justify-center">
                <span class="text-gray-500 text-lg">Tidak ada foto</span>
            </div>
        @endif
    </div>

    <!-- Detail Produk -->
    <div class="p-8">
        <h3 class="text-2xl font-semibold text-gray-800 mb-6">{{ $product->name }}</h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div class="flex items-center">
                    <span class="font-medium text-gray-600 w-32">ID:</span>
                    <span class="text-gray-800">{{ $product->id }}</span>
                </div>
                <div class="flex items-center">
                    <span class="font-medium text-gray-600 w-32">Kategori:</span>
                    <span class="text-gray-800">{{ $product->category }}</span>
                </div>
                <div class="flex items-center">
                    <span class="font-medium text-gray-600 w-32">Nama:</span>
                    <span class="text-gray-800">{{ $product->name }}</span>
                </div>
            </div>

            <div class="space-y-4">
                <div class="flex items-center">
                    <span class="font-medium text-gray-600 w-32">Stok:</span>
                    <span class="text-gray-800">{{ number_format($product->stok) }}</span>
                </div>
                <div class="flex items-center">
                    <span class="font-medium text-gray-600 w-32">Harga:</span>
                    <span class="text-green-600 font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                </div>
                <div class="flex items-center">
                    <span class="font-medium text-gray-600 w-32">Update Terakhir:</span>
                    <span class="text-gray-800">{{ $product->updated_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>
        </div>

        <!-- Tombol Aksi -->
        <div class="mt-8 flex space-x-4">
            <a href="{{ route('products.edit', $product) }}" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-200">
                Edit Produk
            </a>
            <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition duration-200" onclick="return confirm('Yakin hapus produk ini?')">
                    Hapus Produk
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
