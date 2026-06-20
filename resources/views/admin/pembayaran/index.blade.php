@extends('layouts.admin')
@section('title', 'Verifikasi Transaksi Pembayaran')
@section('page_title', 'Verifikasi — Pembayaran')

@section('content')

{{-- Breadcrumb --}}
<ul class="admin-breadcrumb">
  <li><a href="{{ route('admin.dashboard') }}"><i class="mdi mdi-home-outline"></i> Dashboard</a></li>
  <li><span class="sep">/</span></li>
  <li class="active">Verifikasi Pembayaran</li>
</ul>

{{-- Page Header --}}
<div class="page-header">
  <div class="page-header-left">
    <h1>Verifikasi Transaksi Pembayaran</h1>
    <p>Review pengunggahan bukti bayar dan verifikasi keaslian transaksi pembayaran pendaftaran.</p>
  </div>
</div>
<div class="card grid-margin">
  <div class="card-body-custom">

    <!-- Filters -->
    <form method="GET" action="{{ route('admin.pembayaran.index') }}" class="row g-3 mb-4">
      <div class="col-md-5">
        <input type="text" name="search" class="form-control" placeholder="Cari nama calon siswa..." value="{{ request('search') }}">
      </div>
      <div class="col-md-3">
        <select name="status" class="form-control">
          <option value="">-- Semua Status --</option>
          <option value="Menunggu Verifikasi" {{ request('status') == 'Menunggu Verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
          <option value="Valid" {{ request('status') == 'Valid' ? 'selected' : '' }}>Valid</option>
          <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
        </select>
      </div>
      <div class="col-md-4 d-flex gap-2">
        <button type="submit" class="btn btn-primary btn-icon-text py-2 flex-grow-1">
          <i class="mdi mdi-magnify btn-icon-prepend"></i> Filter
        </button>
        <a href="{{ route('admin.pembayaran.index') }}" class="btn btn-light py-2">Reset</a>
      </div>
    </form>

    <div class="table-responsive">
      <table class="table table-striped table-hover align-middle">
        <thead>
          <tr>
            <th style="width: 50px;">#</th>
            <th>Calon Siswa</th>
            <th>Kelas / Paket</th>
            <th>Tanggal Bayar</th>
            <th>Nominal</th>
            <th class="text-center">Bukti</th>
            <th class="text-center">Status Verifikasi</th>
            <th class="text-center" style="width: 100px;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($transaksi as $index => $item)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>
                <div class="font-weight-bold text-dark">{{ $item->siswa ? $item->siswa->nama_lengkap : 'Siswa Terhapus' }}</div>
                <small class="text-muted">{{ $item->siswa ? 'NIK: ' . $item->siswa->nik_kia : '' }}</small>
              </td>
              <td>
                <div class="font-weight-bold">{{ ($item->siswa && $item->siswa->kelas) ? $item->siswa->kelas->nama_kelas : '-' }}</div>
                <small class="text-muted">{{ ($item->siswa && $item->siswa->paket) ? $item->siswa->paket->nama_paket : '-' }}</small>
              </td>
              <td>
                {{ $item->tanggal_bayar ? $item->tanggal_bayar->format('d/m/Y') : '-' }}
              </td>
              <td>
                <span class="font-weight-bold text-success">Rp {{ number_format($item->nominal, 0, ',', '.') }}</span>
              </td>
              <td class="text-center">
                @if($item->bukti_pembayaran)
                  <i class="mdi mdi-file-image text-primary fs-4"></i>
                @else
                  <span class="text-muted small">-</span>
                @endif
              </td>
              <td class="text-center">
                @if($item->status_verifikasi == 'Menunggu Verifikasi')
                  <span class="badge badge-warning">Menunggu Verifikasi</span>
                @elseif($item->status_verifikasi == 'Valid')
                  <span class="badge badge-success">Valid (Disetujui)</span>
                @else
                  <span class="badge badge-danger">Ditolak</span>
                @endif
              </td>
              <td class="text-center">
                <a href="{{ route('admin.pembayaran.show', $item->id) }}" class="btn btn-sm btn-outline-primary py-1 px-3">
                  <i class="mdi mdi-eye"></i> Detail
                </a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="text-center text-muted py-4">Tidak ada data transaksi pembayaran.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
