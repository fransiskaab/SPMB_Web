@extends('layouts.admin')
@section('title', 'Detail Siswa - ' . $siswa->nama_lengkap)
@section('page_title', 'Verifikasi — Detail Siswa')

@section('content')

{{-- Breadcrumb --}}
<ul class="admin-breadcrumb">
  <li><a href="{{ route('admin.dashboard') }}"><i class="mdi mdi-home-outline"></i> Dashboard</a></li>
  <li><span class="sep">/</span></li>
  <li><a href="{{ route('admin.siswa.index') }}">Verifikasi Calon Murid</a></li>
  <li><span class="sep">/</span></li>
  <li class="active">{{ $siswa->nama_lengkap }}</li>
</ul>

{{-- Page Header --}}
<div class="page-header">
  <div class="page-header-left">
    <h1>Detail Pendaftaran: {{ $siswa->nama_lengkap }}</h1>
    <p>Review kelengkapan data pribadi, data orang tua, dan lakukan verifikasi status pendaftaran.</p>
  </div>
  <div class="page-header-actions">
    <a href="{{ route('admin.siswa.index') }}" class="btn btn-sm" style="background: white; border: 1px solid var(--border); color: var(--text-secondary); border-radius: 8px; display: flex; align-items: center; gap: 6px; padding: 7px 14px; font-size: 0.82rem; font-weight: 500; text-decoration: none;">
      <i class="mdi mdi-arrow-left"></i>
      Kembali ke Daftar
    </a>
  </div>
