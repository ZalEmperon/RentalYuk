@extends('client.components.base')

@section('page-content')
  <!-- Main Content -->
  <main class="container mx-auto px-6 py-8">
    <!-- Judul dan Breadcrumb -->
    <div>
      <nav class="text-sm mb-4">
        <a href="#" class="text-indigo-600 hover:underline">Home</a>
        <span class="mx-2 text-gray-500">/</span>
        <span class="text-gray-700">Sewa {{ $type }} di {{ $city }}</span>
      </nav>
      <h1 class="text-3xl font-bold text-gray-900">Sewa {{ ucfirst($type) }} di {{ ucfirst($city) }}</h1>
      <p class="mt-2 text-gray-600">Menampilkan {{ $searchCount }} hasil yang sesuai dengan pencarian Anda.</p>
    </div>
    <div class="mt-8 flex flex-col lg:flex-row gap-8">
      <!-- Kolom Filter -->
      <aside class="w-full lg:w-1/4">
        <form action="" method="GET" class="bg-white p-6 rounded-lg shadow-lg sticky top-28">
          <h3 class="text-xl font-semibold mb-4 border-b pb-3">Filter Pencarian</h3>
          <div class="mb-6">
            <label for="brand_name" class="block text-sm font-medium text-gray-700">Nama Kendaraan/Brand</label>
            <input type="text" name="brand_name" id="brand_name" placeholder="Contoh: Honda"
              value="{{ $old_input['brand_name'] ?? '' }}"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          </div>
          <div class="mb-6">
            <h4 class="font-semibold mb-3">Tipe Transmisi</h4>
            <div class="space-y-2">
              <label class="flex items-center">
                <input type="checkbox" name="transmission[]" value="Manual" class="..."
                  {{ in_array('Manual', $old_input['transmission'] ?? []) ? 'checked' : '' }}>
                <span class="ml-2 text-gray-700">Manual</span>
              </label>
              <label class="flex items-center">
                <input type="checkbox" name="transmission[]" value="Otomatis" class="..."
                  {{ in_array('Otomatis', $old_input['transmission'] ?? []) ? 'checked' : '' }}>
                <span class="ml-2 text-gray-700">Otomatis</span>
              </label>
            </div>
          </div>
          <div class="mb-6">
            <h4 class="font-semibold mb-3">Jenis Bahan Bakar</h4>
            <select id="fuel_type" name="fuel_type"
              class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
              <option value="">Semua Jenis</option>
              <option value="Bensin" {{ ($old_input['fuel_type'] ?? '') == 'Bensin' ? 'selected' : '' }}>Bensin</option>
              <option value="Solar (Diesel)" {{ ($old_input['fuel_type'] ?? '') == 'Solar (Diesel)' ? 'selected' : '' }}>
                Solar (Diesel)</option>
              <option value="Listrik" {{ ($old_input['fuel_type'] ?? '') == 'Listrik' ? 'selected' : '' }}>Listrik
              </option>
              <option value="Hybrid" {{ ($old_input['fuel_type'] ?? '') == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
            </select>
          </div>
          <div class="mb-6">
            <h4 class="font-semibold mb-3">Rentang Harga</h4>
            <div class="space-y-4">
              <div>
                <label for="min_price" class="block text-sm font-medium text-gray-700">Min Harga</label>
                <input type="number" name="min_price" id="min_price" placeholder="Contoh: 100000"
                  value="{{ $old_input['min_price'] ?? '' }}"
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
              </div>
              <div>
                <label for="max_price" class="block text-sm font-medium text-gray-700">Max Harga</label>
                <input type="number" name="max_price" id="max_price" placeholder="Contoh: 1000000"
                  value="{{ $old_input['max_price'] ?? '' }}"
                  class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
              </div>
            </div>
          </div>
          <div>
            <h4 class="font-semibold mb-3">Kapasitas Penumpang</h4>
            <div class="space-y-2">
              <label class="flex items-center">
                <input type="radio" name="capacity" value="" class="..."
                  {{ empty($old_input['capacity']) ? 'checked' : '' }}>
                <span class="ml-2 text-gray-700">Semua</span>
              </label>
              <label class="flex items-center">
                <input type="radio" name="capacity" value="2-4" class="..."
                  {{ ($old_input['capacity'] ?? '') == '2-4' ? 'checked' : '' }}>
                <span class="ml-2 text-gray-700">2 - 4 orang</span>
              </label>
              <label class="flex items-center">
                <input type="radio" name="capacity" value="5-7" class="..."
                  {{ ($old_input['capacity'] ?? '') == '5-7' ? 'checked' : '' }}>
                <span class="ml-2 text-gray-700">5 - 7 orang</span>
              </label>
              <label class="flex items-center">
                <input type="radio" name="capacity" value=">7" class="..."
                  {{ ($old_input['capacity'] ?? '') == '>7' ? 'checked' : '' }}>
                <span class="ml-2 text-gray-700">&gt; 7 orang</span>
              </label>
            </div>
          </div>
          <button type="submit"
            class="w-full mt-6 bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition duration-300">Terapkan
            Filter</button>
        </form>
      </aside>

      <!-- Kolom Hasil Pencarian -->
      <section class="w-full lg:w-3/4">
        <div class="space-y-6">
          @forelse ($vehicleDatas as $data)
            <div
              class="bg-white rounded-lg shadow-lg overflow-hidden {{ $data->is_premium > 0 ? 'border-2 border-yellow-400' : '' }}">
              <div class="flex flex-col md:flex-row">
                <img
                  src="{{ $data->photos->isNotEmpty() ? asset('storage/photo/' . $data->type . '/' . $data->photos->first()->photo_url) : 'https://placehold.co/600x400/1abc9c/ffffff?text=No+Image' }}"
                  alt="{{ $data->brand . ' ' . $data->model }}" class="w-full md:w-1/3 h-48 md:h-auto object-cover">
                <div class="p-6 flex flex-col justify-between w-full">
                  <div>
                    <div class="flex justify-between items-start">
                      <h3 class="text-xl font-bold mb-1">{{ $data->brand . ' ' . $data->model }}</h3>
                      @if ($data->is_premium > 0)
                        <span
                          class="bg-yellow-400 text-yellow-900 text-xs font-bold px-2 py-1 rounded-full">PREMIUM</span>
                      @endif
                    </div>
                    <p class="text-gray-600 text-sm mb-3">Kota: {{ $data->city }}</p>
                    <div class="flex items-center space-x-4 text-sm text-gray-500 mb-4">
                      <span>{{ $data->transmission }}</span>
                      <span>•</span>
                      <span>{{ $data->capacity }} Kursi</span>
                      <span>•</span>
                      <span>{{ $data->fuel_type }}</span>
                    </div>
                    <p class="text-gray-700 text-sm leading-relaxed">{{ $data->description }}</p>
                  </div>
                  <div class="flex justify-between items-center mt-4 pt-4 border-t">
                    <p class="text-lg font-bold text-indigo-600">Rp
                      {{ number_format($data->price_per_day, 0, ',', '.') }}<span
                        class="text-sm font-normal text-gray-500">/hari</span></p>
                    <a href="/detail/{{ $data->id }}"
                      class="bg-indigo-600 text-white px-5 py-2 rounded-md hover:bg-indigo-700 font-semibold text-sm transition duration-300">Lihat
                      Detail</a>
                  </div>
                </div>
              </div>
            </div>
          @empty
            <div
              class="bg-white rounded-lg shadow-lg overflow-hidden">
              <div class="flex flex-row justify-center p-6">
                Tidak ada Kendaraan dengan spesifikasi, jenis, maupun asal kota yang cocok
              </div>
            </div>
          @endforelse

          <!-- Pagination -->
          <div class="flex justify-center pt-8">
            <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
              <a href="#"
                class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                <span class="sr-only">Previous</span>
                <!-- Heroicon name: solid/chevron-left -->
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                  aria-hidden="true">
                  <path fill-rule="evenodd"
                    d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                    clip-rule="evenodd" />
                </svg>
              </a>
              <a href="#" aria-current="page"
                class="z-10 bg-indigo-50 border-indigo-500 text-indigo-600 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                1 </a>
              <a href="#"
                class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                2 </a>
              <a href="#"
                class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-2 py-2 rounded-r-md border">
                <span class="sr-only">Next</span>
                <!-- Heroicon name: solid/chevron-right -->
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                  aria-hidden="true">
                  <path fill-rule="evenodd"
                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                    clip-rule="evenodd" />
                </svg>
              </a>
            </nav>
          </div>
        </div>
      </section>
    </div>
  </main>
@endsection
