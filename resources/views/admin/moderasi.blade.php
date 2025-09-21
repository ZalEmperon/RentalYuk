@extends('admin.components.base')

@section('page-content')
  {{-- [MODIFIKASI] Latar belakang utama diubah menjadi slate-100 yang lebih cerah --}}
  <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-100 p-6">
    <div class="bg-white rounded-2xl shadow-xl">
      <div class="p-6 border-b">
        <h2 class="text-xl font-semibold text-gray-800">Iklan Menunggu Persetujuan ({{ $modCounts }})</h2>
      </div>
      <div class="overflow-x-auto">
        <table class="w-full">
          <thead class="bg-slate-50">
            <tr>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemilik</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kendaraan</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Dibuat</th>
              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($modDatas as $data)
              {{-- [MODIFIKASI] Setiap baris diberi animasi pop-out --}}
              <tr class="animate-on-scroll" style="--delay: {{ $loop->index * 100 }}ms;">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm font-medium text-gray-900">{{ $data->user->name }}</div>
                  <div class="text-sm text-gray-500">{{ $data->user->email }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm font-medium text-gray-900">{{ $data->brand }} {{ $data->model }}</div>
                  <div class="text-sm text-gray-500">{{ $data->city }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $data->created_at->format('d M Y, H:i') }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                  <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" data-id="{{ $data->id }}" class="decision-btn-approve bg-green-100 text-green-800 px-3 py-1 rounded-md hover:bg-green-200 text-xs font-semibold transition-colors">Setujui</button>
                  <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" data-id="{{ $data->id }}" class="decision-btn-reject bg-red-100 text-red-800 px-3 py-1 rounded-md hover:bg-red-200 text-xs font-semibold transition-colors">Tolak</button>
                  <button type="button" data-id="{{ $data->id }}" data-modal-target="default-modal"
                    data-modal-toggle="default-modal" class="detail-btn text-indigo-600 hover:text-indigo-900 text-xs font-semibold inline-flex items-center gap-1">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M10 12.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" /><path fill-rule="evenodd" d="M.664 10.59a1.651 1.651 0 010-1.186A10.004 10.004 0 0110 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0110 17c-4.257 0-7.893-2.66-9.336-6.41zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" /></svg>
                    Detail
                  </button>
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
  {{-- ======================================================= --}}
  {{-- MODAL DETAIL KENDARAAN (DESAIN BARU) --}}
  {{-- ======================================================= --}}
  {{-- [MODIFIKASI] Latar belakang modal diubah menjadi semi-transparan dengan backdrop-blur --}}
  <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-full max-h-full bg-black/60 backdrop-blur-sm">
    <div class="relative p-4 w-full max-w-4xl max-h-full">
      <div class="relative bg-slate-50 rounded-2xl shadow-lg animate-on-modal-open">
        {{-- Modal Header --}}
        <div class="flex items-start justify-between p-5 border-b rounded-t">
          <div>
            <h3 class="text-2xl font-bold text-slate-900" id="detailName"></h3>
            <p class="text-sm text-slate-500 mt-1" id="detailCity"></p>
          </div>
          <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="default-modal">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" /></svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        
        {{-- Modal Body --}}
        <div class="p-5 space-y-6 max-h-[70vh] overflow-y-auto">
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- Kolom Kiri: Galeri & Info Dasar --}}
            <div>
              <div class="mb-4">
                <img id="mainImageModal" src="" alt="Gambar Utama" class="w-full aspect-video object-cover rounded-xl mb-3 border-2 border-white shadow-lg">
                <div class="grid grid-cols-5 gap-2" id="detailImage"></div>
              </div>
              <div class="bg-white p-4 rounded-xl border space-y-2 text-sm">
                <div class="flex justify-between"><span class="text-slate-500">Merek:</span><strong class="text-slate-800" id="detailBrand"></strong></div>
                <div class="flex justify-between"><span class="text-slate-500">Model:</span><strong class="text-slate-800" id="detailModel"></strong></div>
                <div class="flex justify-between"><span class="text-slate-500">Tahun:</span><strong class="text-slate-800" id="detailYear"></strong></div>
                <div class="flex justify-between"><span class="text-slate-500">Tipe:</span><strong class="text-slate-800" id="detailType"></strong></div>
              </div>
            </div>
            
            {{-- Kolom Kanan: Spesifikasi, Deskripsi, dll. --}}
            <div class="space-y-5">
              <div class="bg-white p-4 rounded-xl border">
                <h4 class="text-lg font-semibold text-slate-800 mb-3">Spesifikasi</h4>
                <div class="flex flex-wrap gap-3">
                  <span class="spec-tag-modal" id="detailTransmission"></span>
                  <span class="spec-tag-modal" id="detailCapacity"></span>
                  <span class="spec-tag-modal" id="detailFuel_type"></span>
                </div>
              </div>
              <div class="bg-white p-4 rounded-xl border">
                <h4 class="text-lg font-semibold text-slate-800 mb-2">Alamat & Deskripsi</h4>
                <p class="text-sm text-slate-600 leading-relaxed font-semibold" id="detailAddress"></p>
                <p class="text-sm text-slate-600 leading-relaxed mt-1" id="detailDescription"></p>
              </div>
            </div>
          </div>
        </div>
        
        {{-- Modal Footer dengan Tombol Aksi --}}
        <div class="flex items-center justify-between p-5 border-t border-slate-200 rounded-b bg-white">
          <p class="text-2xl font-bold text-indigo-600" id="detailPriceperday"></p>
          <div class="flex items-center gap-2">
            <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" id="modalRejectBtn" class="decision-btn-reject text-sm px-4 py-2 rounded-lg font-semibold bg-red-100 text-red-700 hover:bg-red-200 transition-colors">
                Tolak
            </button>
            <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" id="modalApproveBtn" class="decision-btn-approve text-sm px-4 py-2 rounded-lg font-semibold bg-green-500 text-white hover:bg-green-600 transition-colors transform hover:scale-105">
                Setujui
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Modal Konfirmasi (Tetap sama) --}}
  <div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-[100] justify-center items-center w-full md:inset-0 h-full max-h-full bg-black bg-opacity-50">
    <div class="relative p-4 w-full max-w-md max-h-full">
      <div class="relative bg-white rounded-lg shadow-sm animate-on-modal-open">
        <button type="button" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="popup-modal">
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" /></svg>
          <span class="sr-only">Close modal</span>
        </button>
        <div class="p-4 md:p-5 text-center">
          <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
          <h3 class="mb-5 text-lg font-normal text-gray-500" id="confirm-desc"></h3>
          <form id="decisionForm" action="" method="POST">
            @csrf
            @method('PUT')
            <button data-modal-hide="popup-modal" type="submit" id="confirm-btn" class="text-white focus:ring-4 focus:outline-none font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center"></button>
            <button data-modal-hide="popup-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Tidak Jadi</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('custom-css')
