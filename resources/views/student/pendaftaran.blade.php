@extends('layouts.admin')

@section('title', 'Pilih Paket Pendaftaran')
@section('page_title', 'Pilih Paket Pendaftaran')

@section('content')
<div class="row">
  <div class="col-12 mb-4">
    <div class="card bg-white border border-light shadow-sm p-4" style="border-radius: 12px;">
      <h4 class="font-weight-bold text-dark mb-2"><i class="mdi mdi-package-variant-closed text-primary me-2"></i>Pilih Paket Pendaftaran Anda</h4>
      <p class="text-muted small mb-0">
        Berdasarkan profil Anda (Jenis Kelamin: <strong>{{ $siswa->jenis_kelamin == 'L' ? 'Laki-Laki' : 'Perempuan' }}</strong>), berikut adalah paket pendaftaran yang tersedia untuk Anda.
      </p>
    </div>
  </div>
</div>

<div class="row justify-content-center">
  @forelse($paket as $item)
    <div class="col-md-6 col-lg-4 mb-4">
      <div class="card h-100 shadow-sm border border-light d-flex flex-column {{ ($siswa->paket_id == $item->id) ? 'border-primary border-2' : '' }}" style="border-radius: 16px;">
        <div class="card-header text-center py-4 bg-white border-bottom position-relative">
          @if($siswa->paket_id == $item->id)
            <span class="badge badge-primary position-absolute" style="top: 15px; right: 15px;">Terpilih</span>
          @endif
          <h4 class="font-weight-bold text-dark mb-1">{{ $item->nama_paket }}</h4>
          <p class="text-muted small mb-3">Kelas: <strong>{{ $item->kelas ? $item->kelas->nama_kelas : '-' }}</strong> ({{ $item->kelas ? $item->kelas->jenjang : '-' }})</p>
          <h3 class="font-weight-bold text-success mb-0">Rp {{ number_format($item->nominal_biaya, 0, ',', '.') }}</h3>
        </div>
        
        <div class="card-body d-flex flex-column flex-grow-1">
          <h6 class="font-weight-bold text-dark small mb-2">Perlengkapan yang diperoleh:</h6>
          <ul class="list-unstyled flex-grow-1 pl-0">
            @forelse($item->items as $detailItem)
              <li class="small text-muted mb-2 d-flex align-items-center">
                <i class="mdi mdi-check text-success fs-5 me-2"></i>
                {{ $detailItem->nama_item }}
              </li>
            @empty
              <li class="small text-muted italic">Tidak ada perlengkapan yang dilampirkan.</li>
            @endforelse
          </ul>

          <form action="{{ route('student.pendaftaran.submit') }}" method="POST" class="d-grid mt-4">
            @csrf
            <input type="hidden" name="paket_id" value="{{ $item->id }}">
            @if($siswa->paket_id == $item->id)
              <button type="button" class="btn btn-outline-success py-2.5 rounded-lg font-weight-bold" disabled>
                <i class="mdi mdi-check-circle me-1"></i> Paket Terpilih
              </button>
            @else
              <button type="submit" class="btn btn-primary py-2.5 rounded-lg font-weight-bold text-white" onclick="return confirm('Apakah Anda yakin ingin memilih paket ini? Status pendaftaran Anda akan disetel ke Menunggu Verifikasi.');">
                Pilih Paket Ini
              </button>
            @endif
          </form>
        </div>
      </div>
    </div>
  @empty
    <div class="col-12 text-center py-5">
      <i class="mdi mdi-package-variant-closed text-muted mb-3" style="font-size: 4rem;"></i>
      <h5 class="text-muted">Tidak ada paket pendaftaran yang sesuai dengan kriteria gender/profil Anda saat ini.</h5>
    </div>
  @endforelse
</div>
@endsection
