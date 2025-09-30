  @extends('layouts.app')

  @section('content')
  <div class="flex justify-between mb-6">
      <h2 class="text-2xl font-bold">Daftar Produk</h2>
      <a href="{{ route('products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Tambah Produk</a>
  </div>

  <div class="bg-white shadow-md rounded-lg overflow-hidden">
      <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
              <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Update Terakhir</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
              </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
              @foreach($products as $product)
              <tr>
                  <td class="px-6 py-4 whitespace-nowrap">{{ $product->id }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ $product->category }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ $product->name }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">
                      @if($product->photo)
                          <img src="{{ $product->photo_url }}" alt="Foto" class="w-16 h-16 object-cover rounded">
                      @else
                          Tidak ada
                      @endif
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($product->price, 2, ',', '.') }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ $product->updated_at->format('d/m/Y H:i') }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                      <a href="{{ route('products.show', $product) }}" class="text-indigo-600 hover:text-indigo-900 mr-2">Lihat</a>
                      <a href="{{ route('products.edit', $product) }}" class="text-blue-600 hover:text-blue-900 mr-2">Edit</a>
                      <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Yakin hapus?')">Hapus</button>
                      </form>
                  </td>
              </tr>
              @endforeach
          </tbody>
      </table>
  </div>

  {{ $products->links() }} <!-- Pagination -->
  @endsection
  