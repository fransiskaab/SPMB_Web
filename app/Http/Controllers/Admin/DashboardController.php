<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\PaketPendaftaran;
use App\Models\Siswa;
use App\Models\TransaksiPembayaran;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard index.
     */
    public function index()
    {
        $totalSiswa = Siswa::count();
        $siswaBaru = Siswa::where('status_pendaftaran', 'Menunggu Verifikasi')->count();
        $siswaDiterima = Siswa::where('status_pendaftaran', 'Diterima')->count();
        $siswaDitolak = Siswa::where('status_pendaftaran', 'Ditolak')->count();
        
        $totalKelas = Kelas::count();
        $totalPaket = PaketPendaftaran::count();
        
        $totalPendapatan = TransaksiPembayaran::where('status_verifikasi', 'Valid')->sum('nominal');
        $pembayaranMenunggu = TransaksiPembayaran::where('status_verifikasi', 'Menunggu Verifikasi')->count();

        $recentRegistrations = Siswa::with(['kelas', 'paket'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $recentPayments = TransaksiPembayaran::with('siswa')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalSiswa',
            'siswaBaru',
            'siswaDiterima',
            'siswaDitolak',
            'totalKelas',
            'totalPaket',
            'totalPendapatan',
            'pembayaranMenunggu',
            'recentRegistrations',
            'recentPayments'
        ));
    }
}
