<nav class="admin-sidebar" id="adminSidebar">

  {{-- Brand --}}
  <a class="sidebar-brand" href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('student.dashboard') }}">
    <div class="sidebar-brand-icon">
      <i class="mdi mdi-school"></i>
    </div>
    <div class="sidebar-brand-text">
      <span class="sidebar-brand-name">SIPMB</span>
      <span class="sidebar-brand-sub">Panel Administrasi</span>
    </div>
  </a>

  {{-- Navigation --}}
  <ul class="sidebar-nav">

    @if(auth()->user()->isAdmin())

      <span class="sidebar-section-label">Menu Utama</span>

      <li class="sidebar-nav-item">
        <a class="sidebar-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
          <i class="mdi mdi-view-dashboard-outline nav-icon"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <span class="sidebar-section-label">Master Data</span>

      <li class="sidebar-nav-item">
        <a class="sidebar-nav-link {{ request()->routeIs('admin.kelas.*') ? 'active' : '' }}" href="{{ route('admin.kelas.index') }}">
          <i class="mdi mdi-school nav-icon"></i>
          <span>Data Kelas</span>
        </a>
      </li>

      <li class="sidebar-nav-item">
        <a class="sidebar-nav-link {{ request()->routeIs('admin.paket.*') ? 'active' : '' }}" href="{{ route('admin.paket.index') }}">
          <i class="mdi mdi-package-variant-closed nav-icon"></i>
          <span>Paket Pendaftaran</span>
        </a>
      </li>

      <span class="sidebar-section-label">Verifikasi</span>

      <li class="sidebar-nav-item">
        <a class="sidebar-nav-link {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}" href="{{ route('admin.siswa.index') }}">
          <i class="mdi mdi-account-check nav-icon"></i>
          <span>Verifikasi Siswa</span>
        </a>
      </li>

      <li class="sidebar-nav-item">
        <a class="sidebar-nav-link {{ request()->routeIs('admin.pembayaran.*') ? 'active' : '' }}" href="{{ route('admin.pembayaran.index') }}">
          <i class="mdi mdi-cash-multiple nav-icon"></i>
          <span>Verifikasi Pembayaran</span>
        </a>
      </li>

      <span class="sidebar-section-label">Manajemen</span>

      <li class="sidebar-nav-item">
        <a class="sidebar-nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
          <i class="mdi mdi-account-multiple-outline nav-icon"></i>
          <span>Kelola Pengguna</span>
        </a>
      </li>

    @elseif(auth()->user()->isCalonMurid())

      <span class="sidebar-section-label">Beranda</span>

      <li class="sidebar-nav-item">
        <a class="sidebar-nav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}" href="{{ route('student.dashboard') }}">
          <i class="mdi mdi-view-dashboard-outline nav-icon"></i>
          <span>Dashboard Siswa</span>
        </a>
      </li>

      <span class="sidebar-section-label">Proses Pendaftaran</span>

      <li class="sidebar-nav-item">
        <a class="sidebar-nav-link {{ request()->routeIs('student.profile') ? 'active' : '' }}" href="{{ route('student.profile') }}">
          <i class="mdi mdi-account-edit-outline nav-icon"></i>
          <span>Lengkapi Profil</span>
        </a>
      </li>

      <li class="sidebar-nav-item">
        <a class="sidebar-nav-link {{ request()->routeIs('student.pendaftaran') ? 'active' : '' }}" href="{{ route('student.pendaftaran') }}">
          <i class="mdi mdi-clipboard-list-outline nav-icon"></i>
          <span>Pilih Paket</span>
        </a>
      </li>

      <li class="sidebar-nav-item">
        <a class="sidebar-nav-link {{ request()->routeIs('student.pembayaran') ? 'active' : '' }}" href="{{ route('student.pembayaran') }}">
          <i class="mdi mdi-credit-card-outline nav-icon"></i>
          <span>Konfirmasi Pembayaran</span>
        </a>
      </li>

      <li class="sidebar-nav-item">
        <a class="sidebar-nav-link {{ request()->routeIs('student.pengumuman') ? 'active' : '' }}" href="{{ route('student.pengumuman') }}">
          <i class="mdi mdi-bullhorn-outline nav-icon"></i>
          <span>Pengumuman Kelulusan</span>
        </a>
      </li>

    @endif

  </ul>

  {{-- Sidebar Footer: User info + Logout --}}
  <div class="sidebar-footer">
    <div class="sidebar-user">
      <div class="sidebar-user-avatar">
        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
      </div>
      <div class="sidebar-user-info">
        <span class="sidebar-user-name">{{ auth()->user()->name }}</span>
        <span class="sidebar-user-role">
          @if(auth()->user()->isAdmin()) Administrator
          @elseif(auth()->user()->isCalonMurid()) Calon Siswa/Wali Murid
          @else {{ auth()->user()->role }}
          @endif
        </span>
      </div>
    </div>
    <button class="sidebar-logout-btn" onclick="document.getElementById('admin-logout-form').submit()">
      <i class="mdi mdi-logout nav-icon" style="color: #f87171;"></i>
      Keluar dari Sistem
    </button>
  </div>

</nav>
