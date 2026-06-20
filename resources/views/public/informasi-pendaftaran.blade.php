@extends('layouts.public')

@section('title', 'Informasi Pendaftaran')

@section('content')
<section class="py-5 bg-light-custom">
  <div class="container">
    <div class="row text-center mb-4">
      <div class="col-12">
        <h2 class="section-title">Informasi Pendaftaran</h2>
        <p class="section-desc">Panduan alur, syarat kelengkapan, dan jadwal seleksi penerimaan murid baru.</p>
      </div>
    </div>
  </div>
</section>

<!-- Flow Section -->
<section class="py-5">
  <div class="container">
    <div class="row text-center mb-5">
      <div class="col-12">
        <h4 class="font-weight-bold text-dark">Alur Pendaftaran Online</h4>
        <p class="text-muted">Proses pendaftaran cepat dan mudah melalui 4 tahapan ringkas.</p>
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-3 mb-4 mb-md-0">
        <div class="flow-step h-100 text-center">
          <div class="flow-num mx-auto">1</div>
          <h5 class="font-weight-bold text-dark">Daftar Akun</h5>
          <p class="text-muted small mb-0">Buat akun calon murid baru di halaman registrasi dengan email aktif.</p>
        </div>
      </div>
      
      <div class="col-md-3 mb-4 mb-md-0">
        <div class="flow-step h-100 text-center">
          <div class="flow-num mx-auto">2</div>
          <h5 class="font-weight-bold text-dark">Lengkapi Profil</h5>
          <p class="text-muted small mb-0">Login lalu isi lengkap formulir biodata pribadi serta informasi orang tua.</p>
        </div>
      </div>
      
      <div class="col-md-3 mb-4 mb-md-0">
        <div class="flow-step h-100 text-center">
          <div class="flow-num mx-auto">3</div>
          <h5 class="font-weight-bold text-dark">Pilih Paket & Bayar</h5>
          <p class="text-muted small mb-0">Pilih paket pendaftaran, transfer biaya pendaftaran, lalu upload foto bukti transfer.</p>
        </div>
      </div>
      
      <div class="col-md-3">
        <div class="flow-step h-100 text-center">
          <div class="flow-num mx-auto">4</div>
          <h5 class="font-weight-bold text-dark">Verifikasi & Lulus</h5>
          <p class="text-muted small mb-0">Admin akan memverifikasi berkas dan pembayaran Anda. Hasil kelulusan diumumkan di dashboard.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Requirements & Schedule -->
<section class="py-5 bg-light-custom">
  <div class="container">
    <div class="row">
      
      <!-- Schedule -->
      <div class="col-lg-6 mb-4 mb-lg-0">
        <h4 class="font-weight-bold text-dark mb-4"><i class="mdi mdi-calendar-clock text-primary me-2"></i>Jadwal Penerimaan Murid Baru</h4>
        <div class="card border-0 shadow-sm p-4">
          <div class="card-body p-2">
            <div class="timeline-item">
              <h6 class="font-weight-bold text-primary">Gelombang 1 (Reguler)</h6>
              <p class="text-dark font-weight-bold mb-1">01 Januari - 31 Maret 2026</p>
              <small class="text-muted">Potongan biaya formulir pendaftaran 50%</small>
            </div>
            <div class="timeline-item">
              <h6 class="font-weight-bold text-primary">Gelombang 2 (Umum)</h6>
              <p class="text-dark font-weight-bold mb-1">01 April - 30 Juni 2026</p>
              <small class="text-muted">Biaya pendaftaran normal, kuota terbatas</small>
            </div>
            <div class="timeline-item mb-0 pb-0">
              <h6 class="font-weight-bold text-danger">Gelombang 3 (Tambahan)</h6>
              <p class="text-dark font-weight-bold mb-1">01 Juli - 15 Juli 2026</p>
              <small class="text-muted">Hanya dibuka jika kuota kelas belum penuh</small>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Requirements -->
      <div class="col-lg-6">
        <h4 class="font-weight-bold text-dark mb-4"><i class="mdi mdi-file-document-box-multiple text-success me-2"></i>Syarat Dokumen & Kelengkapan</h4>
        <div class="card border-0 shadow-sm p-4">
          <div class="card-body p-2">
            <ul class="list-unstyled text-muted">
              <li class="mb-3 d-flex align-items-start gap-2">
                <i class="mdi mdi-check-circle-outline text-success fs-5"></i>
                <div>
                  <strong class="text-dark">Persyaratan Usia</strong>
                  <p class="mb-0 small">Minimal 4 tahun untuk jenjang RA, dan minimal 6 tahun untuk jenjang MI (pada Juli 2026).</p>
                </div>
              </li>
              <li class="mb-3 d-flex align-items-start gap-2">
                <i class="mdi mdi-check-circle-outline text-success fs-5"></i>
                <div>
                  <strong class="text-dark">Kartu Keluarga & Akta Lahir</strong>
                  <p class="mb-0 small">Fotokopi/scan Kartu Keluarga (KK) dan Akta Kelahiran calon murid.</p>
                </div>
              </li>
              <li class="mb-3 d-flex align-items-start gap-2">
                <i class="mdi mdi-check-circle-outline text-success fs-5"></i>
                <div>
                  <strong class="text-dark">KTP Orang Tua</strong>
                  <p class="mb-0 small">Fotokopi/scan KTP Ayah dan Ibu kandung / Wali murid.</p>
                </div>
              </li>
              <li class="d-flex align-items-start gap-2">
                <i class="mdi mdi-check-circle-outline text-success fs-5"></i>
                <div>
                  <strong class="text-dark">Bukti Pkh (Optional)</strong>
                  <p class="mb-0 small">Kartu Perlindungan Sosial (PKH/KPS/KIP) jika ada.</p>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Important Note -->
<section class="py-5">
  <div class="container text-center">
    <div class="alert alert-warning border shadow-sm p-4 max-width-800 mx-auto" style="border-radius: 16px;">
      <h5 class="font-weight-bold text-dark"><i class="mdi mdi-alert me-2 text-warning"></i>Catatan Penting</h5>
      <p class="mb-0 text-muted small">
        Seluruh berkas pendaftaran yang diunggah harus berupa scan file dokumen asli yang terbaca jelas. Pembayaran pendaftaran yang telah diverifikasi oleh admin tidak dapat ditarik kembali dengan alasan apa pun.
      </p>
    </div>
  </div>
</section>
@endsection
