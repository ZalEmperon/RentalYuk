@extends('admin.components.base')

@section('page-content')
  <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
    <!-- Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      <div class="bg-white p-6 rounded-lg shadow-lg">
        <p class="text-sm text-gray-500">Total Pengguna</p>
        <p class="text-3xl font-bold text-gray-800">{{ $adminStats->jumlah_user }}</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow-lg">
        <p class="text-sm text-gray-500">Total Iklan</p>
        <p class="text-3xl font-bold text-gray-800">{{ $adminStats->jumlah_iklan_approved }}</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow-lg">
        <p class="text-sm text-gray-500">Iklan Pending</p>
        <p class="text-3xl font-bold text-yellow-500">{{ $adminStats->jumlah_iklan_menunggu}}</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow-lg">
        <p class="text-sm text-gray-500">Pendapatan (Bulan Ini)</p>
        <p class="text-3xl font-bold text-green-500">
          Rp {{ number_format($monthlyRevenue, 0, ',', '.') }}
        </p>
      </div>
      <!-- <div class="bg-white p-6 rounded-lg shadow-lg">
        <p class="text-sm text-gray-500">Pendapatan (Bulan Ini)</p>
        <p class="text-3xl font-bold text-green-500">Rp 1.550.000</p>
      </div> -->
    </div>

    <!-- Chart and Recent Transactions -->
    <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-6">
      <div class="lg:col-span-2 bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold mb-4">Statistik Transaksi (6 Bulan Terakhir)</h2>
        <canvas id="transactionsChart"></canvas>
      </div>
      <div class="bg-white p-6 rounded-lg shadow-lg">
        <h3 class="font-semibold text-gray-800 border-b pb-3 mb-4">Pembayaran Terbaru</h3>
        <div class="space-y-4">

          @forelse ($recentTransactions as $transaction)
            <div class="flex justify-between items-center">
              <div>
                <p class="font-medium text-gray-700">{{ $transaction->user->name }}</p>
                <p class="text-sm text-gray-500">Paket {{ $transaction->plan->name }}</p>
              </div>
              <p class="font-semibold text-green-600">+ Rp {{ number_format($transaction->amount, 0, ',', '.') }}</p>
            </div>
          @empty
            <p class="text-sm text-gray-500 text-center py-4">Belum ada pembayaran terbaru.</p>
          @endforelse
          
        </div>
      </div>
  </main>
@endsection

