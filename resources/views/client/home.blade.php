@extends('client.components.base')

@section('title', 'RentalYuk - Solusi Sewa Kendaraan Terpercaya')


@section('page-content')
  <main class="animated-main-background">
    {{-- Hero Section dengan Latar Belakang Silver Geometris --}}
    <section class="relative text-center py-20 md:py-32 overflow-hidden bg-slate-900/50 text-white" id="hero-section">
      <div class="absolute inset-0 z-0 opacity-5"
        style="background-image: url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22100%22 height=%22100%22 viewBox=%220 0 100 100%22%3E%3Cg fill-rule=%22evenodd%22%3E%3Cg fill=%22%23ffffff%22 fill-opacity=%220.4%22%3E%3Cpath opacity=%22.5%22 d=%22M96 95h4v1h-4v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4h-9v4h-1v-4H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15v-9H0v-1h15V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h9V0h1v15h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9zm-1 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm9-10v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-10 0v-9h-9v9h9zm-9-10h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9zm10 0h9v-9h-9v9z%22/%3E%3Cpath d=%22M6 5V0h1v5h9V0h1v5h9V0h1v5h9V0h1v5h9V0h1v5h9V0h1v5h9V0h1v5h9V0h1v5h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h4v1h-4v9h-1v-9h-9v9h-1v-9h-9v9h-1v-9h-9v9h-1v-9h-9v9h-1v-9h-9v9h-1v-9h-9v9h-1v-9h-9v9H0v-1h5v-9H0v-1h5v-9H0v-1h5v-9H0v-1h5v-9H0v-1h5v-9H0v-1h5v-9H0v-1h5v-9H0V5h6zm-1 0V0h-5v5h5zm-1 9V5h-5v9h5zm-1 9v-9h-5v9h5zm-1 9v-9h-5v9h5zm-1 9v-9h-5v9h5zm-1 9v-9h-5v9h5zm-1 9v-9h-5v9h5zm-1 9v-9h-5v9h5zm-1 9v-9h-5v9h5zm10-9h5v-9h-5v9zm1 9h5v-9h-5v9zm1 9h5v-9h-5v9zm1 9h5v-9h-5v9zm1 9h5v-9h-5v9zm1 9h5v-9h-5v9zm1 9h5v-9h-5v9zm1 9h5v-9h-5v9zm1 9h5v-9h-5v9zm9-10h9v-9h-9v9zm1 9h9v-9h-9v9zm1 9h9v-9h-9v9zm1 9h9v-9h-9v9zm1 9h9v-9h-9v9zm1 9h9v-9h-9v9zm1 9h9v-9h-9v9zm1 9h9v-9h-9v9zm1 9h9v-9h-9v9zm9-10v-9h-9v9h9zm1 9v-9h-9v9h9zm1 9v-9h-9v9h9zm1 9v-9h-9v9h9zm1 9v-9h-9v9h9zm1 9v-9h-9v9h9zm1 9v-9h-9v9h9zm1 9v-9h-9v9h9zm1 9v-9h-9v9h9zm9-10h9v-9h-9v9zm1 9h9v-9h-9v9zm1 9h9v-9h-9v9zm1 9h9v-9h-9v9zm1 9h9v-9h-9v9zm1 9h9v-9h-9v9zm1 9h9v-9h-9v9zm1 9h9v-9h-9v9zm1 9h9v-9h-9v9zm9-10v-9h-9v9h9zm1 9v-9h-9v9h9zm1 9v-9h-9v9h9zm1 9v-9h-9v9h9zm1 9v-9h-9v9h9zm1 9v-9h-9v9h9zm1 9v-9h-9v9h9zm1 9v-9h-9v9h9zm1 9v-9h-9v9h9zm9-10h9v-9h-9v9zm1 9h9v-9h-9v9zm1 9h9v-9h-9v9zm1 9h9v-9h-9v9zm1 9h9v-9h-9v9zm1 9h9v-9h-9v9zm1 9h9v-9h-9v9zm1 9h9v-9h-9v9zm1 9h9v-9h-9v9zm9-10v-9h-9v9h9zm1 9v-9h-9v9h9zm1 9v-9h-9v9h9zm1 9v-9h-9v9h9zm1 9v-9h-9v9h9zm1 9v-9h-9v9h9zm1 9v-9h-9v9h9zm1 9v-9h-9v9h9zm1 9v-9h-9v9h9z%22/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');">
      </div>
      <div class="absolute inset-0 z-10 bg-gradient-to-b from-slate-900/50 via-slate-900/80 to-slate-900"></div>

      <div class="relative z-20 container mx-auto px-6">
        <h1 class="text-4xl md:text-6xl font-extrabold text-white leading-tight drop-shadow-lg animate-fade-in-up">
          Sewa Kendaraan <span class="text-indigo-400">Terbaik</span> di Kota Anda
        </h1>
        <p class="mt-4 text-lg text-slate-300 max-w-2xl mx-auto drop-shadow-md animate-fade-in-up delay-200">
          Temukan kendaraan yang tepat untuk perjalanan Anda dengan mudah, cepat, dan aman.
        </p>
        <div
          class="mt-8 max-w-4xl mx-auto bg-white/10 backdrop-blur-sm p-4 rounded-xl shadow-2xl border border-white/20 flex flex-col md:flex-row items-center gap-4 animate-fade-in-up delay-400">

          <select id="vehicleType"
            class="text-sm rounded-lg block w-full md:w-md p-2.5 bg-gray-800 border-gray-600 placeholder-gray-400 text-white focus:ring-blue-500 focus:border-blue-500">
            <option value="" selected>Pilih Jenis</option>
            <option value="semua">Semua Jenis</option>
            <option value="mobil">Mobil</option>
            <option value="motor">Motor</option>
          </select>

          <div class="relative w-full">
            <svg class="w-6 h-6 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none"
              stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z">
              </path>
            </svg>
            <input type="text" id="cityInput" placeholder="Masukkan kota atau lokasi (e.g., Surabaya)"
              class="w-full pl-12 pr-4 py-3 bg-slate-800/50 text-white placeholder-slate-400 border border-slate-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors">
          </div>

          <button id="searchBtn"
            class="w-full md:w-auto bg-indigo-600 text-white px-8 py-3 rounded-lg hover:bg-indigo-500 transition-all duration-300 font-semibold shrink-0 shadow-lg hover:scale-105 transform">
            Cari Kendaraan
          </button>
        </div>
      </div>
    </section>

    {{-- Keunggulan Section --}}
    <section id="keunggulan" class="relative py-16 bg-white z-10">
      <div class="container mx-auto px-6">
        <div class="text-center mb-12">
          <h2 class="text-3xl font-bold text-gray-900 animate-on-scroll">Mengapa Memilih RentalYuk?</h2>
          <p class="mt-2 text-gray-600 animate-on-scroll delay-100">Kami memberikan yang terbaik untuk perjalanan Anda.
          </p>
        </div>
        <div class="grid md:grid-cols-3 gap-8 text-center">
          <div
            class="p-8 bg-slate-50 rounded-xl shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-on-scroll delay-200">
            <div
              class="flex items-center justify-center h-16 w-16 rounded-full bg-indigo-100 text-indigo-600 mx-auto mb-4 icon-animation">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01" />
              </svg>
            </div>
            <h3 class="text-xl font-semibold mb-2">Harga Terbaik</h3>
            <p class="text-gray-600">Dapatkan penawaran harga sewa paling kompetitif tanpa biaya tersembunyi.</p>
          </div>
          <div
            class="p-8 bg-slate-50 rounded-xl shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-on-scroll delay-300">
            <div
              class="flex items-center justify-center h-16 w-16 rounded-full bg-indigo-100 text-indigo-600 mx-auto mb-4 icon-animation">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                  d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
              </svg>
            </div>
            <h3 class="text-xl font-semibold mb-2">Banyak Pilihan</h3>
            <p class="text-gray-600">Dari mobil keluarga hingga motor lincah, temukan kendaraan sesuai kebutuhan Anda.</p>
          </div>
          <div
            class="p-8 bg-slate-50 rounded-xl shadow-md hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 animate-on-scroll delay-400">
            <div
              class="flex items-center justify-center h-16 w-16 rounded-full bg-indigo-100 text-indigo-600 mx-auto mb-4 icon-animation">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <h3 class="text-xl font-semibold mb-2">Proses Mudah & Aman</h3>
            <p class="text-gray-600">Pesan kendaraan impian Anda hanya dalam beberapa klik dengan sistem yang aman.</p>
          </div>
        </div>
      </div>
    </section>

    {{-- Mobil Section --}}
    <section id="mobil" class="relative py-16 bg-slate-50 z-10">
      <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center animate-on-scroll">Pilihan Mobil Populer</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
          {{-- Card Mobil --}}
          @foreach ($mobilDatas as $data)
            <div
              class="bg-white rounded-xl shadow-lg overflow-hidden group animate-on-scroll delay-{{ $loop->iteration * 100 }}">
              <div class="overflow-hidden">
                <img
                  src="{{ $data->main_photo_url ? asset('storage/photo/' . $data->type . '/' . $data->main_photo_url) : 'https://placehold.co/600x400/1abc9c/ffffff?text=No+Image' }}"
                  alt="{{ $data->brand }} {{ $data->model }}"
                  class="w-full h-56 object-cover transform group-hover:scale-110 transition-transform duration-700 ease-in-out">
              </div>
              <div class="p-6">
                <h3 class="text-xl font-semibold mb-2 text-gray-800">{{ $data->brand }} {{ $data->model }}</h3>
                <div class="flex items-center gap-4 text-sm text-gray-600 mb-4">
                  {{-- Menampilkan Transmisi --}}
                  <span class="flex items-center gap-1.5"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                      fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4">
                      </path>
                    </svg>{{ $data->transmission }}</span>
                  {{-- Menampilkan Kapasitas --}}
                  <span class="flex items-center gap-1.5"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                      fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                      </path>
                    </svg>{{ $data->capacity }} Kursi</span>
                </div>
                <div class="flex justify-between items-center border-t pt-4 mt-4">
                  <p class="text-lg font-bold text-indigo-600">Rp
                    {{ number_format($data->price_per_day, 0, ',', '.') }}<span
                      class="text-sm font-normal text-gray-500">/hari</span></p>
                  <a href="/detail/{{ $data->id }}"
                    class="bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-500 font-semibold text-sm transition-all duration-300 transform hover:scale-105">Sewa</a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    {{-- Motor Section --}}
    <section id="motor" class="relative py-16 bg-white z-10">
      <div class="container mx-auto px-6">
        <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center animate-on-scroll">Pilihan Motor Terlaris</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
          {{-- Card Motor --}}
          @foreach ($motorDatas as $data)
            <div
              class="bg-white rounded-xl shadow-lg overflow-hidden group animate-on-scroll delay-{{ $loop->iteration * 100 }}">
              <div class="overflow-hidden">
                <img
                  src="{{ $data->main_photo_url ? asset('storage/photo/' . $data->type . '/' . $data->main_photo_url) : 'https://placehold.co/600x400/3498db/ffffff?text=No+Image' }}"
                  alt="{{ $data->brand }} {{ $data->model }}"
                  class="w-full h-56 object-cover transform group-hover:scale-110 transition-transform duration-700 ease-in-out">
              </div>
              <div class="p-6">
                <h3 class="text-xl font-semibold mb-2 text-gray-800">{{ $data->brand }} {{ $data->model }}</h3>
                <div class="flex items-center gap-4 text-sm text-gray-600 mb-4">
                  {{-- Menampilkan Transmisi --}}
                  <span class="flex items-center gap-1.5"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                      fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6.75a5.25 5.25 0 016.38 4.5H18a2.25 2.25 0 012.25 2.25v3.75a2.25 2.25 0 01-2.25-2.25H6.75a2.25 2.25 0 01-2.25-2.25v-3.75a2.25 2.25 0 012.25-2.25h1.87a5.25 5.25 0 016.38-4.5zM12 12.75a.75.75 0 100-1.5.75.75 0 000 1.5z" />
                    </svg>{{ $data->transmission }}</span>
                  {{-- Menampilkan Kapasitas (untuk motor mungkin tidak relevan, tapi bisa ditampilkan jika ada) --}}
                  <span class="flex items-center gap-1.5"><svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                      fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                      </path>
                    </svg>{{ $data->capacity }} Orang</span>
                </div>
                <div class="flex justify-between items-center border-t pt-4 mt-4">
                  <p class="text-lg font-bold text-indigo-600">Rp
                    {{ number_format($data->price_per_day, 0, ',', '.') }}<span
                      class="text-sm font-normal text-gray-500">/hari</span></p>
                  <a href="/detail/{{ $data->id }}"
                    class="bg-indigo-600 text-white px-5 py-2 rounded-lg hover:bg-indigo-500 font-semibold text-sm transition-all duration-300 transform hover:scale-105">Sewa</a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>


  </main>
  {{-- Tentang Footer --}}
  <footer id="tentang" class="relative py-16 bg-slate-50 z-10">
    <div class="container mx-auto px-6">
      <div class="bg-white p-8 md:p-12 rounded-xl shadow-xl animate-on-scroll delay-600">
        <div class="grid md:grid-cols-2 gap-12 items-center">
          <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Tentang RentalYuk</h2>
            <p class="text-gray-600 mb-4 leading-relaxed">
              RentalYuk adalah platform marketplace yang menghubungkan pemilik kendaraan dengan para penyewa di seluruh
              Indonesia. Misi kami adalah membuat proses sewa kendaraan menjadi lebih mudah, transparan, dan aman bagi
              kedua belah pihak.
            </p>
            <p class="text-gray-600 leading-relaxed">
              Kami percaya bahwa setiap orang berhak mendapatkan akses transportasi yang fleksibel sesuai kebutuhan.
              Baik untuk liburan keluarga, perjalanan bisnis, atau sekadar kebutuhan harian, RentalYuk hadir sebagai
              solusi andalan Anda.
            </p>
          </div>
          <div class="overflow-hidden rounded-lg">
            <img src="https://placehold.co/600x400/a5b4fc/ffffff?text=Tim+RentalYuk" alt="Tim Kami"
              class="w-full h-full object-cover rounded-lg shadow-md transform hover:scale-110 transition-transform duration-500">
          </div>
        </div>
      </div>
    </div>
  </footer>
