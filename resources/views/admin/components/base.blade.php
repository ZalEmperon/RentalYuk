<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - RentalYuk</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @yield('custom-css')
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100">
  {{-- Side Bar --}}
  @include('admin.components.sidebar')
  <div class="p-4 sm:ml-64">
    {{-- Top Bar --}}
    @include('admin.components.navbar')
    <!-- Main Content -->
    @yield('page-content')
  </div>
  @yield('page-component')
  @yield('custom-js')

</body>

</html>
