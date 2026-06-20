<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\OrangTua;
use App\Models\PaketPendaftaran;
use App\Models\Siswa;
use App\Models\TransaksiPembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentDashboardController extends Controller
{
    /**
     * Show student dashboard landing page.
     */
    public function dashboard()
    {
        $user = Auth::user();
        $siswa = $user->siswa;
        
        $isProfileComplete = $siswa !== null;
        $hasSelectedPackage = $isProfileComplete && $siswa->paket_id !== null;
        
        $totalBayarValid = 0;
        $sisaTagihan = 0;
        
        if ($hasSelectedPackage) {
            $totalBayarValid = $siswa->totalPembayaranValid();
            $sisaTagihan = $siswa->sisaTagihan();
        }

        return view('student.dashboard', compact(
            'siswa',
            'isProfileComplete',
            'hasSelectedPackage',
            'totalBayarValid',
            'sisaTagihan'
        ));
    }

    /**
     * Show profile completion form.
     */
    public function profile()
    {
        $user = Auth::user();
        $siswa = $user->siswa;
        
        $ayah = null;
        $ibu = null;
        
        if ($siswa) {
            $ayah = $siswa->orangTua()->where('hubungan', 'Ayah')->first();
            $ibu = $siswa->orangTua()->where('hubungan', 'Ibu')->first();
        }

        return view('student.profile', compact('siswa', 'ayah', 'ibu'));
    }

    /**
     * Store or update student profile data.
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            // Student Personal Data
            'nama_lengkap' => 'required|string|max:255',
            'nama_panggilan' => 'required|string|max:255',
            'nik_kia' => 'required|string|max:20',
            'no_kk' => 'required|string|max:20',
            'no_pkh' => 'nullable|string|max:30',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'agama' => 'required|string|max:50',
            'anak_ke' => 'required|integer|min:1',
            'jumlah_saudara' => 'required|integer|min:0',
            'status_keluarga' => 'required|string|max:255',
            
            // Father Info
            'ayah_nama' => 'required|string|max:255',
            'ayah_nik' => 'required|string|max:20',
            'ayah_pekerjaan' => 'required|string|max:255',
            'ayah_penghasilan' => 'required|numeric|min:0',
            'ayah_no_hp' => 'required|string|max:20',

            // Mother Info
            'ibu_nama' => 'required|string|max:255',
            'ibu_nik' => 'required|string|max:20',
            'ibu_pekerjaan' => 'required|string|max:255',
            'ibu_penghasilan' => 'required|numeric|min:0',
            'ibu_no_hp' => 'required|string|max:20',
        ]);

        $user = Auth::user();

        // 1. Create or Update Student Record
        $siswa = Siswa::updateOrCreate(
            ['user_id' => $user->id],
            [
                'nama_lengkap' => $request->nama_lengkap,
                'nama_panggilan' => $request->nama_panggilan,
                'nik_kia' => $request->nik_kia,
                'no_kk' => $request->no_kk,
                'no_pkh' => $request->no_pkh,
                'tempat_lahir' => $request->tempat_lahir,
                'tanggal_lahir' => $request->tanggal_lahir,
                'jenis_kelamin' => $request->jenis_kelamin,
                'agama' => $request->agama,
                'anak_ke' => $request->anak_ke,
                'jumlah_saudara' => $request->jumlah_saudara,
                'status_keluarga' => $request->status_keluarga,
            ]
        );

        // 2. Create or Update Father's Info
        OrangTua::updateOrCreate(
            [
                'siswa_id' => $siswa->id,
                'hubungan' => 'Ayah'
            ],
            [
                'nama' => $request->ayah_nama,
                'nik' => $request->ayah_nik,
                'pekerjaan' => $request->ayah_pekerjaan,
                'penghasilan' => $request->ayah_penghasilan,
                'no_hp' => $request->ayah_no_hp,
            ]
        );

        // 3. Create or Update Mother's Info
        OrangTua::updateOrCreate(
            [
                'siswa_id' => $siswa->id,
                'hubungan' => 'Ibu'
            ],
            [
                'nama' => $request->ibu_nama,
                'nik' => $request->ibu_nik,
                'pekerjaan' => $request->ibu_pekerjaan,
                'penghasilan' => $request->ibu_penghasilan,
                'no_hp' => $request->ibu_no_hp,
            ]
        );

        return redirect()->route('student.dashboard')
            ->with('success', 'Formulir data profil pendaftaran berhasil disimpan.');
    }

    /**
     * Show package selection page.
     */
    public function pendaftaran()
    {
        $user = Auth::user();
        $siswa = $user->siswa;

        if (!$siswa) {
            return redirect()->route('student.profile')
                ->with('error', 'Anda harus melengkapi profil terlebih dahulu sebelum memilih paket pendaftaran.');
        }

        // Show packages that match the candidate's gender (or all packages)
        $paket = PaketPendaftaran::with('kelas')
            ->where('jenis_kelamin', $siswa->jenis_kelamin)
            ->orderBy('nominal_biaya', 'asc')
            ->get();

        return view('student.pendaftaran', compact('siswa', 'paket'));
    }

    /**
     * Process package application submission.
     */
    public function submitPendaftaran(Request $request)
    {
        $user = Auth::user();
        $siswa = $user->siswa;

        if (!$siswa) {
            return redirect()->route('student.profile')
                ->with('error', 'Anda harus melengkapi profil terlebih dahulu.');
        }

        $request->validate([
            'paket_id' => 'required|exists:paket_pendaftaran,id',
        ]);

        $paket = PaketPendaftaran::findOrFail($request->paket_id);

        $siswa->update([
            'paket_id' => $paket->id,
            'kelas_id' => $paket->kelas_id,
            'status_pendaftaran' => 'Menunggu Verifikasi',
        ]);

        return redirect()->route('student.dashboard')
            ->with('success', 'Pendaftaran paket pendaftaran berhasil diajukan. Status Anda sekarang Menunggu Verifikasi.');
    }

    /**
     * Show payment confirmation page.
     */
    public function pembayaran()
    {
        $user = Auth::user();
        $siswa = $user->siswa;

        if (!$siswa || !$siswa->paket_id) {
            return redirect()->route('student.dashboard')
                ->with('error', 'Silakan ajukan pilihan paket pendaftaran Anda terlebih dahulu.');
        }

        $transaksi = $siswa->transaksiPembayaran()->orderBy('created_at', 'desc')->get();
        $totalBayarValid = $siswa->totalPembayaranValid();
        $sisaTagihan = $siswa->sisaTagihan();

        return view('student.pembayaran', compact('siswa', 'transaksi', 'totalBayarValid', 'sisaTagihan'));
    }

    /**
     * Submit proof of payment upload.
     */
    public function submitPembayaran(Request $request)
    {
        $user = Auth::user();
        $siswa = $user->siswa;

        if (!$siswa || !$siswa->paket_id) {
            return redirect()->route('student.dashboard');
        }

        $request->validate([
            'tanggal_bayar' => 'required|date',
            'nominal' => 'required|numeric|min:1',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('bukti_pembayaran')->store('bukti_bayar', 'public');

        TransaksiPembayaran::create([
            'siswa_id' => $siswa->id,
            'tanggal_bayar' => $request->tanggal_bayar,
            'nominal' => $request->nominal,
            'bukti_pembayaran' => $path,
            'status_verifikasi' => 'Menunggu Verifikasi',
        ]);

        return redirect()->route('student.pembayaran')
            ->with('success', 'Bukti pembayaran berhasil diunggah dan sedang menunggu verifikasi dari admin.');
    }

    /**
     * Show announcement page.
     */
    public function pengumuman()
    {
        $user = Auth::user();
        $siswa = $user->siswa;

        return view('student.pengumuman', compact('siswa'));
    }
}
