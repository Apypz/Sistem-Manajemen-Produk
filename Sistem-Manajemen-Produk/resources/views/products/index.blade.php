  @extends('layouts.app')

  @section('content')
  <div class="flex justify-between mb-6">
      <h2 class="text-2xl font-bold">Daftar Produk</h2>
      <a href="{{ route('products.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Tambah Produk</a>
  </div>

  <!-- Form Pencarian -->
  <div class="bg-white p-4 rounded-lg shadow-md mb-6">
      <form method="GET" action="{{ route('products.index') }}" class="flex space-x-4">
          <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan nama atau kategori..." class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
          <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600">Cari</button>
          @if(request('search'))
              <a href="{{ route('products.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">Reset</a>
          @endif
      </form>
  </div>

  <div class="bg-white shadow-md rounded-lg overflow-x-auto">
      <table class="min-w-1 divide-y divide-gray-200">
          <thead class="bg-gray-50">
              <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Foto</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
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
                  <td class="px-5 py-4 whitespace-nowrap">{{ number_format($product->stok) }}</td>
                  <td class="px-5 py-4 whitespace-nowrap">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                  <td class="px-5 py-4 whitespace-nowrap">{{ $product->updated_at->format('d/m/Y H:i') }}</td>
                  <td class="px-5 py-8 whitespace-nowrap text-sm font-medium flex align-middle">
                      <a href="{{ route('products.show', $product) }}"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 bg-amber-300 px-1 py-1 rounded mr-1">
  <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
</svg>
</a>
                      <a href="{{ route('products.edit', $product) }}" class=""><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-white bg-blue-500 px-1 py-1 rounded mr-1">
  <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
</svg>
</a>
                      <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="" onclick="return confirm('Yakin hapus?')"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-white bg-red-500 px-1 py-1 rounded">
  <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
</svg>
</button>
                      </form>
                  </td>
              </tr>
              @endforeach
          </tbody>
      </table>
  </div>

  {{ $products->links() }} <!-- Pagination -->
  @endsection
  