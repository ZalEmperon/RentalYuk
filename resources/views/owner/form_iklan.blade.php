@extends('owner.components.base')

@section('page-content')
  <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
    <form action="/owner/form-iklan" method="POST" class="space-y-8" enctype="multipart/form-data">
      @csrf
      <!-- Section 1: Informasi Dasar -->
      <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold border-b pb-4 mb-6">1. Informasi Dasar Kendaraan</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label for="type" class="block text-sm font-medium text-gray-700">Jenis Kendaraan</label>
            <select id="type" name="type"
              class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
              <option>Mobil</option>
              <option>Motor</option>
            </select>
          </div>
          <div>
            <label for="brand" class="block text-sm font-medium text-gray-700">Merek</label>
            <input type="text" name="brand" id="brand" placeholder="Contoh: Toyota, Honda"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          </div>
          <div>
            <label for="model" class="block text-sm font-medium text-gray-700">Model</label>
            <input type="text" name="model" id="model" placeholder="Contoh: Avanza, Vario 150"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          </div>
          <div>
            <label for="year" class="block text-sm font-medium text-gray-700">Tahun Pembuatan</label>
            <input type="number" name="year" id="year" placeholder="Contoh: 2022" min="1970" max="2025"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          </div>
          <!-- PENAMBAHAN: Spesifikasi Kendaraan -->
          <div>
            <label for="transmission" class="block text-sm font-medium text-gray-700">Transmisi</label>
            <select id="transmission" name="transmission"
              class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
              <option>Manual</option>
              <option>Otomatis</option>
            </select>
          </div>
          <div>
            <label for="capacity" class="block text-sm font-medium text-gray-700">Kapasitas Penumpang</label>
            <input type="number" name="capacity" id="capacity" placeholder="Jumlah kursi, contoh: 7" min="1"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          </div>
          <div class="md:col-span-2">
            <label for="fuel_type" class="block text-sm font-medium text-gray-700">Jenis Bahan Bakar</label>
            <select id="fuel_type" name="fuel_type"
              class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
              <option>Bensin</option>
              <option>Solar (Diesel)</option>
              <option>Listrik</option>
              <option>Hybrid</option>
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
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          </div>
          <div>
            <label for="price" class="block text-sm font-medium text-gray-700">Harga per Hari (Rp)</label>
            <input type="number" name="price_per_day" id="price" placeholder="Contoh: 350000"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
          </div>
          <div class="md:col-span-2">
            <label for="address" class="block text-sm font-medium text-gray-700">Alamat Lengkap (Detail Lokasi)</label>
            <textarea id="address" name="address" rows="3"
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              placeholder="Tulis alamat lengkap atau patokan untuk penjemputan kendaraan."></textarea>
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
            placeholder="Jelaskan kondisi kendaraan, fasilitas (misal: AC dingin, audio), dan syarat sewa jika ada."></textarea>
        </div>
      </div>

      <!-- Section 4: Unggah Foto -->
      <div class="bg-white p-6 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold border-b pb-4 mb-6">4. Foto Kendaraan</h2>
        <p class="text-sm text-gray-500 mb-4">Unggah semua foto kendaraan Anda di sini. Klik pada salah satu foto untuk
          menjadikannya sebagai <b>Foto Utama</b> (sampul iklan). Foto Pertama akan menjadi sampul jika tidak memilih</p>
        <input type="hidden" name="main_photo_url" id="main_photo_input">
        <div id="dropzone"
          class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md transition-colors">
          <div class="space-y-1 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48"
              aria-hidden="true">
              <path
                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <div class="flex text-sm text-gray-600">
              <label for="file-upload"
                class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500">
                <span>Unggah file</span>
                <input id="file-upload" name="photo[]" type="file" class="sr-only" multiple
                  accept="image/jpeg,image/png,image/jpg" required>
              </label>
              <p class="pl-1">atau seret dan lepas</p>
            </div>
            <p class="text-xs text-gray-500">PNG, JPG hingga 4 MB per foto.</p>
          </div>
        </div>
        <div id="preview" class="flex flex-wrap gap-4 justify-start mt-4"></div>
      </div>
      <!-- Tombol Aksi -->
      <div class="flex justify-end space-x-4">
        <button type="submit"
          class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 font-semibold text-sm transition duration-300">Simpan
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
      const fileInput = document.getElementById("file-upload");
      const dropzone = document.getElementById("dropzone");
      let uploadedFiles = []; // Array untuk menyimpan objek File

      // Fungsi untuk menandai foto utama
      function setMainPhoto(itemElement) {
        document.querySelectorAll('.photo-preview-item').forEach(el => el.classList.remove('is-main'));
        if (itemElement) {
          itemElement.classList.add('is-main');
          mainPhotoInput.value = itemElement.dataset.filename;
        } else {
          mainPhotoInput.value = '';
        }
      }

      // Fungsi untuk menangani event listener pada item foto
      function addPhotoEventListeners(element) {
        element.addEventListener('click', () => setMainPhoto(element));
      }

      // Fungsi untuk menangani file yang dipilih atau di-drop
      function handleFiles(files) {
        // Gabungkan file lama (jika ada) dengan file baru dan filter duplikat
        const newFiles = [...files].filter(file => !uploadedFiles.some(existing => existing.name === file.name));
        uploadedFiles.push(...newFiles);

        // Buat ulang preview dari awal berdasarkan array `uploadedFiles`
        previewContainer.innerHTML = '';
        const dt = new DataTransfer();

        uploadedFiles.forEach((file, index) => {
          dt.items.add(file);

          const reader = new FileReader();
          reader.onload = e => {
            const filename = file.name;
            const wrapper = document.createElement("div");
            wrapper.classList.add("relative", "group", "photo-preview-item", "cursor-pointer");
            wrapper.dataset.filename = filename;

            wrapper.innerHTML = `
                    <img src="${e.target.result}" class="h-24 w-24 object-cover rounded-md shadow-md">
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="text-white text-xs font-bold">Jadikan Utama</span>
                    </div>
                    <span class="main-photo-badge absolute top-1 right-1 bg-indigo-600 text-white text-xs font-semibold px-2 py-0.5 rounded-full hidden">Utama</span>
                `;

            previewContainer.appendChild(wrapper);
            addPhotoEventListeners(wrapper);

            // Otomatis tandai foto utama
            const currentMain = mainPhotoInput.value;
            if (currentMain === filename) {
              setMainPhoto(wrapper);
            } else if (!currentMain && index === 0) {
              setMainPhoto(wrapper);
            }
          };
          reader.readAsDataURL(file);
        });

        fileInput.files = dt.files; // Update file input dengan file yang valid
      }

      // Event listeners untuk dropzone
      dropzone.addEventListener("drop", e => {
        e.preventDefault();
        e.stopPropagation();
        dropzone.classList.remove("border-indigo-500", "bg-indigo-50");
        handleFiles(e.dataTransfer.files);
      });

      fileInput.addEventListener("change", e => handleFiles(e.target.files));

      ["dragenter", "dragover"].forEach(event => dropzone.addEventListener(event, e => {
        e.preventDefault();
        e.stopPropagation();
        dropzone.classList.add("border-indigo-500", "bg-indigo-50");
      }));
      ["dragleave"].forEach(event => dropzone.addEventListener(event, e => {
        e.preventDefault();
        e.stopPropagation();
        dropzone.classList.remove("border-indigo-500", "bg-indigo-50");
      }));
    });
  </script>
@endsection