@endsection

{{-- ======================================================= --}}
{{-- CSS KUSTOM (Disisipkan ke base.blade.php) --}}
{{-- ======================================================= --}}
@section('custom-css')
  <style>
    /* Latar Belakang Utama yang Hidup */
    .animated-main-background {
      background: linear-gradient(-45deg,
          #f8fafc,
          /* slate-50 */
          #e2e8f0,
          /* slate-200 */
          #cbd5e1
          /* slate-300 */
        );
      background-size: 200% 200%;
      animation: subtleGradient 20s ease infinite;
    }

    @keyframes subtleGradient {
      0% {
        background-position: 0% 50%;
      }

      50% {
        background-position: 100% 50%;
      }

      100% {
        background-position: 0% 50%;
      }
    }

    /* Keyframes untuk animasi fade-in saat elemen terlihat */
    @keyframes fadeInUpx {
      from {
        opacity: 0;
        transform: translateY(30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Kelas untuk elemen yang akan dianimasikan saat scroll */
    .animate-on-scroll {
      opacity: 0;
      /* Mulai dari transparan */
      transition: opacity 0.8s ease-out, transform 0.8s ease-out;
      transform: translateY(30px);
      /* Posisi awal sebelum animasi */
    }

    /* Kelas yang ditambahkan oleh JS saat elemen terlihat */
    .is-visible {
      opacity: 1;
      transform: translateY(0);
    }

    /* Kelas utilitas untuk delay animasi */
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

    .delay-500 {
      transition-delay: 0.5s;
    }

    .delay-600 {
      transition-delay: 0.6s;
    }

    /* Animasi kecil untuk ikon */
    .icon-animation {
      animation: iconFloat 3s ease-in-out infinite;
    }

    @keyframes iconFloat {

      0%,
      100% {
        transform: translateY(0);
      }

      50% {
        transform: translateY(-10px);
      }
    }
  </style>
@endsection

{{-- ======================================================= --}}
{{-- JAVASCRIPT KUSTOM (Disisipkan ke base.blade.php) --}}
{{-- ======================================================= --}}
@section('custom-js')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // JavaScript untuk Parallax Effect di Hero Section
      const hero = document.getElementById('hero-section');
      if (hero) {
        window.addEventListener('scroll', function() {
          let scrollPosition = window.pageYOffset;
          hero.style.backgroundPositionY = scrollPosition * 0.4 + 'px';
        });
      }

      // Intersection Observer untuk memicu animasi saat elemen di-scroll
      const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.2 // Picu saat 20% elemen terlihat
      };

      const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-visible');
            observer.unobserve(entry.target); // Hentikan observasi setelah animasi berjalan
          }
        });
      }, observerOptions);

      // Amati semua elemen dengan kelas `.animate-on-scroll`
      document.querySelectorAll('.animate-on-scroll').forEach(element => {
        observer.observe(element);
      });
    });
    document.getElementById('searchBtn').addEventListener('click', function() {
      const type = document.getElementById('vehicleType').value;
      const city = document.getElementById('cityInput').value.trim();

      // Convert city to lowercase, replace spaces with hyphens for a clean URL
      const citySlug = city ? city.toLowerCase().replace(/\s+/g, '-') : 'semua';

      // Build URL like /sewa-mobil-jakarta or /sewa-semua
      let targetUrl = '/sewa-' + (type || 'semua') + '-' + citySlug;

      // Redirect to that page
      window.location.href = targetUrl;
    });
  </script>
@endsection
