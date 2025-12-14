@extends('layouts.app')

@section('content')
    <h2 class="text-2xl font-bold mb-6">Edit Produk</h2>
    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data"
        class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        @method('PUT')
        <!-- Sama seperti create, tapi value dari $product -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Kategori</label>
            <select name="category"
                class="w-full px-3 py-2 border rounded focus:outline-none @error('category') border-red-500 @enderror">
                <option value="">Pilih Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ $product->category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
            @error('category') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Nama Produk</label>
            <input type="text" name="name" value="{{ $product->name }}"
                class="w-full px-3 py-2 border rounded focus:outline-none @error('name') border-red-500 @enderror">
            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Foto Saat Ini</label>
            @if($product->photo)
                <img src="{{ $product->photo_url }}" alt="Foto" class="w-32 h-32 object-cover rounded mb-2">
            @endif
            <input type="file" name="photo"
                class="w-full px-3 py-2 border rounded focus:outline-none @error('photo') border-red-500 @enderror">
            @error('photo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Harga (Rp)</label>
            <input type="number" name="price" step="0.01" value="{{ $product->price }}"
                class="w-full px-3 py-2 border rounded focus:outline-none @error('price') border-red-500 @enderror">
            @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 w-full">Update</button>
        <a href="{{ route('products.index') }}" class="block text-center text-gray-600 mt-2">Kembali</a>
    </form>
@endsection