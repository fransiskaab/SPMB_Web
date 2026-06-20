@extends('layouts.public')

@section('title', 'Fasilitas Sekolah')

@section('content')
<section class="py-5 bg-light-custom">
  <div class="container">
    <div class="row text-center mb-4">
      <div class="col-12">
        <h2 class="section-title">Fasilitas Sekolah</h2>
        <p class="section-desc">Kami menyediakan sarana prasarana modern untuk mendukung kenyamanan proses belajar mengajar.</p>
      </div>
    </div>
  </div>
</section>

<!-- Facility Cards Grid -->
<section class="py-5">
  <div class="container">
    <div class="row">
      
      <!-- Classroom -->
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="facility-card h-100">
          <div style="height: 200px; background: linear-gradient(135deg, #10b981 0%, #059669 100%); display: flex; align-items: center; justify-content: center; color: white;">
            <i class="mdi mdi-google-classroom" style="font-size: 4rem;"></i>
          </div>
          <div class="facility-body">
            <h5 class="font-weight-bold text-dark mb-2">Ruang Kelas AC & LCD</h5>
            <p class="text-muted small mb-0">
              Setiap kelas dilengkapi pendingin udara (AC), LCD proyektor interaktif, papan tulis magnetik, loker siswa, dan pencahayaan yang sangat baik.
            </p>
          </div>
        </div>
      </div>

      <!-- Laboratory -->
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="facility-card h-100">
          <div style="height: 200px; background: linear-gradient(135deg, #4f46e5 0%, #3730a3 100%); display: flex; align-items: center; justify-content: center; color: white;">
            <i class="mdi mdi-flask" style="font-size: 4rem;"></i>
          </div>
          <div class="facility-body">
            <h5 class="font-weight-bold text-dark mb-2">Laboratorium Sains</h5>
            <p class="text-muted small mb-0">
              Laboratorium IPA lengkap dengan mikroskop digital, alat peraga sains mutakhir, serta bahan-bahan percobaan pendukung kurikulum praktikum.
            </p>
          </div>
        </div>
      </div>

      <!-- Library -->
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="facility-card h-100">
          <div style="height: 200px; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); display: flex; align-items: center; justify-content: center; color: white;">
            <i class="mdi mdi-book-open-page-variant" style="font-size: 4rem;"></i>
          </div>
          <div class="facility-body">
            <h5 class="font-weight-bold text-dark mb-2">Perpustakaan Digital</h5>
            <p class="text-muted small mb-0">
              Menyediakan ribuan koleksi buku cetak, ensiklopedia anak, ruang baca berkarpet nyaman, serta akses e-library berbasis tablet pintar.
            </p>
          </div>
        </div>
      </div>

      <!-- Sports Area -->
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="facility-card h-100">
          <div style="height: 200px; background: linear-gradient(135deg, #ec4899 0%, #be185d 100%); display: flex; align-items: center; justify-content: center; color: white;">
            <i class="mdi mdi-soccer" style="font-size: 4rem;"></i>
          </div>
          <div class="facility-body">
            <h5 class="font-weight-bold text-dark mb-2">Lapangan Olahraga & Gym</h5>
            <p class="text-muted small mb-0">
              Memiliki lapangan outdoor serbaguna untuk basket, futsal, bulu tangkis, serta area indoor panahan dan senam lantai yang aman bagi anak.
            </p>
          </div>
        </div>
      </div>

      <!-- Mosque -->
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="facility-card h-100">
          <div style="height: 200px; background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); display: flex; align-items: center; justify-content: center; color: white;">
            <i class="mdi mdi-mosque" style="font-size: 4rem;"></i>
          </div>
          <div class="facility-body">
            <h5 class="font-weight-bold text-dark mb-2">Masjid Darussalam</h5>
            <p class="text-muted small mb-0">
              Masjid megah ber-AC di dalam area sekolah, digunakan untuk ibadah salat berjamaah, hafalan Al-Qur'an (Tahfidz), serta kajian keagamaan.
            </p>
          </div>
        </div>
      </div>

      <!-- Multimedia Room -->
      <div class="col-md-6 col-lg-4 mb-4">
        <div class="facility-card h-100">
          <div style="height: 200px; background: linear-gradient(135deg, #6366f1 0%, #4338ca 100%); display: flex; align-items: center; justify-content: center; color: white;">
            <i class="mdi mdi-laptop" style="font-size: 4rem;"></i>
          </div>
          <div class="facility-body">
            <h5 class="font-weight-bold text-dark mb-2">Lab Komputer & Multimedia</h5>
            <p class="text-muted small mb-0">
              Dilengkapi 40 unit PC modern dengan koneksi internet cepat fiber optik untuk literasi TIK dasar, desain grafis, dan robotika.
            </p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
@endsection
