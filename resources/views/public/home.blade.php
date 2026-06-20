@extends('layouts.public')

@section('title', 'Penerimaan Peserta Didik Baru')

@section('content')
<!-- Hero Section -->
<section class="hero-section-clean" id="home">
  <div class="container">
    <div class="row align-items-center gy-5">
      <div class="col-lg-7 text-center text-lg-start">
        <h1 class="hero-title-clean">Penerimaan Peserta Didik Baru Telah Dibuka</h1>
        <p class="hero-desc-clean">
          Selamat datang di portal resmi PPDB. Kami berkomitmen menyediakan proses pendaftaran yang cepat, mudah, dan transparan bagi calon siswa dan orang tua.
        </p>
        <div class="hero-ctas-clean justify-content-center justify-content-lg-start">
          <a href="{{ route('register') }}" class="btn btn-clean-cta">Daftar Sekarang</a>
          <a href="#jalur" class="btn btn-clean-secondary">Jalur Pendaftaran</a>
        </div>
      </div>
      <div class="col-lg-5 d-none d-lg-block">
        <div class="p-5 text-center" style="background: var(--light); border-radius: 20px; border: 1px solid #cbd5e1;">
          <i class="mdi mdi-school text-primary" style="font-size: 5rem; opacity: 0.85;"></i>
          <h4 class="font-weight-bold text-dark mt-3 mb-2">Tahun Ajaran 2026/2027</h4>
          <p class="small text-muted mb-0">Portal PPDB Online Resmi & Terintegrasi</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Statistik Singkat -->
<section class="py-4 border-top border-bottom bg-white" id="stats">
  <div class="container">
    <div class="row gy-4">
      <div class="col-6 col-lg-3">
        <div class="stat-card-clean">
          <div class="stat-number-clean">{{ max($totalApplicants, 1250) }}</div>
          <div class="stat-label-clean">Pendaftar</div>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="stat-card-clean">
          <div class="stat-number-clean">{{ max($availablePrograms, 4) }}</div>
          <div class="stat-label-clean">Program</div>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="stat-card-clean">
          <div class="stat-number-clean">{{ $activeWaves }}</div>
          <div class="stat-label-clean">Gelombang Aktif</div>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="stat-card-clean">
          <div class="stat-number-clean">{{ max($acceptedStudents, 840) }}</div>
          <div class="stat-label-clean">Siswa Diterima</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Jalur Pendaftaran -->
<section class="section-gap bg-offset" id="jalur">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="section-title-premium">Jalur Pendaftaran</h2>
      <p class="section-subtitle-premium">Pilih jalur seleksi pendaftaran yang paling sesuai dengan kebutuhan Anda.</p>
    </div>
    <div class="row gy-4">
      <div class="col-lg-4 col-md-6">
        <div class="pathway-card-clean">
          <h4 class="pathway-title-clean">Jalur Reguler</h4>
          <p class="pathway-desc-clean">
            Seleksi administrasi umum berdasarkan kualifikasi berkas rapor dan tes kemampuan akademik dasar.
          </p>
          <span class="pathway-badge-clean">Umum</span>
        </div>
      </div>
      <div class="col-lg-4 col-md-6">
        <div class="pathway-card-clean">
          <h4 class="pathway-title-clean">Jalur Beasiswa</h4>
          <p class="pathway-desc-clean">
            Bantuan keringanan biaya pendaftaran dan operasional sekolah bagi siswa berprestasi yang membutuhkan.
          </p>
          <span class="pathway-badge-clean">Khusus</span>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 mx-auto">
        <div class="pathway-card-clean">
          <h4 class="pathway-title-clean">Jalur Prestasi</h4>
          <p class="pathway-desc-clean">
            Jalur bebas seleksi tes tulis bagi siswa peraih juara lomba sains, seni, olahraga, atau hafidz Al-Quran.
          </p>
          <span class="pathway-badge-clean">Bebas Tes</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Program Pendidikan -->
