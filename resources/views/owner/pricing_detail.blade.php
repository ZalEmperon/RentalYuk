@extends('owner.components.base')

{{-- @section('page-content')
<div class="max-w-xl mx-auto bg-white p-6 rounded-xl shadow">
    <h1 class="text-xl font-bold mb-4">Instruksi Pembayaran</h1>

    <div class="mb-4">
        <p><strong>Paket:</strong> {{ $transaction->plan->name }}</p>
        <p><strong>Harga:</strong> Rp {{ number_format($transaction->plan->price, 0, ',', '.') }}</p>
        @if($transaction->unique_code)
            <p><strong>Kode Unik:</strong> {{ $transaction->unique_code }}</p>
        @endif
        <p class="text-lg font-bold">
            Total Bayar: Rp {{ number_format($transaction->amount, 0, ',', '.') }}
        </p>
    </div>

    <div class="mb-4">
        <h2 class="font-semibold">Rekening Tujuan</h2>
        <p>Bank: BCA</p>
        <p>No. Rekening: 1234567890</p>
        <p>Atas Nama: PT Nemo Aqua</p>
    </div>

    <div class="mb-4">
        <p class="text-red-500 text-sm">
            Bayar sebelum {{ $transaction->expired_at->format('d M Y H:i') }} atau transaksi akan otomatis dibatalkan.
        </p>
    </div>

    Form Upload Bukti Pembayaran
    @if($transaction->status === 'pending')
        <form action="{{ route('transactions.uploadProof', $transaction->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label class="block mb-2">Upload Bukti Transfer:</label>
            <input type="file" name="proof" required class="mb-4">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                Kirim Bukti Pembayaran
            </button>
        </form>
    @else
        <p class="text-green-600 font-semibold">Pembayaran sudah dikonfirmasi.</p>
    @endif
</div>
@endsection --}}


@section('page-content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">

</main>
@endsection