</div>
<div class="row">
  <!-- Left Side: Student Info & Parents -->
  <div class="col-lg-8">
    
    <!-- Student Profile Card -->
    <div class="card mb-4 shadow-sm border-0">
      <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="mb-0 font-weight-bold text-primary"><i class="mdi mdi-account me-2"></i>Formulir Data Pribadi</h5>
        <span class="text-muted small">ID Pendaftaran: #{{ $siswa->id }}</span>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label class="text-muted small">Nama Lengkap</label>
            <p class="font-weight-bold text-dark mb-0">{{ $siswa->nama_lengkap }}</p>
          </div>
          <div class="col-md-6 mb-3">
            <label class="text-muted small">Nama Panggilan</label>
            <p class="font-weight-bold text-dark mb-0">{{ $siswa->nama_panggilan }}</p>
          </div>
          <div class="col-md-6 mb-3">
            <label class="text-muted small">NIK / KIA</label>
            <p class="font-weight-bold text-dark mb-0">{{ $siswa->nik_kia }}</p>
          </div>
          <div class="col-md-6 mb-3">
            <label class="text-muted small">Nomor Kartu Keluarga (KK)</label>
            <p class="font-weight-bold text-dark mb-0">{{ $siswa->no_kk }}</p>
          </div>
          <div class="col-md-6 mb-3">
            <label class="text-muted small">Nomor PKH (Jika ada)</label>
            <p class="font-weight-bold text-dark mb-0">{{ $siswa->no_pkh ?? 'Tidak ada' }}</p>
          </div>
          <div class="col-md-6 mb-3">
            <label class="text-muted small">Tempat & Tanggal Lahir</label>
            <p class="font-weight-bold text-dark mb-0">{{ $siswa->tempat_lahir }}, {{ $siswa->tanggal_lahir ? $siswa->tanggal_lahir->format('d M Y') : '-' }}</p>
          </div>
          <div class="col-md-6 mb-3">
            <label class="text-muted small">Jenis Kelamin</label>
            <p class="font-weight-bold text-dark mb-0">{{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
          </div>
          <div class="col-md-6 mb-3">
            <label class="text-muted small">Agama</label>
            <p class="font-weight-bold text-dark mb-0">{{ $siswa->agama }}</p>
          </div>
          <div class="col-md-4 mb-3">
            <label class="text-muted small">Anak Ke-</label>
            <p class="font-weight-bold text-dark mb-0">{{ $siswa->anak_ke }}</p>
          </div>
          <div class="col-md-4 mb-3">
            <label class="text-muted small">Jumlah Saudara</label>
            <p class="font-weight-bold text-dark mb-0">{{ $siswa->jumlah_saudara }}</p>
          </div>
          <div class="col-md-4 mb-3">
            <label class="text-muted small">Status Keluarga</label>
            <p class="font-weight-bold text-dark mb-0">{{ $siswa->status_keluarga }}</p>
          </div>
          <div class="col-md-6">
            <label class="text-muted small">Kewarganegaraan</label>
            <p class="font-weight-bold text-dark mb-0">{{ $siswa->kewarganegaraan }}</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Parent Profile Card -->
    <div class="card mb-4 shadow-sm border-0">
      <div class="card-header bg-white py-3 border-bottom">
        <h5 class="mb-0 font-weight-bold text-primary"><i class="mdi mdi-account-multiple me-2"></i>Data Orang Tua / Wali</h5>
      </div>
      <div class="card-body">
        <div class="row">
          <!-- Ayah Info -->
          <div class="col-md-6 border-end pr-md-4">
            <h6 class="font-weight-bold text-info mb-3"><i class="mdi mdi-gender-male me-1"></i>Data Ayah</h6>
            @if($ayah)
              <div class="mb-2">
                <label class="text-muted small mb-0">Nama Lengkap</label>
                <p class="font-weight-bold text-dark mb-0">{{ $ayah->nama }}</p>
              </div>
              <div class="mb-2">
                <label class="text-muted small mb-0">NIK</label>
                <p class="font-weight-bold text-dark mb-0">{{ $ayah->nik }}</p>
              </div>
              <div class="mb-2">
                <label class="text-muted small mb-0">Pekerjaan</label>
                <p class="font-weight-bold text-dark mb-0">{{ $ayah->pekerjaan }}</p>
              </div>
              <div class="mb-2">
                <label class="text-muted small mb-0">Penghasilan Bulanan</label>
                <p class="font-weight-bold text-success mb-0">Rp {{ number_format($ayah->penghasilan, 0, ',', '.') }}</p>
              </div>
              <div class="mb-2">
                <label class="text-muted small mb-0">No. HP/WhatsApp</label>
                <p class="font-weight-bold text-dark mb-0">{{ $ayah->no_hp }}</p>
              </div>
            @else
              <p class="text-muted small italic">Data ayah belum diisi.</p>
            @endif
          </div>

          <!-- Ibu Info -->
          <div class="col-md-6 pl-md-4">
            <h6 class="font-weight-bold text-danger mb-3"><i class="mdi mdi-gender-female me-1"></i>Data Ibu</h6>
            @if($ibu)
              <div class="mb-2">
                <label class="text-muted small mb-0">Nama Lengkap</label>
                <p class="font-weight-bold text-dark mb-0">{{ $ibu->nama }}</p>
              </div>
              <div class="mb-2">
                <label class="text-muted small mb-0">NIK</label>
                <p class="font-weight-bold text-dark mb-0">{{ $ibu->nik }}</p>
              </div>
              <div class="mb-2">
                <label class="text-muted small mb-0">Pekerjaan</label>
                <p class="font-weight-bold text-dark mb-0">{{ $ibu->pekerjaan }}</p>
              </div>
              <div class="mb-2">
                <label class="text-muted small mb-0">Penghasilan Bulanan</label>
                <p class="font-weight-bold text-success mb-0">Rp {{ number_format($ibu->penghasilan, 0, ',', '.') }}</p>
              </div>
              <div class="mb-2">
                <label class="text-muted small mb-0">No. HP/WhatsApp</label>
                <p class="font-weight-bold text-dark mb-0">{{ $ibu->no_hp }}</p>
              </div>
            @else
              <p class="text-muted small italic">Data ibu belum diisi.</p>
            @endif
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Right Side: Class, Package and Verification Actions -->
  <div class="col-lg-4">
    
    <!-- Package Details Card -->
    <div class="card mb-4 shadow-sm border-0">
      <div class="card-header bg-white py-3 border-bottom">
        <h5 class="mb-0 font-weight-bold text-dark"><i class="mdi mdi-package-variant-closed me-2"></i>Pilihan Paket & Kelas</h5>
      </div>
      <div class="card-body">
        <div class="mb-3">
          <label class="text-muted small mb-0">Kelas Terdaftar</label>
          <h5 class="font-weight-bold text-dark mb-0">
            {{ $siswa->kelas ? $siswa->kelas->nama_kelas : 'Belum Ditentukan' }} 
            @if($siswa->kelas)
              <span class="badge badge-info ms-1">{{ $siswa->kelas->jenjang }}</span>
            @endif
          </h5>
        </div>
        <hr>
        <div class="mb-3">
          <label class="text-muted small mb-0">Paket Pendaftaran</label>
          <h5 class="font-weight-bold text-primary mb-0">
            {{ $siswa->paket ? $siswa->paket->nama_paket : 'Belum Memilih' }}
          </h5>
          @if($siswa->paket)
            <div class="mt-2 text-muted small">
              <strong>Biaya Paket:</strong> Rp {{ number_format($siswa->paket->nominal_biaya, 0, ',', '.') }}
            </div>
          @endif
        </div>
        @if($siswa->paket && $siswa->paket->items->isNotEmpty())
          <div class="mt-3">
            <label class="text-muted small mb-1 d-block">Perlengkapan yang diperoleh:</label>
            <div class="d-flex flex-wrap gap-1">
              @foreach($siswa->paket->items as $item)
                <span class="badge badge-light border text-muted small py-1 px-2 mb-1">{{ $item->nama_item }}</span>
              @endforeach
            </div>
          </div>
        @endif
      </div>
    </div>

    <!-- Payment Summary Card -->
    <div class="card mb-4 shadow-sm border-0">
      <div class="card-header bg-white py-3 border-bottom">
        <h5 class="mb-0 font-weight-bold text-dark"><i class="mdi mdi-cash-multiple me-2"></i>Status Pembayaran</h5>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-6 mb-3">
            <label class="text-muted small mb-0">Total Terbayar</label>
            <h6 class="font-weight-bold text-success mb-0">Rp {{ number_format($totalBayar, 0, ',', '.') }}</h6>
          </div>
          <div class="col-6 mb-3">
            <label class="text-muted small mb-0">Sisa Tagihan</label>
            <h6 class="font-weight-bold text-danger mb-0">Rp {{ number_format($sisaTagihan, 0, ',', '.') }}</h6>
          </div>
        </div>
        @if($sisaTagihan == 0 && $siswa->paket)
          <div class="alert alert-success py-2 text-center small font-weight-bold mb-0">
            <i class="mdi mdi-check-circle me-1"></i> LUNAS
          </div>
        @else
          <div class="alert alert-warning py-2 text-center small font-weight-bold mb-0">
            <i class="mdi mdi-alert-circle me-1"></i> BELUM LUNAS
          </div>
        @endif
      </div>
    </div>

    <!-- Verification Actions Card -->
    <div class="card mb-4 shadow-sm border-primary border-top border-3">
      <div class="card-header bg-white py-3 border-bottom">
        <h5 class="mb-0 font-weight-bold text-dark"><i class="mdi mdi-checkbox-marked-circle-outline me-2"></i>Verifikasi Pendaftaran</h5>
      </div>
      <div class="card-body text-center">
        <div class="mb-4">
          <span class="text-muted d-block small mb-1">Status Saat Ini:</span>
          @if($siswa->status_pendaftaran == 'Menunggu Verifikasi')
            <span class="badge badge-warning font-weight-bold px-3 py-2 text-uppercase">Menunggu Verifikasi</span>
          @elseif($siswa->status_pendaftaran == 'Diterima')
            <span class="badge badge-success font-weight-bold px-3 py-2 text-uppercase">Diterima</span>
          @else
            <span class="badge badge-danger font-weight-bold px-3 py-2 text-uppercase">Ditolak</span>
          @endif
        </div>

        <form action="{{ route('admin.siswa.updateStatus', $siswa->id) }}" method="POST">
          @csrf
          <div class="d-grid gap-2">
            @if($siswa->status_pendaftaran != 'Diterima')
              <button type="submit" name="status_pendaftaran" value="Diterima" class="btn btn-success btn-block py-2 mb-2">
                <i class="mdi mdi-check-circle me-1"></i> Terima Calon Siswa
              </button>
            @endif
            @if($siswa->status_pendaftaran != 'Ditolak')
              <button type="submit" name="status_pendaftaran" value="Ditolak" class="btn btn-danger btn-block py-2 mb-2" onclick="return confirm('Apakah Anda yakin ingin menolak pendaftaran siswa ini?');">
                <i class="mdi mdi-close-circle me-1"></i> Tolak Pendaftaran
              </button>
            @endif
            @if($siswa->status_pendaftaran != 'Menunggu Verifikasi')
              <button type="submit" name="status_pendaftaran" value="Menunggu Verifikasi" class="btn btn-light btn-block py-2">
                Setel ke Menunggu
              </button>
            @endif
          </div>
        </form>
      </div>
      <div class="card-footer bg-light text-center">
        <a href="{{ route('admin.siswa.index') }}" class="btn btn-xs btn-link text-muted py-0">
          <i class="mdi mdi-arrow-left"></i> Kembali ke Daftar
        </a>
      </div>
    </div>

  </div>
</div>
@endsection
