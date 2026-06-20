<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of registered students.
     */
    public function index(Request $request)
    {
        $query = Siswa::with(['kelas', 'paket']);

        // Search filter
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nik_kia', 'like', "%{$search}%")
                  ->orWhere('no_kk', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status_pendaftaran', $request->status);
        }

        $siswa = $query->orderBy('created_at', 'desc')->get();

        return view('admin.siswa.index', compact('siswa'));
    }

    /**
     * Display the student details and parent info.
     */
    public function show($id)
    {
        $siswa = Siswa::with(['user', 'kelas', 'paket', 'orangTua', 'transaksiPembayaran'])->findOrFail($id);
        
        // Parent details
        $ayah = $siswa->orangTua()->where('hubungan', 'Ayah')->first();
        $ibu = $siswa->orangTua()->where('hubungan', 'Ibu')->first();
        
        // Payment info
        $totalBayar = $siswa->totalPembayaranValid();
        $sisaTagihan = $siswa->sisaTagihan();

        return view('admin.siswa.show', compact('siswa', 'ayah', 'ibu', 'totalBayar', 'sisaTagihan'));
    }

    /**
     * Update the student registration status.
     */
    public function updateStatus(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $request->validate([
            'status_pendaftaran' => 'required|in:Menunggu Verifikasi,Diterima,Ditolak',
        ]);

        $siswa->update([
            'status_pendaftaran' => $request->status_pendaftaran,
        ]);

        return redirect()->route('admin.siswa.show', $siswa->id)
            ->with('success', 'Status pendaftaran siswa berhasil diperbarui menjadi: ' . $request->status_pendaftaran);
    }
}
