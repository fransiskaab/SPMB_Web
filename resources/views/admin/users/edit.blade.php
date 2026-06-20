@extends('layouts.admin')
@section('title', 'Edit Pengguna')
@section('page_title', 'Manajemen — Pengguna')

@section('content')

{{-- Breadcrumb --}}
<ul class="admin-breadcrumb">
  <li><a href="{{ route('admin.dashboard') }}"><i class="mdi mdi-home-outline"></i> Dashboard</a></li>
  <li><span class="sep">/</span></li>
  <li><a href="{{ route('admin.users.index') }}">Kelola Pengguna</a></li>
  <li><span class="sep">/</span></li>
  <li class="active">Edit Pengguna</li>
</ul>

{{-- Page Header --}}
<div class="page-header">
  <div class="page-header-left">
    <h1>Edit Pengguna</h1>
    <p>Perbarui informasi akun, hak akses, dan status aktivasi pengguna ini.</p>
  </div>
  <div class="page-header-actions">
    <a href="{{ route('admin.users.index') }}" class="btn btn-sm" style="background: white; border: 1px solid var(--border); color: var(--text-secondary); border-radius: 8px; display: flex; align-items: center; gap: 6px; padding: 7px 14px; font-size: 0.82rem; font-weight: 500; text-decoration: none;">
      <i class="mdi mdi-arrow-left"></i>
      Kembali ke Daftar
    </a>
  </div>
</div>

<div class="row">
  <div class="col-lg-6 mx-auto grid-margin stretch-card">
    <div class="card shadow-sm">
      <div class="card-body">
        <h4 class="card-title">Edit Data Pengguna: {{ $user->name }}</h4>
        <p class="card-description">Perbarui informasi profil pengguna internal sekolah atau ubah password.</p>

        @if ($errors->any())
          <div class="alert alert-danger py-2">
            <ul class="mb-0 pl-3 small">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="forms-sample">
          @csrf
          @method('PUT')
          
          <div class="form-group mb-3">
            <label for="name">Nama Lengkap</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group mb-3">
            <label for="email">Alamat Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group mb-3">
            <label for="password">Password Baru (Kosongkan jika tidak ingin diubah)</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Minimal 8 karakter">
            @error('password')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group mb-4">
            <label for="role">Hak Akses / Role</label>
            @if($user->id === auth()->id())
              <select class="form-control" id="role" name="role" readonly>
                <option value="{{ $user->role }}" selected>{{ $roles[$user->role] }}</option>
              </select>
              <small class="text-muted italic mt-1 d-block">Anda tidak dapat mengubah hak akses/role akun Anda sendiri yang sedang aktif.</small>
            @else
              <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required>
                @foreach($roles as $key => $label)
                  <option value="{{ $key }}" {{ old('role', $user->role) == $key ? 'selected' : '' }}>
                    {{ $label }}
                  </option>
                @endforeach
              </select>
            @endif
            @error('role')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          @if($user->id !== auth()->id())
            <div class="form-check mb-4">
              <label class="form-check-label text-dark">
                <input type="checkbox" class="form-check-input" name="is_active" value="1" {{ old('is_active', $user->is_active) ? 'checked' : '' }}>
                Aktifkan Akun (Hilangkan centang untuk menonaktifkan)
              </label>
            </div>
          @endif

          <button type="submit" class="btn btn-primary me-2">Perbarui Pengguna</button>
          <a href="{{ route('admin.users.index') }}" class="btn btn-light">Batal</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
