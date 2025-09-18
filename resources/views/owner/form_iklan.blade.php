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
            <h2 class="text-xl font-semibold border-b pb-4 mb-6">4.1 Foto Utama (Wajib Diisi)</h2>
            <p class="text-sm text-gray-500 mb-4">Pilih satu foto terbaik yang akan menjadi sampul iklan Anda.</p>
            <div class="flex items-center gap-6">
                <div class="w-40 h-32 bg-gray-100 rounded-lg flex items-center justify-center border">
                    <img id="main-photo-preview" src="https://placehold.co/160x128/e2e8f0/adb5bd?text=Foto+Utama" alt="Preview Foto Utama" class="h-full w-full object-cover rounded-lg">
                </div>
                <div>
                    <label for="main-photo-upload" class="cursor-pointer bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-50 text-sm font-medium">
                        Pilih Gambar
                    </label>
                    <input id="main-photo-upload" name="main_photo" type="file" class="hidden" accept="image/jpeg,image/png,image/jpg">
                    <p class="text-xs text-gray-500 mt-2">PNG, JPG hingga 4 MB.</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold border-b pb-4 mb-6">4.2 Foto Detail (Opsional)</h2>
            <p class="text-sm text-gray-500 mb-4">Unggah beberapa foto tambahan untuk menunjukkan detail kendaraan dari berbagai sudut.</p>
            <div id="dropzone" class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md transition-colors">
                <div class="space-y-1 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" ...></svg>
                    <div class="flex text-sm text-gray-600">
                        <label for="file-upload" class="relative cursor-pointer ...">
                            <span>Unggah file</span>
                            <input id="file-upload" name="detail_photos[]" type="file" class="sr-only" multiple accept="image/jpeg,image/png,image/jpg">
                        </label>
                        <p class="pl-1">atau seret dan lepas</p>
                    </div>
                    <p class="text-xs text-gray-500">PNG, JPG hingga 4 MB per foto. Hingga 5 foto.</p>
                    <div id="preview" class="flex flex-wrap gap-2 justify-center mt-3"></div>
                </div>
            </div>
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
    const dropzone = document.getElementById("dropzone");
    const fileInput = document.getElementById("file-upload");
    const preview = document.getElementById("preview");
    const mainPhotoInput = document.getElementById("main-photo-upload");
    const mainPhotoPreview = document.getElementById("main-photo-preview");

    mainPhotoInput.addEventListener("change", e => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                mainPhotoPreview.src = event.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
    ["dragenter", "dragover"].forEach(event => {
      dropzone.addEventListener(event, e => {
        e.preventDefault();
        e.stopPropagation();
        dropzone.classList.add("border-indigo-500", "bg-indigo-50");
      });
    });

    ["dragleave", "drop"].forEach(event => {
      dropzone.addEventListener(event, e => {
        e.preventDefault();
        e.stopPropagation();
        dropzone.classList.remove("border-indigo-500", "bg-indigo-50");
      });
    });

    dropzone.addEventListener("drop", e => {
      e.preventDefault();
      e.stopPropagation();
      const dt = new DataTransfer();
      [...fileInput.files, ...e.dataTransfer.files].forEach(file => dt.items.add(file));
      fileInput.files = dt.files;
      handleFiles(e.dataTransfer.files);
    });

    fileInput.addEventListener("change", e => {
      handleFiles(fileInput.files);
    });

    function handleFiles(files) {
      preview.innerHTML = ''; // Membersihkan preview sebelum menampilkan yang baru
      [...files].forEach(file => {
        if (!file.type.startsWith("image/")) return;
        const reader = new FileReader();
        reader.onload = e => {
          const img = document.createElement("img");
          img.src = e.target.result;
          img.classList.add("h-20", "w-20", "object-cover", "rounded", "shadow");
          preview.appendChild(img);
        };
        reader.readAsDataURL(file);
      });
    }
  </script>
@endsection
