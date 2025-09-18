@extends('owner.components.base')

@section('title', 'Perbandingan Paket Iklan')

@section('page-content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
  <div class="container mx-auto">
    <div class="text-center mb-12">
      <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900">Perbandingan Paket Iklan</h1>
      <p class="mt-3 text-lg text-gray-600 max-w-2xl mx-auto">Pilih paket yang paling sesuai untuk memaksimalkan jangkauan iklan kendaraan Anda.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-stretch">
      @foreach ($plans as $plan)
        {{-- Kartu Paket --}}
        <div class="relative flex flex-col bg-white p-8 rounded-2xl shadow-lg border-2 {{ $plan->id == $currentPlan->plan_id ? 'border-indigo-500' : 'border-transparent' }} transition-all duration-300">
          
          {{-- Badge "Paket Anda" --}}
          @if ($plan->id == $currentPlan->plan_id)
            <div class="absolute top-0 -translate-y-1/2 w-full flex justify-center">
              <span class="bg-indigo-600 text-white text-xs font-bold px-4 py-1.5 rounded-full uppercase">Paket Anda</span>
            </div>
          @endif
          
          <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-800">{{ $plan->name }}</h2>
            <p class="mt-2 text-gray-500 text-sm h-12">{{ $plan->description }}</p>
          </div>

          <div class="my-6 text-center">
            @if(is_null($plan->price))
              <span class="text-5xl font-extrabold text-gray-900">Gratis</span>
            @else
              <span class="text-5xl font-extrabold text-gray-900">Rp {{ number_format($plan->price, 0, ',', '.') }}</span>
              <span class="text-gray-500">/ bulan</span>
            @endif
          </div>

          <ul class="space-y-4 text-gray-600 mb-8">
            <li class="flex items-center">
              <svg class="w-5 h-5 mr-3 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
              <span><strong>{{ $plan->quota_ads }}</strong> Iklan Aktif</span>
            </li>
            <li class="flex items-center">
              <svg class="w-5 h-5 mr-3 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
              <span>Aktif Selama <strong>{{ is_null($plan->duration_days) ? 'Selamanya' : $plan->duration_days . ' hari' }}</strong></span>
            </li>
            @if ($plan->name != 'Gratis')
              <li class="flex items-center">
                <svg class="w-5 h-5 mr-3 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                <span><strong>Highlight</strong> Iklan Premium</span>
              </li>
            @else
              <li class="flex items-center text-gray-400">
                <svg class="w-5 h-5 mr-3" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                <span>Highlight Iklan Premium</span>
              </li>
            @endif
          </ul>

          <div class="mt-auto">
  @if ($currentPlan && $plan->id == $currentPlan->plan_id)
    {{-- Jika ini adalah paket yang sedang aktif --}}
    <button disabled class="w-full py-3 px-6 rounded-lg bg-gray-300 text-gray-500 font-semibold cursor-not-allowed">
      Paket Aktif
    </button>
  @elseif ($currentPlan && $currentPlan->plan_id == $highestPlan->id)
    {{-- Jika pengguna sudah punya paket tertinggi, nonaktifkan semua tombol lain --}}
    <button disabled class="w-full py-3 px-6 rounded-lg bg-gray-200 text-gray-400 font-semibold cursor-not-allowed">
      Tidak Tersedia
    </button>
  @else
    {{-- Jika ini adalah paket lain dan pengguna belum di level tertinggi --}}
    <form action="{{ route('owner.paket.pilih') }}" method="POST">
      @csrf
      <input type="hidden" name="plan_id" value="{{ $plan->id }}">
      <button type="submit" class="w-full py-3 px-6 rounded-lg bg-indigo-600 text-white font-semibold hover:bg-indigo-700 transition-colors duration-300">
        @if(is_null($currentPlan) || $plan->price > $currentPlan->plan->price)
            Upgrade Paket
        @else
            Pilih Paket
        @endif
      </button>
    </form>
  @endif
</div>
        </div>
      @endforeach
    </div>
  </div>
</main>
@endsection