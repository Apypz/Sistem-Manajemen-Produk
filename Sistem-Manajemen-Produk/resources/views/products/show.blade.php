  @extends('layouts.app')

  @section('content')
  <h2 class="text-2xl font-bold mb-6">Detail Produk</h2>
  <div class="bg-white p-6 rounded-lg shadow-md max-w-md">
      <p><strong>ID:</strong> {{ $product->id }}</p>
      <p><strong>Kategori:</strong> {{ $product->category }}</p>
      <p><strong>Nama