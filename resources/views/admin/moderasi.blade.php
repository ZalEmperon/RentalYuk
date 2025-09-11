@extends('admin.components.base')

@section('page-content')
  <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
    <div class="bg-white rounded-lg shadow-lg">
      <div class="p-6 border-b">
        <h2 class="text-xl font-semibold text-gray-800">Iklan Menunggu Persetujuan ({{ $modCounts }})</h2>
      </div>
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead class="bg-gray-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemilik</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kendaraan</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Dibuat
              </th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            <!-- Iklan 1 -->
            @foreach ($modDatas as $data)
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm font-medium text-gray-900">{{ $data->user->name }}</div>
                  <div class="text-sm text-gray-500">{{ $data->user->email }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm font-medium text-gray-900">{{ $data->brand }} {{ $data->model }}</div>
                  <div class="text-sm text-gray-500">{{ $data->city }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $data->created_at }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                  <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" data-id="{{ $data->id }}" class="decision-btn-approve bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-600 text-xs">Setujui</button>
                  <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" data-id="{{ $data->id }}" class="decision-btn-reject bg-red-500 text-white px-3 py-1 rounded-md hover:bg-red-600 text-xs">Tolak</button>
                  <button type="button" data-id="{{ $data->id }}" data-modal-target="default-modal"
                    data-modal-toggle="default-modal" class="detail-btn text-indigo-600 hover:text-indigo-900 text-xs">Lihat
                    Detail</button>
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
  <div id="default-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
      <!-- Modal content -->
      <div class="relative bg-white rounded-lg shadow-sm">
        <!-- Modal header -->
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
          <h3 class="text-xl font-semibold text-gray-900" id="detailName">
            Juduulll
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
        <div class="p-4 md:p-5 space-y-4">
          <div class="grid md:grid-cols-2 gap-4">
            <div class="col-span-2 md:col-span-1">
              <div class="flex justify-between">
                <p class="text-base leading-relaxed text-gray-500">
                  Merek
                </p>
                <p class="text-base leading-relaxed text-gray-500" id="detailBrand"></p>
              </div>
              <div class="flex justify-between">
                <p class="text-base leading-relaxed text-gray-500">
                  Model
                </p>
                <p class="text-base leading-relaxed text-gray-500" id="detailModel"></p>
              </div>
              <div class="flex justify-between">
                <p class="text-base leading-relaxed text-gray-500">
                  Tahun
                </p>
                <p class="text-base leading-relaxed text-gray-500" id="detailYear"></p>
              </div>
            </div>
            <div class="col-span-2 md:col-span-1">
              <div class="flex justify-between">
                <p class="text-base leading-relaxed text-gray-500">
                  Jenis
                </p>
                <p class="text-base leading-relaxed text-gray-500" id="detailType"></p>
              </div>
              <div class="flex justify-between">
                <p class="text-base leading-relaxed text-gray-500">
                  Kota
                </p>
                <p class="text-base leading-relaxed text-gray-500" id="detailCity"></p>
              </div>
              <div class="flex justify-between">
                <p class="text-base leading-relaxed text-gray-500">
                  Harga/hari
                </p>
                <p class="text-base leading-relaxed text-gray-500" id="detailPriceperday"></p>
              </div>
            </div>
            <div class="col-span-2">
              <p class="text-base leading-relaxed text-gray-500">
                Alamat
              </p>
              <p class="text-base leading-relaxed text-gray-500" id="detailAddress"></p>
            </div>
            <div class="col-span-2">
              <p class="text-base leading-relaxed text-gray-500">
                Deskripsi
              </p>
              <p class="text-base leading-relaxed text-gray-500" id="detailDescription"></p>
              <br>
              <p class="text-base leading-relaxed text-gray-500">
                Gambar
              </p>
            </div>
            <div class="grid col-span-2 grid-cols-3 gap-4" id="detailImage">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

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
          <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
          </svg>
          <h3 class="mb-5 text-lg font-normal text-gray-500" id="confirm-desc"></h3>
          <form id="decisionForm" action="" method="POST">
            @csrf
            @method('PUT')
            <button data-modal-hide="popup-modal" type="submit" id="confirm-btn"
              class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
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
    document.querySelectorAll('.detail-btn').forEach(btn => {
      btn.addEventListener('click', () => {
        const vehicles = @json($modDatas);
        const id = btn.getAttribute('data-id');
        const v = vehicles.find(item => item.id == id);
        // Fill basic info
        document.getElementById('detailName').innerText = `${v.brand} ${v.model}` ?? '';
        document.getElementById('detailBrand').innerText = v.brand ?? '';
        document.getElementById('detailModel').innerText = v.model ?? '';
        document.getElementById('detailYear').innerText = v.year ?? '';
        document.getElementById('detailType').innerText = v.type ?? '';
        document.getElementById('detailCity').innerText = v.city ?? '';
        document.getElementById('detailPriceperday').innerText = `Rp. ${v.price_per_day}` ?? '';
        document.getElementById('detailAddress').innerText = v.address ?? '';
        document.getElementById('detailDescription').innerText = v.description ?? '';

        // Fill images (assuming v.photos is an array of photo objects)
        let imgContainer = document.getElementById('detailImage');
        imgContainer.innerHTML = ""; // clear old ones
        if (v.photos && v.photos.length > 0) {
          v.photos.forEach(photo => {
            imgContainer.innerHTML += `
            <div class="col-span-1 aspect-square">
              <img class="h-full w-full object-cover rounded shadow"
                src="/storage/photo/${v.type}/${photo.photo_url}" alt="">

            </div>
          `;
          });
        }
      });
    });
    document.querySelectorAll('.decision-btn-approve').forEach(button => {
        button.addEventListener('click', function() {
          let id = this.getAttribute('data-id');
          document.getElementById('confirm-btn').innerText = "Ya, Setujui Iklan";
          document.getElementById('confirm-desc').innerText = "Yakin akan menyetujui iklan ini?";
          let form = document.getElementById('decisionForm');
          form.action = "/admin/moderasi/approve-" + id;
        });
      });
    document.querySelectorAll('.decision-btn-reject').forEach(button => {
        button.addEventListener('click', function() {
          let id = this.getAttribute('data-id');
          document.getElementById('confirm-btn').innerText = "Ya, Tolak Iklan";
          document.getElementById('confirm-desc').innerText = "Yakin ingin menolak iklan ini?";
          let form = document.getElementById('decisionForm');
          form.action = "/admin/moderasi/reject-" + id;
        });
      });
  </script>
@endsection
