@extends('owner.components.base')

@section('page-content')
  <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
    <form action="/owner/form-iklan/edit/{{ $vehicleDatas->id }}" method="POST" class="space-y-8"
      enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <!-- Section 1: Informasi Dasar -->
      <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold border-b pb-4 mb-6">1. Informasi Dasar Kendaraan</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label for="type" class="block text-sm font-medium text-gray-700">Jenis Kendaraan</label>
            <select id="type" name="type"
              class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm pointer-events-none cursor-none">
              <option {{ strtolower($vehicleDatas->type) == 'mobil' ? 'selected' : '' }}>Mobil</option>
              <option {{ strtolower($vehicleDatas->type) == 'motor' ? 'selected' : '' }}>Motor</option>
            </select>
          </div>
          <div>
            <label for="brand" class="block text-sm font-medium text-gray-700">Merek</label>
            <input type="text" name="brand" id="brand" placeholder="Contoh: Toyota, Honda"
              value="{{ $vehicleDatas->brand }}"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          </div>
          <div>
            <label for="model" class="block text-sm font-medium text-gray-700">Model</label>
            <input type="text" name="model" id="model" placeholder="Contoh: Avanza, Vario 150"
              value="{{ $vehicleDatas->model }}"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          </div>
          <div>
            <label for="year" class="block text-sm font-medium text-gray-700">Tahun Pembuatan</label>
            <input type="number" name="year" id="year" placeholder="Contoh: 2022" min="1970" max="2025"
              value="{{ $vehicleDatas->year }}"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          </div>
          <!-- PENAMBAHAN: Spesifikasi Kendaraan -->
          <div>
            <label for="transmission" class="block text-sm font-medium text-gray-700">Transmisi</label>
            <select id="transmission" name="transmission"
              class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
              <option {{ $vehicleDatas->transmission == 'Manual' ? 'selected' : '' }}>Manual</option>
              <option {{ $vehicleDatas->transmission == 'Otomatis' ? 'selected' : '' }}>Otomatis</option>
            </select>
          </div>
          <div>
            <label for="capacity" class="block text-sm font-medium text-gray-700">Kapasitas Penumpang</label>
            <input type="number" name="capacity" id="capacity" placeholder="Jumlah kursi, contoh: 7" min="1"
              value="{{ $vehicleDatas->capacity }}"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          </div>
          <div class="md:col-span-2">
            <label for="fuel_type" class="block text-sm font-medium text-gray-700">Jenis Bahan Bakar</label>
            <select id="fuel_type" name="fuel_type"
              class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
              <option {{ $vehicleDatas->fuel_type == 'Bensin' ? 'selected' : '' }}>Bensin</option>
              <option {{ $vehicleDatas->fuel_type == 'Solar (Diesel)' ? 'selected' : '' }}>Solar (Diesel)</option>
              <option {{ $vehicleDatas->fuel_type == 'Listrik' ? 'selected' : '' }}>Listrik</option>
              <option {{ $vehicleDatas->fuel_type == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
            </select>
          </div>
          <!-- AKHIR PENAMBAHAN -->
        </div>
      </div>

      <!-- Section 2: Lokasi & Harga -->
      <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold border-b pb-4 mb-6">2. Lokasi & Harga</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label for="city" class="block text-sm font-medium text-gray-700">Kota</label>
            <input type="text" name="city" id="city" placeholder="Contoh: Surabaya"
              value="{{ $vehicleDatas->city }}"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          </div>
          <div>
            <label for="price" class="block text-sm font-medium text-gray-700">Harga per Hari (Rp)</label>
            <input type="number" name="price_per_day" id="price" placeholder="Contoh: 350000"
              value="{{ $vehicleDatas->price_per_day }}"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          </div>
          <div class="md:col-span-2">
            <label for="address" class="block text-sm font-medium text-gray-700">Alamat Lengkap (Detail Lokasi)</label>
            <textarea id="address" name="address" rows="3"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              placeholder="Tulis alamat lengkap atau patokan untuk penjemputan kendaraan.">{{ $vehicleDatas->address }}</textarea>
          </div>
        </div>
      </div>

      <!-- Section 3: Deskripsi -->
      <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold border-b pb-4 mb-6">3. Deskripsi Iklan</h2>
        <div>
          <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi Lengkap</label>
          <textarea id="description" name="description" rows="5"
            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            placeholder="Jelaskan kondisi kendaraan, fasilitas (misal: AC dingin, audio), dan syarat sewa jika ada.">{{ $vehicleDatas->description }}</textarea>
        </div>
      </div>

      <!-- Section 4: Unggah Foto -->
      <div class="bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-xl font-semibold border-b pb-4 mb-6">4. Foto Kendaraan</h2>
    <p class="text-sm text-gray-500 mb-4">Unggah semua foto kendaraan Anda di sini. Klik pada salah satu foto untuk menjadikannya sebagai **Foto Utama** (sampul iklan).</p>
    
    <input type="hidden" name="main_photo_url" id="main_photo_input" value="{{ $vehicleDatas->main_photo_url }}">
    
    <div id="dropzone" class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md transition-colors">
        <div class="space-y-1 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true"><path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></svg>
            <div class="flex text-sm text-gray-600">
                <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500">
                    <span>Unggah file baru</span>
                    <input id="file-upload" name="photos[]" type="file" class="sr-only" multiple accept="image/jpeg,image/png,image/jpg">
                </label>
                <p class="pl-1">atau seret dan lepas</p>
            </div>
            <p class="text-xs text-gray-500">PNG, JPG hingga 4 MB per foto.</p>
        </div>
    </div>

    <div id="preview" class="flex flex-wrap gap-4 justify-start mt-4">
      @foreach ($vehicleDatas->photos as $photo)
        <div class="relative group photo-preview-item cursor-pointer" data-filename="{{ $photo->photo_url }}">
          <img src="{{ asset('storage/photo/' . $vehicleDatas->type . '/' . $photo->photo_url) }}" class="h-24 w-24 object-cover rounded-md shadow-md">
          <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
            <span class="text-white text-xs font-bold">Jadikan Utama</span>
          </div>
          <span class="main-photo-badge absolute top-1 right-1 bg-indigo-600 text-white text-xs font-semibold px-2 py-0.5 rounded-full hidden">Utama</span>
          <button type="button" data-photo-id="{{ $photo->id }}" class="remove-photo absolute -top-2 -right-2 bg-red-600 text-white rounded-full p-0.5 w-6 h-6 flex items-center justify-center text-sm">✕</button>
        </div>
      @endforeach
    </div>
    <input type="hidden" name="deleted_photos" id="deleted_photos">
</div>

      <!-- Tombol Aksi -->
      <div class="flex justify-end space-x-4">
        <button type="submit"
          class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 font-semibold text-sm transition duration-300">Perbarui
          Iklan</button>
      </div>
    </form>
  </main>
@endsection

@section('custom-js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const previewContainer = document.getElementById('preview');
    const mainPhotoInput = document.getElementById('main_photo_input');
    const deletedPhotosInput = document.getElementById('deleted_photos');
    let deletedPhotos = [];

    // Fungsi untuk menandai foto utama
    function setMainPhoto(itemElement) {
        // Hapus tanda dari semua item
        document.querySelectorAll('.photo-preview-item').forEach(el => el.classList.remove('is-main'));
        
        // Tambahkan tanda ke item yang dipilih
        if (itemElement) {
            itemElement.classList.add('is-main');
            mainPhotoInput.value = itemElement.dataset.filename;
        } else {
            mainPhotoInput.value = '';
        }
    }

    // Fungsi untuk menangani event listener pada item foto
    function addPhotoEventListeners(element) {
        // Klik untuk menjadikan foto utama
        element.addEventListener('click', () => {
            setMainPhoto(element);
        });

        // Klik untuk menghapus foto
        const removeBtn = element.querySelector('.remove-photo');
        if (removeBtn) {
            removeBtn.addEventListener('click', function(e) {
                e.stopPropagation(); // Mencegah event klik utama terpicu
                const photoId = this.dataset.photoId;
                if (photoId) {
                    if (!deletedPhotos.includes(photoId)) {
                        deletedPhotos.push(photoId);
                    }
                    deletedPhotosInput.value = JSON.stringify(deletedPhotos);
                }
                
                const wasMain = element.classList.contains('is-main');
                element.remove();

                // Jika foto yang dihapus adalah foto utama, pilih foto pertama sebagai utama baru
                if (wasMain) {
                    const firstRemainingPhoto = document.querySelector('.photo-preview-item');
                    if (firstRemainingPhoto) {
                        setMainPhoto(firstRemainingPhoto);
                    } else {
                        setMainPhoto(null);
                    }
                }
            });
        }
    }

    // Inisialisasi untuk foto yang sudah ada
    document.querySelectorAll('.photo-preview-item').forEach(addPhotoEventListeners);

    // Tandai foto utama saat halaman dimuat
    const currentMainFilename = mainPhotoInput.value;
    if (currentMainFilename) {
        const mainPhotoElement = document.querySelector(`.photo-preview-item[data-filename="${currentMainFilename}"]`);
        if (mainPhotoElement) {
            mainPhotoElement.classList.add('is-main');
        }
    }

    // Logika Drag & Drop dan preview (tetap sama, tapi disesuaikan sedikit)
    const dropzone = document.getElementById("dropzone");
    const fileInput = document.getElementById("file-upload");

    // ... (kode drag & drop Anda bisa diletakkan di sini, pastikan handleFiles dimodifikasi)

    fileInput.addEventListener("change", e => {
        handleFiles(e.target.files);
    });

    function handleFiles(files) {
        [...files].forEach((file, index) => {
            if (!file.type.startsWith("image/")) return;
            const reader = new FileReader();
            reader.onload = e => {
                const filename = file.name; // Di dunia nyata, ini akan jadi nama acak dari backend
                // Buat elemen baru
                const wrapper = document.createElement("div");
                wrapper.classList.add("relative", "group", "photo-preview-item", "cursor-pointer");
                wrapper.dataset.filename = filename; // Ini hanya untuk UI, backend akan menimpa
                
                wrapper.innerHTML = `
                    <img src="${e.target.result}" class="h-24 w-24 object-cover rounded-md shadow-md">
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="text-white text-xs font-bold">Jadikan Utama</span>
                    </div>
                    <span class="main-photo-badge absolute top-1 right-1 bg-indigo-600 text-white text-xs font-semibold px-2 py-0.5 rounded-full hidden">Utama</span>
                `;
                
                previewContainer.appendChild(wrapper);
                addPhotoEventListeners(wrapper);

                // Jika belum ada foto utama, jadikan foto pertama yang diunggah sebagai utama
                if (!mainPhotoInput.value && index === 0) {
                    setMainPhoto(wrapper);
                }
            };
            reader.readAsDataURL(file);
        });
    }
});
</script>
@endsection
