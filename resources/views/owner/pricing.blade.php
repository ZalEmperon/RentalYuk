<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Paket - RentalYuk</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
  <main class="min-h-screen w-full animated-silver-black-bg font-sans flex items-center justify-center py-12 px-4">
  {{-- Kontainer putih untuk membungkus konten --}}
  <div class="max-w-4xl w-full mx-auto bg-white rounded-2xl shadow-2xl p-8 md:p-12">
    <div class="text-center mb-10 animate-on-scroll">
      <h1 class="text-4xl font-extrabold text-gray-900">Pilih Paket Iklan Anda</h1>
      <p class="text-gray-500 mt-2">Tingkatkan visibilitas kendaraan Anda dan jangkau lebih banyak penyewa.</p>
    </div>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-stretch">

        <div class="flex flex-col p-8 bg-slate-100 border rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 animate-on-scroll delay-100">
          <form action="/owner/pricing" method="POST" class="flex flex-col h-full">
            @csrf
            <input type="hidden" name="plan_id" value="free">
            <h3 class="text-2xl font-semibold text-gray-800">Gratis</h3>
            <p class="mt-2 text-gray-500">Cocok untuk memulai.</p>
            <div class="my-6">
              <span class="text-5xl font-bold text-gray-800">Rp 0</span>
            </div>
            <ul class="space-y-3 mb-6 text-gray-600">
              <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>1 Iklan Aktif</li>
            </ul>
            <button type="submit"
              class="mt-auto w-full px-5 py-3 rounded-xl text-center bg-gray-200 text-gray-800 font-medium hover:bg-gray-300 transition-all duration-300 transform hover:scale-105">
              Pilih Paket Gratis
            </button>
          </form>
        </div>

        <div class="relative flex flex-col p-8 bg-gradient-to-br from-gray-800 to-black text-white rounded-2xl shadow-2xl transform scale-105 animate-on-scroll delay-200">
          <div class="absolute top-0 right-0 -mt-3 mr-3">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-indigo-500 text-white">Paling Populer</span>
          </div>
          <form action="/owner/pricing" method="POST" class="flex flex-col h-full">
            @csrf
            <input type="hidden" name="plan_id" value="premium">
            <h3 class="text-2xl font-semibold">Premium</h3>
            <p class="mt-2 text-gray-300">Untuk visibilitas lebih.</p>
            <div class="my-6">
              <span class="text-5xl font-bold">Rp 50.000</span>
              <span class="text-gray-400">/ bulan</span>
            </div>
            <ul class="space-y-3 mb-6">
              <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>5 Iklan Aktif</li>
              <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>Statistik Iklan</li>
            </ul>
            <button type="submit"
              class="mt-auto w-full px-5 py-3 rounded-xl text-center bg-indigo-500 text-white font-bold hover:bg-indigo-400 transition-all duration-300 transform hover:scale-105">
              Pilih Paket Premium
            </button>
          </form>
        </div>
        
        <div class="flex flex-col p-8 bg-slate-100 border rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2 animate-on-scroll delay-300">
          <form action="/owner/pricing" method="POST" class="flex flex-col h-full">
            @csrf
            <input type="hidden" name="plan_id" value="premium_plus">
            <h3 class="text-2xl font-semibold text-gray-800">Premium Plus</h3>
            <p class="mt-2 text-gray-500">Visibilitas maksimal.</p>
            <div class="my-6">
              <span class="text-5xl font-bold text-gray-800">Rp 100.000</span>
              <span class="text-gray-500">/ bulan</span>
            </div>
            <ul class="space-y-3 mb-6 text-gray-600">
              <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>15 Iklan Aktif</li>
              <li class="flex items-center"><svg class="w-5 h-5 mr-2 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>Statistik Iklan</li>
              <li class="flex items-center font-bold text-indigo-600"><svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>Iklan di-Highlight</li>
            </ul>
            <button type="submit"
              class="mt-auto w-full px-5 py-3 rounded-xl text-center bg-gray-800 text-white font-medium hover:bg-black transition-all duration-300 transform hover:scale-105">
              Pilih Paket Plus
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>
@include('admin.components.status_popup')
<body>

<style>
  .animated-silver-black-bg {
    background: linear-gradient(-45deg, #111827, #4b5563, #d1d5db, #374151);
    background-size: 400% 400%;
    animation: gradientShift 15s ease infinite;
  }
  @keyframes gradientShift {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }

  .animated-border {
    background-size: 200% 200%;
    animation: borderShift 5s ease infinite;
  }
  @keyframes borderShift {
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
  .delay-300 { transition-delay: 0.3s; }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const observerOptions = { root: null, rootMargin: '0px', threshold: 0.1 };
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