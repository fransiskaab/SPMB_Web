@extends('layouts.admin')
@section('title', 'Edit Kelas')
@section('page_title', 'Master Data — Kelas')

@section('content')

{{-- Breadcrumb --}}
<ul class="admin-breadcrumb">
  <li><a href="{{ route('admin.dashboard') }}"><i class="mdi mdi-home-outline"></i> Dashboard</a></li>
  <li><span class="sep">/</span></li>
  <li><a href="{{ route('admin.kelas.index') }}">Data Kelas</a></li>
  <li><span class="sep">/</span></li>
  <li class="active">Edit: {{ $kelasItem->nama_kelas }}</li>
</ul>

{{-- Page Header --}}
<div class="page-header">
  <div class="page-header-left">
    <h1>Edit Kelas: {{ $kelasItem->nama_kelas }}</h1>
    <p>Perbarui nama kelas dan jenjang pendidikan yang sudah ada.</p>
  </div>
  <div class="page-header-actions">
    <a href="{{ route('admin.kelas.index') }}" class="btn btn-sm" style="background: white; border: 1px solid var(--border); color: var(--text-secondary); border-radius: 8px; display: flex; align-items: center; gap: 6px; padding: 7px 14px; font-size: 0.82rem; font-weight: 500; text-decoration: none;">
      <i class="mdi mdi-arrow-left"></i>
      Kembali ke Daftar
    </a>
  </div>
</div>

{{-- Form Card --}}
<div class="row justify-content-center">
  <div class="col-lg-6">
    <div class="card">
      <div class="card-header-custom">
        <h5><i class="mdi mdi-lead-pencil text-warning me-2"></i>Formulir Edit Kelas</h5>
      </div>
      <div class="card-body-custom">

        @if ($errors->any())
          <div class="flash-alert flash-alert-error mb-4">
            <i class="mdi mdi-alert-circle"></i>
            <div>
              @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
              @endforeach
            </div>
          </div>
        @endif

        <form action="{{ route('admin.kelas.update', $kelasItem->id) }}" method="POST">
          @csrf
          @method('PUT')

          <div class="mb-4">
            <label for="nama_kelas">Nama Kelas <span style="color: #dc2626;">*</span></label>
            <input type="text"
                   class="form-control @error('nama_kelas') is-invalid @enderror"
                   id="nama_kelas"
                   name="nama_kelas"
                   placeholder="Contoh: Kelas 1-A"
                   value="{{ old('nama_kelas', $kelasItem->nama_kelas) }}"
                   required
                   autofocus>
            @error('nama_kelas')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="mb-5">
            <label for="jenjang">Jenjang Pendidikan <span style="color: #dc2626;">*</span></label>
            <select class="form-control @error('jenjang') is-invalid @enderror"
                    id="jenjang"
                    name="jenjang"
                    required>
              <option value="RA"  {{ old('jenjang', $kelasItem->jenjang) == 'RA'  ? 'selected' : '' }}>RA — Raudhatul Athfal</option>
              <option value="MI"  {{ old('jenjang', $kelasItem->jenjang) == 'MI'  ? 'selected' : '' }}>MI — Madrasah Ibtidaiyah</option>
              <option value="MTs" {{ old('jenjang', $kelasItem->jenjang) == 'MTs' ? 'selected' : '' }}>MTs — Madrasah Tsanawiyah</option>
              <option value="MA"  {{ old('jenjang', $kelasItem->jenjang) == 'MA'  ? 'selected' : '' }}>MA — Madrasah Aliyah</option>
            </select>
            @error('jenjang')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">
              <i class="mdi mdi-check me-1"></i> Perbarui Kelas
            </button>
            <a href="{{ route('admin.kelas.index') }}" class="btn btn-light">Batal</a>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

@endsection
