<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>@yield('title', 'Selamat Datang') - SIPMB Sekolah</title>
  
  <!-- Base Styles (Bootstrap from Spica Admin) -->
  <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
  
  <!-- Premium Custom Styling -->
  <link rel="stylesheet" href="{{ asset('css/public.css') }}">
  
  <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
  @yield('styles')
</head>

<body>

  <!-- Navigation Bar Component -->
  @include('components.navbar')

  <!-- Main Content -->
  <main>
    @yield('content')
  </main>

  <!-- Footer Component -->
  @include('components.footer')

  <!-- Base Scripts -->
  <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
  
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const navbar = document.querySelector('.public-navbar');
      if (!navbar) return;
      
      const isHome = {{ request()->routeIs('home') ? 'true' : 'false' }};
      
      if (isHome) {
        function handleScroll() {
          if (window.scrollY > 50) {
            navbar.classList.add('navbar-scrolled');
            navbar.classList.remove('navbar-transparent');
          } else {
            navbar.classList.remove('navbar-scrolled');
            navbar.classList.add('navbar-transparent');
          }
        }
        
        handleScroll();
        window.addEventListener('scroll', handleScroll);
      }
    });
  </script>
  @yield('scripts')
</body>

</html>
