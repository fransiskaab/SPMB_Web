@extends('layouts.public')

@section('title', 'Hubungi Kami')

@section('content')
<section class="py-5 bg-light-custom">
  <div class="container">
    <div class="row text-center mb-4">
      <div class="col-12">
        <h2 class="section-title">Hubungi Kami</h2>
        <p class="section-desc">Punya pertanyaan seputar penerimaan murid baru? Hubungi kami langsung atau kunjungi alamat kami.</p>
      </div>
    </div>
  </div>
</section>

<!-- Contact Form & Details -->
<section class="py-5">
  <div class="container">
    <div class="row">
      
      <!-- Info Column -->
      <div class="col-lg-5 mb-5 mb-lg-0">
        <div class="card border-0 shadow-sm p-4 h-100 bg-gradient-primary text-white" style="border-radius: 20px;">
          <div class="card-body">
            <h4 class="font-weight-bold text-white mb-4">Informasi Kontak</h4>
            <p class="text-white-50 mb-5">Kami siap melayani konsultasi pendaftaran pada hari kerja.</p>
            
            <div class="d-flex align-items-start mb-4">
              <i class="mdi mdi-map-marker fs-4 me-3 mt-1"></i>
              <div>
                <h6 class="font-weight-bold mb-1 text-white">Alamat Kampus</h6>
                <p class="mb-0 text-white-50 small">Jl. Pendidikan No. 123, Kel. Kebayoran, Jakarta Selatan, 12110</p>
              </div>
            </div>
            
            <div class="d-flex align-items-start mb-4">
              <i class="mdi mdi-phone fs-4 me-3 mt-1"></i>
              <div>
                <h6 class="font-weight-bold mb-1 text-white">Telepon / WhatsApp</h6>
                <p class="mb-0 text-white-50 small">(021) 7654-3210 / 0812-3456-7890</p>
              </div>
            </div>
            
            <div class="d-flex align-items-start">
              <i class="mdi mdi-email fs-4 me-3 mt-1"></i>
              <div>
                <h6 class="font-weight-bold mb-1 text-white">Alamat Email</h6>
                <p class="mb-0 text-white-50 small">info@sekolah-sipmb.sch.id</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Form Column -->
      <div class="col-lg-7">
        <div class="card border-0 shadow-sm p-4" style="border-radius: 20px;">
          <div class="card-body">
            <h4 class="font-weight-bold text-dark mb-4">Kirim Pesan</h4>
            <form action="#" class="forms-sample">
              <div class="row">
                <div class="col-md-6 mb-3">
                  <label for="name" class="text-muted small">Nama Lengkap</label>
                  <input type="text" class="form-control" id="name" placeholder="Nama Anda" required>
                </div>
                <div class="col-md-6 mb-3">
                  <label for="email" class="text-muted small">Alamat Email</label>
                  <input type="email" class="form-control" id="email" placeholder="Email Anda" required>
                </div>
              </div>
              <div class="mb-3">
                <label for="subject" class="text-muted small">Subjek Pesan</label>
                <input type="text" class="form-control" id="subject" placeholder="Contoh: Tanya Kuota Pendaftaran" required>
              </div>
              <div class="mb-4">
                <label for="message" class="text-muted small">Isi Pesan</label>
                <textarea class="form-control" id="message" rows="5" placeholder="Tuliskan pesan Anda di sini..." required></textarea>
              </div>
              <button type="button" class="btn btn-primary px-4 py-2.5 rounded-lg font-weight-bold" onclick="alert('Terima kasih! Pesan Anda berhasil dikirim (Mockup).');">
                Kirim Pesan
              </button>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Maps Section -->
<section class="py-0 mb-5">
  <div class="container">
    <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 24px;">
      <!-- Google Maps Embed Mock/Iframe -->
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15865.748235284358!2d106.80164627196025!3d-6.205934674719082!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3dd90d95959%3A0xe510b64d36067cfc!2sJakarta%20Selatan%2C%20Kota%20Jakarta%20Selatan%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </div>
</section>
@endsection
