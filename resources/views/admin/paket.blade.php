@extends('admin.components.base')

@section('page-content')
  <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
    <div>
      <!-- Modal toggle -->
      <button type="button" data-modal-target="default-modal" data-modal-toggle="default-modal"
        class="add-btn text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2">
        <span class="flex">
          <svg class="me-2 w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
            height="24" fill="none" viewBox="0 0 24 24">
            <path fill="currentColor"
              d="M2 7c0-1.10457.89543-2 2-2h16c1.1046 0 2 .89543 2 2v4c0 .5523-.4477 1-1 1s-1-.4477-1-1v-1H4v7h10c.5523 0 1 .4477 1 1s-.4477 1-1 1H4c-1.10457 0-2-.8954-2-2V7Z" />
            <path fill="currentColor"
              d="M5 14c0-.5523.44772-1 1-1h2c.55228 0 1 .4477 1 1s-.44772 1-1 1H6c-.55228 0-1-.4477-1-1Zm5 0c0-.5523.4477-1 1-1h4c.5523 0 1 .4477 1 1s-.4477 1-1 1h-4c-.5523 0-1-.4477-1-1Zm9-1c.5523 0 1 .4477 1 1v1h1c.5523 0 1 .4477 1 1s-.4477 1-1 1h-1v1c0 .5523-.4477 1-1 1s-1-.4477-1-1v-1h-1c-.5523 0-1-.4477-1-1s.4477-1 1-1h1v-1c0-.5523.4477-1 1-1Z" />
          </svg>Tambah Paket/Plan
        </span></button>
      <div class="bg-white rounded-lg shadow-lg overflow-x-auto">
        <table class="w-full">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Paket</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kuota Iklan</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Durasi</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">

            @foreach ($paketDatas as $data)
              <tr>
                <td class="px-6 py-4 font-medium text-gray-900">{{ $data->name }}</td>
                <td class="px-6 py-4 text-gray-800">
                  @if (is_null($data->price))
                    -
                  @else
                    Rp {{ $data->price }}
                  @endif
                </td>
                <td class="px-6 py-4 text-gray-800">{{ $data->quota_ads }}</td>
                <td class="px-6 py-4 text-gray-800">
                  @if (is_null($data->duration_days))
                    Selamanya
                  @else
                    {{ $data->duration_days }}
                  @endif
                </td>
                <td class="px-6 py-4 space-x-2">
                  <button data-id="{{ $data->id }}" type="button" data-modal-target="default-modal"
                    data-modal-toggle="default-modal" class="edit-btn text-indigo-600 hover:text-indigo-900">Edit</button>
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
  <!-- Main modal -->
  <div id="default-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow-sm">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
          <h3 class="text-xl font-semibold text-gray-900">
            Tambah Paket / Plan
          </h3>
          <button type="button"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
            data-modal-hide="default-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <!-- Modal body -->
        <form action="/admin/paket" method="POST" id="planForm">
          @csrf
          <div class="p-4 md:p-5 space-y-4">
            <div class="mb-5">
              <label for="adsName" class="block mb-2 text-sm font-medium text-gray-900">Nama Paket</label>
              <input type="text" id="adsName" name="name"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Masukan Nama Paket (Super Duper Premium)" required />
            </div>
            <div class="mb-5">
              <label for="adsPrice" class="block mb-2 text-sm font-medium text-gray-900">Harga Paket</label>
              <div class="flex">
                <span
                  class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md">
                  <b>Rp.</b>
                </span>
                <input type="number" id="adsPrice" name="price"
                  class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm p-2.5">
              </div>
            </div>
            <div class="flex flex-col md:flex-row md:justify-between">
              <div class="mb-5 md:w-100 md:pe-2">
                <label for="adsQuota" class="block mb-2 text-sm font-medium text-gray-900">Kuota Jumlah Periklanan</label>
                <input type="number" id="adsQuota" name="quota_ads"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                  placeholder="Masukan Kuota Iklan Kendaraan" required />
              </div>
              <div class="mb-5 md:w-100 md:ps-2">
                <label for="adsTime" class="block mb-2 text-sm font-medium text-gray-900">Waktu Berlaku Paket</label>
                <input type="number" id="adsTime" name="duration_days"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                  placeholder="Berlaku selamanya jika tidak diisi" />
              </div>
            </div>
            <div class="mb-5">
              <label for="adsTime" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi Singkat</label>
              <textarea id="adsDesc" name="description"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Teks singkat mengenai Paket tersebut"></textarea>
            </div>
          </div>
          <!-- Modal footer -->
          <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b">
            <button data-modal-hide="default-modal" type="submit"
              class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Selesai</button>
            <button data-modal-hide="default-modal" type="button"
              class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Kembali</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('custom-js')
  <script>
    document.querySelectorAll('.add-btn').forEach(button => {
      button.addEventListener('click', function() {
        let form = document.getElementById('planForm');
        let existing = form.querySelector("input[name='_method']");
        if (existing) existing.remove();
        form.reset();
      });
    });
    document.querySelectorAll('.edit-btn').forEach(button => {
      button.addEventListener('click', function() {
        const plan = @json($paketDatas);
        const id = this.getAttribute('data-id');
        const v = plan.find(item => item.id == id);
        document.getElementById('adsName').value = v.name;
        document.getElementById('adsPrice').value = v.price;
        document.getElementById('adsQuota').value = v.quota_ads;
        document.getElementById('adsTime').value = v.duration_days;
        document.getElementById('adsDesc').innerText = v.description;

        let form = document.getElementById('planForm');
        const input = document.createElement("input");
        input.type = "hidden";
        input.name = "_method";
        input.value = "PUT";
        form.appendChild(input);
        form.action = "/admin/paket/" + id;
      });
    });
  </script>
@endsection