<style>
  /* Gaya untuk spesifikasi di dalam modal */
  .spec-tag-modal {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      background-color: #f1f5f9; /* slate-100 */
      color: #334155; /* slate-700 */
      padding: 0.5rem 1rem;
      border-radius: 9999px;
      font-size: 0.875rem; /* text-sm */
      font-weight: 500;
  }
  .modal-thumbnail.active {
      outline: 2px solid #4f46e5; /* indigo-600 */
      outline-offset: 2px;
  }

  /* [TAMBAHAN] Keyframes untuk animasi "pop out" */
  @keyframes pop-in {
    from { opacity: 0; transform: translateY(20px) scale(0.95); }
    to { opacity: 1; transform: translateY(0) scale(1); }
  }

  .animate-on-scroll {
    opacity: 0;
    animation: pop-in 0.6s ease-out forwards;
    animation-delay: var(--delay, 0ms);
  }

  .animate-on-modal-open {
    animation: pop-in 0.4s ease-out;
  }
</style>
@endsection

@section('custom-js')
  <script>
    // Seluruh kode JavaScript Anda yang sudah ada tetap sama, tidak perlu diubah.
    document.addEventListener('DOMContentLoaded', function() {
      const vehicles = @json($modDatas);
      
      // Elemen-elemen di dalam modal detail
      const mainImageModal = document.getElementById('mainImageModal');
      const detailImageContainer = document.getElementById('detailImage');
      const modalApproveBtn = document.getElementById('modalApproveBtn');
      const modalRejectBtn = document.getElementById('modalRejectBtn');

      // Fungsi untuk mengisi data modal
      function populateDetailModal(id) {
          const v = vehicles.find(item => item.id == id);
          if (!v) return;

          // Isi info teks
          document.getElementById('detailName').innerText = `${v.brand} ${v.model}` || '';
          document.getElementById('detailCity').innerText = `Diajukan dari ${v.city}` || '';
          document.getElementById('detailBrand').innerText = v.brand || '';
          document.getElementById('detailModel').innerText = v.model || '';
          document.getElementById('detailYear').innerText = v.year || '';
          document.getElementById('detailType').innerText = v.type || '';
          document.getElementById('detailPriceperday').innerText = `Rp ${Number(v.price_per_day).toLocaleString('id-ID')}/hari` || '';
          document.getElementById('detailAddress').innerText = v.address || '';
          document.getElementById('detailDescription').innerText = v.description || '';
          document.getElementById('detailTransmission').innerText = v.transmission || '';
          document.getElementById('detailCapacity').innerText = `${v.capacity} Kursi` || '';
          document.getElementById('detailFuel_type').innerText = v.fuel_type || '';
          
          // Set data-id untuk tombol di footer modal
          modalApproveBtn.setAttribute('data-id', id);
          modalRejectBtn.setAttribute('data-id', id);

          // Isi galeri gambar
          detailImageContainer.innerHTML = ""; // Kosongkan thumbnail lama
          if (v.photos && v.photos.length > 0) {
              mainImageModal.src = `/storage/photo/${v.type}/${v.photos[0].photo_url}`;
              v.photos.forEach((photo, index) => {
                  const img = document.createElement('img');
                  img.src = `/storage/photo/${v.type}/${photo.photo_url}`;
                  img.alt = `Thumbnail ${index + 1}`;
                  img.className = 'modal-thumbnail w-full aspect-video object-cover rounded-md cursor-pointer border hover:opacity-80 transition';
                  if (index === 0) {
                      img.classList.add('active');
                  }
                  detailImageContainer.appendChild(img);
              });
          } else {
              mainImageModal.src = 'https://placehold.co/800x600/e2e8f0/334155?text=No+Image';
          }
      }
      
      // Fungsi untuk setup modal konfirmasi
      function setupConfirmationModal(button, isApprove) {
          const id = button.getAttribute('data-id');
          const form = document.getElementById('decisionForm');
          const confirmBtn = document.getElementById('confirm-btn');
          const confirmDesc = document.getElementById('confirm-desc');
          
          if (isApprove) {
              confirmDesc.innerText = "Yakin akan menyetujui iklan ini?";
              confirmBtn.innerText = "Ya, Setujui Iklan";
              confirmBtn.className = "text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center";
              form.action = `/admin/moderasi/approve-${id}`;
          } else {
              confirmDesc.innerText = "Yakin ingin menolak iklan ini?";
              confirmBtn.innerText = "Ya, Tolak Iklan";
              confirmBtn.className = "text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center";
              form.action = `/admin/moderasi/reject-${id}`;
          }
      }

      // --- Event Listeners ---
      
      // Event listener untuk klik thumbnail di dalam modal
      detailImageContainer.addEventListener('click', function(event) {
          if (event.target.classList.contains('modal-thumbnail')) {
              mainImageModal.src = event.target.src;
              detailImageContainer.querySelectorAll('.modal-thumbnail').forEach(thumb => thumb.classList.remove('active'));
              event.target.classList.add('active');
          }
      });

      // Event listener untuk tombol "Lihat Detail" di tabel
      document.querySelectorAll('.detail-btn').forEach(btn => {
          btn.addEventListener('click', () => {
              const id = btn.getAttribute('data-id');
              populateDetailModal(id);
          });
      });

      // Event listener untuk tombol "Setujui" & "Tolak" di tabel
      document.querySelectorAll('.decision-btn-approve').forEach(button => {
          button.addEventListener('click', function() { setupConfirmationModal(this, true); });
      });
      document.querySelectorAll('.decision-btn-reject').forEach(button => {
          button.addEventListener('click', function() { setupConfirmationModal(this, false); });
      });
    });
  </script>
@endsection