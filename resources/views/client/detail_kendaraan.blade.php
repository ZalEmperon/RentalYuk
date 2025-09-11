@extends('client.components.base')

@section('title', 'Detail ' . $vehicle->brand . ' ' . $vehicle->model)

@section('page-content')
  <main class="container mx-auto px-6 py-8">
    <nav class="text-sm mb-4">
      <a href="/" class="text-indigo-600 hover:underline">Home</a>
      <span class="mx-2 text-gray-500">/</span>
      <span class="text-gray-700">{{ $vehicle->brand }} {{ $vehicle->model }}</span>
    </nav>

    <div class="bg-white p-6 md:p-8 rounded-lg shadow-lg">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
          {{-- Gambar Utama --}}
          <img id="main-image" src="{{ $vehicle->main_photo_url ? asset('storage/photo/' . $vehicle->type . '/' . $vehicle->main_photo_url) : 'https://placehold.co/800x500/gray/ffffff?text=No+Image' }}" alt="{{ $vehicle->brand }} - Tampilan Utama" class="w-full h-auto rounded-lg shadow-md mb-4 aspect-[4/3] object-cover cursor-pointer hover:border-2 hover:border-indigo-500 aspect-video object-cover transition-all duration-300 transform hover:scale-105 transition-transform duration-500">

          {{-- Thumbnail --}}
          @if($vehicle->photos->isNotEmpty())
          <div class="grid grid-cols-4 gap-4">
            @foreach($vehicle->photos as $photo)
            <img src="{{ asset('storage/photo/' . $vehicle->type . '/' . $photo->photo_url) }}" alt="Thumbnail {{ $loop->iteration }}" class="thumbnail-image w-full h-auto rounded-lg cursor-pointer hover:border-2 hover:border-indigo-500 aspect-video object-cover transition-all duration-300 transform hover:scale-110 transition-transform duration-500">
            @endforeach
          </div>
          @endif
        </div>

        <div class="lg:col-span-1">
          <h1 class="text-3xl font-bold text-gray-900">{{ $vehicle->brand }} {{ $vehicle->model }}</h1>
          <p class="text-gray-600 mt-1"><strong>Lokasi:</strong> {{ $vehicle->city }}</p>

          <div class="mt-6">
  <h2 class="text-xl font-semibold mb-3">Spesifikasi</h2>
  <div class="grid grid-cols-2 gap-4 text-sm">
    
    {{-- Icon Transmisi --}}
    <div class="flex items-center text-gray-700">
      <svg class="w-5 h-5 mr-2 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
      </svg>
      <span>Transmisi: {{ $vehicle->transmission }}</span>
    </div>

    {{-- Icon Kapasitas --}}
    <div class="flex items-center text-gray-700">
      <svg class="w-5 h-5 mr-2 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-4.663M3.75 12.16c0-1.113.285-2.16.786-3.07M3.75 12.16l-.001.109A12.318 12.318 0 008.624 3c2.331 0 4.512.645 6.374 1.766l.001.109a6.375 6.375 0 00-11.964 4.663z" />
      </svg>
      <span>Kapasitas: {{ $vehicle->capacity }} Kursi</span>
    </div>

    {{-- Icon Tahun --}}
    <div class="flex items-center text-gray-700">
      <svg class="w-5 h-5 mr-2 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0h18M-4.5 12h22.5" />
      </svg>
      <span>Tahun: {{ $vehicle->year }}</span>
    </div>

    {{-- Icon Bahan Bakar --}}
    <div class="flex items-center text-gray-700">
      <svg class="w-5 h-5 mr-2 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125V14.25m-17.25 4.5h16.5M5.625 13.5a1.875 1.875 0 10-3.75 0v1.125c0 .621.504 1.125 1.125 1.125h1.5v1.125c0 .621.504 1.125 1.125 1.125h1.5a1.125 1.125 0 01-1.125-1.125V13.5z" />
      </svg>
      <span>Bahan Bakar: {{ $vehicle->fuel_type }}</span>
    </div>

  </div>
</div>

          <div class="mt-6">
              <h2 class="text-xl font-semibold mb-2">Alamat Lengkap</h2>
              <p class="text-gray-600 text-sm leading-relaxed">{{ $vehicle->address }}</p>
          </div>

          <div class="mt-6">
            <h2 class="text-xl font-semibold mb-2">Deskripsi</h2>
            <p class="text-gray-600 text-sm leading-relaxed">{{ $vehicle->description }}</p>
          </div>

          <div class="mt-6 bg-indigo-50 p-6 rounded-lg">
            <p class="text-2xl font-bold text-indigo-600">Rp {{ number_format($vehicle->price_per_day, 0, ',', '.') }} <span class="text-base font-normal text-gray-600">/ hari</span></p>
            <a href="https://wa.me/{{ $vehicle->user->phone }}?text=Halo, saya tertarik untuk menyewa {{ $vehicle->brand }} {{ $vehicle->model }} dari RentalYuk." target="_blank"
              class="w-full mt-4 bg-green-500 text-white py-3 rounded-lg font-semibold text-lg hover:bg-green-600 transition duration-300 flex items-center justify-center">
              <svg class="w-6 h-6 mr-2" ...></svg>
              Hubungi via WhatsApp
            </a>
            <p class="text-xs text-center text-gray-500 mt-3">Anda akan diarahkan ke WhatsApp pemilik: <strong>{{ $vehicle->user->name }}</strong></p>
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
</script>
@endsection