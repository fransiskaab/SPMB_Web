@extends('layouts.admin')
@section('title', 'Lengkapi Profil')
@section('page_title', 'Formulir Pendaftaran')

@section('content')
<div class="row">
  <div class="col-lg-10 mx-auto grid-margin stretch-card">
    <div class="card shadow-sm">
      <div class="card-body">
        <h4 class="card-title"><i class="mdi mdi-account-edit text-primary me-2"></i>Lengkapi Formulir Pendaftaran</h4>
        <p class="card-description">Harap isi seluruh data calon siswa dan informasi orang tua secara jujur dan benar.</p>

        @if ($errors->any())
          <div class="alert alert-danger py-2">
            <ul class="mb-0 pl-3 small">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('student.profile.update') }}" method="POST" class="forms-sample">
          @csrf
          
          <!-- SECTION 1: DATA PRIBADI SISWA -->
          <h5 class="text-primary font-weight-bold mb-3 mt-4 pb-2 border-bottom"><i class="mdi mdi-account me-1"></i>A. Data Pribadi Calon Siswa</h5>
          
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="nama_lengkap" class="text-muted small">Nama Lengkap</label>
              <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $siswa->nama_lengkap ?? auth()->user()->name) }}" required>
            </div>
            
            <div class="col-md-6 mb-3">
              <label for="nama_panggilan" class="text-muted small">Nama Panggilan</label>
              <input type="text" class="form-control" id="nama_panggilan" name="nama_panggilan" value="{{ old('nama_panggilan', $siswa->nama_panggilan ?? '') }}" placeholder="Contoh: Fauzi" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="nik_kia" class="text-muted small">NIK / KIA (Nomor Induk Kependudukan)</label>
              <input type="text" class="form-control" id="nik_kia" name="nik_kia" value="{{ old('nik_kia', $siswa->nik_kia ?? '') }}" placeholder="32xxxxxxxxxxxxxx" required>
            </div>
            
            <div class="col-md-6 mb-3">
              <label for="no_kk" class="text-muted small">Nomor Kartu Keluarga (KK)</label>
              <input type="text" class="form-control" id="no_kk" name="no_kk" value="{{ old('no_kk', $siswa->no_kk ?? '') }}" placeholder="32xxxxxxxxxxxxxx" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="tempat_lahir" class="text-muted small">Tempat Lahir</label>
              <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $siswa->tempat_lahir ?? '') }}" placeholder="Contoh: Bandung" required>
            </div>
            
            <div class="col-md-6 mb-3">
              <label for="tanggal_lahir" class="text-muted small">Tanggal Lahir</label>
              <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', ($siswa && $siswa->tanggal_lahir) ? $siswa->tanggal_lahir->format('Y-m-d') : '') }}" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="jenis_kelamin" class="text-muted small">Jenis Kelamin</label>
              <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                <option value="L" {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>Laki-laki (L)</option>
                <option value="P" {{ old('jenis_kelamin', $siswa->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>Perempuan (P)</option>
              </select>
            </div>
            
            <div class="col-md-6 mb-3">
              <label for="agama" class="text-muted small">Agama</label>
              <select class="form-control" id="agama" name="agama" required>
                <option value="Islam" {{ old('agama', $siswa->agama ?? '') == 'Islam' ? 'selected' : '' }}>Islam</option>
                <option value="Kristen" {{ old('agama', $siswa->agama ?? '') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                <option value="Katolik" {{ old('agama', $siswa->agama ?? '') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                <option value="Hindu" {{ old('agama', $siswa->agama ?? '') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                <option value="Budha" {{ old('agama', $siswa->agama ?? '') == 'Budha' ? 'selected' : '' }}>Budha</option>
                <option value="Konghucu" {{ old('agama', $siswa->agama ?? '') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
              </select>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 mb-3">
              <label for="anak_ke" class="text-muted small">Anak Ke-</label>
              <input type="number" min="1" class="form-control" id="anak_ke" name="anak_ke" value="{{ old('anak_ke', $siswa->anak_ke ?? '') }}" placeholder="1" required>
            </div>
            
            <div class="col-md-4 mb-3">
              <label for="jumlah_saudara" class="text-muted small">Jumlah Saudara</label>
              <input type="number" min="0" class="form-control" id="jumlah_saudara" name="jumlah_saudara" value="{{ old('jumlah_saudara', $siswa->jumlah_saudara ?? '') }}" placeholder="0" required>
            </div>
            
            <div class="col-md-4 mb-3">
              <label for="status_keluarga" class="text-muted small">Status Hubungan Keluarga</label>
              <select class="form-control" id="status_keluarga" name="status_keluarga" required>
                <option value="Anak Kandung" {{ old('status_keluarga', $siswa->status_keluarga ?? '') == 'Anak Kandung' ? 'selected' : '' }}>Anak Kandung</option>
                <option value="Anak Angkat" {{ old('status_keluarga', $siswa->status_keluarga ?? '') == 'Anak Angkat' ? 'selected' : '' }}>Anak Angkat</option>
                <option value="Anak Tiri" {{ old('status_keluarga', $siswa->status_keluarga ?? '') == 'Anak Tiri' ? 'selected' : '' }}>Anak Tiri</option>
              </select>
            </div>
          </div>

          <div class="form-group mb-3">
            <label for="no_pkh" class="text-muted small">Nomor PKH / KPS / KIP (Opsional)</label>
            <input type="text" class="form-control" id="no_pkh" name="no_pkh" value="{{ old('no_pkh', $siswa->no_pkh ?? '') }}" placeholder="Masukkan jika ada">
          </div>


          <!-- SECTION 2: DATA ORANG TUA (AYAH) -->
          <h5 class="text-info font-weight-bold mb-3 mt-5 pb-2 border-bottom"><i class="mdi mdi-gender-male me-1"></i>B. Informasi Ayah Kandung</h5>
          
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="ayah_nama" class="text-muted small">Nama Lengkap Ayah</label>
              <input type="text" class="form-control" id="ayah_nama" name="ayah_nama" value="{{ old('ayah_nama', $ayah->nama ?? '') }}" placeholder="Nama Ayah" required>
            </div>
            
            <div class="col-md-6 mb-3">
              <label for="ayah_nik" class="text-muted small">NIK Ayah</label>
              <input type="text" class="form-control" id="ayah_nik" name="ayah_nik" value="{{ old('ayah_nik', $ayah->nik ?? '') }}" placeholder="NIK Ayah" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 mb-3">
              <label for="ayah_pekerjaan" class="text-muted small">Pekerjaan Ayah</label>
              <input type="text" class="form-control" id="ayah_pekerjaan" name="ayah_pekerjaan" value="{{ old('ayah_pekerjaan', $ayah->pekerjaan ?? '') }}" placeholder="Contoh: Karyawan Swasta" required>
            </div>
            
            <div class="col-md-4 mb-3">
              <label for="ayah_penghasilan" class="text-muted small">Penghasilan Bulanan (Rupiah)</label>
              <input type="number" min="0" class="form-control" id="ayah_penghasilan" name="ayah_penghasilan" value="{{ old('ayah_penghasilan', $ayah ? (int)$ayah->penghasilan : '') }}" placeholder="Contoh: 3000000" required>
            </div>
            
            <div class="col-md-4 mb-3">
              <label for="ayah_no_hp" class="text-muted small">No. HP / WhatsApp Ayah</label>
              <input type="text" class="form-control" id="ayah_no_hp" name="ayah_no_hp" value="{{ old('ayah_no_hp', $ayah->no_hp ?? '') }}" placeholder="08xxxxxxxxxx" required>
            </div>
          </div>


          <!-- SECTION 3: DATA ORANG TUA (IBU) -->
          <h5 class="text-danger font-weight-bold mb-3 mt-5 pb-2 border-bottom"><i class="mdi mdi-gender-female me-1"></i>C. Informasi Ibu Kandung</h5>
          
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="ibu_nama" class="text-muted small">Nama Lengkap Ibu</label>
              <input type="text" class="form-control" id="ibu_nama" name="ibu_nama" value="{{ old('ibu_nama', $ibu->nama ?? '') }}" placeholder="Nama Ibu" required>
            </div>
            
            <div class="col-md-6 mb-3">
              <label for="ibu_nik" class="text-muted small">NIK Ibu</label>
              <input type="text" class="form-control" id="ibu_nik" name="ibu_nik" value="{{ old('ibu_nik', $ibu->nik ?? '') }}" placeholder="NIK Ibu" required>
            </div>
          </div>

          <div class="row">
            <div class="col-md-4 mb-3">
              <label for="ibu_pekerjaan" class="text-muted small">Pekerjaan Ibu</label>
              <input type="text" class="form-control" id="ibu_pekerjaan" name="ibu_pekerjaan" value="{{ old('ibu_pekerjaan', $ibu->pekerjaan ?? '') }}" placeholder="Contoh: Ibu Rumah Tangga" required>
            </div>
            
            <div class="col-md-4 mb-3">
              <label for="ibu_penghasilan" class="text-muted small">Penghasilan Bulanan (Rupiah)</label>
              <input type="number" min="0" class="form-control" id="ibu_penghasilan" name="ibu_penghasilan" value="{{ old('ibu_penghasilan', $ibu ? (int)$ibu->penghasilan : '') }}" placeholder="Contoh: 0" required>
            </div>
            
            <div class="col-md-4 mb-3">
              <label for="ibu_no_hp" class="text-muted small">No. HP / WhatsApp Ibu</label>
              <input type="text" class="form-control" id="ibu_no_hp" name="ibu_no_hp" value="{{ old('ibu_no_hp', $ibu->no_hp ?? '') }}" placeholder="08xxxxxxxxxx" required>
            </div>
          </div>

          <div class="mt-4 pt-2 border-top">
            <button type="submit" class="btn btn-primary me-2 py-2 px-4 font-weight-bold">Simpan & Lanjutkan</button>
            <a href="{{ route('student.dashboard') }}" class="btn btn-light py-2 px-4">Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
