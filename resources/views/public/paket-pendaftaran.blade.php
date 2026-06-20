@extends('layouts.public')

@section('title', 'Paket Pendaftaran')

@section('content')
<section class="py-5 bg-light-custom">
  <div class="container">
    <div class="row text-center mb-4">
      <div class="col-12">
        <h2 class="section-title">Paket Pendaftaran</h2>
        <p class="section-desc">Pilihan paket pendaftaran siswa baru beserta rincian biaya dan perlengkapan seragam/alat tulis.</p>
      </div>
    </div>
  </div>
</section>

<!-- Packages Display Grid -->
<section class="py-5">
  <div class="container">
    <div class="row justify-content-center">
      
      @forelse($paket as $item)
        <div class="col-md-6 col-lg-4 mb-4">
          <div class="package-card h-100 d-flex flex-column {{ $loop->first ? 'featured' : '' }}">
            @if($loop->first)
              <span class="package-badge">Paling Populer</span>
            @endif
            
            <div class="package-header text-center">
              <h4 class="font-weight-bold text-dark mb-1">{{ $item->nama_paket }}</h4>
              <p class="text-muted small mb-3">
                Kelas: <strong>{{ $item->kelas ? $item->kelas->nama_kelas : '-' }}</strong> 
                ({{ $item->kelas ? $item->kelas->jenjang : '-' }})
              </p>
              <div class="package-price">
                Rp {{ number_format($item->nominal_biaya, 0, ',', '.') }}
              </div>
              <span class="text-muted small">Sekali Bayar</span>
            </div>

            <div class="package-body d-flex flex-column flex-grow-1">
              <p class="font-weight-bold text-dark small mb-3">Perlengkapan yang diperoleh:</p>
              <ul class="package-list flex-grow-1">
                <li class="small text-muted">
                  <i class="mdi mdi-gender-transgender"></i>
                  Target Gender: <strong>{{ $item->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</strong>
                </li>
                @forelse($item->items as $detailItem)
                  <li class="small text-muted">
                    <i class="mdi mdi-check-circle"></i>
                    {{ $detailItem->nama_item }}
                  </li>
                @empty
                  <li class="small text-muted italic">Tidak ada perlengkapan yang dilampirkan.</li>
                @endforelse
              </ul>
              
              <div class="d-grid mt-4">
                <a href="{{ route('register') }}" class="btn {{ $loop->first ? 'btn-primary' : 'btn-outline-primary' }} py-2.5 rounded-lg font-weight-bold">
                  Daftar Sekarang
                </a>
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12 text-center py-5">
          <i class="mdi mdi-package-variant text-muted mb-3" style="font-size: 4rem;"></i>
          <h5 class="text-muted">Belum ada paket pendaftaran yang ditawarkan saat ini.</h5>
        </div>
      @endforelse

    </div>
  </div>
</section>
@endsection
