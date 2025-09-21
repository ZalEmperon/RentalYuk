@extends('client.components.base')

@section('title', 'Detail ' . $vehicleData->brand . ' ' . $vehicleData->model)

@section('seo_element')
  <meta name="description"
    content="Temukan {{ $vehicleData->type . ' ' . $vehicleData->brand . ' ' . $vehicleData->model }} di {{ $vehicleData->city }} dengan harga terbaik. Lihat daftar {{ $vehicleData->type }} matic, sport, dan lainnya yang terbaru. Dapatkan {{ $vehicleData->type }} impianmu sekarang!. {{ $vehicleData->description }}">

  <script type="application/ld+json">
    {!! $vehicleJsonLd !!}
  </script>
@endsection

@section('page-content')
  <main class="container mx-auto px-6 py-8">
    <nav class="text-sm mb-4">
      <a href="/" class="text-indigo-600 hover:underline">Home</a>
      <span class="mx-2 text-gray-500">/</span>
      <span class="text-gray-700">{{ $vehicleData->brand }} {{ $vehicleData->model }}</span>
    </nav>

    <div class="bg-white p-6 md:p-8 rounded-lg shadow-lg">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
          {{-- Gambar Utama --}}
          <img id="main-image"
            src="{{ $vehicleData->photos->isNotEmpty() ? asset('storage/photo/' . $vehicleData->type . '/' . $vehicleData->photos->first()->photo_url) : 'https://placehold.co/800x500/gray/ffffff?text=No+Image' }}"
            alt="{{ $vehicleData->brand }} - Tampilan Utama"
            class="w-full h-auto rounded-lg shadow-md mb-4 aspect-[4/3] object-cover cursor-pointer hover:border-2 hover:border-indigo-500 aspect-video object-cover transition-all duration-300 transform hover:scale-105 transition-transform duration-500">

          {{-- Thumbnail --}}
          @if ($vehicleData->photos->isNotEmpty())
            <div class="grid grid-cols-4 gap-4">
              @foreach ($vehicleData->photos as $photo)
                <img src="{{ asset('storage/photo/' . $vehicleData->type . '/' . $photo->photo_url) }}"
                  alt="Thumbnail {{ $loop->iteration }}"
                  class="thumbnail-image w-full h-auto rounded-lg cursor-pointer hover:border-2 hover:border-indigo-500 aspect-video object-cover transition-all duration-300 transform hover:scale-110 transition-transform duration-500">
              @endforeach
            </div>
          @endif
        </div>

        <div class="lg:col-span-1">
          <h1 class="text-3xl font-bold text-gray-900">{{ $vehicleData->brand }} {{ $vehicleData->model }}</h1>
          <p class="text-gray-600 mt-1"><strong>Lokasi:</strong> {{ $vehicleData->city }}</p>

          <div class="mt-6">
            <h2 class="text-xl font-semibold mb-3">Spesifikasi</h2>
            <div class="grid grid-cols-2 gap-4 text-sm">

              {{-- Icon Transmisi --}}
              <div class="flex items-center text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-indigo-500" fill="currentColor"
                  viewBox="0 0 16 16">
                  <path
                    d="M7.068.727c.243-.97 1.62-.97 1.864 0l.071.286a.96.96 0 0 0 1.622.434l.205-.211c.695-.719 1.888-.03 1.613.931l-.08.284a.96.96 0 0 0 1.187 1.187l.283-.081c.96-.275 1.65.918.931 1.613l-.211.205a.96.96 0 0 0 .434 1.622l.286.071c.97.243.97 1.62 0 1.864l-.286.071a.96.96 0 0 0-.434 1.622l.211.205c.719.695.03 1.888-.931 1.613l-.284-.08a.96.96 0 0 0-1.187 1.187l.081.283c.275.96-.918 1.65-1.613.931l-.205-.211a.96.96 0 0 0-1.622.434l-.071.286c-.243.97-1.62.97-1.864 0l-.071-.286a.96.96 0 0 0-1.622-.434l-.205.211c-.695.719-1.888.03-1.613-.931l.08-.284a.96.96 0 0 0-1.186-1.187l-.284.081c-.96.275-1.65-.918-.931-1.613l.211-.205a.96.96 0 0 0-.434-1.622l-.286-.071c-.97-.243-.97-1.62 0-1.864l.286-.071a.96.96 0 0 0 .434-1.622l-.211-.205c-.719-.695-.03-1.888.931-1.613l.284.08a.96.96 0 0 0 1.187-1.186l-.081-.284c-.275-.96.918-1.65 1.613-.931l.205.211a.96.96 0 0 0 1.622-.434zM12.973 8.5H8.25l-2.834 3.779A4.998 4.998 0 0 0 12.973 8.5m0-1a4.998 4.998 0 0 0-7.557-3.779l2.834 3.78zM5.048 3.967l-.087.065zm-.431.355A4.98 4.98 0 0 0 3.002 8c0 1.455.622 2.765 1.615 3.678L7.375 8zm.344 7.646.087.065z" />
                </svg>
                <span>Transmisi: {{ $vehicleData->transmission }}</span>
              </div>

              {{-- Icon Kapasitas --}}
              <div class="flex items-center text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-indigo-500" fill="currentColor"
                  viewBox="0 0 16 16">
                  <path
                    d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                </svg>
                <span>Kapasitas: {{ $vehicleData->capacity }} Kursi</span>
              </div>

              {{-- Icon Tahun --}}
              <div class="flex items-center text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-indigo-500" fill="currentColor"
                  viewBox="0 0 16 16">
                  <path
                    d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2M9.5 7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5m3 0h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5M2 10.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3.5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5" />
                </svg>
                <span>Tahun: {{ $vehicleData->year }}</span>
              </div>

              {{-- Icon Bahan Bakar --}}
              <div class="flex items-center text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-5 mr-2 text-indigo-500"
                  viewBox="0 0 16 16">
                  <path
                    d="M1 2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v8a2 2 0 0 1 2 2v.5a.5.5 0 0 0 1 0V8h-.5a.5.5 0 0 1-.5-.5V4.375a.5.5 0 0 1 .5-.5h1.495c-.011-.476-.053-.894-.201-1.222a.97.97 0 0 0-.394-.458c-.184-.11-.464-.195-.9-.195a.5.5 0 0 1 0-1q.846-.002 1.412.336c.383.228.634.551.794.907.295.655.294 1.465.294 2.081V7.5a.5.5 0 0 1-.5.5H15v4.5a1.5 1.5 0 0 1-3 0V12a1 1 0 0 0-1-1v4h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1zm2.5 0a.5.5 0 0 0-.5.5v5a.5.5 0 0 0 .5.5h5a.5.5 0 0 0 .5-.5v-5a.5.5 0 0 0-.5-.5z" />
                </svg>
                <span>Bahan Bakar: {{ $vehicleData->fuel_type }}</span>
              </div>

            </div>
          </div>
          <div class="mt-6">
            <h2 class="text-xl font-semibold mb-2">Alamat Lengkap</h2>
            <p class="text-gray-600 text-sm leading-relaxed">{{ $vehicleData->address }}</p>
          </div>

          <div class="mt-6">
            <h2 class="text-xl font-semibold mb-2">Deskripsi</h2>
            <p class="text-gray-600 text-sm leading-relaxed">{{ $vehicleData->description }}</p>
          </div>

          <div class="mt-6 bg-indigo-50 p-6 rounded-lg">
            <p class="text-2xl font-bold text-indigo-600">Rp
              {{ number_format($vehicleData->price_per_day, 0, ',', '.') }} <span
                class="text-base font-normal text-gray-600">/ hari</span></p>
            @php
              $whatsapp_message = urlencode(
                  'Halo, saya tertarik untuk menyewa ' .
                      $vehicleData->brand .
                      ' ' .
                      $vehicleData->model .
                      ' dari RentalYuk.',
              );
              $whatsapp_link = 'https://wa.me/' . $vehicleData->user->phone . '?text=' . $whatsapp_message;
            @endphp
            <a href="{{ $whatsapp_link }}" target="_blank"
              class="w-full mt-4 bg-green-500 text-white py-3 rounded-lg font-semibold text-lg hover:bg-green-600 transition duration-300 flex items-center justify-center">
              <svg class="w-6 h-6 mr-2" ...></svg>
              Hubungi via WhatsApp
            </a>
            <p class="text-xs text-center text-gray-500 mt-3">Anda akan diarahkan ke WhatsApp pemilik:
              <strong>{{ $vehicleData->user->name }}</strong>
            </p>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection

@section('custom-js')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const mainImage = document.getElementById('main-image');
      const thumbnails = document.querySelectorAll('.thumbnail-image');

      thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', function() {
          // Ganti gambar utama dengan gambar thumbnail yang diklik
          mainImage.src = this.src;

          // Atur style border untuk menandai thumbnail aktif
          thumbnails.forEach(t => t.classList.remove('border-2', 'border-indigo-500'));
          this.classList.add('border-2', 'border-indigo-500');
        });
      });
    });
    fetch('/api/vehicles/{{ $vehicleData->id }}/increment-view', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Content-Type': 'application/json'
        }
      })
      .then(res => res.json())
      .then(data => console.log('New views count:', data.views));
  </script>
@endsection
