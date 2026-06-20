<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="SIPMB - Sistem Informasi Penerimaan Murid Baru">
  <title>@yield('title', 'Dashboard') — SIPMB Admin</title>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Material Design Icons -->
  <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
  <!-- Bootstrap (via vendor bundle) -->
  <link rel="stylesheet" href="{{ asset('vendors/css/vendor.bundle.base.css') }}">
  <!-- Spica Admin Base Style -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />

  <style>
    /* ── Design Tokens ───────────────────────────────────────────── */
    :root {
      --sidebar-width: 255px;
      --navbar-height: 63px;
      --primary: #4f46e5;
      --primary-dark: #4338ca;
      --primary-light: rgba(79, 70, 229, 0.08);
      --sidebar-bg: #0f172a;
      --sidebar-text: #94a3b8;
      --sidebar-active-bg: rgba(79, 70, 229, 0.15);
      --sidebar-active-text: #ffffff;
      --sidebar-hover-bg: rgba(255, 255, 255, 0.05);
      --surface: #ffffff;
      --surface-alt: #f8fafc;
      --border: #e2e8f0;
      --text-primary: #0f172a;
      --text-secondary: #64748b;
      --font: 'Plus Jakarta Sans', sans-serif;
      --shadow-sm: 0 1px 3px 0 rgba(0,0,0,0.06), 0 1px 2px 0 rgba(0,0,0,0.04);
      --shadow-md: 0 4px 6px -1px rgba(0,0,0,0.07), 0 2px 4px -1px rgba(0,0,0,0.04);
      --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.07), 0 4px 6px -2px rgba(0,0,0,0.04);
      --radius: 10px;
      --radius-lg: 14px;
      --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* ── Reset & Base ────────────────────────────────────────────── */
    *, *::before, *::after { box-sizing: border-box; }

    body {
      font-family: var(--font);
      background-color: var(--surface-alt);
      color: var(--text-primary);
      margin: 0;
      padding: 0;
      overflow-x: hidden;
      font-size: 14px;
      line-height: 1.6;
    }

    /* ── Layout Shell ────────────────────────────────────────────── */
    .admin-shell {
      display: flex;
      min-height: 100vh;
    }

    /* ── Sidebar ─────────────────────────────────────────────────── */
    .admin-sidebar {
      width: var(--sidebar-width);
      background: var(--sidebar-bg);
      position: fixed;
      top: 0;
      left: 0;
      height: 100vh;
      overflow-y: auto;
      overflow-x: hidden;
      z-index: 1040;
      display: flex;
      flex-direction: column;
      transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      scrollbar-width: thin;
      scrollbar-color: rgba(255,255,255,0.1) transparent;
    }

    .admin-sidebar::-webkit-scrollbar { width: 4px; }
    .admin-sidebar::-webkit-scrollbar-track { background: transparent; }
    .admin-sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 2px; }

    /* Sidebar Brand */
    .sidebar-brand {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 20px 20px 16px;
      border-bottom: 1px solid rgba(255,255,255,0.06);
      text-decoration: none;
      flex-shrink: 0;
    }

    .sidebar-brand-icon {
      width: 38px;
      height: 38px;
      border-radius: 10px;
      background: linear-gradient(135deg, var(--primary), #8b5cf6);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.1rem;
      color: white;
      flex-shrink: 0;
    }

    .sidebar-brand-text { line-height: 1.2; }
    .sidebar-brand-name {
      font-weight: 800;
      font-size: 1rem;
      color: #ffffff;
      display: block;
    }
    .sidebar-brand-sub {
      font-size: 0.7rem;
      color: var(--sidebar-text);
      font-weight: 500;
    }

    /* Sidebar Nav */
    .sidebar-nav {
      flex: 1;
      padding: 16px 12px;
      list-style: none;
      margin: 0;
    }

    .sidebar-section-label {
      font-size: 0.65rem;
      font-weight: 700;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: rgba(148, 163, 184, 0.5);
      padding: 16px 8px 6px;
      display: block;
    }

    .sidebar-nav-item { margin-bottom: 2px; }

    .sidebar-nav-link {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 9px 12px;
      border-radius: 8px;
      text-decoration: none;
      color: var(--sidebar-text);
      font-weight: 500;
      font-size: 0.85rem;
      transition: var(--transition);
      white-space: nowrap;
      overflow: hidden;
    }

    .sidebar-nav-link:hover {
      background: var(--sidebar-hover-bg);
      color: #ffffff;
    }

    .sidebar-nav-link.active {
      background: var(--sidebar-active-bg);
      color: var(--sidebar-active-text);
      font-weight: 600;
    }

    .sidebar-nav-link .nav-icon {
      font-size: 1.1rem;
      width: 20px;
      text-align: center;
      flex-shrink: 0;
      color: var(--sidebar-text);
      transition: var(--transition);
    }

    .sidebar-nav-link:hover .nav-icon,
    .sidebar-nav-link.active .nav-icon {
      color: var(--primary);
    }

    /* Sidebar Footer */
    .sidebar-footer {
      padding: 12px;
      border-top: 1px solid rgba(255,255,255,0.06);
      flex-shrink: 0;
    }

    .sidebar-user {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 10px;
      border-radius: 8px;
      background: rgba(255,255,255,0.04);
      margin-bottom: 8px;
    }

    .sidebar-user-avatar {
      width: 34px;
      height: 34px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--primary), #8b5cf6);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.9rem;
      font-weight: 700;
      color: white;
      flex-shrink: 0;
    }

    .sidebar-user-info { overflow: hidden; }
    .sidebar-user-name {
      font-size: 0.8rem;
      font-weight: 600;
      color: #ffffff;
      display: block;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .sidebar-user-role {
      font-size: 0.68rem;
      color: var(--sidebar-text);
      display: block;
    }

    .sidebar-logout-btn {
      display: flex;
      align-items: center;
      gap: 8px;
      width: 100%;
      padding: 9px 12px;
      border-radius: 8px;
      color: #f87171;
      background: transparent;
      border: none;
      cursor: pointer;
      font-size: 0.82rem;
      font-weight: 500;
      font-family: var(--font);
      transition: var(--transition);
      text-align: left;
    }

    .sidebar-logout-btn:hover {
      background: rgba(248, 113, 113, 0.1);
      color: #fca5a5;
    }

    /* ── Main Content Area ───────────────────────────────────────── */
    .admin-main {
      margin-left: var(--sidebar-width);
      flex: 1;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      transition: margin-left 0.3s;
    }

    /* ── Top Navbar ──────────────────────────────────────────────── */
    .admin-navbar {
      height: var(--navbar-height);
      background: var(--surface);
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      padding: 0 24px;
      position: sticky;
      top: 0;
      z-index: 1030;
      gap: 16px;
      box-shadow: var(--shadow-sm);
    }

    .navbar-toggle-btn {
      display: none;
      background: none;
      border: none;
      cursor: pointer;
      padding: 8px;
      border-radius: 6px;
      color: var(--text-secondary);
      font-size: 1.3rem;
      transition: var(--transition);
    }

    .navbar-toggle-btn:hover { background: var(--surface-alt); color: var(--text-primary); }

    .navbar-page-title {
      font-size: 1rem;
      font-weight: 700;
      color: var(--text-primary);
      margin: 0;
      flex: 1;
    }

    .navbar-right {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .navbar-user-pill {
      display: flex;
      align-items: center;
      gap: 8px;
      padding: 6px 12px 6px 6px;
      background: var(--surface-alt);
      border: 1px solid var(--border);
      border-radius: 50px;
      cursor: pointer;
      transition: var(--transition);
      text-decoration: none;
    }

    .navbar-user-pill:hover { background: var(--primary-light); border-color: rgba(79,70,229,0.2); }

    .navbar-user-avatar {
      width: 28px;
      height: 28px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--primary), #8b5cf6);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.7rem;
      font-weight: 700;
      color: white;
    }

    .navbar-user-name {
      font-size: 0.82rem;
      font-weight: 600;
      color: var(--text-primary);
    }

    /* ── Content Wrapper ─────────────────────────────────────────── */
    .admin-content {
      flex: 1;
      padding: 24px;
    }

    /* ── Alert Messages ──────────────────────────────────────────── */
    .flash-messages { margin-bottom: 20px; }

    .flash-alert {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 12px 16px;
      border-radius: var(--radius);
      font-size: 0.875rem;
      font-weight: 500;
      margin-bottom: 10px;
      border: 1px solid transparent;
    }

    .flash-alert-success {
      background: #f0fdf4;
      border-color: #bbf7d0;
      color: #166534;
    }

    .flash-alert-error {
      background: #fef2f2;
      border-color: #fecaca;
      color: #991b1b;
    }

    .flash-close {
      margin-left: auto;
      background: none;
      border: none;
      cursor: pointer;
      color: inherit;
      opacity: 0.6;
      padding: 2px;
      font-size: 1rem;
      line-height: 1;
    }

    .flash-close:hover { opacity: 1; }

    /* ── Page Header ─────────────────────────────────────────────── */
    .page-header {
      display: flex;
      align-items: flex-start;
      justify-content: space-between;
      margin-bottom: 24px;
      gap: 16px;
      flex-wrap: wrap;
    }

    .page-header-left h1 {
      font-size: 1.375rem;
      font-weight: 800;
      color: var(--text-primary);
      margin: 0 0 4px 0;
      line-height: 1.3;
    }

    .page-header-left p {
      font-size: 0.875rem;
      color: var(--text-secondary);
      margin: 0;
    }

    .page-header-actions { display: flex; gap: 8px; align-items: center; }

    /* ── Breadcrumb ──────────────────────────────────────────────── */
    .admin-breadcrumb {
      display: flex;
      align-items: center;
      gap: 6px;
      font-size: 0.78rem;
      color: var(--text-secondary);
      margin-bottom: 16px;
      list-style: none;
      padding: 0;
    }

    .admin-breadcrumb li { display: flex; align-items: center; gap: 6px; }
    .admin-breadcrumb li a { color: var(--text-secondary); text-decoration: none; transition: var(--transition); }
    .admin-breadcrumb li a:hover { color: var(--primary); }
    .admin-breadcrumb li.active { color: var(--text-primary); font-weight: 600; }
    .admin-breadcrumb .sep { color: #cbd5e1; font-size: 0.7rem; }

    /* ── Cards ───────────────────────────────────────────────────── */
    .card {
      background: var(--surface);
      border-radius: var(--radius-lg);
      border: 1px solid var(--border);
      box-shadow: var(--shadow-sm);
    }

    .card-header-custom {
      padding: 16px 20px;
      border-bottom: 1px solid var(--border);
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .card-header-custom h5,
    .card-header-custom h4 {
      margin: 0;
      font-weight: 700;
      font-size: 0.95rem;
      color: var(--text-primary);
    }

    .card-body-custom { padding: 20px; }

    /* ── Tables ──────────────────────────────────────────────────── */
    .table thead th {
      font-size: 0.75rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      color: var(--text-secondary);
      background: #f8fafc;
      border-bottom: 1px solid var(--border);
      padding: 10px 12px;
      white-space: nowrap;
    }

    .table tbody td {
      padding: 12px;
      font-size: 0.85rem;
      color: var(--text-primary);
      border-bottom: 1px solid #f1f5f9;
      vertical-align: middle;
    }

    .table tbody tr:hover td { background: #f8fafc; }
    .table tbody tr:last-child td { border-bottom: none; }

    /* ── Buttons ─────────────────────────────────────────────────── */
    .btn-primary {
      background: var(--primary) !important;
      border-color: var(--primary) !important;
      color: #ffffff !important;
      font-weight: 600;
      border-radius: 8px;
      transition: var(--transition);
    }

    .btn-primary:hover {
      background: var(--primary-dark) !important;
      border-color: var(--primary-dark) !important;
      transform: translateY(-1px);
      box-shadow: 0 4px 10px rgba(79, 70, 229, 0.25);
    }

    .btn-sm { font-size: 0.8rem; padding: 5px 10px; }

    /* ── Badges ──────────────────────────────────────────────────── */
    .badge {
      font-size: 0.7rem;
      font-weight: 600;
      padding: 4px 8px;
      border-radius: 6px;
    }

    /* ── Forms ───────────────────────────────────────────────────── */
    .form-control, .form-select {
      border-color: var(--border);
      border-radius: 8px;
      font-size: 0.875rem;
      font-family: var(--font);
      color: var(--text-primary);
      transition: var(--transition);
    }

    .form-control:focus, .form-select:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.12);
    }

    label {
      font-size: 0.82rem;
      font-weight: 600;
      color: var(--text-secondary);
      margin-bottom: 6px;
      display: block;
    }

    /* ── Footer ──────────────────────────────────────────────────── */
    .admin-footer {
      padding: 16px 24px;
      border-top: 1px solid var(--border);
      font-size: 0.78rem;
      color: var(--text-secondary);
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: var(--surface);
    }

    /* ── Mobile Overlay ──────────────────────────────────────────── */
    .sidebar-overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0,0,0,0.5);
      z-index: 1035;
    }

    /* ── Responsive ──────────────────────────────────────────────── */
    @media (max-width: 991.98px) {
      .admin-sidebar {
        transform: translateX(-100%);
      }

      .admin-sidebar.sidebar-open {
        transform: translateX(0);
      }

      .admin-main {
        margin-left: 0;
      }

      .navbar-toggle-btn {
        display: flex;
      }

      .sidebar-overlay.show {
        display: block;
      }
    }

    /* ── Spica Compatibility Overrides ───────────────────────────── */
    /* Remove Spica's old layout classes interference */
    .container-scroller,
    .page-body-wrapper,
    .main-panel,
    .content-wrapper { all: unset; display: contents; }

    /* Keep Bootstrap utility classes working */
    .d-flex { display: flex !important; }
    .d-none { display: none !important; }
    .grid-margin { margin-bottom: 24px; }
    .stretch-card { display: flex !important; flex-direction: column; }
    .stretch-card > .card { flex: 1; }
  </style>

  @yield('styles')
