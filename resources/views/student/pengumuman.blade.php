@extends('layouts.admin')

@section('title', 'Pengumuman Kelulusan')
@section('page_title', 'Pengumuman Kelulusan')

@section('content')
<div class="row">
  <div class="col-lg-8 mx-auto grid-margin stretch-card">
    <div class="card shadow-sm border-0" style="border-radius: 20px;">
      <div class="card-body p-5 text-center">
        
        <i class="mdi mdi-bullhorn-outline text-primary mb-4" style="font-size: 4rem;"></i>
        <h3 class="font-weight-bold text-dark mb-4">Pengumuman Kelulusan Calon Murid</h3>
        
        @if(!$siswa)
          <div class="alert alert-warning p-4 rounded-lg">
            <h5 class="font-weight-bold mb-2"><i class="mdi mdi-alert me-2"></i>Data Profil Belum Diisi</h5>
            <p class="mb-0 small">Harap lengkapi formulir data pribadi dan informasi orang tua terlebih dahulu agar admin dapat melakukan review berkas.</p>
          </div>
          <a href="{{ route('student.profile') }}" class="btn btn-primary font-weight-bold py-2.5 px-4 mt-3">Isi Formulir Profil</a>
        @elseif(!$siswa->paket_id)
          <div class="alert alert-warning p-4 rounded-lg">
            <h5 class="font-weight-bold mb-2"><i class="mdi mdi-alert me-2"></i>Belum Memilih Paket</h5>
            <p class="mb-0 small">Harap tentukan paket pendaftaran yang Anda ikuti agar berkas Anda dapat mulai diverifikasi.</p>
          </div>
          <a href="{{ route('student.pendaftaran') }}" class="btn btn-primary font-weight-bold py-2.5 px-4 mt-3">Pilih Paket Pendaftaran</a>
        @else
          
          <div class="border rounded p-4 mb-4 bg-light text-start">
            <h6 class="text-muted small text-uppercase mb-3 font-weight-bold">Informasi Calon Siswa</h6>
            <div class="row">
              <div class="col-md-6 mb-2">
                <span class="text-muted small d-block">Nama Lengkap:</span>
                <strong class="text-dark">{{ $siswa->nama_lengkap }}</strong>
              </div>
              <div class="col-md-6 mb-2">
                <span class="text-muted small d-block">NIK / KIA:</span>
                <strong class="text-dark">{{ $siswa->nik_kia }}</strong>
              </div>
              <div class="col-md-6 mb-2">
                <span class="text-muted small d-block">Kelas & Jenjang:</span>
                <strong class="text-dark">{{ $siswa->kelas ? $siswa->kelas->nama_kelas : '-' }} ({{ $siswa->kelas ? $siswa->kelas->jenjang : '-' }})</strong>
              </div>
              <div class="col-md-6">
                <span class="text-muted small d-block">Paket Pendaftaran:</span>
                <strong class="text-dark">{{ $siswa->paket ? $siswa->paket->nama_paket : '-' }}</strong>
              </div>
            </div>
          </div>

          <!-- Announcement Result Decision Block -->
          @if($siswa->status_pendaftaran == 'Menunggu Verifikasi')
            <div class="alert alert-warning p-5 rounded-lg border-0 bg-gradient-warning text-white" style="border-radius: 16px;">
              <i class="mdi mdi-clock-outline fs-1 mb-3"></i>
              <h4 class="font-weight-bold text-white mb-2">Pendaftaran Sedang Ditinjau</h4>
              <p class="mb-0 text-white-50 small">
                Status berkas pendaftaran Anda saat ini adalah <strong>Menunggu Verifikasi</strong>. Panitia PMB sedang memvalidasi data profil, kelengkapan keluarga, dan bukti transfer pembayaran Anda. Harap periksa halaman ini secara berkala.
              </p>
            </div>
          @elseif($siswa->status_pendaftaran == 'Diterima')
            <div class="alert alert-success p-5 rounded-lg border-0 bg-gradient-success text-white text-center" style="border-radius: 16px;">
              <i class="mdi mdi-checkbox-marked-circle-outline fs-1 mb-3"></i>
              <h4 class="font-weight-bold text-white mb-2">Selamat! Anda Dinyatakan Diterima</h4>
              <p class="mb-4 text-white-50 small">
                Berdasarkan hasil seleksi berkas administrasi dan keaslian transaksi pembayaran, Anda dinyatakan **LULUS / DITERIMA** sebagai murid baru.
              </p>
              
              <!-- Next step instruction letter -->
              <div class="bg-white rounded text-dark p-3 text-start mt-3 shadow-xs">
                <h6 class="font-weight-bold text-success mb-2"><i class="mdi mdi-information-outline me-1"></i>Langkah Daftar Ulang:</h6>
                <ol class="small mb-0 pl-3 text-muted">
                  <li class="mb-1">Hadir ke sekolah pada tanggal 15-18 Juli 2026 untuk mengukur seragam dan sepatu sekolah.</li>
                  <li class="mb-1">Membawa fotokopi Akta Lahir, Kartu Keluarga, dan KTP Orang Tua (asli diperlihatkan).</li>
                  <li>Mengambil perlengkapan alat tulis dan buku paket di koperasi sekolah.</li>
                </ol>
              </div>
            </div>
          @else
            <div class="alert alert-danger p-5 rounded-lg border-0 bg-gradient-danger text-white" style="border-radius: 16px;">
              <i class="mdi mdi-close-circle-outline fs-1 mb-3"></i>
              <h4 class="font-weight-bold text-white mb-2">Mohon Maaf, Pendaftaran Ditolak</h4>
              <p class="mb-0 text-white-50 small">
                Setelah meninjau berkas data pribadi atau konfirmasi bukti pembayaran pendaftaran Anda, dengan sangat menyesal panitia PMB menyatakan bahwa pendaftaran Anda **DITOLAK**. Silakan hubungi bagian administrasi sekolah untuk informasi lebih lanjut.
              </p>
            </div>
          @endif
          
        @endif

      </div>
      <div class="card-footer bg-light text-center py-3">
        <a href="{{ route('student.dashboard') }}" class="btn btn-sm btn-link text-muted py-0">
          <i class="mdi mdi-arrow-left"></i> Kembali ke Dashboard
        </a>
      </div>
    </div>
  </div>
</div>
@endsection
