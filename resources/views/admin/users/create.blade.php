@extends('layouts.admin')
@section('title', 'Tambah Pengguna')
@section('page_title', 'Manajemen — Pengguna')

@section('content')

{{-- Breadcrumb --}}
<ul class="admin-breadcrumb">
  <li><a href="{{ route('admin.dashboard') }}"><i class="mdi mdi-home-outline"></i> Dashboard</a></li>
  <li><span class="sep">/</span></li>
  <li><a href="{{ route('admin.users.index') }}">Kelola Pengguna</a></li>
  <li><span class="sep">/</span></li>
  <li class="active">Tambah Pengguna Baru</li>
</ul>

{{-- Page Header --}}
<div class="page-header">
  <div class="page-header-left">
    <h1>Tambah Pengguna Baru</h1>
    <p>Daftarkan akun administrator, staff, operator, atau kepala sekolah baru.</p>
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
        <h4 class="card-title">Tambah Pengguna Baru</h4>
        <p class="card-description">Daftarkan akun administrator, staff, operator, atau kepala sekolah baru.</p>

        @if ($errors->any())
          <div class="alert alert-danger py-2">
            <ul class="mb-0 pl-3 small">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('admin.users.store') }}" method="POST" class="forms-sample">
          @csrf
          
          <div class="form-group mb-3">
            <label for="name">Nama Lengkap</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
            @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group mb-3">
            <label for="email">Alamat Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="email@sipmb.test" value="{{ old('email') }}" required>
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group mb-3">
            <label for="password">Password Baru</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Minimal 8 karakter" required>
            @error('password')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group mb-4">
            <label for="role">Hak Akses / Role</label>
            <select class="form-control @error('role') is-invalid @enderror" id="role" name="role" required>
              <option value="" disabled selected>-- Pilih Role --</option>
              @foreach($roles as $key => $label)
                <option value="{{ $key }}" {{ old('role') == $key ? 'selected' : '' }}>
                  {{ $label }}
                </option>
              @endforeach
            </select>
            @error('role')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <button type="submit" class="btn btn-primary me-2">Simpan Pengguna</button>
          <a href="{{ route('admin.users.index') }}" class="btn btn-light">Batal</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
