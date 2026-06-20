@extends('layouts.admin')
@section('title', 'Dashboard Admin')
@section('page_title', 'Dashboard')

@section('content')

{{-- Welcome Header --}}
<div class="page-header">
  <div class="page-header-left">
    <h1>Dashboard Admin</h1>
    <p>Selamat datang, <strong>{{ auth()->user()->name }}</strong>. Berikut ringkasan aktivitas SIPMB hari ini.</p>
  </div>
</div>

{{-- KPI Stat Cards --}}
<div class="row g-4 mb-4">
  <div class="col-12 col-sm-6 col-xl-3">
    <div class="card h-100" style="border-left: 4px solid var(--primary); border-radius: 12px;">
      <div class="card-body-custom">
        <div class="d-flex justify-content-between align-items-flex-start">
          <div>
            <p style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-secondary); margin: 0 0 8px 0;">Total Pendaftar</p>
            <h2 style="font-size: 2rem; font-weight: 800; color: var(--text-primary); margin: 0 0 8px 0;">{{ $totalSiswa }}</h2>
            <p style="font-size: 0.78rem; color: var(--text-secondary); margin: 0;">
              <span style="color: #16a34a; font-weight: 600;">{{ $siswaDiterima }} Diterima</span>
              &nbsp;&bull;&nbsp;
              <span style="color: #ca8a04; font-weight: 600;">{{ $siswaBaru }} Menunggu</span>
            </p>
          </div>
          <div style="width: 46px; height: 46px; background: var(--primary-light); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 1.3rem; flex-shrink: 0;">
            <i class="mdi mdi-account-multiple"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12 col-sm-6 col-xl-3">
    <div class="card h-100" style="border-left: 4px solid #10b981; border-radius: 12px;">
      <div class="card-body-custom">
        <div class="d-flex justify-content-between align-items-flex-start">
          <div>
            <p style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-secondary); margin: 0 0 8px 0;">Total Pendapatan</p>
            <h2 style="font-size: 1.5rem; font-weight: 800; color: var(--text-primary); margin: 0 0 8px 0;">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h2>
            <p style="font-size: 0.78rem; color: var(--text-secondary); margin: 0;">Hanya transaksi terverifikasi</p>
          </div>
          <div style="width: 46px; height: 46px; background: rgba(16, 185, 129, 0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #10b981; font-size: 1.3rem; flex-shrink: 0;">
            <i class="mdi mdi-cash-multiple"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12 col-sm-6 col-xl-3">
    <div class="card h-100" style="border-left: 4px solid #f59e0b; border-radius: 12px;">
      <div class="card-body-custom">
        <div class="d-flex justify-content-between align-items-flex-start">
          <div>
            <p style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-secondary); margin: 0 0 8px 0;">Verifikasi Siswa</p>
            <h2 style="font-size: 2rem; font-weight: 800; color: var(--text-primary); margin: 0 0 8px 0;">{{ $siswaBaru }}</h2>
            <p style="font-size: 0.78rem; color: var(--text-secondary); margin: 0;">Formulir menunggu review</p>
          </div>
          <div style="width: 46px; height: 46px; background: rgba(245, 158, 11, 0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #f59e0b; font-size: 1.3rem; flex-shrink: 0;">
            <i class="mdi mdi-account-search"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12 col-sm-6 col-xl-3">
    <div class="card h-100" style="border-left: 4px solid #ef4444; border-radius: 12px;">
      <div class="card-body-custom">
        <div class="d-flex justify-content-between align-items-flex-start">
          <div>
            <p style="font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--text-secondary); margin: 0 0 8px 0;">Pending Pembayaran</p>
            <h2 style="font-size: 2rem; font-weight: 800; color: var(--text-primary); margin: 0 0 8px 0;">{{ $pembayaranMenunggu }}</h2>
            <p style="font-size: 0.78rem; color: var(--text-secondary); margin: 0;">Transaksi menunggu verifikasi</p>
          </div>
          <div style="width: 46px; height: 46px; background: rgba(239, 68, 68, 0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #ef4444; font-size: 1.3rem; flex-shrink: 0;">
            <i class="mdi mdi-clock-alert-outline"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Tables Row --}}
