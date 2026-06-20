@extends('layouts.admin')
@section('title', 'Dashboard Siswa')
@section('page_title', 'Dashboard Siswa')

@section('content')
<div class="row">
  <div class="col-12">
    <!-- Welcome Alert Banner -->
    <div class="alert alert-primary bg-white shadow-xs p-4 border border-light d-flex align-items-center mb-4" style="border-radius: 12px;">
      <i class="mdi mdi-hand-wave-outline text-primary fs-2 me-3"></i>
      <div>
        <h5 class="font-weight-bold text-dark mb-1">Halo, {{ auth()->user()->name }}!</h5>
        <p class="mb-0 text-muted small">Selamat datang di Sistem Penerimaan Murid Baru. Berikut adalah ringkasan proses pendaftaran Anda.</p>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <!-- Status Flow Checklist -->
  <div class="col-lg-4 mb-4">
    <div class="card h-100 shadow-sm">
      <div class="card-body">
        <h5 class="card-title"><i class="mdi mdi-checkbox-marked-outline text-primary me-2"></i>Status Tahapan Anda</h5>
        <hr>
        <ul class="list-unstyled">
          <!-- Step 1: Register Account -->
          <li class="mb-3 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
              <i class="mdi mdi-check-circle text-success fs-4 me-2"></i>
              <span class="text-dark font-weight-bold">1. Daftar Akun</span>
            </div>
            <span class="badge badge-success small">Selesai</span>
          </li>

          <!-- Step 2: Fill Profile -->
          <li class="mb-3 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
              @if($isProfileComplete)
                <i class="mdi mdi-check-circle text-success fs-4 me-2"></i>
                <span class="text-dark font-weight-bold">2. Lengkapi Profil</span>
              @else
                <i class="mdi mdi-circle-outline text-muted fs-4 me-2"></i>
                <span class="text-muted">2. Lengkapi Profil</span>
              @endif
            </div>
            @if($isProfileComplete)
              <span class="badge badge-success small">Selesai</span>
            @else
              <a href="{{ route('student.profile') }}" class="btn btn-xs btn-primary font-weight-bold py-1 px-2">Isi Data</a>
            @endif
          </li>

          <!-- Step 3: Select Package -->
          <li class="mb-3 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
              @if($hasSelectedPackage)
                <i class="mdi mdi-check-circle text-success fs-4 me-2"></i>
                <span class="text-dark font-weight-bold">3. Pilih Paket</span>
              @else
                <i class="mdi mdi-circle-outline text-muted fs-4 me-2"></i>
                <span class="text-muted">3. Pilih Paket</span>
              @endif
            </div>
            @if($hasSelectedPackage)
              <span class="badge badge-success small">Selesai</span>
            @elseif($isProfileComplete)
              <a href="{{ route('student.pendaftaran') }}" class="btn btn-xs btn-primary font-weight-bold py-1 px-2">Pilih</a>
            @else
              <span class="badge badge-light text-muted small">Terkunci</span>
            @endif
          </li>

          <!-- Step 4: Pay -->
          <li class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
              @if($hasSelectedPackage && $sisaTagihan == 0)
                <i class="mdi mdi-check-circle text-success fs-4 me-2"></i>
                <span class="text-dark font-weight-bold">4. Pembayaran</span>
              @else
                <i class="mdi mdi-circle-outline text-muted fs-4 me-2"></i>
                <span class="text-muted">4. Pembayaran</span>
              @endif
            </div>
            @if($hasSelectedPackage && $sisaTagihan == 0)
              <span class="badge badge-success small">Lunas</span>
            @elseif($hasSelectedPackage)
              <a href="{{ route('student.pembayaran') }}" class="btn btn-xs btn-primary font-weight-bold py-1 px-2">Bayar</a>
            @else
              <span class="badge badge-light text-muted small">Terkunci</span>
            @endif
          </li>
        </ul>
      </div>
    </div>
  </div>

  <!-- Status Cards Column -->
  <div class="col-lg-8">
    @if(!$isProfileComplete)
      <!-- Profile Action Card -->
      <div class="card bg-gradient-warning text-white p-4 mb-4">
        <div class="card-body">
          <h4 class="font-weight-bold text-white mb-2"><i class="mdi mdi-account-alert me-2"></i>Profil Anda Belum Lengkap!</h4>
          <p class="text-white-50 small mb-4">Anda harus mengisi data biodata diri calon siswa, serta informasi tentang ayah dan ibu kandung sebelum melanjutkan ke pemilihan kelas dan paket.</p>
          <a href="{{ route('student.profile') }}" class="btn btn-light text-warning font-weight-bold">Lengkapi Data Sekarang</a>
        </div>
      </div>
    @elseif(!$hasSelectedPackage)
      <!-- Package Action Card -->
      <div class="card bg-gradient-info text-white p-4 mb-4">
        <div class="card-body">
          <h4 class="font-weight-bold text-white mb-2"><i class="mdi mdi-package-variant me-2"></i>Silakan Pilih Paket Pendaftaran!</h4>
          <p class="text-white-50 small mb-4">Profil Anda sudah lengkap. Tahapan selanjutnya adalah menentukan paket pendaftaran dan perlengkapan seragam/sepatu yang diinginkan.</p>
          <a href="{{ route('student.pendaftaran') }}" class="btn btn-light text-info font-weight-bold">Pilih Paket Pendaftaran</a>
        </div>
      </div>
    @else
      <!-- Overview Panels -->
      <div class="row">
        <!-- Status Pendaftaran -->
        <div class="col-md-6 mb-4">
          <div class="card h-100 shadow-sm border-top border-primary border-3">
            <div class="card-body">
              <h6 class="text-muted text-uppercase mb-2 font-weight-bold">Status Verifikasi Berkas</h6>
              <div class="d-flex align-items-center mb-3">
                @if($siswa->status_pendaftaran == 'Menunggu Verifikasi')
                  <h4 class="font-weight-bold text-warning mb-0"><i class="mdi mdi-clock-alert me-1"></i>Menunggu Verifikasi</h4>
                @elseif($siswa->status_pendaftaran == 'Diterima')
                  <h4 class="font-weight-bold text-success mb-0"><i class="mdi mdi-checkbox-marked-circle me-1"></i>Diterima (Lulus)</h4>
                @else
                  <h4 class="font-weight-bold text-danger mb-0"><i class="mdi mdi-close-circle-outline me-1"></i>Ditolak</h4>
                @endif
              </div>
              <p class="text-muted small mb-3">Tim administrasi sekolah sedang mereview biodata diri dan kelengkapan keluarga Anda.</p>
              <a href="{{ route('student.pengumuman') }}" class="btn btn-sm btn-outline-primary font-weight-bold">Cek Pengumuman</a>
            </div>
          </div>
        </div>

        <!-- Status Pembayaran -->
        <div class="col-md-6 mb-4">
          <div class="card h-100 shadow-sm border-top border-success border-3">
            <div class="card-body">
              <h6 class="text-muted text-uppercase mb-2 font-weight-bold">Status Keuangan / Tagihan</h6>
              <div class="d-flex align-items-center mb-3">
                @if($sisaTagihan == 0)
                  <h4 class="font-weight-bold text-success mb-0"><i class="mdi mdi-shield-check me-1"></i>LUNAS</h4>
                @else
                  <h4 class="font-weight-bold text-danger mb-0"><i class="mdi mdi-cash-multiple me-1"></i>Sisa Tagihan: Rp {{ number_format($sisaTagihan, 0, ',', '.') }}</h4>
                @endif
              </div>
              <div class="text-muted small mb-3">
                Total Tagihan Paket: <strong>Rp {{ number_format($siswa->paket->nominal_biaya, 0, ',', '.') }}</strong><br>
                Telah Dibayar (Valid): <strong>Rp {{ number_format($totalBayarValid, 0, ',', '.') }}</strong>
              </div>
              <a href="{{ route('student.pembayaran') }}" class="btn btn-sm btn-outline-success font-weight-bold">Konfirmasi Bayar / Detail</a>
            </div>
          </div>
        </div>

        <!-- Selected Package Details -->
        <div class="col-12">
          <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
              <h5 class="mb-0 font-weight-bold text-dark"><i class="mdi mdi-package-variant-closed text-primary me-2"></i>Paket Pendaftaran Terpilih</h5>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 mb-3 mb-md-0">
                  <label class="text-muted small mb-0">Nama Paket</label>
                  <h5 class="font-weight-bold text-dark">{{ $siswa->paket->nama_paket }}</h5>
                  <label class="text-muted small mb-0">Rencana Kelas</label>
                  <p class="font-weight-bold text-dark mb-0">{{ $siswa->kelas ? $siswa->kelas->nama_kelas : '-' }} ({{ $siswa->kelas ? $siswa->kelas->jenjang : '-' }})</p>
                </div>
                <div class="col-md-6">
                  <label class="text-muted small mb-1">Perlengkapan yang diperoleh:</label>
                  <div class="d-flex flex-wrap gap-1">
                    @forelse($siswa->paket->items as $item)
                      <span class="badge badge-light border text-muted mb-1 me-1">{{ $item->nama_item }}</span>
                    @empty
                      <span class="text-muted small">Tidak ada perlengkapan yang dilampirkan.</span>
                    @endforelse
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    @endif
  </div>
</div>
@endsection
