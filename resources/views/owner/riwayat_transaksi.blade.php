@extends('owner.components.base')

@section('title', 'Riwayat Transaksi')

@section('page-content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
  <div class="bg-white rounded-lg shadow-lg">
    <div class="p-6 border-b">
      <h2 class="text-xl font-semibold text-gray-800">Riwayat Transaksi Paket Iklan</h2>
      <p class="text-gray-600 mt-1">Berikut adalah daftar semua transaksi yang pernah Anda lakukan.</p>
    </div>
    <div class="overflow-x-auto">
      <table class="w-full">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor Invoice</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paket</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Tagihan</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bukti</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @forelse ($transactions as $transaction)
            <tr>
              <td class="px-6 py-4 whitespace-nowrap font-mono text-sm text-gray-900">{{ $transaction->invoice_number }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $transaction->plan->name }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $transaction->created_at->format('d M Y, H:i') }}</td>
              <td class="px-6 py-4 whitespace-nowrap">
                @if ($transaction->status == 'success')
                  <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Success</span>
                @elseif ($transaction->status == 'pending')
                  <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                @else
                  <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Failed</span>
                @endif
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                @if ($transaction->status == 'pending')
                    {{-- JIKA STATUS PENDING, TAMPILKAN TOMBOL INI --}}
                    <a href="{{ route('owner.pembayaran.show', $transaction->invoice_number) }}" class="text-white bg-indigo-600 hover:bg-indigo-700 px-3 py-1.5 rounded-md text-xs">
                    Lanjutkan Pembayaran
                    </a>
                @elseif ($transaction->proof_url)
                    {{-- JIKA TIDAK PENDING TAPI ADA BUKTI, TAMPILKAN LINK INI --}}
                    <a href="{{ asset('storage/' . $transaction->proof_url) }}" target="_blank" class="text-indigo-600 hover:underline">
                    Lihat Bukti
                    </a>
                @else
                    {{-- JIKA TIDAK ADA KONDISI DI ATAS, TAMPILKAN INI --}}
                    <span class="text-gray-400">-</span>
                @endif
                </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center py-8 text-gray-500">Anda belum memiliki riwayat transaksi.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</main>
@endsection