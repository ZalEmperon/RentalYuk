
@extends('client.components.base') 


@section('title', 'Pilih Paket Iklan - RentalYuk')


@section('page-content')
<main class="min-h-screen w-full animated-silver-black-bg font-sans flex items-center justify-center py-12 px-4">
    
  {{-- Kontainer putih untuk membungkus konten --}}
  <div class="max-w-4xl w-full mx-auto bg-white rounded-2xl shadow-2xl p-8 md:p-12">
    
    <div class="text-center mb-10 animate-on-scroll">
      <h1 class="text-4xl font-extrabold text-gray-900">Pilih Paket Iklan Anda</h1>
      <p class="text-gray-500 mt-2">Tingkatkan visibilitas kendaraan Anda dan jangkau lebih banyak penyewa.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

      <div class="flex flex-col p-8 bg-slate-50 border rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 animate-on-scroll delay-100">
        <form action="/owner/pricing" method="POST" class="flex flex-col h-full">
          @csrf
          <input type="hidden" name="plan_id" value="1">
          <h3 class="text-2xl font-semibold text-gray-800">Paket Gratis</h3>
          <p class="mt-2 text-gray-500">Cocok untuk memulai dan mencoba platform kami.</p>
          <div class="my-6">
            <span class="text-5xl font-bold text-gray-800">Rp 0</span>
            <span class="text-gray-500">/ bulan</span>
          </div>
          <ul class="space-y-3 mb-6 text-gray-600">
            <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>Maksimal 1 iklan aktif</li>
            <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>1 foto per iklan</li>
            <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>Ditampilkan 7 hari</li>
            <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>Tidak ada statistik detail</li>
          </ul>
          <button type="submit"
            class="mt-auto w-full px-5 py-3 rounded-xl text-center bg-gray-200 text-gray-800 font-medium hover:bg-gray-300 transition-all duration-300 transform hover:scale-105">
            Pilih Paket Gratis
          </button>
        </form>
      </div>

      <div class="relative flex flex-col p-8 bg-gradient-to-br from-gray-800 to-black text-white rounded-2xl shadow-2xl transform hover:scale-[1.03] transition-all duration-300 animate-on-scroll delay-200">
        <div class="absolute top-0 right-0 -mt-3 mr-3">
          <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-indigo-500 text-white">Paling Populer</span>
        </div>
        <form action="/owner/pricing" method="POST" class="flex flex-col h-full">
          @csrf
          <input type="hidden" name="plan_id" value="2">
          <h3 class="text-2xl font-semibold">Paket Premium</h3>
          <p class="mt-2 text-gray-300">Untuk visibilitas maksimal dan fitur lengkap.</p>
          <div class="my-6">
            <span class="text-5xl font-bold">Rp 99.000</span>
            <span class="text-gray-400">/ bulan</span>
          </div>
          <ul class="space-y-3 mb-6">
            <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>Iklan tak terbatas</li>
            <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>Hingga 10 foto per iklan</li>
            <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>Prioritas tampil di pencarian</li>
            <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>Statistik lengkap (tayangan & klik)</li>
            <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>Support prioritas</li>
          </ul>
          <button type="submit"
            class="mt-auto w-full px-5 py-3 rounded-xl text-center bg-indigo-500 text-white font-bold hover:bg-indigo-400 transition-all duration-300 transform hover:scale-105">
            Pilih Paket Premium
          </button>
        </form>
      </div>
      
    </div>
  </div>
</main>
@endsection

@section('custom-css')
<style>
  .animated-silver-black-bg {
    background: linear-gradient(
      -45deg,
      #111827, /* gray-900 */
      #4b5563, /* gray-600 */
      #d1d5db, /* gray-300 */
      #374151  /* gray-700 */
    );
    background-size: 400% 400%;
    animation: gradientShift 15s ease infinite;
  }

  @keyframes gradientShift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
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
  
  .delay-100 { transition-delay: 0.1s; }
  .delay-200 { transition-delay: 0.2s; }
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
</script>
@endsection