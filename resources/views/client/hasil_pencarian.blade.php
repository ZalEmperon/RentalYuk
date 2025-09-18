@extends('client.components.base')

@section('page-content')
  <!-- Main Content -->
  <main class="container mx-auto px-6 py-8">
    <!-- Judul dan Breadcrumb -->
    <div>
      <nav class="text-sm mb-4">
        <a href="#" class="text-indigo-600 hover:underline">Home</a>
        <span class="mx-2 text-gray-500">/</span>
        <span class="text-gray-700">Sewa Mobil di Surabaya</span>
      </nav>
      <h1 class="text-3xl font-bold text-gray-900">Sewa Mobil di Surabaya</h1>
      <p class="mt-2 text-gray-600">Menampilkan 12 hasil yang sesuai dengan pencarian Anda.</p>
    </div>

    <div class="mt-8 flex flex-col lg:flex-row gap-8">
      <!-- Kolom Filter -->
      <aside class="w-full lg:w-1/4">
        <div class="bg-white p-6 rounded-lg shadow-lg sticky top-28">
          <h3 class="text-xl font-semibold mb-4 border-b pb-3">Filter Pencarian</h3>

          <!-- Filter Tipe Kendaraan -->
          <div class="mb-6">
            <h4 class="font-semibold mb-3">Tipe Kendaraan</h4>
            <div class="space-y-2">
              <label class="flex items-center">
                <input type="checkbox" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                  checked>
                <span class="ml-2 text-gray-700">Mobil Manual</span>
              </label>
              <label class="flex items-center">
                <input type="checkbox" class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                  checked>
                <span class="ml-2 text-gray-700">Mobil Matic</span>
              </label>
            </div>
          </div>

          <!-- Filter Harga -->
          <div class="mb-6">
            <h4 class="font-semibold mb-3">Rentang Harga</h4>
            <input type="range" min="100000" max="1000000" value="500000"
              class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer">
            <div class="flex justify-between text-sm text-gray-600 mt-2">
              <span>Rp 100rb</span>
              <span>Rp 1jt</span>
            </div>
          </div>

          <!-- Filter Kapasitas -->
          <div>
            <h4 class="font-semibold mb-3">Kapasitas Penumpang</h4>
            <div class="space-y-2">
              <label class="flex items-center">
                <input type="radio" name="kapasitas"
                  class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                <span class="ml-2 text-gray-700">Semua</span>
              </label>
              <label class="flex items-center">
                <input type="radio" name="kapasitas"
                  class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                <span class="ml-2 text-gray-700">2 - 4 orang</span>
              </label>
              <label class="flex items-center">
                <input type="radio" name="kapasitas"
                  class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                <span class="ml-2 text-gray-700">5 - 7 orang</span>
              </label>
              <label class="flex items-center">
                <input type="radio" name="kapasitas"
                  class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                <span class="ml-2 text-gray-700">> 7 orang</span>
              </label>
            </div>
          </div>

          <button
            class="w-full mt-6 bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition duration-300">Terapkan
            Filter</button>
        </div>
      </aside>

      <!-- Kolom Hasil Pencarian -->
      <section class="w-full lg:w-3/4">
        <div class="space-y-6">
          <!-- Result Card 1 (Premium) -->
          <div class="bg-white rounded-lg shadow-lg overflow-hidden border-2 border-yellow-400">
            <div class="flex flex-col md:flex-row">
              <img src="https://placehold.co/400x300/3498db/ffffff?text=Toyota+Avanza" alt="Toyota Avanza"
                class="w-full md:w-1/3 h-48 md:h-auto object-cover">
              <div class="p-6 flex flex-col justify-between w-full">
                <div>
                  <div class="flex justify-between items-start">
                    <h3 class="text-xl font-bold mb-1">Toyota Avanza</h3>
                    <span class="bg-yellow-400 text-yellow-900 text-xs font-bold px-2 py-1 rounded-full">PREMIUM</span>
                  </div>
                  <p class="text-gray-600 text-sm mb-3">Lokasi: Rungkut, Surabaya</p>
                  <div class="flex items-center space-x-4 text-sm text-gray-500 mb-4">
                    <span>Manual</span>
                    <span>•</span>
                    <span>7 Kursi</span>
                    <span>•</span>
                    <span>Bensin</span>
                  </div>
                  <p class="text-gray-700 text-sm leading-relaxed">Kondisi mobil terawat, bersih, dan siap untuk
                    perjalanan jauh. AC dingin. Cocok untuk keluarga.</p>
                </div>
                <div class="flex justify-between items-center mt-4 pt-4 border-t">
                  <p class="text-lg font-bold text-indigo-600">Rp 350.000<span
                      class="text-sm font-normal text-gray-500">/hari</span></p>
                  <a href="#"
                    class="bg-indigo-600 text-white px-5 py-2 rounded-md hover:bg-indigo-700 font-semibold text-sm transition duration-300">Lihat
                    Detail</a>
                </div>
              </div>
            </div>
          </div>

          <!-- Result Card 2 -->
          <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="flex flex-col md:flex-row">
              <img src="https://placehold.co/400x300/e74c3c/ffffff?text=Honda+Brio" alt="Honda Brio"
                class="w-full md:w-1/3 h-48 md:h-auto object-cover">
              <div class="p-6 flex flex-col justify-between w-full">
                <div>
                  <h3 class="text-xl font-bold mb-1">Honda Brio</h3>
                  <p class="text-gray-600 text-sm mb-3">Lokasi: Gubeng, Surabaya</p>
                  <div class="flex items-center space-x-4 text-sm text-gray-500 mb-4">
                    <span>Matic</span>
                    <span>•</span>
                    <span>5 Kursi</span>
                    <span>•</span>
                    <span>Bensin</span>
                  </div>
                  <p class="text-gray-700 text-sm leading-relaxed">Mobil lincah dan irit bahan bakar, cocok untuk keliling
                    kota. Interior bersih dan wangi.</p>
                </div>
                <div class="flex justify-between items-center mt-4 pt-4 border-t">
                  <p class="text-lg font-bold text-indigo-600">Rp 300.000<span
                      class="text-sm font-normal text-gray-500">/hari</span></p>
                  <a href="#"
                    class="bg-indigo-600 text-white px-5 py-2 rounded-md hover:bg-indigo-700 font-semibold text-sm transition duration-300">Lihat
                    Detail</a>
                </div>
              </div>
            </div>
          </div>

          <!-- Result Card 3 -->
          <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="flex flex-col md:flex-row">
              <img src="https://placehold.co/400x300/2ecc71/ffffff?text=Xpander" alt="Mitsubishi Xpander"
                class="w-full md:w-1/3 h-48 md:h-auto object-cover">
              <div class="p-6 flex flex-col justify-between w-full">
                <div>
                  <h3 class="text-xl font-bold mb-1">Mitsubishi Xpander</h3>
                  <p class="text-gray-600 text-sm mb-3">Lokasi: Wonokromo, Surabaya</p>
                  <div class="flex items-center space-x-4 text-sm text-gray-500 mb-4">
                    <span>Matic</span>
                    <span>•</span>
                    <span>7 Kursi</span>
                    <span>•</span>
                    <span>Bensin</span>
                  </div>
                  <p class="text-gray-700 text-sm leading-relaxed">Mobil keluarga yang nyaman dengan kabin luas. Siap
                    menemani perjalanan liburan Anda.</p>
                </div>
                <div class="flex justify-between items-center mt-4 pt-4 border-t">
                  <p class="text-lg font-bold text-indigo-600">Rp 400.000<span
                      class="text-sm font-normal text-gray-500">/hari</span></p>
                  <a href="#"
                    class="bg-indigo-600 text-white px-5 py-2 rounded-md hover:bg-indigo-700 font-semibold text-sm transition duration-300">Lihat
                    Detail</a>
                </div>
              </div>
            </div>
          </div>

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
