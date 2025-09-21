<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Akun Baru - RentalYuk</title>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  @vite('resources/css/app.css')
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-animated-gradient flex items-center justify-center min-h-screen font-inter">

<div data-aos="fade-up" class="w-full max-w-md mx-auto bg-white/20 backdrop-blur-lg p-8 rounded-2xl shadow-2xl border border-white/30">
<div class="text-center mb-8">
<a href="/" class="text-4xl font-bold text-white tracking-wider">RentalYuk</a>
      <h2 class="mt-4 text-2xl font-bold text-white">Buat Akun Baru</h2>
      <p class="mt-2 text-sm text-indigo-200">Sudah punya akun? <a href="/login"
          class="font-medium text-white hover:underline">Masuk di sini</a></p>
    </div>
    <form action="/register" method="POST">
      @csrf
      <div class="space-y-6">
        @if (session('status'))
          <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('status') }}
          </div>
        @endif
        @if ($errors->any())
          <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        <div>
        <label for="name" class="block text-sm font-medium text-gray-200">Nama Lengkap</label>
          <div class="mt-1">
            {{-- Ganti class input --}}
            <input id="name" name="name" type="text" required placeholder="Nama Pengguna"
              class="w-full px-4 py-3 bg-white text-gray-900 placeholder-gray-400 border border-gray-400/50 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition">
          </div>
        </div>
        <div>
          <label for="email" class="block text-sm font-medium text-gray-200">Alamat Email</label>
          <div class="mt-1">
            <input id="email" name="email" type="email" autocomplete="email" required placeholder="contoh@email.com"
              class="w-full px-4 py-3 bg-white text-gray-900 placeholder-gray-400 border border-gray-400/50 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition">
          </div>
        </div>
        <div>
          <label for="phone" class="block text-sm font-medium text-gray-200">Nomor WhatsApp</label>
          <div class="mt-1">
            <input id="phone" name="phone" type="tel" required placeholder="Gunakan awalan 62 (62818...)"
              class="w-full px-4 py-3 bg-white text-gray-900 placeholder-gray-400 border border-gray-400/50 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition">
          </div>
        </div>
        <div>
          <label for="password" class="block text-sm font-medium text-gray-200">Password</label>
          <div class="mt-1">
            <input id="password" name="password" type="password" autocomplete="new-password" required placeholder="Minimal 8 Karakter"
              class="w-full px-4 py-3 bg-white text-gray-900 placeholder-gray-400 border border-gray-400/50 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition">
          </div>
        </div>
        <div>
          <label for="password_confirmation" class="block text-sm font-medium text-gray-200">Konfirmasi Password</label>
          <div class="mt-1">
            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
              required placeholder="Ulangi password Anda"
              class="w-full px-4 py-3 bg-white text-gray-900 placeholder-gray-400 border border-gray-400/50 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition">
          </div>
        </div>
        <div>
        <button type="submit"
            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-lg text-lg font-medium text-white bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transform hover:scale-105 transition-all duration-300">
            Daftar
          </button>
        </div>
      </div>
    </form>
  </div>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({ duration: 800, once: true });
  </script>
</body>

</html>
