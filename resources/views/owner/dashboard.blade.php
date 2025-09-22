@extends('owner.components.base')

@section('page-content')
  @php
    use Carbon\Carbon;
    $endDate = Carbon::parse($ownerStats->end_date);
  @endphp
  <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
    <!-- Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      @if ($ownerStats->plan_id !== 1)
        <div class="p-4 col-span-2 rounded-lg shadow-xl bg-indigo-100 flex items-center justify-between">
          @if (now() < $endDate)
            <p class="text-sm text-black ">Paket {{ $ownerStats->name }} berlaku {{ round(now()->diffInDays($endDate)) }}
              hari dan akan habis pada tanggal {{ $endDate->format('d M Y') }}</p>
          @else
            <p class="text-sm text-red-700 ">Paket {{ $ownerStats->name }} habis pada hari ini
              ({{ $endDate->format('d M Y') }}). <a href="/owner/paket-saya" class="text-green-600">Segera Upgrade</a></p>
          @endif
        </div>
      @endif
      <div class="bg-white p-6 rounded-lg shadow-lg flex items-center justify-between">
        <div>
          <p class="text-sm text-gray-500">Total Iklan Aktif</p>
          <p
            class="text-xl font-bold {{ ($ownerStats?->jumlah_iklan ?? 0) >= ($ownerStats?->quota_ads ?? 1) ? 'text-red-500' : 'text-gray-800' }}">
            {{ $ownerStats?->jumlah_iklan ?? 0 }} / {{ $ownerStats?->quota_ads ?? 1 }}
          </p>
        </div>
        <div class="bg-indigo-100 text-indigo-600 p-3 rounded-full">
          <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
            class="w-8 h-8" viewBox="0 0 16 16">
            <path 
              d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679q.05.242.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.8.8 0 0 0 .381-.404l.792-1.848ZM3 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2m10 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2M6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2zM2.906 5.189a.51.51 0 0 0 .497.731c.91-.073 3.35-.17 4.597-.17s3.688.097 4.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 11.691 3H4.309a.5.5 0 0 0-.447.276L2.906 5.19Z" />
          </svg>
        </div>
      </div>
      <div class="bg-white p-6 rounded-lg shadow-lg flex items-center justify-between">
        <div>
          <p class="text-sm text-gray-500">Total Dilihat</p>
          <p class="text-3xl font-bold text-gray-800">{{ $ownerStats?->jumlah_lihat ?? 0 }}</p>
        </div>
        <div class="bg-green-100 text-green-600 p-3 rounded-full">
          <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
            </path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
            </path>
          </svg>
        </div>
      </div>
    </div>

    <!-- Daftar Iklan -->
    <div class="mt-8 bg-white rounded-lg shadow-lg">
      <div class="p-6 flex flex-col sm:flex-row sm:justify-between items-start sm:items-center border-b">
        <h2 class="text-xl font-semibold text-gray-800 mb-2 sm:mb-0">Daftar Iklan Anda</h2>
        <a href="/owner/form-iklan"
          class="bg-indigo-600 text-white px-5 py-2 rounded-md hover:bg-indigo-700 font-semibold text-sm transition duration-300">
          + Tambah Iklan Baru
        </a>
      </div>
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kendaraan</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga/Hari</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <!-- Row 1 -->
            @foreach ($ownerDatas as $data)
              <tr
                class="relative {{ $data->mod_status == 'locked' ? 'bg-slate-300 text-slate-800' : ($data->mod_status == 'approve' ? '' : ($data->mod_status == 'reject' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800')) }}">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm font-medium text-gray-900">{{ $data->brand }} {{ $data->model }}</div>
                  <div class="text-sm text-gray-500 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                      class="me-2" viewBox="0 0 16 16">
                      <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                      <path
                        d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                    </svg>
                    {{ $data->view_count }}
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Rp. {{ $data->price_per_day }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  @if ($data->mod_status != 'approve')
                    <span
                      class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $data->mod_status == 'locked' ? 'bg-gray-200 text-gray-800' : ($data->mod_status == 'reject' ? 'bg-red-200 text-red-800' : 'bg-yellow-200 text-yellow-800') }}">{{ $data->mod_status == 'locked' ? 'Terkunci' : ($data->mod_status == 'reject' ? 'Ditolak' : 'Menunggu') }}</span>
                  @else
                    <span
                      class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $data->status == 'locked' ? 'bg-gray-100 text-gray-800' : ($data->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800') }}">{{ $data->status == 'locked' ? 'Terkunci' : ($data->status == 'active' ? 'Aktif' : 'Tidak Aktif') }}</span>
                  @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-3">
                  @if ($data->mod_status == 'locked' && $data->status == 'locked')
                    <button type="button" data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                      data-id="{{ $data->id }}" class="delete-btn text-red-600 hover:text-red-900">Hapus</button>
                  @else
                    <a href="/owner/form-iklan/edit/{{ $data->id }}"
                      class="text-indigo-600 hover:text-indigo-900">Edit</a>
                    <button type="button" data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                      data-id="{{ $data->id }}" class="delete-btn text-red-600 hover:text-red-900">Hapus</button>
                    @if ($data->mod_status == 'approve')
                      <form action="/owner/ad-switch/{{ $data->id }}" method="POST" class="inline">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                          class="text-yellow-600 {{ $data->status == 'active' ? 'hover:text-green-900' : 'hover:text-yellow-900' }}">
                          {{ $data->status == 'active' ? 'Nonaktifkan' : 'Aktifkan' }}</button>
                      </form>
                    @elseif ($data->mod_status == 'reject')
                      <form action="/owner/ad-resubmit/{{ $data->id }}" method="POST" class="inline">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="text-green-600 hover:text-green-900">
                          Ajukan Kembali</button>
                      </form>
                    @endif
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </main>
@endsection

@section('page-component')
  <div id="popup-modal" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
      <div class="relative bg-white rounded-lg shadow-sm">
        <button type="button"
          class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
          data-modal-hide="popup-modal">
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
        <div class="p-4 md:p-5 text-center">
          <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
            fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
          </svg>
          <h3 class="mb-5 text-lg font-normal text-gray-500">Yakin ingin menghapus iklan ini?</h3>
          <form id="deleteForm" action="" method="POST">
            @csrf
            @method('DELETE')
            <button data-modal-hide="popup-modal" type="submit"
              class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
              Ya, hapus iklan
            </button>
            <button data-modal-hide="popup-modal" type="button"
              class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Tidak
              Jadi</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('custom-js')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
          let id = this.getAttribute('data-id');
          let form = document.getElementById('deleteForm');
          form.action = "/owner/form-iklan/delete/" + id;
        });
      });
    });
  </script>
@endsection
