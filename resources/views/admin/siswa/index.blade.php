@extends('layouts.admin')
@section('title', 'Verifikasi Pendaftaran Siswa')
@section('page_title', 'Verifikasi — Siswa')

@section('content')

{{-- Breadcrumb --}}
<ul class="admin-breadcrumb">
  <li><a href="{{ route('admin.dashboard') }}"><i class="mdi mdi-home-outline"></i> Dashboard</a></li>
  <li><span class="sep">/</span></li>
  <li class="active">Verifikasi Calon Murid</li>
</ul>

{{-- Page Header --}}
<div class="page-header">
  <div class="page-header-left">
    <h1>Verifikasi Calon Murid</h1>
    <p>Review data formulir pendaftaran calon murid baru dan tentukan kelulusan status pendaftaran.</p>
  </div>
</div>
<div class="card grid-margin">
  <div class="card-body-custom">

    <!-- Filters -->
    <form method="GET" action="{{ route('admin.siswa.index') }}" class="row g-3 mb-4">
      <div class="col-md-5">
        <input type="text" name="search" class="form-control" placeholder="Cari nama, NIK, atau No. KK..." value="{{ request('search') }}">
      </div>
      <div class="col-md-3">
        <select name="status" class="form-control">
          <option value="">-- Semua Status --</option>
          <option value="Menunggu Verifikasi" {{ request('status') == 'Menunggu Verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
          <option value="Diterima" {{ request('status') == 'Diterima' ? 'selected' : '' }}>Diterima</option>
          <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
        </select>
      </div>
      <div class="col-md-4 d-flex gap-2">
        <button type="submit" class="btn btn-primary btn-icon-text py-2 flex-grow-1">
          <i class="mdi mdi-magnify btn-icon-prepend"></i> Filter
        </button>
        <a href="{{ route('admin.siswa.index') }}" class="btn btn-light py-2">Reset</a>
      </div>
    </form>

    <div class="table-responsive">
      <table class="table table-striped table-hover align-middle">
        <thead>
          <tr>
            <th style="width: 50px;">#</th>
            <th>Nama Calon Siswa</th>
            <th>Kelas / Paket</th>
            <th class="text-center">Gender</th>
            <th>Tempat, Tanggal Lahir</th>
            <th class="text-center">Status</th>
            <th>Tanggal Daftar</th>
            <th class="text-center" style="width: 100px;">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($siswa as $index => $item)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td>
                <div class="font-weight-bold text-dark">{{ $item->nama_lengkap }}</div>
                <small class="text-muted">NIK: {{ $item->nik_kia }}</small>
              </td>
              <td>
                <div class="font-weight-bold">{{ $item->kelas ? $item->kelas->nama_kelas : '-' }}</div>
                <small class="text-muted">{{ $item->paket ? $item->paket->nama_paket : '-' }}</small>
              </td>
              <td class="text-center">
                @if($item->jenis_kelamin == 'L')
                  <span class="badge badge-outline-primary font-weight-bold">Laki-Laki</span>
                @else
                  <span class="badge badge-outline-danger font-weight-bold">Perempuan</span>
                @endif
              </td>
              <td>
                <div>{{ $item->tempat_lahir }}</div>
                <small class="text-muted">{{ $item->tanggal_lahir ? $item->tanggal_lahir->format('d M Y') : '-' }}</small>
              </td>
              <td class="text-center">
                @if($item->status_pendaftaran == 'Menunggu Verifikasi')
                  <span class="badge badge-warning">Menunggu Verifikasi</span>
                @elseif($item->status_pendaftaran == 'Diterima')
                  <span class="badge badge-success">Diterima</span>
                @else
                  <span class="badge badge-danger">Ditolak</span>
                @endif
              </td>
              <td>
                {{ $item->created_at->format('d/m/Y H:i') }}
              </td>
              <td class="text-center">
                <a href="{{ route('admin.siswa.show', $item->id) }}" class="btn btn-sm btn-outline-primary py-1 px-3">
                  <i class="mdi mdi-eye"></i> Detail
                </a>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="text-center text-muted py-4">Tidak ada data calon murid yang cocok.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
