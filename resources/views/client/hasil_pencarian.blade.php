@extends('client.components.base')

@section('seo_element')
  <meta name="description"
    content="Temukan {{ $type }} bekas & baru di {{ $city == 'semua' ? 'berbagai kota' : $city }} dengan harga terbaik. Lihat daftar {{ $type }} matic, sport, dan lainnya yang terbaru. Dapatkan {{ $type }} impianmu sekarang!">
@endsection
@section('page-content')
  {{-- [MODIFIKASI] Latar belakang diberi kelas animasi dan tekstur --}}
  <main class="animated-main-background">
    <div class="container mx-auto px-6 py-8">
      <div class="animate-on-scroll">
        <nav class="text-sm mb-4">
          <a href="#" class="text-indigo-600 hover:underline">Home</a>
          <span class="mx-2 text-gray-500">/</span>
          <span class="text-gray-700">Sewa {{ $type }} di {{ $city }}</span>
        </nav>
        <h1 class="text-4xl font-extrabold text-gray-900">Hasil Pencarian</h1>
        <p class="mt-2 text-gray-600">Menampilkan {{ $searchCount }} hasil yang sesuai dengan pencarian Anda di <span
            class="font-bold text-indigo-600">{{ ucfirst($city == 'semua' ? 'Berbagai Kota' : $city) }}</span>.</p>
      </div>
      <div class="mt-8 flex flex-col lg:flex-row gap-8">
        <aside class="w-full lg:w-1/4 animate-on-scroll delay-100">
          {{-- [MODIFIKASI] Kartu filter diberi efek kaca buram --}}
          <form action="" id="searchForm" method="GET"
            class="bg-white/60 backdrop-blur-xl p-6 rounded-2xl shadow-lg border border-white/20 sticky top-28">
            <h3 class="text-xl font-semibold mb-4 border-b pb-3 text-gray-800">Filter Pencarian</h3>
            <div class="mb-6">
              <h4 for="keyword" class="font-semibold mb-3">Nama Kendaraan/Brand</h4>
              <input type="text" name="keyword" id="keyword" placeholder="Contoh: Honda"
                value="{{ $old_input['keyword'] ?? '' }}"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="mb-6">
              <h4 for="city" class="font-semibold mb-3">Lokasi Kota/Daerah</h4>
              <input type="text" name="city" id="city" placeholder="Contoh: Surabaya"
                value="{{ $city ?? '' }}"
                class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div class="mb-6">
              <h4 class="font-semibold mb-3">Jenis Kendaraan</h4>
              <select id="type" name="type"
                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <option value="kendaraan" {{ $type == 'kendaraan' ? 'selected' : '' }}>Semua Jenis</option>
                <option value="mobil" {{ $type == 'mobil' ? 'selected' : '' }}>Mobil</option>
                <option value="motor" {{ $type == 'motor' ? 'selected' : '' }}>Motor</option>
              </select>
            </div>
            <div class="mb-6">
              <h4 class="font-semibold mb-3">Tipe Transmisi</h4>
              <div class="space-y-2">
                <label class="flex items-center cursor-pointer">
                  <input type="checkbox" name="transmission[]" value="Manual"
                    class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                    {{ in_array('Manual', $old_input['transmission'] ?? []) ? 'checked' : '' }}>
                  <span class="ml-2 text-gray-700">Manual</span>
                </label>
                <label class="flex items-center cursor-pointer">
                  <input type="checkbox" name="transmission[]" value="Otomatis"
                    class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
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
                <option value="Bensin" {{ ($old_input['fuel_type'] ?? '') == 'Bensin' ? 'selected' : '' }}>Bensin
                </option>
                <option value="Solar (Diesel)"
                  {{ ($old_input['fuel_type'] ?? '') == 'Solar (Diesel)' ? 'selected' : '' }}>
                  Solar (Diesel)</option>
                <option value="Listrik" {{ ($old_input['fuel_type'] ?? '') == 'Listrik' ? 'selected' : '' }}>Listrik
                </option>
                <option value="Hybrid" {{ ($old_input['fuel_type'] ?? '') == 'Hybrid' ? 'selected' : '' }}>Hybrid
                </option>
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
                <label class="flex items-center cursor-pointer">
                  <input type="radio" name="capacity" value=""
                    class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                    {{ empty($old_input['capacity']) ? 'checked' : '' }}>
                  <span class="ml-2 text-gray-700">Semua</span>
                </label>
                <label class="flex items-center cursor-pointer">
                  <input type="radio" name="capacity" value="2-4"
                    class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                    {{ ($old_input['capacity'] ?? '') == '2-4' ? 'checked' : '' }}>
                  <span class="ml-2 text-gray-700">2 - 4 orang</span>
                </label>
                <label class="flex items-center cursor-pointer">
                  <input type="radio" name="capacity" value="5-7"
                    class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                    {{ ($old_input['capacity'] ?? '') == '5-7' ? 'checked' : '' }}>
                  <span class="ml-2 text-gray-700">5 - 7 orang</span>
                </label>
                <label class="flex items-center cursor-pointer">
                  <input type="radio" name="capacity" value=">7"
                    class="h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500"
                    {{ ($old_input['capacity'] ?? '') == '>7' ? 'checked' : '' }}>
                  <span class="ml-2 text-gray-700">&gt; 7 orang</span>
                </label>
              </div>
            </div>
            <button type="submit"
              class="w-full mt-6 bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 transition-all duration-300 font-semibold shadow-lg hover:shadow-xl transform hover:scale-105">Terapkan
              Filter</button>
          </form>
        </aside>

        <section class="w-full lg:w-3/4">
          <div class="space-y-6">
            @forelse ($vehicleDatas as $data)
              {{-- [MODIFIKASI] Kartu hasil pencarian diberi efek hover dan animasi --}}
              <div
                class="bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:-translate-y-1 transform animate-on-scroll delay-{{ ($loop->index % 3) * 100 + 200 }} {{ $data->is_premium > 0 ? 'border-2 border-yellow-400' : '' }}">
                <div class="flex flex-col md:flex-row">
                  <div class="md:w-1/3 overflow-hidden">
                    <img
                      src="{{ $data->photos->isNotEmpty() ? asset('storage/photo/' . $data->type . '/' . $data->photos->first()->photo_url) : 'https://placehold.co/600x400/1abc9c/ffffff?text=No+Image' }}"
                      alt="{{ $data->brand . ' ' . $data->model }}"
                      class="w-full h-full object-cover transition-transform duration-500 ease-in-out transform hover:scale-110">
                  </div>
                  <div class="p-6 flex flex-col justify-between w-full">
                    <div>
                      <div class="flex justify-between items-start">
                        <h3 class="text-xl font-bold mb-1 text-gray-800">{{ $data->brand . ' ' . $data->model }}</h3>
                        @if ($data->is_premium > 0)
                          <span
                            class="bg-yellow-400 text-yellow-900 text-xs font-bold px-3 py-1 rounded-full shrink-0">PREMIUM</span>
                        @endif
                      </div>
                      <p class="text-gray-600 text-sm mb-3">Kota: {{ $data->city }}</p>
                      <div class="flex items-center flex-wrap gap-x-4 gap-y-1 text-sm text-gray-500 mb-4">
                        <span>{{ $data->transmission }}</span><span class="text-gray-300">•</span>
                        <span>{{ $data->capacity }} Kursi</span><span class="text-gray-300">•</span>
                        <span>{{ $data->fuel_type }}</span>
                      </div>
                      {{-- <p class="text-gray-700 text-sm leading-relaxed">{{ $data->description }}</p> --}}
                    </div>
                    <div class="flex justify-between items-center mt-4 pt-4 border-t">
                      <p class="text-lg font-bold text-indigo-600">Rp
                        {{ number_format($data->price_per_day, 0, ',', '.') }}<span
                          class="text-sm font-normal text-gray-500">/hari</span></p>
                      <a href="/detail/{{ $data->id }}"
                        class="bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-700 font-semibold text-sm transition duration-300 transform hover:scale-105">Lihat
                        Detail</a>
                    </div>
                  </div>
                </div>
              </div>
            @empty
              <div
                class="bg-white rounded-lg shadow-lg overflow-hidden p-12 text-center text-gray-500 animate-on-scroll">
                <h3 class="text-xl font-semibold text-gray-800">Oops! Tidak Ada Hasil</h3>
                <p class="mt-2">Tidak ada kendaraan yang cocok dengan filter pencarian Anda. Coba ubah filter atau
                  perluas area pencarian.</p>
              </div>
            @endforelse

            <div class="flex justify-center pt-8 animate-on-scroll delay-400">
              <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                <a href="#"
                  class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                  <span class="sr-only">Previous</span>
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
                  class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                  <span class="sr-only">Next</span>
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
    </div>
  </main>
@endsection

@section('custom-css')
  <style>
    /* Latar Belakang Utama yang Hidup */
    .animated-main-background {
      background-color: #f9fafb;
      /* gray-50 */
      background-image: radial-gradient(theme('colors.slate.200') 1px, transparent 1px);
      background-size: 20px 20px;
    }

    /* Keyframes untuk animasi "pop out" */
    .animate-on-scroll {
      opacity: 0;
      transform: translateY(30px);
      transition: opacity 0.8s ease-out, transform 0.8s ease-out;
    }

    .is-visible {
      opacity: 1;
      transform: translateY(0);
    }

    .delay-100 {
      transition-delay: 0.1s;
    }

    .delay-200 {
      transition-delay: 0.2s;
    }

    .delay-300 {
      transition-delay: 0.3s;
    }

    .delay-400 {
      transition-delay: 0.4s;
    }
  </style>
@endsection

@section('custom-js')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
      };
      const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target);
          }
        });
      }, observerOptions);
      document.querySelectorAll('.animate-on-scroll').forEach(element => {
        observer.observe(element);
      });
    });
    document.getElementById('searchForm').addEventListener('submit', function(e) {
      e.preventDefault();

      let type = document.getElementById('type').value || 'kendaraan';
      let city = document.getElementById('city').value || 'semua';

      // Pastikan city & type dalam slug format (tanpa spasi)
      city = city.toLowerCase().replace(/\s+/g, '-');
      type = type.toLowerCase();

      // Ganti action form jadi route dinamis
      this.action = `/sewa-${type}-${city}`;
      this.submit();
    });
  </script>
@endsection
