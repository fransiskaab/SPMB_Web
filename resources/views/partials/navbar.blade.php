<header class="admin-navbar">
  {{-- Mobile toggle button --}}
  <button class="navbar-toggle-btn" onclick="openSidebar()" aria-label="Toggle sidebar">
    <i class="mdi mdi-menu"></i>
  </button>

  {{-- Page Title (set via @section in child views) --}}
  <h1 class="navbar-page-title">
    @hasSection('page_title')
      @yield('page_title')
    @else
      @yield('title', 'Dashboard')
    @endif
  </h1>

  {{-- Right Actions --}}
  <div class="navbar-right">
    {{-- Public Site Link --}}
    <a href="{{ route('home') }}" target="_blank"
       class="btn btn-sm"
       style="color: var(--text-secondary); border: 1px solid var(--border); background: var(--surface); border-radius: 8px; display: flex; align-items: center; gap: 6px; padding: 5px 12px; font-size: 0.8rem; font-weight: 500; text-decoration: none; transition: var(--transition);"
       title="Lihat halaman publik">
      <i class="mdi mdi-open-in-new" style="font-size: 0.9rem;"></i>
      <span class="d-none d-md-inline">Website</span>
    </a>

    {{-- User Pill --}}
    <div class="dropdown">
      <a class="navbar-user-pill" href="#" data-bs-toggle="dropdown" aria-expanded="false" id="navbarUserDropdown">
        <div class="navbar-user-avatar">
          {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
        </div>
        <span class="navbar-user-name d-none d-sm-block">{{ auth()->user()->name }}</span>
        <i class="mdi mdi-chevron-down" style="font-size: 0.9rem; color: var(--text-secondary);"></i>
      </a>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarUserDropdown" style="border-radius: 10px; border: 1px solid var(--border); box-shadow: var(--shadow-lg); min-width: 180px; padding: 6px;">
        <li>
          <span class="dropdown-item-text" style="font-size: 0.78rem; color: var(--text-secondary); padding: 4px 12px;">
            Masuk sebagai
          </span>
        </li>
        <li>
          <span class="dropdown-item-text" style="font-size: 0.85rem; font-weight: 700; color: var(--text-primary); padding: 4px 12px 8px;">
            {{ auth()->user()->name }}
          </span>
        </li>
        <li><hr class="dropdown-divider" style="margin: 4px 0;"></li>
        <li>
          <a class="dropdown-item" href="#"
             onclick="event.preventDefault(); document.getElementById('admin-logout-form').submit();"
             style="font-size: 0.85rem; color: #dc2626; border-radius: 6px; display: flex; align-items: center; gap: 8px; padding: 8px 12px;">
            <i class="mdi mdi-logout"></i>
            Keluar
          </a>
        </li>
      </ul>
    </div>
  </div>
</header>
