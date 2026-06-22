<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Login ke sistem administrasi SIPMB — Penerimaan Murid Baru">
  <title>Masuk — SIPMB</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />

  <style>
    :root {
      --primary: #4f46e5;
      --primary-dark: #4338ca;
      --primary-light: rgba(79, 70, 229, 0.08);
      --font: 'Plus Jakarta Sans', sans-serif;
    }

    *, *::before, *::after { box-sizing: border-box; }

    body {
      font-family: var(--font);
      margin: 0;
      padding: 0;
      min-height: 100vh;
      display: flex;
      background: #f8fafc;
    }

    /* Left Panel */
    .auth-left {
      width: 45%;
      background: linear-gradient(135deg, #0f172a 0%, #1e293b 40%, #312e81 100%);
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 60px 50px;
      position: relative;
      overflow: hidden;
    }

    .auth-left::before {
      content: '';
      position: absolute;
      top: -100px;
      right: -100px;
      width: 400px;
      height: 400px;
      border-radius: 50%;
      background: rgba(79, 70, 229, 0.15);
      pointer-events: none;
    }

    .auth-left::after {
      content: '';
      position: absolute;
      bottom: -80px;
      left: -80px;
      width: 300px;
      height: 300px;
      border-radius: 50%;
      background: rgba(139, 92, 246, 0.1);
      pointer-events: none;
    }

    .auth-brand {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 60px;
      position: relative;
      z-index: 1;
    }

    .auth-brand-icon {
      width: 44px;
      height: 44px;
      background: linear-gradient(135deg, var(--primary), #8b5cf6);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.25rem;
      color: white;
    }

    .auth-brand-name {
      font-size: 1.25rem;
      font-weight: 800;
      color: white;
    }

    .auth-left-content {
      position: relative;
      z-index: 1;
    }

    .auth-left-content h2 {
      font-size: 2.25rem;
      font-weight: 800;
      color: white;
      line-height: 1.25;
      margin: 0 0 16px 0;
    }

    .auth-left-content h2 span {
      background: linear-gradient(135deg, #a78bfa, #60a5fa);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .auth-left-content p {
      font-size: 1rem;
      color: rgba(148, 163, 184, 0.9);
      line-height: 1.7;
      margin: 0 0 40px 0;
    }

    .auth-features {
      list-style: none;
      padding: 0;
      margin: 0;
      display: flex;
      flex-direction: column;
      gap: 16px;
    }

    .auth-features li {
      display: flex;
      align-items: flex-start;
      gap: 12px;
      color: rgba(203, 213, 225, 0.9);
      font-size: 0.9rem;
      font-weight: 500;
    }

    .auth-features li i {
      font-size: 1.1rem;
      color: #a78bfa;
      margin-top: 1px;
      flex-shrink: 0;
    }

    /* Right Panel */
    .auth-right {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px 50px;
    }

    .auth-form-card {
      width: 100%;
      max-width: 420px;
    }

    .auth-form-title {
      font-size: 1.75rem;
      font-weight: 800;
      color: #0f172a;
      margin: 0 0 6px 0;
    }

    .auth-form-subtitle {
      font-size: 0.9rem;
      color: #64748b;
      margin: 0 0 32px 0;
    }

    .auth-form-subtitle a {
      color: var(--primary);
      font-weight: 600;
      text-decoration: none;
    }

    .auth-form-subtitle a:hover { text-decoration: underline; }

    .form-group-auth { margin-bottom: 20px; }

    .form-label-auth {
      font-size: 0.82rem;
      font-weight: 600;
      color: #374151;
      display: block;
      margin-bottom: 6px;
    }

    .form-input-auth {
      width: 100%;
      padding: 11px 14px;
      border: 1.5px solid #e2e8f0;
      border-radius: 10px;
      font-size: 0.9rem;
      font-family: var(--font);
      color: #0f172a;
      background: white;
      transition: all 0.2s;
      outline: none;
    }

    .form-input-auth::placeholder { color: #94a3b8; }

    .form-input-auth:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.12);
    }

    .form-input-auth.is-invalid {
      border-color: #f87171;
    }

    .form-input-auth.is-invalid:focus {
      box-shadow: 0 0 0 3px rgba(248, 113, 113, 0.15);
    }

    .invalid-text {
      color: #dc2626;
      font-size: 0.78rem;
      margin-top: 5px;
      display: block;
    }

    .input-with-icon {
      position: relative;
    }

    .input-icon {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: #94a3b8;
      font-size: 1.05rem;
      pointer-events: none;
    }

    .input-with-icon .form-input-auth {
      padding-left: 38px;
    }

    .form-remember {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 24px;
    }

    .form-remember input[type="checkbox"] {
      width: 16px;
      height: 16px;
      border-radius: 4px;
      accent-color: var(--primary);
      cursor: pointer;
    }

    .form-remember label {
      font-size: 0.85rem;
      color: #64748b;
      cursor: pointer;
      margin: 0;
    }

    .btn-auth {
      width: 100%;
      padding: 13px;
      background: var(--primary);
      color: white;
      border: none;
      border-radius: 10px;
      font-size: 0.95rem;
      font-weight: 700;
      font-family: var(--font);
      cursor: pointer;
      transition: all 0.2s;
      letter-spacing: 0.01em;
    }

    .btn-auth:hover {
      background: var(--primary-dark);
      transform: translateY(-1px);
      box-shadow: 0 6px 16px rgba(79, 70, 229, 0.3);
    }

    .btn-auth:active { transform: translateY(0); }

    .auth-divider {
      text-align: center;
      margin: 24px 0;
      font-size: 0.82rem;
      color: #94a3b8;
    }

    .auth-link-secondary {
      text-align: center;
      font-size: 0.87rem;
      color: #64748b;
    }

    .auth-link-secondary a {
      color: var(--primary);
      font-weight: 600;
      text-decoration: none;
    }

    .auth-link-secondary a:hover { text-decoration: underline; }

    .alert-auth {
      background: #fef2f2;
      border: 1px solid #fecaca;
      border-radius: 10px;
      padding: 12px 14px;
      margin-bottom: 20px;
      font-size: 0.85rem;
      color: #991b1b;
      display: flex;
      align-items: flex-start;
      gap: 10px;
    }

    .alert-auth i { flex-shrink: 0; font-size: 1rem; margin-top: 1px; }

    /* Responsive */
    @media (max-width: 768px) {
      .auth-left { display: none; }
      .auth-right { padding: 30px 20px; }
    }
  </style>
</head>
<body>

  {{-- Left Panel: Branding --}}
  <div class="auth-left">
    <div class="auth-brand">
      <div class="auth-brand-icon">
        <i class="mdi mdi-school"></i>
      </div>
      <span class="auth-brand-name">SIPMB</span>
    </div>

    <div class="auth-left-content">
      <h2>
        Selamat Datang di<br>
        Portal <span>Penerimaan Murid Baru</span>
      </h2>
      <p>
        Sistem terpadu untuk mengelola proses penerimaan siswa baru secara digital, transparan, dan efisien.
      </p>
      <ul class="auth-features">
        <li>
          <i class="mdi mdi-shield-check-outline"></i>
          <span>Verifikasi data siswa secara online dengan akurasi tinggi</span>
        </li>
        <li>
          <i class="mdi mdi-cash-multiple"></i>
          <span>Konfirmasi pembayaran dan monitoring tagihan secara real-time</span>
        </li>
        <li>
          <i class="mdi mdi-bullhorn-outline"></i>
          <span>Pengumuman kelulusan otomatis langsung ke akun siswa</span>
        </li>
        <li>
          <i class="mdi mdi-account-multiple-outline"></i>
          <span>Akses Portal: Administrator & Calon Siswa / Wali Murid</span>
        </li>
      </ul>
    </div>
  </div>

  {{-- Right Panel: Form --}}
  <div class="auth-right">
    <div class="auth-form-card">
      <h1 class="auth-form-title">Masuk ke Sistem</h1>
      <p class="auth-form-subtitle">
        Belum punya akun siswa?
        <a href="{{ route('register') }}">Daftar Sekarang</a>
      </p>

      @if ($errors->any())
        <div class="alert-auth">
          <i class="mdi mdi-alert-circle-outline"></i>
          <div>
            @foreach ($errors->all() as $error)
              <div>{{ $error }}</div>
            @endforeach
          </div>
        </div>
      @endif

      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group-auth">
          <label class="form-label-auth" for="email">Alamat Email</label>
          <div class="input-with-icon">
            <i class="mdi mdi-email-outline input-icon"></i>
            <input type="email"
                   class="form-input-auth @error('email') is-invalid @enderror"
                   id="email"
                   name="email"
                   value="{{ old('email') }}"
                   placeholder="contoh@email.com"
                   required
                   autofocus
                   autocomplete="email">
          </div>
          @error('email')
            <span class="invalid-text">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group-auth">
          <label class="form-label-auth" for="password">Password</label>
          <div class="input-with-icon">
            <i class="mdi mdi-lock-outline input-icon"></i>
            <input type="password"
                   class="form-input-auth @error('password') is-invalid @enderror"
                   id="password"
                   name="password"
                   placeholder="••••••••"
                   required
                   autocomplete="current-password">
          </div>
          @error('password')
            <span class="invalid-text">{{ $message }}</span>
          @enderror
        </div>

        <button type="submit" class="btn-auth">
          <i class="mdi mdi-login me-1"></i> Masuk ke Akun
        </button>

      </form>

      <div class="auth-divider">atau</div>

    </div>
  </div>

</body>
</html>
