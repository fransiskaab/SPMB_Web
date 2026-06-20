@extends('layouts.admin')
@section('title', 'Paket Pendaftaran')
@section('page_title', 'Master Data — Paket')

@section('content')

{{-- Breadcrumb --}}
<ul class="admin-breadcrumb">
  <li><a href="{{ route('admin.dashboard') }}"><i class="mdi mdi-home-outline"></i> Dashboard</a></li>
  <li><span class="sep">/</span></li>
  <li class="active">Paket Pendaftaran</li>
</ul>
{{-- Page Header --}}
<div class="page-header">
  <div class="page-header-left">
    <h1>Paket Pendaftaran</h1>
    <p>Kelola paket pendaftaran beserta rincian biaya dan perlengkapan seragam/alat tulis yang diperoleh.</p>
  </div>
  <div class="page-header-actions">
    <a href="{{ route('admin.paket.create') }}" class="btn btn-primary d-flex align-items-center gap-2" style="padding: 8px 16px; font-size: 0.85rem;">
      <i class="mdi mdi-plus"></i>
      Tambah Paket
    </a>
  </div>
</div>

<div class="card grid-margin">
  <div class="card-body-custom">

    <div class="table-responsive">
      <table class="table table-striped table-hover align-middle">
        <thead>
          <tr>
            <th style="width: 50px;">#</th>
            <th>Nama Paket</th>
            <th>Kelas</th>
            <th class="text-center">Gender</th>
            <th>Biaya</th>
            <th>Perlengkapan Yang Diperoleh</th>
            <th class="text-center">Pendaftar</th>
            <th style="width: 150px;" class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($paket as $index => $item)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td class="font-weight-bold text-dark">{{ $item->nama_paket }}</td>
              <td>
                <div class="font-weight-bold">{{ $item->kelas ? $item->kelas->nama_kelas : '-' }}</div>
                <small class="text-muted">{{ $item->kelas ? $item->kelas->jenjang : '-' }}</small>
              </td>
              <td class="text-center">
                @if($item->jenis_kelamin == 'L')
                  <span class="badge badge-outline-primary font-weight-bold">Laki-Laki</span>
                @else
                  <span class="badge badge-outline-danger font-weight-bold">Perempuan</span>
                @endif
              </td>
              <td>
                <span class="font-weight-bold text-success">Rp {{ number_format($item->nominal_biaya, 0, ',', '.') }}</span>
              </td>
              <td>
                <div style="max-width: 350px; white-space: normal;">
                  @forelse($item->items as $detailItem)
                    <span class="badge badge-light border text-muted mb-1 me-1">{{ $detailItem->nama_item }}</span>
                  @empty
                    <span class="text-muted small">Tidak ada perlengkapan.</span>
                  @endforelse
                </div>
              </td>
              <td class="text-center">
                <span class="badge badge-pill badge-outline-success font-weight-bold">{{ $item->siswa_count }}</span>
              </td>
              <td class="text-center">
                <div class="d-flex justify-content-center gap-1">
                  <a href="{{ route('admin.paket.edit', $item->id) }}" class="btn btn-sm btn-outline-warning py-1 px-2 me-1">
                    <i class="mdi mdi-lead-pencil"></i>
                  </a>
                  <form action="{{ route('admin.paket.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket pendaftaran ini?');" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger py-1 px-2">
                      <i class="mdi mdi-delete"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="text-center text-muted py-4">Belum ada data paket pendaftaran. Silakan klik tombol "Tambah Paket".</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
