@extends('admin.components.base')

@section('title', 'Manajemen Transaksi')

@section('page-content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
  <div class="bg-white rounded-lg shadow-lg">
    <div class="p-6 border-b">
      <h2 class="text-xl font-semibold text-gray-800">Manajemen Transaksi</h2>
      <p class="text-gray-600 mt-1">Verifikasi pembayaran dan kelola semua transaksi dari pengguna.</p>
    </div>
    <div class="overflow-x-auto">
      <table class="w-full">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Invoice #</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengguna</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Paket</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bukti</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          @forelse ($transactions as $transaction)
            <tr>
              <td class="px-6 py-4 whitespace-nowrap font-mono text-sm">{{ $transaction->invoice_number }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $transaction->user->name }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $transaction->plan->name }}</td>
              <td class="px-6 py-4 whitespace-nowrap text-sm">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</td>
              <td class="px-6 py-4 whitespace-nowrap">
                @if ($transaction->status == 'success')
                  <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Success</span>
                @elseif ($transaction->status == 'pending')
                  <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                @else
                  <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Failed</span>
                @endif
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm">
                @if ($transaction->proof_url)
                  <a href="{{ asset('storage/' . $transaction->proof_url) }}" target="_blank" class="text-indigo-600 hover:underline">Lihat Bukti</a>
                @else
                  <span class="text-gray-400">Belum diunggah</span>
                @endif
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm">
                @if ($transaction->status == 'pending' && $transaction->proof_url)
                  <form action="{{ route('admin.transaksi.update', $transaction->id) }}" method="POST" class="flex items-center gap-2">
                    @csrf
                    @method('PUT')
                    <button type="submit" name="status" value="success" class="bg-green-500 text-white px-2 py-1 rounded-md hover:bg-green-600 text-xs font-semibold">Setujui</button>
                    <button type="submit" name="status" value="failed" class="bg-red-500 text-white px-2 py-1 rounded-md hover:bg-red-600 text-xs font-semibold">Tolak</button>
                  </form>
                @else
                  <span class="text-gray-400">-</span>
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="7" class="text-center py-8 text-gray-500">Tidak ada data transaksi.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</main>
@endsection