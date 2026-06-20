<nav class="navbar navbar-expand-lg public-navbar {{ request()->routeIs('home') ? 'navbar-transparent' : 'navbar-scrolled' }} fixed-top py-3">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
      <img src="{{ asset('images/logo.svg') }}" height="36" alt="logo" style="filter: brightness(0) invert(1); transition: filter 0.3s ease;">
      <span class="brand-text">PPDB Portal</span>
    </a>
    <button class="navbar-toggler border-0 p-0" type="button" data-bs-toggle="collapse" data-bs-target="#publicNavbar" aria-controls="publicNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="mdi mdi-menu text-white fs-3 navbar-toggler-icon-custom"></span>
    </button>
    <div class="collapse navbar-collapse" id="publicNavbar">
      <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-1 gap-lg-3">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('home') && !request()->has('hash') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ request()->routeIs('home') ? '#jalur' : route('home') . '#jalur' }}">Jalur</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ request()->routeIs('home') ? '#program' : route('home') . '#program' }}">Program</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ request()->routeIs('home') ? '#alur' : route('home') . '#alur' }}">Alur</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ request()->routeIs('home') ? '#faq' : route('home') . '#faq' }}">FAQ</a>
        </li>
      </ul>
      <div class="d-flex align-items-center gap-3">
        @auth
          @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.dashboard') }}" class="btn btn-nav-cta">Dashboard Admin</a>
          @elseif(auth()->user()->isCalonMurid())
            <a href="{{ route('student.dashboard') }}" class="btn btn-nav-cta">Dashboard Siswa</a>
          @else
            <span class="text-white me-1 small auth-user-name">{{ auth()->user()->name }}</span>
          @endif
          
          <a href="#" class="btn btn-nav-outline" onclick="event.preventDefault(); document.getElementById('logout-form-public').submit();">
            Logout
          </a>
          <form id="logout-form-public" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>
        @else
          <a href="{{ route('login') }}" class="btn btn-nav-outline">Login</a>
          <a href="{{ route('register') }}" class="btn btn-nav-cta">Daftar Sekarang</a>
        @endauth
      </div>
    </div>
  </div>
</nav>

<style>
  /* Custom Navbar Toggle Icon Colors */
  .public-navbar.navbar-transparent .navbar-toggler-icon-custom {
    color: #ffffff !important;
  }
  .public-navbar.navbar-scrolled .navbar-toggler-icon-custom {
    color: var(--secondary) !important;
  }
  .public-navbar.navbar-scrolled img {
    filter: none !important;
  }
  .public-navbar.navbar-scrolled .brand-text {
    color: var(--primary) !important;
  }
  .public-navbar.navbar-scrolled .auth-user-name {
    color: var(--secondary) !important;
  }

  /* Outline Button */
  .btn-nav-outline {
    font-size: 0.9rem;
    font-weight: 600;
    padding: 0.5rem 1.25rem;
    border-radius: 8px;
    transition: var(--transition);
    text-decoration: none !important;
  }
  .public-navbar.navbar-transparent .btn-nav-outline {
    color: rgba(255, 255, 255, 0.9) !important;
    border: 1px solid rgba(255, 255, 255, 0.4);
  }
  .public-navbar.navbar-transparent .btn-nav-outline:hover {
    color: #ffffff !important;
    background: rgba(255, 255, 255, 0.1);
    border-color: #ffffff;
  }
  .public-navbar.navbar-scrolled .btn-nav-outline {
    color: var(--secondary) !important;
    border: 1px solid #cbd5e1;
  }
  .public-navbar.navbar-scrolled .btn-nav-outline:hover {
    background: #f1f5f9;
  }

  /* Primary CTA Button in Nav */
  .btn-nav-cta {
    background: var(--accent) !important;
    color: white !important;
    font-size: 0.9rem;
    font-weight: 700;
    padding: 0.5rem 1.25rem;
    border-radius: 8px;
    border: none;
    box-shadow: 0 4px 10px rgba(37, 99, 235, 0.2);
    transition: var(--transition);
    text-decoration: none !important;
  }
  .btn-nav-cta:hover {
    background: var(--accent-hover) !important;
    transform: translateY(-1px);
    box-shadow: 0 6px 14px rgba(37, 99, 235, 0.3);
  }
</style>
