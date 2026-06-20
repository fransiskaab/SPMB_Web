@extends('layouts.admin')
@section('title', 'Data Kelas')
@section('page_title', 'Master Data — Kelas')

@section('content')

{{-- Breadcrumb --}}
<ul class="admin-breadcrumb">
  <li><a href="{{ route('admin.dashboard') }}"><i class="mdi mdi-home-outline"></i> Dashboard</a></li>
  <li><span class="sep">/</span></li>
  <li class="active">Data Kelas</li>
</ul>

{{-- Page Header --}}
<div class="page-header">
  <div class="page-header-left">
    <h1>Data Kelas</h1>
    <p>Daftar seluruh kelas aktif beserta jenjang pendidikan dan statistik pendaftarannya.</p>
  </div>
  <div class="page-header-actions">
    <a href="{{ route('admin.kelas.create') }}" class="btn btn-primary d-flex align-items-center gap-2" style="padding: 8px 16px; font-size: 0.85rem;">
      <i class="mdi mdi-plus"></i>
      Tambah Kelas
    </a>
  </div>
</div>

{{-- Table Card --}}
<div class="card grid-margin">
  <div class="card-body-custom">
    <div class="table-responsive">
      <table class="table table-hover align-middle mb-0">
        <thead>
          <tr>
            <th style="width: 50px;">#</th>
            <th>Nama Kelas</th>
            <th>Jenjang</th>
            <th class="text-center">Siswa Terdaftar</th>
            <th class="text-center">Pilihan Paket</th>
            <th style="width: 120px;" class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($kelas as $index => $item)
            <tr>
              <td style="color: var(--text-secondary); font-weight: 500;">{{ $index + 1 }}</td>
              <td>
                <span style="font-weight: 700; color: var(--text-primary);">{{ $item->nama_kelas }}</span>
              </td>
              <td>
                <span class="badge" style="background: rgba(79,70,229,0.1); color: var(--primary); font-weight: 600;">
                  {{ $item->jenjang }}
                </span>
              </td>
              <td class="text-center">
                <span class="badge" style="background: #f0fdf4; color: #166534; font-weight: 700; font-size: 0.8rem; padding: 5px 10px;">
                  {{ $item->siswa_count }} siswa
                </span>
              </td>
              <td class="text-center">
                <span class="badge" style="background: #eff6ff; color: #1d4ed8; font-weight: 700; font-size: 0.8rem; padding: 5px 10px;">
                  {{ $item->paket_pendaftaran_count }} paket
                </span>
              </td>
              <td class="text-center">
                <div class="d-flex justify-content-center gap-1">
                  <a href="{{ route('admin.kelas.edit', $item->id) }}"
                     class="btn btn-sm"
                     style="background: #fffbeb; border: 1px solid #fde68a; color: #92400e; border-radius: 7px; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;"
                     title="Edit Kelas">
                    <i class="mdi mdi-lead-pencil" style="font-size: 0.9rem;"></i>
                  </a>
                  <form action="{{ route('admin.kelas.destroy', $item->id) }}" method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus kelas \'{{ $item->nama_kelas }}\'?');"
                        style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="btn btn-sm"
                            style="background: #fef2f2; border: 1px solid #fecaca; color: #991b1b; border-radius: 7px; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center;"
                            title="Hapus Kelas">
                      <i class="mdi mdi-delete" style="font-size: 0.9rem;"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center py-5">
                <div style="color: var(--text-secondary);">
                  <i class="mdi mdi-school-outline" style="font-size: 2.5rem; display: block; margin-bottom: 10px; opacity: 0.4;"></i>
                  <p style="font-weight: 600; margin-bottom: 4px;">Belum Ada Data Kelas</p>
                  <small>Klik tombol "Tambah Kelas" di atas untuk membuat kelas pertama.</small>
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection
