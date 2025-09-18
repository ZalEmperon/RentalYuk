<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - RentalYuk</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @yield('custom-css')
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<style>
  .photo-preview-item.is-main {
    border: 3px solid #4f46e5; /* Warna indigo-600 */
    border-radius: 0.375rem; /* rounded-md */
  }
  .photo-preview-item.is-main .main-photo-badge {
    display: inline-block;
  }
</style>
<body>
  {{-- Side Bar --}}
  @include('owner.components.sidebar')
  <div class="sm:ml-64">
    {{-- Top Bar --}}
    @include('owner.components.navbar')
    <!-- Main Content -->
    @yield('page-content')
  </div>
  @include('admin.components.status_popup')
  @yield('page-component')
  @yield('custom-js')

</body>

</html>
