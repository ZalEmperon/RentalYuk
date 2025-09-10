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
              class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
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
                class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                <span>Unggah file baru</span>
                <input id="file-upload" name="photo[]" type="file" class="sr-only" multiple>
              </label>
              <p class="pl-1">atau seret dan lepas</p>
            </div>
            <p class="text-xs text-gray-500">PNG, JPG hingga 4 MB per foto. Hingga 5 foto.</p>
            <!-- preview existing -->
            <div id="preview" class="flex flex-wrap gap-3 justify-center mt-3">
              @foreach ($vehicleDatas->photos as $photo)
                <div class="relative group">
                  <img src="{{ asset('storage/photo/' . $vehicleDatas->type . '/' . $photo->photo_url) }}"
                    class="h-20 w-20 object-cover rounded shadow">
                  <button type="button" data-photo-id="{{ $photo->id }}"
                    class="remove-photo absolute -top-2 -right-2 bg-red-600 text-white rounded-full p-0.5 w-6 h-6 flex items-center justify-center text-sm transition-opacity opacity-75 group-hover:opacity-100">
                    ✕
                  </button>
                </div>
              @endforeach
            </div>
            <input type="hidden" name="deleted_photos" id="deleted_photos">
          </div>
        </div>
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
    const dropzone = document.getElementById("dropzone");
    const fileInput = document.getElementById("file-upload");
    const preview = document.getElementById("preview");
    const deletedPhotosInput = document.getElementById("deleted_photos");
    let deletedPhotos = [];

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
      [...files].forEach(file => {
        if (!file.type.startsWith("image/")) return;
        const reader = new FileReader();
        reader.onload = e => {
          const wrapper = document.createElement("div");
          wrapper.classList.add("relative", "group", "new-upload");

          const img = document.createElement("img");
          img.src = e.target.result;
          img.classList.add("h-20", "w-20", "object-cover", "rounded", "shadow");
          
          wrapper.appendChild(img);
          preview.appendChild(wrapper);
        };
        reader.readAsDataURL(file);
      });
    }

    document.querySelectorAll(".remove-photo").forEach(btn => {
      btn.addEventListener("click", function() {
        const photoId = this.dataset.photoId;
        if (photoId) {
          if (!deletedPhotos.includes(photoId)) {
            deletedPhotos.push(photoId);
          }
          deletedPhotosInput.value = JSON.stringify(deletedPhotos);
        }
        this.parentElement.remove();
      });
    });
  </script>
@endsection
