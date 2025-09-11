<!-- Header -->
<header class="bg-white shadow-md sticky top-0 z-50">
  <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
    <a href="/" class="text-2xl font-bold text-indigo-600">RentalYuk</a>
    <div class="hidden md:flex space-x-8 items-center">
      <a href="/#mobil" class="text-gray-600 hover:text-indigo-600 transition duration-300">Sewa Mobil</a>
      <a href="/#motor" class="text-gray-600 hover:text-indigo-600 transition duration-300">Sewa Motor</a>
      <a href="/sewa-kendaraan-semua" class="text-gray-600 hover:text-indigo-600 transition duration-300">Pencarian</a>
      <a href="/#tentang" class="text-gray-600 hover:text-indigo-600 transition duration-300">Tentang Kami</a>
    </div>
    <div class="hidden md:flex items-center space-x-4">
      @auth
        <!-- Button trigger -->
        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
          class="text-black bg-violet-50 hover:bg-violet-500 hover:text-white focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center"
          type="button">
          <b>Welcome, {{ auth()->user()->name }}</b>
          <svg class="w-2.5 h-2.5 ms-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m1 1 4 4 4-4" />
          </svg>
        </button>
      @endauth
      @guest
        <a href="/login" class="text-gray-600 hover:text-indigo-600">Masuk</a>
        <a href="/register"
          class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition duration-300">Daftar</a>
      @endguest
    </div>
    <button id="mobile-menu-button" class="md:hidden text-gray-600 hover:text-indigo-600 focus:outline-none">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
      </svg>
    </button>
  </nav>
  <!-- Mobile Menu -->
  <div id="mobile-menu" class="hidden md:hidden px-6 pt-2 pb-4">
    <a href="/#mobil" class="block text-gray-600 hover:text-indigo-600 py-2">Sewa Mobil</a>
    <a href="/#motor" class="block text-gray-600 hover:text-indigo-600 py-2">Sewa Motor</a>
    <a href="/sewa-kendaraan-semua" class="block text-gray-600 hover:text-indigo-600 py-2">Pencarian</a>
    <a href="/#tentang" class="block text-gray-600 hover:text-indigo-600 py-2">Tentang Kami</a>
    <div class="border-t border-gray-200 mt-4 pt-4">
      @auth
        <!-- Button trigger -->
        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown2"
          class="text-black bg-violet-50 w-full hover:bg-violet-500 hover:text-white focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center justify-between"
          type="button">
          Welcome, {{ auth()->user()->name }}
          <svg class="w-2.5 h-2.5 ms-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m1 1 4 4 4-4" />
          </svg>
        </button>
      @endauth
      @guest
        <a href="/login" class="block text-gray-600 hover:text-indigo-600 py-2">Masuk</a>
        <a href="/register"
          class="block bg-indigo-600 text-white text-center px-4 py-2 rounded-md hover:bg-indigo-700 transition duration-300 mt-2">Daftar</a>
      @endguest
    </div>
  </div>
  @auth
    <!-- Dropdown menu -->
    <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 ">
      <ul class="py-2 text-sm text-gray-700 ">
        <li>
          <a href="/{{ auth()->user()->role }}/dashboard"
            class="block px-4 py-2 hover:bg-gray-100">Dashboard</a>
        </li>
        <li>
          <a href="logout" class="block px-4 py-2 hover:bg-gray-100">Log
            out</a>
        </li>
      </ul>
    </div>
    <!-- Dropdown menu -->
    <div id="dropdown2" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 ">
      <ul class="py-2 text-sm text-gray-700 ">
        <li>
          <a href="/{{ auth()->user()->role }}/dashboard"
            class="block px-4 py-2 hover:bg-gray-100">Dashboard</a>
        </li>
        <li>
          <a href="logout" class="block px-4 py-2 hover:bg-gray-100">Log
            out</a>
        </li>
      </ul>
    </div>
  @endauth
</header>
