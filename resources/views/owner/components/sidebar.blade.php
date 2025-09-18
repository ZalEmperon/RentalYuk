<!-- Sidebar -->
<aside id="default-sidebar"
  class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
  aria-label="Sidenav">
  <div class="overflow-y-auto py-5 px-3 h-full bg-slate-900 border-r border-slate-700">
    <ul class="space-y-2">
      <li>
        <a href="/" class="text-2xl font-bold text-white pb-4 border-b border-slate-700 block text-center">RentalYuk</a>
      </li>
      <li>
        <!-- Menghapus 'group' dari <a> dan 'group-hover' dari <svg> -->
        <a href="/owner/dashboard"
          class="flex items-center p-2 text-base font-normal text-gray-300 rounded-lg hover:bg-slate-700 hover:text-white">
          <!-- Ikon sekarang memiliki warna tetap -->
          <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
            </path>
          </svg>
          <span class="ml-3">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="/owner/form-iklan"
          class="flex items-center p-2 text-base font-normal text-gray-300 rounded-lg hover:bg-slate-700 hover:text-white">
          <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M9 17v-2a4 4 0 00-4-4H3V9h2a4 4 0 004-4V3l5 4-5 4zm6 0v-2a4 4 0 014-4h2V9h-2a4 4 0 01-4-4V3l-5 4 5 4z">
            </path>
          </svg>
          <span class="ml-3">Iklan Saya</span>
        </a>
      </li>
      <li>
        <a href="{{ route('owner.paket.show') }}" class="flex items-center p-2 text-base font-normal text-gray-300 rounded-lg hover:bg-slate-700 hover:text-white">
          <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
          <span class="ml-3">Paket Saya</span>
        </a>
      </li>

      <li>
        <a href="{{ route('owner.transaksi.riwayat') }}" class="flex items-center p-2 text-base font-normal text-gray-300 rounded-lg hover:bg-slate-700 hover:text-white">
          <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
          <span class="ml-3">Riwayat Transaksi</span>
        </a>
      </li>
      <li>
        <a href="/owner/pengaturan"
          class="flex items-center p-2 text-base font-normal text-gray-300 rounded-lg hover:bg-slate-700 hover:text-white">
          <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
            </path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
            </path>
          </svg>
          <span class="ml-3">Pengaturan</span>
        </a>
      </li>
    </ul>
  </div>
  <div class="absolute bottom-0 left-0 p-4 space-x-4 w-full bg-slate-900 z-20">
    <ul class="pt-4 border-t border-slate-700">
      <li>
        <a href="/logout"
          class="flex items-center p-2 text-base font-normal text-gray-300 rounded-lg transition duration-75 hover:bg-slate-700 hover:text-white">
          <svg class="w-5 h-5 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
          </svg>
          Logout
        </a>
      </li>
    </ul>
  </div>
</aside>
