@extends('layouts.public')

@section('title', 'Profil Sekolah')

@section('content')
<section class="py-5 bg-light-custom">
  <div class="container">
    <div class="row text-center mb-4">
      <div class="col-12">
        <h2 class="section-title">Profil Sekolah</h2>
        <p class="section-desc">Kenali lebih dekat sejarah, visi, misi, dan struktur organisasi sekolah kami.</p>
      </div>
    </div>
  </div>
</section>

<!-- History Section -->
<section class="py-5">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 mb-4 mb-lg-0">
        <div style="width: 100%; height: 350px; background: linear-gradient(135deg, #4f46e5 0%, #06b6d4 100%); border-radius: 24px; display: flex; align-items: center; justify-content: center; color: white; padding: 2rem;">
          <div class="text-center">
            <i class="mdi mdi-history" style="font-size: 5rem;"></i>
            <h3 class="font-weight-bold mt-3">Didirikan Tahun 2015</h3>
            <p class="text-white-50">Berdedikasi untuk mencerdaskan bangsa</p>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <h3 class="font-weight-bold text-dark mb-3">Sejarah Singkat</h3>
        <p class="text-muted">
          Sekolah kami didirikan pada tahun 2015 oleh Yayasan Pendidikan Islam Madani dengan komitmen luhur untuk menyediakan pendidikan tingkat dasar yang berkualitas tinggi di lingkungan yang kondusif. Mulai dari puluhan murid di angkatan pertama, sekolah kami terus berkembang pesat hingga menjadi rujukan nasional.
        </p>
        <p class="text-muted">
          Dalam perjalanannya, sekolah terus beradaptasi dengan kemajuan teknologi modern tanpa melupakan nilai-nilai moral keagamaan. Hal ini dibuktikan dengan diperolehnya sertifikat Akreditasi "A" Unggul secara berturut-turut serta ratusan prestasi siswa di berbagai bidang.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Vision & Mission Details -->
<section class="py-5 bg-light-custom">
  <div class="container">
    <div class="row">
      <div class="col-md-6 mb-4 mb-md-0">
        <div class="card p-4 border-0 shadow-sm h-100">
          <div class="card-body">
            <h4 class="font-weight-bold text-primary mb-3"><i class="mdi mdi-eye me-2"></i>Visi Sekolah</h4>
            <p class="text-muted">
              Menjadi lembaga pendidikan terdepan yang menghasilkan lulusan unggul dalam prestasi akademik, kokoh dalam aqidah keagamaan, terampil menggunakan teknologi, serta peduli terhadap lingkungan sosial.
            </p>
          </div>
        </div>
      </div>
      
      <div class="col-md-6">
        <div class="card p-4 border-0 shadow-sm h-100">
          <div class="card-body">
            <h4 class="font-weight-bold text-success mb-3"><i class="mdi mdi-bullseye me-2"></i>Misi Sekolah</h4>
            <ul class="text-muted pl-3">
              <li class="mb-2">Menerapkan kurikulum terintegrasi yang menggabungkan standar nasional dan nilai keagamaan islam.</li>
              <li class="mb-2">Melaksanakan metode pembelajaran aktif, kreatif, efektif, dan menyenangkan (PAKEM).</li>
              <li class="mb-2">Membekali siswa dengan literasi komputer, sains, dan bahasa asing sejak dini.</li>
              <li>Menumbuhkan kepedulian sosial melalui program bakti masyarakat dan infaq berkala.</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Organizational & Accreditation -->
<section class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 mb-4 mb-lg-0">
        <h4 class="font-weight-bold text-dark mb-4"><i class="mdi mdi-sitemap text-primary me-2"></i>Struktur Organisasi</h4>
        <div class="table-responsive">
          <table class="table border">
            <thead class="table-light">
              <tr>
                <th>Jabatan</th>
                <th>Nama Pejabat</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><strong>Kepala Sekolah</strong></td>
                <td>H. Ahmad Muzakki, M.Pd.</td>
              </tr>
              <tr>
                <td><strong>Wakil Kepala Kurikulum</strong></td>
                <td>Drs. Hendra Wijaya</td>
              </tr>
              <tr>
                <td><strong>Wakil Kepala Kesiswaan</strong></td>
                <td>Ibu Nining Sulastri, S.Pd.</td>
              </tr>
              <tr>
                <td><strong>Bendahara Sekolah</strong></td>
                <td>Ibu Rina Amalia, S.E.</td>
              </tr>
              <tr>
                <td><strong>Kepala Tata Usaha</strong></td>
                <td>Bapak Rudi Hartono, A.Md.</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      
      <div class="col-lg-6">
        <h4 class="font-weight-bold text-dark mb-4"><i class="mdi mdi-seal text-success me-2"></i>Status Akreditasi</h4>
        <div class="card bg-gradient-success text-white border-0 shadow p-4 text-center">
          <div class="card-body">
            <h1 class="font-weight-extrabold mb-2" style="font-size: 4.5rem; letter-spacing: -2px; color: white;">A</h1>
            <h4 class="font-weight-bold mb-2">Terakreditasi "SANGAT BAIK" (Unggul)</h4>
            <p class="mb-0 text-white-50">Oleh Badan Akreditasi Nasional Sekolah/Madrasah (BAN-S/M)</p>
            <small class="text-white-50">Sertifikat Berlaku s.d. Desember 2029</small>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