</head>

<body>
<div class="admin-shell">

  <!-- ─── Sidebar ─────────────────────────────────────────────── -->
  @include('partials.sidebar')

  <!-- ─── Main ──────────────────────────────────────────────────── -->
  <div class="admin-main">

    <!-- Top Navbar -->
    @include('partials.navbar')

    <!-- Content -->
    <div class="admin-content">

      <!-- Flash Messages -->
      @if (session('success'))
        <div class="flash-messages">
          <div class="flash-alert flash-alert-success" id="flash-success">
            <i class="mdi mdi-check-circle"></i>
            <span>{{ session('success') }}</span>
            <button class="flash-close" onclick="this.parentElement.remove()">
              <i class="mdi mdi-close"></i>
            </button>
          </div>
        </div>
      @endif

      @if (session('error'))
        <div class="flash-messages">
          <div class="flash-alert flash-alert-error" id="flash-error">
            <i class="mdi mdi-alert-circle"></i>
            <span>{{ session('error') }}</span>
            <button class="flash-close" onclick="this.parentElement.remove()">
              <i class="mdi mdi-close"></i>
            </button>
          </div>
        </div>
      @endif

      <!-- Page Content -->
      @yield('content')

    </div>
    <!-- /admin-content -->

    <!-- Footer -->
    @include('partials.footer')

  </div>
  <!-- /admin-main -->

</div>
<!-- /admin-shell -->

<!-- Mobile sidebar overlay -->
<div class="sidebar-overlay" id="sidebarOverlay" onclick="closeSidebar()"></div>

<!-- Hidden logout form -->
<form id="admin-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
  @csrf
</form>

<!-- Scripts -->
<script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
<script>
  // Mobile sidebar toggle
  function openSidebar() {
    document.getElementById('adminSidebar').classList.add('sidebar-open');
    document.getElementById('sidebarOverlay').classList.add('show');
    document.body.style.overflow = 'hidden';
  }

  function closeSidebar() {
    document.getElementById('adminSidebar').classList.remove('sidebar-open');
    document.getElementById('sidebarOverlay').classList.remove('show');
    document.body.style.overflow = '';
  }

  // Auto-dismiss flash messages after 5 seconds
  setTimeout(function() {
    ['flash-success', 'flash-error'].forEach(function(id) {
      var el = document.getElementById(id);
      if (el) {
        el.style.transition = 'opacity 0.5s';
        el.style.opacity = '0';
        setTimeout(function() { el.remove(); }, 500);
      }
    });
  }, 5000);
</script>
@yield('scripts')
</body>
</html>
