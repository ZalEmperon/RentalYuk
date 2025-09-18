@extends('owner.components.base')
@section('title', 'Pembayaran Invoice')

@section('page-content')
<main class="flex-1 bg-gray-100 p-6">
  <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-lg">
    <div class="text-center border-b pb-6 mb-6">
      <h1 class="text-2xl font-bold text-gray-800">Pembayaran Invoice</h1>
      <p class="font-mono text-indigo-600 font-bold">{{ $transaction->invoice_number }}</p>
    </div>
    
    <div class="space-y-4 text-sm">
      <div class="flex justify-between items-baseline">
        <span class="font-semibold text-gray-600">Total Tagihan:</span>
        <span class="text-2xl font-bold text-red-600">Rp {{ number_format($transaction->amount, 0, ',', '.') }}</span>
      </div>
      <div class="flex justify-between">
        <span class="font-semibold text-gray-600">Status:</span>
        <span class="px-3 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">{{ ucfirst($transaction->status) }}</span>
      </div>
    </div>

    <div class="mt-8 pt-6 border-t">
      <h2 class="text-lg font-semibold text-gray-800 mb-4">Silakan Transfer ke Rekening Berikut:</h2>
      <div class="bg-gray-50 p-4 rounded-lg">
        <p class="font-bold">Bank Central Asia (BCA)</p>
        <p>Nomor Rekening: <strong class="text-lg">1234567890</strong></p>
        <p>Atas Nama: <strong class="text-lg">PT RentalYuk Indonesia</strong></p>
      </div>
    </div>

    {{-- Form Upload Bukti Pembayaran --}}
    <div class="mt-8 pt-6 border-t">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Unggah Bukti Pembayaran</h2>
        @if ($transaction->proof_url)
            <div class="mb-4">
                <p class="text-sm text-green-600 mb-2">Anda sudah mengunggah bukti. Anda bisa menggantinya dengan yang baru.</p>
                <a href="{{ asset('storage/' . $transaction->proof_url) }}" target="_blank" class="text-indigo-600 hover:underline">Lihat Bukti Saat Ini</a>
            </div>
        @endif
        <form action="{{ route('owner.pembayaran.upload', $transaction->invoice_number) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="proof" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
            @error('proof') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            <button type="submit" class="w-full mt-4 bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 font-semibold text-sm">Unggah Bukti</button>
        </form>
    </div>
  </div>
</main>
@endsection