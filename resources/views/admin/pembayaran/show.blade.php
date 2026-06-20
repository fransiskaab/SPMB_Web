@extends('layouts.admin')
@section('title', 'Detail Pembayaran #' . $transaksi->id)
@section('page_title', 'Verifikasi — Detail Pembayaran')

@section('content')

{{-- Breadcrumb --}}
<ul class="admin-breadcrumb">
  <li><a href="{{ route('admin.dashboard') }}"><i class="mdi mdi-home-outline"></i> Dashboard</a></li>
  <li><span class="sep">/</span></li>
  <li><a href="{{ route('admin.pembayaran.index') }}">Verifikasi Pembayaran</a></li>
  <li><span class="sep">/</span></li>
  <li class="active">Transaksi #{{ $transaksi->id }}</li>
</ul>

{{-- Page Header --}}
<div class="page-header">
  <div class="page-header-left">
    <h1>Detail Pembayaran #{{ $transaksi->id }}</h1>
    <p>Review bukti pembayaran dan lakukan verifikasi atau penolakan transaksi ini.</p>
  </div>
  <div class="page-header-actions">
    <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-sm" style="background: white; border: 1px solid var(--border); color: var(--text-secondary); border-radius: 8px; display: flex; align-items: center; gap: 6px; padding: 7px 14px; font-size: 0.82rem; font-weight: 500; text-decoration: none;">
      <i class="mdi mdi-arrow-left"></i>
      Kembali ke Daftar
    </a>
  </div>
</div>

