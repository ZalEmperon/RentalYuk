<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sewa Toyota Avanza di Surabaya - RentalYuk</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @yield('custom-css')
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-gray-100 text-gray-800">
  {{-- Navigation Bar --}}
  @include('client.components.navbar')
  <!-- Main Content -->
  @yield('page-content')
  {{-- Footer --}}
  @include('client.components.footer')
  @include('admin.components.status_popup')
  @yield('custom-js')
  <script>
    // Mobile menu toggle
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuButton.addEventListener('click', () => {
      mobileMenu.classList.toggle('hidden');
    });

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
        e.preventDefault();

        document.querySelector(this.getAttribute('href')).scrollIntoView({
          behavior: 'smooth'
        });
      });
    });
  </script>
</body>

</html>
