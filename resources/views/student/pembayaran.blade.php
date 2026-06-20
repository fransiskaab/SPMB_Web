@extends('layouts.admin')

@section('title', 'Konfirmasi Pembayaran')
@section('page_title', 'Konfirmasi Pembayaran')

@section('content')
<div class="row">
  <!-- Left Side: Bank transfer instructions & upload form -->
  <div class="col-lg-7 mb-4">
    
    <!-- Bank instructions card -->
    <div class="card mb-4 shadow-sm">
      <div class="card-body">
        <h5 class="card-title text-primary"><i class="mdi mdi-bank me-2"></i>Petunjuk Pembayaran Transfer Bank</h5>
        <hr>
        <p class="text-muted small">Silakan transfer biaya pendaftaran Anda ke salah satu rekening bank resmi sekolah berikut:</p>
        
        <div class="border rounded p-3 bg-light mb-3">
          <div class="row align-items-center">
            <div class="col-3 text-center">
              <h5 class="font-weight-bold text-primary mb-0">MANDIRI</h5>
            </div>
            <div class="col-9">
              <h6 class="font-weight-bold text-dark mb-0">123-456-7890-123</h6>
              <small class="text-muted">A/N: YAYASAN PENDIDIKAN MADANI</small>
            </div>
          </div>
        </div>

        <div class="border rounded p-3 bg-light">
          <div class="row align-items-center">
            <div class="col-3 text-center">
              <h5 class="font-weight-bold text-success mb-0">BSI</h5>
            </div>
            <div class="col-9">
              <h6 class="font-weight-bold text-dark mb-0">711-223-3445</h6>
              <small class="text-muted">A/N: YAYASAN PENDIDIKAN MADANI</small>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Upload Form -->
    <div class="card shadow-sm">
      <div class="card-body">
        <h5 class="card-title text-primary"><i class="mdi mdi-upload me-2"></i>Konfirmasi Upload Bukti Transfer</h5>
        <hr>
        
        @if ($errors->any())
          <div class="alert alert-danger py-2">
            <ul class="mb-0 pl-3 small">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('student.pembayaran.submit') }}" method="POST" enctype="multipart/form-data">
          @csrf
          
          <div class="row">
            <div class="col-md-6 mb-3">
              <div class="form-group">
                <label for="tanggal_bayar" class="text-muted small">Tanggal Pembayaran</label>
                <input type="date" class="form-control @error('tanggal_bayar') is-invalid @enderror" id="tanggal_bayar" name="tanggal_bayar" value="{{ old('tanggal_bayar', date('Y-m-d')) }}" required>
                @error('tanggal_bayar')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="col-md-6 mb-3">
              <div class="form-group">
                <label for="nominal" class="text-muted small">Nominal Transfer (Rupiah)</label>
                <input type="number" min="1" class="form-control @error('nominal') is-invalid @enderror" id="nominal" name="nominal" value="{{ old('nominal', (int)$sisaTagihan) }}" placeholder="Contoh: 1500000" required>
                @error('nominal')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>

          <div class="form-group mb-4">
            <label for="bukti_pembayaran" class="text-muted small">Upload Foto Bukti Pembayaran (JPG/PNG, Max. 2MB)</label>
            <input type="file" class="form-control @error('bukti_pembayaran') is-invalid @enderror" id="bukti_pembayaran" name="bukti_pembayaran" accept="image/*" required>
            @error('bukti_pembayaran')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          @if($sisaTagihan == 0)
            <div class="alert alert-success py-2 text-center small font-weight-bold">
              Tagihan Anda sudah lunas. Anda tidak perlu mengunggah bukti pembayaran lagi.
            </div>
            <button type="button" class="btn btn-success py-2 px-4" disabled>Simpan Konfirmasi</button>
          @else
            <button type="submit" class="btn btn-success py-2 px-4 font-weight-bold text-white">
              <i class="mdi mdi-check-circle me-1"></i> Simpan Konfirmasi
            </button>
          @endif
        </form>
      </div>
    </div>

  </div>

  <!-- Right Side: Financial balance & previous uploads list -->
  <div class="col-lg-5">
    
    <!-- Balance summary card -->
    <div class="card mb-4 shadow-sm border-top border-primary border-3">
      <div class="card-body text-center">
        <h6 class="text-muted text-uppercase mb-2 font-weight-bold">Sisa Tagihan Anda</h6>
        <h2 class="font-weight-bold text-danger mb-4">Rp {{ number_format($sisaTagihan, 0, ',', '.') }}</h2>
        
        <div class="row text-start bg-light rounded p-3">
          <div class="col-6 mb-2">
            <small class="text-muted d-block">Nama Paket:</small>
            <strong class="text-dark">{{ $siswa->paket->nama_paket }}</strong>
          </div>
          <div class="col-6 mb-2">
            <small class="text-muted d-block">Total Tagihan:</small>
            <strong class="text-dark">Rp {{ number_format($siswa->paket->nominal_biaya, 0, ',', '.') }}</strong>
          </div>
          <div class="col-6">
            <small class="text-muted d-block">Telah Diverifikasi:</small>
            <strong class="text-success">Rp {{ number_format($totalBayarValid, 0, ',', '.') }}</strong>
          </div>
          <div class="col-6">
            <small class="text-muted d-block">Status Tagihan:</small>
            @if($sisaTagihan == 0)
              <span class="badge badge-success small py-1 px-2 font-weight-bold">LUNAS</span>
            @else
              <span class="badge badge-warning small py-1 px-2 font-weight-bold">BELUM LUNAS</span>
            @endif
          </div>
        </div>
      </div>
    </div>

    <!-- History uploads -->
    <div class="card shadow-sm">
      <div class="card-body">
        <h5 class="card-title text-dark"><i class="mdi mdi-history me-2"></i>Riwayat Konfirmasi Bayar</h5>
        <hr>
        
        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead>
              <tr>
                <th>Nominal / Tgl</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @forelse($transaksi as $trans)
                <tr>
                  <td>
                    <div class="font-weight-bold text-success">Rp {{ number_format($trans->nominal, 0, ',', '.') }}</div>
                    <small class="text-muted">{{ $trans->tanggal_bayar ? $trans->tanggal_bayar->format('d/m/Y') : '-' }}</small>
                  </td>
                  <td>
                    @if($trans->status_verifikasi == 'Menunggu Verifikasi')
                      <span class="badge badge-warning font-weight-bold py-1 px-2 small">Menunggu</span>
                    @elseif($trans->status_verifikasi == 'Valid')
                      <span class="badge badge-success font-weight-bold py-1 px-2 small">Disetujui</span>
                    @else
                      <span class="badge badge-danger font-weight-bold py-1 px-2 small">Ditolak</span>
                    @endif
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="2" class="text-center text-muted small py-3">Belum ada riwayat pembayaran yang diupload.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection
