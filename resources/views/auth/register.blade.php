<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Daftar akun calon murid baru — SIPMB Sistem Penerimaan Murid Baru">
  <title>Daftar Akun — SIPMB</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />

  <style>
    :root {
      --primary: #4f46e5;
      --primary-dark: #4338ca;
      --secondary: #10b981;
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
      width: 40%;
      background: linear-gradient(160deg, #0f172a 0%, #1e293b 50%, #064e3b 100%);
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
      background: rgba(16, 185, 129, 0.1);
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
      background: rgba(79, 70, 229, 0.12);
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
      background: linear-gradient(135deg, var(--primary), var(--secondary));
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
      font-size: 2rem;
      font-weight: 800;
      color: white;
      line-height: 1.3;
      margin: 0 0 16px 0;
    }

    .auth-left-content h2 span {
      background: linear-gradient(135deg, #6ee7b7, #60a5fa);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .auth-left-content p {
      font-size: 0.95rem;
      color: rgba(148, 163, 184, 0.9);
      line-height: 1.7;
      margin: 0 0 32px 0;
    }

    .steps-list {
      list-style: none;
      padding: 0;
      margin: 0;
      counter-reset: step-counter;
    }

    .steps-list li {
      counter-increment: step-counter;
      display: flex;
      align-items: flex-start;
      gap: 14px;
      margin-bottom: 18px;
      color: rgba(203, 213, 225, 0.9);
      font-size: 0.88rem;
    }

    .steps-list li::before {
      content: counter(step-counter);
      width: 26px;
      height: 26px;
      background: rgba(16, 185, 129, 0.2);
      border: 1px solid rgba(16, 185, 129, 0.4);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.75rem;
      font-weight: 800;
      color: #6ee7b7;
      flex-shrink: 0;
      margin-top: 1px;
    }

    .steps-list li span { font-weight: 500; line-height: 1.5; }

    /* Right Panel */
    .auth-right {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px 50px;
      overflow-y: auto;
    }

    .auth-form-card {
      width: 100%;
      max-width: 460px;
      padding: 10px 0;
    }

    .auth-notice {
      display: flex;
      align-items: flex-start;
      gap: 10px;
      background: #eff6ff;
      border: 1px solid #bfdbfe;
      border-radius: 10px;
      padding: 12px 14px;
      margin-bottom: 24px;
      font-size: 0.82rem;
      color: #1d4ed8;
      font-weight: 500;
    }

    .auth-notice i { flex-shrink: 0; font-size: 1rem; }

    .auth-form-title {
      font-size: 1.65rem;
      font-weight: 800;
      color: #0f172a;
      margin: 0 0 6px 0;
    }

    .auth-form-subtitle {
      font-size: 0.88rem;
      color: #64748b;
      margin: 0 0 28px 0;
    }

    .auth-form-subtitle a {
      color: var(--primary);
      font-weight: 600;
      text-decoration: none;
    }

    .auth-form-subtitle a:hover { text-decoration: underline; }

    .form-row { display: flex; gap: 14px; }
    .form-row .form-group-auth { flex: 1; }

    .form-group-auth { margin-bottom: 18px; }

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
      font-size: 0.875rem;
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
    .form-input-auth.is-invalid { border-color: #f87171; }
    .form-input-auth.is-invalid:focus { box-shadow: 0 0 0 3px rgba(248, 113, 113, 0.15); }

    .input-with-icon { position: relative; }
    .input-icon {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: #94a3b8;
      font-size: 1.05rem;
      pointer-events: none;
    }
    .input-with-icon .form-input-auth { padding-left: 38px; }

    .invalid-text {
      color: #dc2626;
      font-size: 0.78rem;
      margin-top: 5px;
      display: block;
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
      margin-top: 8px;
    }

    .btn-auth:hover {
      background: var(--primary-dark);
      transform: translateY(-1px);
      box-shadow: 0 6px 16px rgba(79, 70, 229, 0.3);
    }

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

    .alert-auth i { flex-shrink: 0; font-size: 1rem; }

    .auth-link-secondary {
      text-align: center;
      font-size: 0.85rem;
      color: #64748b;
      margin-top: 20px;
    }

    .auth-link-secondary a {
      color: var(--primary);
      font-weight: 600;
      text-decoration: none;
    }

    .auth-link-secondary a:hover { text-decoration: underline; }

    @media (max-width: 768px) {
      .auth-left { display: none; }
      .auth-right { padding: 30px 20px; }
      .form-row { flex-direction: column; gap: 0; }
    }
  </style>
</head>
<body>

  {{-- Left Panel: Branding + Steps --}}
  <div class="auth-left">
    <div class="auth-brand">
      <div class="auth-brand-icon">
        <i class="mdi mdi-school"></i>
      </div>
      <span class="auth-brand-name">SIPMB</span>
    </div>

    <div class="auth-left-content">
      <h2>
        Mulai Perjalanan<br>
        <span>Pendidikan Anda</span><br>
        Di Sini
      </h2>
      <p>
        Daftarkan diri Anda sebagai calon murid baru dan nikmati kemudahan proses pendaftaran secara online.
      </p>
      <ol class="steps-list">
        <li><span>Buat akun dan masuk ke portal SIPMB</span></li>
        <li><span>Lengkapi data biodata diri dan informasi orang tua</span></li>
        <li><span>Pilih kelas dan paket pendaftaran yang sesuai</span></li>
        <li><span>Upload bukti pembayaran untuk konfirmasi</span></li>
        <li><span>Pantau status verifikasi dan pengumuman kelulusan</span></li>
      </ol>
    </div>
  </div>

  {{-- Right Panel: Form --}}
  <div class="auth-right">
    <div class="auth-form-card">

      <h1 class="auth-form-title">Buat Akun Baru</h1>
      <p class="auth-form-subtitle">
        Sudah punya akun?
        <a href="{{ route('login') }}">Masuk sekarang</a>
      </p>

      <div class="auth-notice">
        <i class="mdi mdi-information-outline"></i>
        <span>Pendaftaran akun ini <strong>khusus untuk Calon Murid Baru</strong>. Akun admin & staf hanya dibuat oleh administrator.</span>
      </div>

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

      <form action="{{ route('register') }}" method="POST">
        @csrf

        <div class="form-group-auth">
          <label class="form-label-auth" for="name">Nama Lengkap <span style="color: #dc2626;">*</span></label>
          <div class="input-with-icon">
            <i class="mdi mdi-account-outline input-icon"></i>
            <input type="text"
                   class="form-input-auth @error('name') is-invalid @enderror"
                   id="name"
                   name="name"
                   value="{{ old('name') }}"
                   placeholder="Nama lengkap sesuai KK"
                   required
                   autofocus
                   autocomplete="name">
          </div>
          @error('name')
            <span class="invalid-text">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-group-auth">
          <label class="form-label-auth" for="email">Alamat Email <span style="color: #dc2626;">*</span></label>
          <div class="input-with-icon">
            <i class="mdi mdi-email-outline input-icon"></i>
            <input type="email"
                   class="form-input-auth @error('email') is-invalid @enderror"
                   id="email"
                   name="email"
                   value="{{ old('email') }}"
                   placeholder="email@aktif.com"
                   required
                   autocomplete="email">
          </div>
          @error('email')
            <span class="invalid-text">{{ $message }}</span>
          @enderror
        </div>

        <div class="form-row">
          <div class="form-group-auth">
            <label class="form-label-auth" for="password">Password <span style="color: #dc2626;">*</span></label>
            <div class="input-with-icon">
              <i class="mdi mdi-lock-outline input-icon"></i>
              <input type="password"
                     class="form-input-auth @error('password') is-invalid @enderror"
                     id="password"
                     name="password"
                     placeholder="Min. 8 karakter"
                     required
                     autocomplete="new-password">
            </div>
            @error('password')
              <span class="invalid-text">{{ $message }}</span>
            @enderror
          </div>

          <div class="form-group-auth">
            <label class="form-label-auth" for="password_confirmation">Konfirmasi Password <span style="color: #dc2626;">*</span></label>
            <div class="input-with-icon">
              <i class="mdi mdi-lock-check-outline input-icon"></i>
              <input type="password"
                     class="form-input-auth"
                     id="password_confirmation"
                     name="password_confirmation"
                     placeholder="Ulangi password"
                     required
                     autocomplete="new-password">
            </div>
          </div>
        </div>

        <button type="submit" class="btn-auth">
          <i class="mdi mdi-account-plus me-1"></i> Buat Akun & Masuk
        </button>

      </form>

    </div>
  </div>

</body>
</html>