<div class="row">
  <!-- Left Side: Transaction Details & Student Summary -->
  <div class="col-lg-6 mb-4">
    <div class="card shadow-sm border-0 mb-4">
      <div class="card-header bg-white py-3 border-bottom">
        <h5 class="mb-0 font-weight-bold text-primary"><i class="mdi mdi-receipt me-2"></i>Rincian Transaksi</h5>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-6 mb-3">
            <label class="text-muted small mb-0">ID Transaksi</label>
            <p class="font-weight-bold text-dark mb-0">#{{ $transaksi->id }}</p>
          </div>
          <div class="col-6 mb-3">
            <label class="text-muted small mb-0">Tanggal Bayar</label>
            <p class="font-weight-bold text-dark mb-0">{{ $transaksi->tanggal_bayar ? $transaksi->tanggal_bayar->format('d M Y') : '-' }}</p>
          </div>
          <div class="col-12 mb-3">
            <label class="text-muted small mb-0">Nominal Transfer</label>
            <h3 class="font-weight-bold text-success mt-1 mb-0">Rp {{ number_format($transaksi->nominal, 0, ',', '.') }}</h3>
          </div>
        </div>
      </div>
    </div>

    <!-- Student Summary Card -->
    <div class="card shadow-sm border-0">
      <div class="card-header bg-white py-3 border-bottom">
        <h5 class="mb-0 font-weight-bold text-dark"><i class="mdi mdi-account-card-details me-2"></i>Calon Murid & Tagihan</h5>
      </div>
      <div class="card-body">
        @if($transaksi->siswa)
          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="text-muted small mb-0">Nama Calon Siswa</label>
              <p class="font-weight-bold text-dark mb-0">{{ $transaksi->siswa->nama_lengkap }}</p>
              <small class="text-muted">NIK: {{ $transaksi->siswa->nik_kia }}</small>
            </div>
            <div class="col-md-6 mb-3">
              <label class="text-muted small mb-0">Kelas & Paket Pilihan</label>
              <p class="font-weight-bold text-dark mb-0">{{ $transaksi->siswa->kelas ? $transaksi->siswa->kelas->nama_kelas : 'Belum Ditentukan' }}</p>
              <small class="text-primary font-weight-bold">{{ $transaksi->siswa->paket ? $transaksi->siswa->paket->nama_paket : 'Belum Memilih' }}</small>
            </div>
            
            <div class="col-12">
              <hr class="my-3">
            </div>

            <div class="col-md-6 mb-3">
              <label class="text-muted small mb-0">Biaya Paket Pendaftaran</label>
              <p class="font-weight-bold text-dark mb-0">
                Rp {{ $transaksi->siswa->paket ? number_format($transaksi->siswa->paket->nominal_biaya, 0, ',', '.') : '0' }}
              </p>
            </div>
            <div class="col-md-6 mb-3">
              <label class="text-muted small mb-0">Total Terbayar Valid</label>
              <p class="font-weight-bold text-success mb-0">
                Rp {{ number_format($totalBayarValid, 0, ',', '.') }}
              </p>
            </div>
            <div class="col-md-12">
              <label class="text-muted small mb-0">Sisa Tagihan Saat Ini</label>
              <h5 class="font-weight-bold text-danger mb-0">
                Rp {{ number_format($sisaTagihan, 0, ',', '.') }}
              </h5>
            </div>
          </div>
        @else
          <p class="text-muted py-2">Data siswa tidak ditemukan.</p>
        @endif
      </div>
      <div class="card-footer bg-light text-center py-2">
        @if($transaksi->siswa)
          <a href="{{ route('admin.siswa.show', $transaksi->siswa->id) }}" class="btn btn-xs btn-link text-muted py-0">
            <i class="mdi mdi-account"></i> Lihat Profil Lengkap Siswa
          </a>
        @endif
      </div>
    </div>
  </div>

  <!-- Right Side: Proof of Payment image & Actions -->
  <div class="col-lg-6">
    <div class="card shadow-sm border-0 mb-4">
      <div class="card-header bg-white py-3 border-bottom">
        <h5 class="mb-0 font-weight-bold text-dark"><i class="mdi mdi-file-image me-2"></i>Bukti Pembayaran</h5>
      </div>
      <div class="card-body text-center bg-light" style="min-height: 250px;">
        @if($transaksi->bukti_pembayaran)
          @php
            $imageSrc = filter_var($transaksi->bukti_pembayaran, FILTER_VALIDATE_URL) 
                        ? $transaksi->bukti_pembayaran 
                        : asset('storage/' . $transaksi->bukti_pembayaran);
          @endphp
          <a href="{{ $imageSrc }}" target="_blank" title="Klik untuk memperbesar gambar">
            <img src="{{ $imageSrc }}" class="img-fluid rounded border shadow-sm" style="max-height: 400px; object-fit: contain;" alt="Bukti Pembayaran">
          </a>
          <p class="text-muted small mt-2"><i class="mdi mdi-information-outline me-1"></i>Klik pada gambar untuk membuka di tab baru.</p>
        @else
          <div class="d-flex flex-column justify-content-center align-items-center py-5">
            <i class="mdi mdi-file-hidden text-muted mb-2" style="font-size: 3rem;"></i>
            <p class="text-muted mb-0">Bukti pembayaran tidak diunggah.</p>
          </div>
        @endif
      </div>
    </div>

    <!-- Verification Card -->
    <div class="card shadow-sm border-primary border-top border-3">
      <div class="card-header bg-white py-3 border-bottom">
        <h5 class="mb-0 font-weight-bold text-dark"><i class="mdi mdi-checkbox-marked-circle-outline me-2"></i>Verifikasi Transaksi</h5>
      </div>
      <div class="card-body text-center">
        <div class="mb-4">
          <span class="text-muted d-block small mb-1">Status Verifikasi Saat Ini:</span>
          @if($transaksi->status_verifikasi == 'Menunggu Verifikasi')
            <span class="badge badge-warning font-weight-bold px-3 py-2 text-uppercase">Menunggu Verifikasi</span>
          @elseif($transaksi->status_verifikasi == 'Valid')
            <span class="badge badge-success font-weight-bold px-3 py-2 text-uppercase">Valid (Disetujui)</span>
          @else
            <span class="badge badge-danger font-weight-bold px-3 py-2 text-uppercase">Ditolak</span>
          @endif
        </div>

        <form action="{{ route('admin.pembayaran.verify', $transaksi->id) }}" method="POST">
          @csrf
          <div class="d-grid gap-2">
            @if($transaksi->status_verifikasi != 'Valid')
              <button type="submit" name="status_verifikasi" value="Valid" class="btn btn-success btn-block py-2 mb-2">
                <i class="mdi mdi-check-circle me-1"></i> Setujui / Validasikan Pembayaran
              </button>
            @endif
            @if($transaksi->status_verifikasi != 'Ditolak')
              <button type="submit" name="status_verifikasi" value="Ditolak" class="btn btn-danger btn-block py-2 mb-2" onclick="return confirm('Apakah Anda yakin ingin menolak transaksi pembayaran ini?');">
                <i class="mdi mdi-close-circle me-1"></i> Tolak Transaksi Pembayaran
              </button>
            @endif
            @if($transaksi->status_verifikasi != 'Menunggu Verifikasi')
              <button type="submit" name="status_verifikasi" value="Menunggu Verifikasi" class="btn btn-light btn-block py-2">
                Setel ke Menunggu Verifikasi
              </button>
            @endif
          </div>
        </form>
      </div>
      <div class="card-footer bg-light text-center py-2">
        <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-xs btn-link text-muted py-0">
          <i class="mdi mdi-arrow-left"></i> Kembali ke Daftar
        </a>
      </div>
    </div>
  </div>
</div>
@endsection