<div class="row g-4 mb-4">
  {{-- Recent Registrations --}}
  <div class="col-lg-7">
    <div class="card h-100">
      <div class="card-header-custom">
        <h5><i class="mdi mdi-account-multiple-outline text-primary me-2"></i>Pendaftar Terbaru</h5>
        <a href="{{ route('admin.siswa.index') }}" style="font-size: 0.8rem; color: var(--primary); font-weight: 600; text-decoration: none;">
          Lihat Semua <i class="mdi mdi-arrow-right"></i>
        </a>
      </div>
      <div class="card-body-custom p-0">
        <div class="table-responsive">
          <table class="table align-middle mb-0" style="margin: 0;">
            <thead>
              <tr>
                <th>Nama Calon Siswa</th>
                <th>Kelas / Paket</th>
                <th class="text-center">Status</th>
              </tr>
            </thead>
            <tbody>
              @forelse($recentRegistrations as $siswa)
                <tr>
                  <td>
                    <div style="font-weight: 700; color: var(--text-primary);">{{ $siswa->nama_lengkap }}</div>
                    <small style="color: var(--text-secondary);">NIK: {{ $siswa->nik_kia }}</small>
                  </td>
                  <td>
                    <div style="font-weight: 600;">{{ $siswa->kelas ? $siswa->kelas->nama_kelas : '—' }}</div>
                    <small style="color: var(--text-secondary);">{{ $siswa->paket ? $siswa->paket->nama_paket : '—' }}</small>
                  </td>
                  <td class="text-center">
                    @if($siswa->status_pendaftaran == 'Menunggu Verifikasi')
                      <span class="badge" style="background: #fffbeb; color: #92400e; border: 1px solid #fde68a;">Menunggu</span>
                    @elseif($siswa->status_pendaftaran == 'Diterima')
                      <span class="badge" style="background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0;">Diterima</span>
                    @else
                      <span class="badge" style="background: #fef2f2; color: #991b1b; border: 1px solid #fecaca;">Ditolak</span>
                    @endif
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="3" class="text-center py-4" style="color: var(--text-secondary);">
                    <i class="mdi mdi-information-outline d-block mb-1" style="font-size: 1.5rem;"></i>
                    Belum ada data pendaftaran.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  {{-- Pending Payments --}}
  <div class="col-lg-5">
    <div class="card h-100">
      <div class="card-header-custom">
        <h5><i class="mdi mdi-cash-check text-success me-2"></i>Pembayaran Perlu Verifikasi</h5>
        <a href="{{ route('admin.pembayaran.index') }}" style="font-size: 0.8rem; color: var(--primary); font-weight: 600; text-decoration: none;">
          Lihat Semua <i class="mdi mdi-arrow-right"></i>
        </a>
      </div>
      <div class="card-body-custom p-0">
        <div class="table-responsive">
          <table class="table align-middle mb-0">
            <thead>
              <tr>
                <th>Siswa</th>
                <th>Nominal</th>
                <th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @php $pendingPayments = $recentPayments->where('status_verifikasi', 'Menunggu Verifikasi'); @endphp
              @forelse($pendingPayments as $pembayaran)
                <tr>
                  <td>
                    <div style="font-weight: 700; color: var(--text-primary);">{{ $pembayaran->siswa ? $pembayaran->siswa->nama_lengkap : '—' }}</div>
                    <small style="color: var(--text-secondary);">{{ $pembayaran->tanggal_bayar ? $pembayaran->tanggal_bayar->format('d M Y') : '—' }}</small>
                  </td>
                  <td>
                    <span style="font-weight: 700; color: #059669;">Rp {{ number_format($pembayaran->nominal, 0, ',', '.') }}</span>
                  </td>
                  <td class="text-center">
                    <a href="{{ route('admin.pembayaran.show', $pembayaran->id) }}"
                       class="btn btn-sm btn-primary"
                       style="font-size: 0.75rem; padding: 4px 10px;">
                      Verifikasi
                    </a>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="3" class="text-center py-4" style="color: var(--text-secondary);">
                    <i class="mdi mdi-check-circle-outline d-block mb-1" style="font-size: 1.5rem; color: #10b981;"></i>
                    Tidak ada pembayaran tertunda.
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- System Stats --}}
<div class="row g-4">
  <div class="col-md-6">
    <div class="card">
      <div class="card-header-custom">
        <h5><i class="mdi mdi-chart-bar text-primary me-2"></i>Statistik Master Data</h5>
      </div>
      <div class="card-body-custom">
        <div class="row text-center">
          <div class="col-6">
            <div style="background: var(--primary-light); border-radius: 12px; padding: 20px;">
              <h3 style="font-size: 2rem; font-weight: 800; color: var(--primary); margin: 0 0 4px 0;">{{ $totalKelas }}</h3>
              <p style="font-size: 0.8rem; color: var(--text-secondary); margin: 0; font-weight: 600;">Total Kelas</p>
            </div>
          </div>
          <div class="col-6">
            <div style="background: rgba(16, 185, 129, 0.08); border-radius: 12px; padding: 20px;">
              <h3 style="font-size: 2rem; font-weight: 800; color: #10b981; margin: 0 0 4px 0;">{{ $totalPaket }}</h3>
              <p style="font-size: 0.8rem; color: var(--text-secondary); margin: 0; font-weight: 600;">Total Paket</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="card">
      <div class="card-header-custom">
        <h5><i class="mdi mdi-information-outline text-secondary me-2"></i>Informasi Sistem</h5>
      </div>
      <div class="card-body-custom">
        <div class="row">
          <div class="col-6">
            <p style="font-size: 0.78rem; color: var(--text-secondary); margin: 0 0 2px 0;">Versi Laravel</p>
            <p style="font-weight: 700; color: var(--text-primary); margin: 0 0 16px 0;">{{ app()->version() }}</p>
            <p style="font-size: 0.78rem; color: var(--text-secondary); margin: 0 0 2px 0;">Database</p>
            <p style="font-weight: 700; color: var(--text-primary); margin: 0;">MySQL</p>
          </div>
          <div class="col-6">
            <p style="font-size: 0.78rem; color: var(--text-secondary); margin: 0 0 2px 0;">Tanggal</p>
            <p style="font-weight: 700; color: var(--text-primary); margin: 0 0 16px 0;">{{ now()->format('d M Y') }}</p>
            <p style="font-size: 0.78rem; color: var(--text-secondary); margin: 0 0 2px 0;">Status Sistem</p>
            <p style="font-weight: 700; color: #10b981; margin: 0;"><i class="mdi mdi-check-circle"></i> Aktif</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
