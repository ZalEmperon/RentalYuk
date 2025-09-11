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
