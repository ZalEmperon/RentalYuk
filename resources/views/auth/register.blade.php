<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF--O">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Akun Baru - RentalYuk</title>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  @vite('resources/css/app.css')
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  
  {{-- [TAMBAHAN] CSS untuk animasi logo berjatuhan --}}
  <style>
    .bg-animated-gradient {
      background: linear-gradient(-45deg, #4f46e5, #7c3aed, #a855f7, #6366f1);
      background-size: 400% 400%;
      animation: gradientShift 15s ease infinite;
    }

    @keyframes gradientShift {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    /* Area untuk menampung logo yang jatuh */
    .falling-logos {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: 0;
    }

    /* Masing-masing logo */
    .falling-logos .logo {
      position: absolute;
      display: block;
      width: 40px; /* Ukuran logo */
      height: 40px;
      opacity: 0.2; /* Transparansi logo */
      animation: fall 15s linear infinite;
      top: -150px; /* Mulai dari atas layar */
      color: white; /* Warna SVG */
    }

    /* Animasi jatuh */
    @keyframes fall {
      0% {
        transform: translateY(0) rotate(0deg);
        opacity: 0.2;
      }
      100% {
        transform: translateY(100vh) rotate(360deg); /* Jatuh ke bawah sambil berputar */
        opacity: 0.1;
      }
    }

    /* Memberi delay dan posisi horizontal yang berbeda untuk setiap logo */
    .falling-logos .logo:nth-child(1) { left: 10%; animation-delay: 0s; width: 50px; height: 50px; }
    .falling-logos .logo:nth-child(2) { left: 20%; animation-delay: 2s; animation-duration: 12s; }
    .falling-logos .logo:nth-child(3) { left: 30%; animation-delay: 4s; width: 30px; height: 30px; }
    .falling-logos .logo:nth-child(4) { left: 40%; animation-delay: 1s; animation-duration: 18s; }
    .falling-logos .logo:nth-child(5) { left: 50%; animation-delay: 3s; width: 60px; height: 60px; }
    .falling-logos .logo:nth-child(6) { left: 60%; animation-delay: 5s; }
    .falling-logos .logo:nth-child(7) { left: 70%; animation-delay: 2.5s; animation-duration: 14s; }
    .falling-logos .logo:nth-child(8) { left: 80%; animation-delay: 6s; width: 35px; height: 35px; }
    .falling-logos .logo:nth-child(9) { left: 90%; animation-delay: 3.5s; animation-duration: 20s; }
  </style>
</head>

<body class="bg-animated-gradient flex items-center justify-center min-h-screen font-inter py-12">

{{-- [TAMBAHAN] Kontainer untuk menampung logo yang berjatuhan --}}
<div class="falling-logos">
    @for ($i = 0; $i < 9; $i++)
        <div class="logo">
            {{-- Ini adalah SVG logo Anda --}}
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6-2.292m0 0A9.043 9.043 0 0 1 9 7.5a9.018 9.018 0 0 1-3-5.25m9 5.25c0-1.591-1.208-2.908-2.754-3.238" />
            </svg>
        </div>
    @endfor
</div>

{{-- [MODIFIKASI] Kartu daftar diberi z-index dan sedikit margin vertikal (my-8) --}}
<div data-aos="fade-up" class="w-full max-w-md mx-auto bg-white/20 backdrop-blur-lg p-8 rounded-2xl shadow-2xl border border-white/30 relative z-10 my-8">
<div class="text-center mb-8">
<a href="/" class="text-4xl font-bold text-white tracking-wider">RentalYuk</a>
      <h2 class="mt-4 text-2xl font-bold text-white">Buat Akun Baru</h2>
      <p class="mt-2 text-sm text-indigo-200">Sudah punya akun? <a href="/login"
          class="font-medium text-white hover:underline">Masuk di sini</a></p>
    </div>
    <form action="/register" method="POST">
      @csrf
      <div class="space-y-4"> {{-- [MODIFIKASI] Mengurangi space-y menjadi 4 --}}
        @if (session('status'))
          <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('status') }}
          </div>
        @endif
        @if ($errors->any())
          <div class="bg-red-500/80 text-white p-3 rounded-lg text-sm">
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
            <input id="name" name="name" type="text" required placeholder="Nama Pengguna"
              class="w-full px-4 py-3 bg-white/10 text-white placeholder-gray-300 border border-gray-400/50 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition">
          </div>
        </div>
        <div>
          <label for="email" class="block text-sm font-medium text-gray-200">Alamat Email</label>
          <div class="mt-1">
            <input id="email" name="email" type="email" autocomplete="email" required placeholder="contoh@email.com"
              class="w-full px-4 py-3 bg-white/10 text-white placeholder-gray-300 border border-gray-400/50 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition">
          </div>
        </div>
        <div>
          <label for="phone" class="block text-sm font-medium text-gray-200">Nomor WhatsApp</label>
          <div class="mt-1">
            <input id="phone" name="phone" type="tel" required placeholder="Gunakan awalan 62 (62818...)"
              class="w-full px-4 py-3 bg-white/10 text-white placeholder-gray-300 border border-gray-400/50 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition">
          </div>
        </div>
        <div>
          <label for="password" class="block text-sm font-medium text-gray-200">Password</label>
          <div class="mt-1">
            <input id="password" name="password" type="password" autocomplete="new-password" required placeholder="Minimal 8 Karakter"
              class="w-full px-4 py-3 bg-white/10 text-white placeholder-gray-300 border border-gray-400/50 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition">
          </div>
        </div>
        <div>
          <label for="password_confirmation" class="block text-sm font-medium text-gray-200">Konfirmasi Password</label>
          <div class="mt-1">
            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
              required placeholder="Ulangi password Anda"
              class="w-full px-4 py-3 bg-white/10 text-white placeholder-gray-300 border border-gray-400/50 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition">
          </div>
        </div>
        <div class="pt-2"> {{-- [MODIFIKASI] Menambah padding-top --}}
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