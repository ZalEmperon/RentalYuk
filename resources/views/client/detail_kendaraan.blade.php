@extends('client.components.base')

@section('title', 'Detail ' . $vehicle->brand . ' ' . $vehicle->model)


@section('page-content')
<main class="bg-slate-50 py-8">
  <div class="container mx-auto px-6">
    {{-- Breadcrumb Navigation --}}
    <nav class="text-sm mb-4 animate-on-scroll">
      <a href="/" class="text-indigo-600 hover:underline">Home</a>
      <span class="mx-2 text-gray-500">/</span>
      <span class="text-gray-700">{{ $vehicle->brand }} {{ $vehicle->model }}</span>
    </nav>

    {{-- Kartu Utama dengan Efek Kaca --}}
    <div class="bg-white/60 backdrop-blur-xl p-6 md:p-8 rounded-2xl shadow-lg border border-white/20">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- Kolom Kiri: Galeri Gambar --}}
        <div class="lg:col-span-2 animate-on-scroll delay-100">
          {{-- Gambar Utama --}}
          <div class="relative overflow-hidden rounded-lg shadow-md mb-4 group">
            <img id="main-image" src="{{ $vehicle->main_photo_url ? asset('storage/photo/' . $vehicle->type . '/' . $vehicle->main_photo_url) : 'https://placehold.co/800x500/gray/ffffff?text=No+Image' }}" alt="{{ $vehicle->brand }} - Tampilan Utama" class="w-full h-auto aspect-[4/3] object-cover transition-transform duration-500 group-hover:scale-105">
            <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors duration-300"></div>
          </div>

          {{-- Thumbnail --}}
          @if($vehicle->photos->isNotEmpty())
          <div class="grid grid-cols-4 gap-4">
            @foreach($vehicle->photos as $photo)
            <div class="overflow-hidden rounded-lg">
                <img src="{{ asset('storage/photo/' . $vehicle->type . '/' . $photo->photo_url) }}" alt="Thumbnail {{ $loop->iteration }}" class="thumbnail-image w-full h-auto cursor-pointer border-2 border-transparent hover:border-indigo-500 aspect-video object-cover transition-all duration-300 transform hover:scale-110">
            </div>
            @endforeach
          </div>
          @endif
        </div>

        {{-- Kolom Kanan: Detail Kendaraan --}}
        <div class="lg:col-span-1 animate-on-scroll delay-200">
          <h1 class="text-3xl font-bold text-gray-900">{{ $vehicle->brand }} {{ $vehicle->model }}</h1>
          <p class="text-gray-600 mt-1"><strong>Lokasi:</strong> {{ $vehicle->city }}</p>

          {{-- Spesifikasi --}}
          <div class="mt-6 p-4 bg-slate-50 rounded-lg border animate-on-scroll delay-300">
            <h2 class="text-xl font-semibold mb-3 text-gray-800">Spesifikasi</h2>
            <div class="grid grid-cols-2 gap-4 text-sm">
              <div class="flex items-center text-gray-700"><svg class="w-5 h-5 mr-2 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" /></svg><span>{{ $vehicle->transmission }}</span></div>
              <div class="flex items-center text-gray-700"><svg class="w-5 h-5 mr-2 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-4.663M3.75 12.16c0-1.113.285-2.16.786-3.07M3.75 12.16l-.001.109A12.318 12.318 0 008.624 3c2.331 0 4.512.645 6.374 1.766l.001.109a6.375 6.375 0 00-11.964 4.663z" /></svg><span>{{ $vehicle->capacity }} Kursi</span></div>
              <div class="flex items-center text-gray-700"><svg class="w-5 h-5 mr-2 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0h18M-4.5 12h22.5" /></svg><span>{{ $vehicle->year }}</span></div>
              <div class="flex items-center text-gray-700"><svg class="w-5 h-5 mr-2 text-indigo-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.125-.504 1.125-1.125V14.25m-17.25 4.5h16.5M5.625 13.5a1.875 1.875 0 10-3.75 0v1.125c0 .621.504 1.125 1.125 1.125h1.5v1.125c0 .621.504 1.125 1.125 1.125h1.5a1.125 1.125 0 01-1.125-1.125V13.5z" /></svg><span>{{ $vehicle->fuel_type }}</span></div>
            </div>
          </div>

          {{-- Alamat & Deskripsi --}}
          <div class="mt-6 animate-on-scroll delay-400">
            <h2 class="text-xl font-semibold mb-2">Alamat Lengkap</h2>
            <p class="text-gray-600 text-sm leading-relaxed">{{ $vehicle->address }}</p>
          </div>
          <div class="mt-6 animate-on-scroll delay-500">
            <h2 class="text-xl font-semibold mb-2">Deskripsi</h2>
            <p class="text-gray-600 text-sm leading-relaxed">{{ $vehicle->description }}</p>
          </div>

          {{-- Kotak Harga dan Tombol WhatsApp --}}
          <div class="mt-6 bg-gradient-to-br from-indigo-50 to-purple-100 p-6 rounded-lg animate-on-scroll delay-600">
            <p class="text-2xl font-bold text-indigo-600">Rp {{ number_format($vehicle->price_per_day, 0, ',', '.') }} <span class="text-base font-normal text-gray-600">/ hari</span></p>
            <a href="https://wa.me/{{ $vehicle->user->phone }}?text=Halo, saya tertarik untuk menyewa {{ $vehicle->brand }} {{ $vehicle->model }} dari RentalYuk." target="_blank"
               class="w-full mt-4 bg-gradient-to-r from-green-500 to-teal-500 text-white py-3 rounded-lg font-semibold text-lg hover:from-green-600 hover:to-teal-600 transition-all duration-300 flex items-center justify-center shadow-lg hover:shadow-xl transform hover:scale-105">
              <svg class="w-6 h-6 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M16.6 14c-.2-.1-1.5-.7-1.7-.8-.2-.1-.4-.1-.6.1-.2.2-.6.7-.8.9-.1.1-.3.2-.5.1-.2-.1-.9-.3-1.8-1.1-.7-.6-1.1-1.4-1.3-1.6-.1-.2 0-.4.1-.5.1-.1.2-.3.4-.4.1-.1.2-.2.2-.3.1-.1.1-.3 0-.4-.1-.1-1.2-2.8-1.6-3.8-.4-.9-.8-.8-1.1-.8-.3 0-.6-.1-.8-.1-.2 0-.6.1-.9.4-.3.3-1.2 1.1-1.2 2.7 0 1.6 1.2 3.1 1.4 3.3.2.2 2.4 3.7 5.8 5.1.8.3 1.4.5 1.9.7.8.2 1.5.2 2.1.1.7-.1 2.2-1.1 2.5-2.1.3-.9.3-1.7.2-1.9-.1-.2-.4-.3-.6-.4zM12 2C6.5 2 2 6.5 2 12s4.5 10 10 10 10-4.5 10-10S17.5 2 12 2zM9.1 17.5c-1-1.8-1.6-3.6-1.6-5.4 0-3.3 2.7-6 6-6 1.7 0 3.3.7 4.5 1.9s1.9 2.9 1.9 4.5c0 .1 0 .2 0 .3l-1.9-1.9c-.4-.4-1-.4-1.4 0-.4.4-.4 1 0 1.4l2.6 2.6c.2.2.4.3.7.3.3 0 .5-.1.7-.3l2.6-2.6c.4-.4.4-1 0-1.4s-1-.4-1.4 0l-1.9 1.9c0-.1 0-.2 0-.3 0-2.4-2-4.4-4.4-4.4-2.4 0-4.4 2-4.4 4.4 0 1.8.6 3.5 1.5 4.9.4.5 1 .6 1.5.2.5-.4.6-1 .2-1.5z"></path></svg>
              Hubungi via WhatsApp
            </a>
            <p class="text-xs text-center text-gray-500 mt-3">Anda akan diarahkan ke WhatsApp pemilik: <strong>{{ $vehicle->user->name }}</strong></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection


@section('custom-css')
<style>
  /* Keyframes untuk animasi fade-in saat elemen terlihat */
  @keyframes fadeInUpx {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
  }

  /* Kelas untuk elemen yang akan dianimasikan saat scroll */
  .animate-on-scroll {
    opacity: 0; /* Mulai dari transparan */
    transition: opacity 0.8s ease-out, transform 0.8s ease-out;
    transform: translateY(30px); /* Posisi awal sebelum animasi */
  }

  /* Kelas yang ditambahkan oleh JS saat elemen terlihat */
  .is-visible {
    opacity: 1;
    transform: translateY(0);
  }
  
  /* Kelas utilitas untuk delay animasi */
  .delay-100 { transition-delay: 0.1s; }
  .delay-200 { transition-delay: 0.2s; }
  .delay-300 { transition-delay: 0.3s; }
  .delay-400 { transition-delay: 0.4s; }
  .delay-500 { transition-delay: 0.5s; }
  .delay-600 { transition-delay: 0.6s; }
</style>
@endsection


@section('custom-js')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // --- FUNGSI 1: GALERI GAMBAR THUMBNAIL ---
    const mainImage = document.getElementById('main-image');
    const thumbnails = document.querySelectorAll('.thumbnail-image');

    thumbnails.forEach(thumbnail => {
      thumbnail.addEventListener('click', function() {
        // Ganti gambar utama
        mainImage.src = this.src;

        // Atur style border untuk menandai thumbnail aktif
        thumbnails.forEach(t => t.classList.remove('border-indigo-500'));
        this.classList.add('border-indigo-500');
      });
    });

    // --- FUNGSI 2: ANIMASI "POP OUT" SAAT SCROLL ---
    const observerOptions = {
      root: null,
      rootMargin: '0px',
      threshold: 0.1 // Picu saat 10% elemen terlihat
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
</script>
@endsection