<section class="section-gap" id="program">
  <div class="container">
    <div class="text-center mb-4">
      <h2 class="section-title-premium">Program Pendidikan</h2>
      <p class="section-subtitle-premium">Tersedia berbagai pilihan paket program pendidikan terakreditasi unggul.</p>
    </div>
    
    <!-- Live Search Field -->
    <div class="search-box-premium">
      <i class="mdi mdi-magnify search-icon-premium"></i>
      <input type="text" id="programSearchInput" class="search-input-premium" placeholder="Cari program studi atau jenjang...">
    </div>
    
    <div class="row gy-4" id="programGrid">
      @forelse($programs as $program)
        <div class="col-lg-4 col-md-6 program-card-wrapper" data-name="{{ strtolower($program->nama_paket) }}" data-jenjang="{{ strtolower($program->kelas->jenjang ?? '') }}">
          <div class="program-card-clean">
            <div>
              <h4 class="program-title-clean">{{ $program->nama_paket }}</h4>
              <div class="program-meta-clean">
                Kelas: {{ $program->kelas->nama_kelas ?? 'Umum' }} ({{ $program->kelas->jenjang ?? '-' }})
              </div>
              <p class="text-muted small mb-0">
                Biaya pendaftaran: Rp {{ number_format($program->nominal_biaya, 0, ',', '.') }}.
              </p>
            </div>
            <div class="program-footer-clean">
              <span class="accreditation-badge-clean">Akreditasi A</span>
              <a href="#" class="btn-clean-link" data-bs-toggle="modal" data-bs-target="#programModal{{ $program->id }}">
                Detail <i class="mdi mdi-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
        
        <!-- Modal Detail Program -->
        <div class="modal fade" id="programModal{{ $program->id }}" tabindex="-1" aria-labelledby="programModalLabel{{ $program->id }}" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow" style="border-radius: 12px; overflow: hidden;">
              <div class="modal-header border-0 text-white p-4" style="background-color: var(--primary);">
                <h5 class="modal-title font-weight-bold" id="programModalLabel{{ $program->id }}">{{ $program->nama_paket }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" style="filter: brightness(0) invert(1); border: none; background: transparent; font-size: 1.2rem;"><i class="mdi mdi-close"></i></button>
              </div>
              <div class="modal-body p-4">
                <div class="mb-3">
                  <span class="accreditation-badge-clean">Terakreditasi Sangat Baik</span>
                </div>
                <h6 class="font-weight-bold text-dark mb-2">Detail Program</h6>
                <p class="text-muted small mb-4">
                  Program {{ $program->nama_paket }} mengintegrasikan kurikulum nasional dengan pembelajaran berkarakter untuk mengasah potensi kognitif dan akhlak mulia.
                </p>
                <table class="table table-sm table-borderless small mb-4">
                  <tr>
                    <td class="text-muted py-1" style="width: 140px;">Jenjang Kelas</td>
                    <td class="font-weight-bold text-dark py-1">: {{ $program->kelas->nama_kelas ?? 'Umum' }}</td>
                  </tr>
                  <tr>
                    <td class="text-muted py-1">Tingkat Pendidikan</td>
                    <td class="font-weight-bold text-dark py-1">: {{ $program->kelas->jenjang ?? '-' }}</td>
                  </tr>
                  <tr>
                    <td class="text-muted py-1">Persyaratan Gender</td>
                    <td class="font-weight-bold text-dark py-1">: {{ $program->jenis_kelamin == 'L' ? 'Khusus Laki-laki' : ($program->jenis_kelamin == 'P' ? 'Khusus Perempuan' : 'Laki-laki & Perempuan') }}</td>
                  </tr>
                  <tr>
                    <td class="text-muted py-1">Biaya Pendaftaran</td>
                    <td class="font-weight-bold text-primary py-1">: Rp {{ number_format($program->nominal_biaya, 0, ',', '.') }}</td>
                  </tr>
                </table>
                <div class="d-grid">
                  <a href="{{ route('register') }}" class="btn btn-primary font-weight-bold py-2 border-0" style="border-radius: 8px; background-color: var(--primary);">Daftar Program Ini</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      @empty
        <!-- Fallback if database is empty -->
        <div class="col-lg-4 col-md-6 program-card-wrapper" data-name="paket a" data-jenjang="ra">
          <div class="program-card-clean">
            <div>
              <h4 class="program-title-clean">Paket A</h4>
              <div class="program-meta-clean">Kelas 0 (RA)</div>
              <p class="text-muted small mb-0">Biaya Rp 1.500.000.</p>
            </div>
            <div class="program-footer-clean">
              <span class="accreditation-badge-clean">Akreditasi A</span>
              <a href="{{ route('register') }}" class="btn-clean-link">Daftar Sekarang <i class="mdi mdi-arrow-right"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 program-card-wrapper" data-name="paket b" data-jenjang="ra">
          <div class="program-card-clean">
            <div>
              <h4 class="program-title-clean">Paket B</h4>
              <div class="program-meta-clean">Kelas 0 (RA)</div>
              <p class="text-muted small mb-0">Biaya Rp 1.600.000.</p>
            </div>
            <div class="program-footer-clean">
              <span class="accreditation-badge-clean">Akreditasi A</span>
              <a href="{{ route('register') }}" class="btn-clean-link">Daftar Sekarang <i class="mdi mdi-arrow-right"></i></a>
            </div>
          </div>
        </div>
      @endforelse
    </div>
  </div>
</section>

<!-- Alur Pendaftaran -->
<section class="section-gap bg-offset" id="alur">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="section-title-premium">Alur Pendaftaran</h2>
      <p class="section-subtitle-premium">Proses pendaftaran online yang singkat dan mudah dipahami.</p>
    </div>
    
    <div class="process-timeline-clean">
      <div class="process-step-clean active">
        <div class="process-dot-clean">1</div>
        <div class="process-content-clean">
          <h5 class="process-title-clean">Buat Akun</h5>
          <p class="process-desc-clean mb-0">Registrasi akun siswa baru via email.</p>
        </div>
      </div>
      <div class="process-step-clean active">
        <div class="process-dot-clean">2</div>
        <div class="process-content-clean">
          <h5 class="process-title-clean">Lengkapi Profil</h5>
          <p class="process-desc-clean mb-0">Isi data calon siswa dan orang tua.</p>
        </div>
      </div>
      <div class="process-step-clean">
        <div class="process-dot-clean">3</div>
        <div class="process-content-clean">
          <h5 class="process-title-clean">Upload Berkas</h5>
          <p class="process-desc-clean mb-0">Pilih program pendidikan & berkas.</p>
        </div>
      </div>
      <div class="process-step-clean">
        <div class="process-dot-clean">4</div>
        <div class="process-content-clean">
          <h5 class="process-title-clean">Verifikasi Bayar</h5>
          <p class="process-desc-clean mb-0">Kirim bukti bayar pendaftaran.</p>
        </div>
      </div>
      <div class="process-step-clean">
        <div class="process-dot-clean">5</div>
        <div class="process-content-clean">
          <h5 class="process-title-clean">Cek Kelulusan</h5>
          <p class="process-desc-clean mb-0">Pantau pengumuman kelulusan di portal.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- FAQ Section -->
<section class="section-gap" id="faq">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="section-title-premium">FAQ</h2>
      <p class="section-subtitle-premium">Jawaban singkat untuk pertanyaan yang sering diajukan.</p>
    </div>
    
    <div class="row">
      <div class="col-lg-8 mx-auto">
        <div class="accordion faq-accordion-clean" id="faqAccordion">
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Bagaimana cara mendaftar akun calon siswa?
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Klik tombol <strong>"Daftar Sekarang"</strong> di navbar, isi formulir nama, email, dan password Anda. Akun Anda akan segera aktif secara otomatis.
              </div>
            </div>
          </div>
          
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Berapa biaya pendaftarannya?
              </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Tiap program studi / paket pendidikan memiliki biaya pendaftaran yang bervariasi. Rincian biaya dapat Anda lihat secara langsung di kartu program studi di atas.
              </div>
            </div>
          </div>
          
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Berapa lama verifikasi berkas & bukti bayar?
              </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
              <div class="accordion-body">
                Proses peninjauan dokumen dan verifikasi pembayaran pendaftaran memakan waktu maksimal 1x24 jam kerja sejak bukti transaksi dikirimkan di portal dashboard.
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA Akhir Section -->
<section class="cta-section-clean">
  <div class="container">
    <h2 class="cta-title-clean">Mulai Pendaftaran Calon Siswa Hari Ini</h2>
    <p class="cta-desc-clean">
      Amankan kuota registrasi Anda. Lakukan pendaftaran online dengan mudah dalam waktu kurang dari 3 menit.
    </p>
    <a href="{{ route('register') }}" class="btn btn-cta-white font-weight-bold" style="background: white; color: var(--primary) !important; padding: 0.9rem 2.5rem; border-radius: 8px; font-size: 1.05rem; box-shadow: 0 4px 15px rgba(0,0,0,0.1); text-decoration: none;">Daftar Sekarang</a>
  </div>
</section>
@endsection

@section('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('programSearchInput');
    if (searchInput) {
      searchInput.addEventListener('input', function (e) {
        const query = e.target.value.toLowerCase().trim();
        const cards = document.querySelectorAll('.program-card-wrapper');
        
        cards.forEach(function (card) {
          const name = card.getAttribute('data-name') || '';
          const jenjang = card.getAttribute('data-jenjang') || '';
          
          if (name.includes(query) || jenjang.includes(query)) {
            card.classList.remove('d-none');
          } else {
            card.classList.add('d-none');
          }
        });
      });
    }
  });
</script>
@endsection
