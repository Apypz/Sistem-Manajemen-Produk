  @extends('layouts.app')

  @section('content')
  <h2 class="text-2xl font-bold mb-6">Tambah Produk Baru</h2>
  <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md max-w-md">
      @csrf
      <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">Kategori</label>
          <select name="category" class="w-full px-3 py-2 border rounded focus:outline-none focus:shadow-outline @error('category') border-red-500 @enderror">
              <option value="">Pilih Kategori</option>
              @foreach($categories as $cat)
                  <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
              @endforeach
          </select>
          @error('category') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
      </div>

      <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">Nama Produk</label>
          <input type="text" name="name" value="{{ old('name') }}" class="w-full px-3 py-2 border rounded focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror">
          @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
      </div>

      <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">Foto Produk</label>
          <input type="file" name="photo" class="w-full px-3 py-2 border rounded focus:outline-none @error('photo') border-red-500 @enderror">
          @error('photo') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
      </div>

      <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">Harga (Rp)</label>
          <input type="number" name="price" step="0.01" value="{{ old('price') }}" class="w-full px-3 py-2 border rounded focus:outline-none focus:shadow-outline @error('price') border-red-500 @enderror">
          @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
      </div>

      <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 w-full">Simpan</button>
      <a href="{{ route('products.index') }}" class="block text-center text-gray-600 mt-2">Kembali</a>
  </form>
  @endsection
  