@extends('layouts.admin')
@section('title', 'Kelola Pengguna')
@section('page_title', 'Manajemen — Pengguna')

@section('content')

{{-- Breadcrumb --}}
<ul class="admin-breadcrumb">
  <li><a href="{{ route('admin.dashboard') }}"><i class="mdi mdi-home-outline"></i> Dashboard</a></li>
  <li><span class="sep">/</span></li>
  <li class="active">Kelola Pengguna</li>
</ul>

{{-- Page Header --}}
<div class="page-header">
  <div class="page-header-left">
    <h1>Manajemen Pengguna</h1>
    <p>Kelola akun administrator, staff, operator, dan kepala sekolah yang berwenang mengakses sistem.</p>
  </div>
  <div class="page-header-actions">
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary d-flex align-items-center gap-2" style="padding: 8px 16px; font-size: 0.85rem;">
      <i class="mdi mdi-plus"></i>
      Tambah Pengguna
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
            <th>Nama Lengkap</th>
            <th>Email</th>
            <th>Hak Akses / Role</th>
            <th class="text-center">Status</th>
            <th>Tanggal Dibuat</th>
            <th style="width: 150px;" class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($users as $index => $item)
            <tr>
              <td>{{ $index + 1 }}</td>
              <td class="font-weight-bold text-dark">{{ $item->name }}</td>
              <td>{{ $item->email }}</td>
              <td>
                @if($item->role === 'admin')
                  <span class="badge badge-primary font-weight-bold">Administrator</span>
                @elseif($item->role === 'staff')
                  <span class="badge badge-success font-weight-bold">Staff Akademik</span>
                @elseif($item->role === 'operator')
                  <span class="badge badge-info font-weight-bold">Operator</span>
                @elseif($item->role === 'kepala_sekolah')
                  <span class="badge badge-warning font-weight-bold">Kepala Sekolah</span>
                @else
                  <span class="badge badge-secondary font-weight-bold">{{ $item->role }}</span>
                @endif
              </td>
              <td class="text-center">
                @if($item->is_active)
                  <span class="badge badge-outline-success font-weight-bold">Aktif</span>
                @else
                  <span class="badge badge-outline-danger font-weight-bold">Nonaktif</span>
                @endif
              </td>
              <td>
                {{ $item->created_at->format('d/m/Y') }}
              </td>
              <td class="text-center">
                <div class="d-flex justify-content-center gap-1">
                  <a href="{{ route('admin.users.edit', $item->id) }}" class="btn btn-sm btn-outline-warning py-1 px-2 me-1">
                    <i class="mdi mdi-lead-pencil"></i>
                  </a>
                  @if($item->id !== auth()->id())
                    <form action="{{ route('admin.users.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');" style="display:inline-block;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-outline-danger py-1 px-2">
                        <i class="mdi mdi-delete"></i>
                      </button>
                    </form>
                  @else
                    <button class="btn btn-sm btn-outline-secondary py-1 px-2" disabled title="Anda tidak dapat menghapus akun Anda sendiri">
                      <i class="mdi mdi-delete"></i>
                    </button>
                  @endif
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center text-muted py-4">Belum ada data pengguna internal.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
