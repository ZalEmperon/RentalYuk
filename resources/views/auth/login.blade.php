<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale-1.0">
  <title>Masuk - RentalYuk</title>
  @vite(['resources/css/app.css'])
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/heroicons/2.1.3/24/outline/heroicons.min.css">
</head>

<body class="bg-gradient-to-br from-indigo-600 to-purple-700 flex items-center justify-center min-h-screen font-inter">

  <div class="w-full max-w-md mx-auto bg-white/20 backdrop-blur-lg p-8 rounded-2xl shadow-2xl border border-white/30">
    <div class="text-center mb-8">
        <div class="flex items-center justify-center gap-x-3 mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-9 h-9 text-white">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6-2.292m0 0A9.043 9.043 0 0 1 9 7.5a9.018 9.018 0 0 1-3-5.25m9 5.25c0-1.591-1.208-2.908-2.754-3.238" />
            </svg>
            <a href="/" class="text-4xl font-bold text-white tracking-wider">RentalYuk</a>
        </div>
      <h2 class="mt-4 text-2xl font-bold text-white">Masuk ke Akun Anda</h2>
      <p class="mt-2 text-sm text-indigo-200">Belum punya akun? <a href="/register"
          class="font-medium text-white hover:underline">Daftar gratis</a></p>
    </div>

    <form action="/login" method="POST">
      @csrf
      @if (session('status'))
        <div class="flex items-center gap-x-3 bg-green-500/80 text-white p-3 rounded-lg mb-4 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
            <span>{{ session('status') }}</span>
        </div>
      @endif
      @if ($errors->any())
        <div class="flex items-center gap-x-3 bg-red-500/80 text-white p-3 rounded-lg mb-4 text-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
            <span>{{ $errors->first() }}</span>
        </div>
      @endif

      <div class="space-y-6">
        <div>
          <label for="email" class="block text-sm font-medium text-gray-200">Email Pengguna</label>
          <div class="mt-1 relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
              </svg>
            </div>
            <input id="email" name="email" type="email" placeholder="contoh@email.com" autocomplete="email" required
              class="w-full pl-10 pr-4 py-3 bg-white/10 text-white placeholder-gray-400 border border-gray-400/50 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition duration-300">
          </div>
        </div>

        <div>
          <div class="flex items-center justify-between">
            <label for="password" class="block text-sm font-medium text-gray-200">Password</label>
            <div class="text-sm">
              <a href="/forgot-password" class="font-medium text-indigo-300 hover:text-white hover:underline">Lupa password?</a>
            </div>
          </div>
          <div class="mt-1 relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <input id="password" placeholder="••••••••" name="password" type="password" autocomplete="current-password"
              required
              class="w-full pl-10 pr-10 py-3 bg-white/10 text-white placeholder-gray-400 border border-gray-400/50 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 transition duration-300">
            <button type="button" id="togglePassword"
              class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-400 hover:text-white focus:outline-none">
              <svg id="eyeIcon" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                </path>
              </svg>
              <svg id="eyeSlashIcon" class="h-5 w-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 1.274-4.057 5.064 7 9.542 7 .847 0 1.673.124 2.458.352M6.125 5.175A10.05 10.05 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.054 10.054 0 01-2.036 3.825m-2.223-2.223a3 3 0 10-4.243-4.243M1 1l22 22">
                </path>
              </svg>
            </button>
          </div>
        </div>

        <div>
          <button type="submit"
            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-lg text-lg font-medium text-white bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transform hover:scale-105 transition-all duration-300">
            Masuk
          </button>
        </div>
      </div>
    </form>
  </div>

  <script>
    // FUNGSI INI TIDAK DIUBAH SAMA SEKALI
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');
    const eyeSlashIcon = document.getElementById('eyeSlashIcon');

    togglePassword.addEventListener('click', function() {
      // Ubah tipe input dari password ke text atau sebaliknya
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);

      // Ganti ikon mata
      eyeIcon.classList.toggle('hidden');
      eyeSlashIcon.classList.toggle('hidden');
    });
  </script>

</body>

</html>