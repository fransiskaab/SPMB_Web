@extends('layouts.admin')
@section('title', 'Edit Paket Pendaftaran')
@section('page_title', 'Master Data — Paket')

@section('content')

{{-- Breadcrumb --}}
<ul class="admin-breadcrumb">
  <li><a href="{{ route('admin.dashboard') }}"><i class="mdi mdi-home-outline"></i> Dashboard</a></li>
  <li><span class="sep">/</span></li>
  <li><a href="{{ route('admin.paket.index') }}">Paket Pendaftaran</a></li>
  <li><span class="sep">/</span></li>
  <li class="active">Edit: {{ $paket->nama_paket }}</li>
</ul>

{{-- Page Header --}}
<div class="page-header">
  <div class="page-header-left">
    <h1>Edit Paket Pendaftaran</h1>
    <p>Perbarui rincian paket pendaftaran, biaya, dan pilihan perlengkapan.</p>
  </div>
  <div class="page-header-actions">
    <a href="{{ route('admin.paket.index') }}" class="btn btn-sm" style="background: white; border: 1px solid var(--border); color: var(--text-secondary); border-radius: 8px; display: flex; align-items: center; gap: 6px; padding: 7px 14px; font-size: 0.82rem; font-weight: 500; text-decoration: none;">
      <i class="mdi mdi-arrow-left"></i>
      Kembali ke Daftar
    </a>
  </div>
</div>
<div class="row">
  <div class="col-lg-8 mx-auto grid-margin stretch-card">
    <div class="card shadow-sm">
      <div class="card-body">
        <h4 class="card-title">Edit Paket Pendaftaran: {{ $paket->nama_paket }}</h4>
        <p class="card-description">Perbarui rincian paket pendaftaran, biaya, dan pilihan perlengkapan.</p>

        @if ($errors->any())
          <div class="alert alert-danger py-2">
            <ul class="mb-0 pl-3 small">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('admin.paket.update', $paket->id) }}" method="POST" class="forms-sample">
          @csrf
          @method('PUT')
          <div class="form-group">
            <label for="nama_paket">Nama Paket</label>
            <input type="text" class="form-control @error('nama_paket') is-invalid @enderror" id="nama_paket" name="nama_paket" value="{{ old('nama_paket', $paket->nama_paket) }}" required>
            @error('nama_paket')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="kelas_id">Pilih Kelas</label>
                <select class="form-control @error('kelas_id') is-invalid @enderror" id="kelas_id" name="kelas_id" required>
                  @foreach($kelas as $kelasItem)
                    <option value="{{ $kelasItem->id }}" {{ old('kelas_id', $paket->kelas_id) == $kelasItem->id ? 'selected' : '' }}>
                      {{ $kelasItem->nama_kelas }} ({{ $kelasItem->jenjang }})
                    </option>
                  @endforeach
                </select>
                @error('kelas_id')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group">
                <label for="jenis_kelamin">Target Gender</label>
                <select class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin" required>
                  <option value="L" {{ old('jenis_kelamin', $paket->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki (L)</option>
                  <option value="P" {{ old('jenis_kelamin', $paket->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan (P)</option>
                </select>
                @error('jenis_kelamin')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="nominal_biaya">Biaya Pendaftaran (Rupiah)</label>
            <div class="input-group">
              <span class="input-group-text">Rp</span>
              <input type="number" step="0.01" min="0" class="form-control @error('nominal_biaya') is-invalid @enderror" id="nominal_biaya" name="nominal_biaya" value="{{ old('nominal_biaya', $paket->nominal_biaya) }}" required>
            </div>
            @error('nominal_biaya')
              <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group mb-4">
            <label class="font-weight-bold mb-2">Pilih Perlengkapan yang Diperoleh:</label>
            <p class="text-muted small">Centang item perlengkapan/seragam yang akan didapatkan siswa saat mendaftar paket ini.</p>
            <div class="row">
              @foreach($items as $item)
                <div class="col-md-6 col-lg-4 mb-2">
                  <div class="form-check">
                    <label class="form-check-label text-dark">
                      <input type="checkbox" class="form-check-input" name="items[]" value="{{ $item->id }}" {{ in_array($item->id, old('items', $selectedItems)) ? 'checked' : '' }}>
                      {{ $item->nama_item }}
                    </label>
                  </div>
                </div>
              @endforeach
            </div>
          </div>

          <button type="submit" class="btn btn-primary me-2">Perbarui Paket</button>
          <a href="{{ route('admin.paket.index') }}" class="btn btn-light">Batal</a>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
