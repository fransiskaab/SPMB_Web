<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransaksiPembayaran;
use Illuminate\Http\Request;

class TransaksiPembayaranController extends Controller
{
    /**
     * Display a listing of payment transactions.
     */
    public function index(Request $request)
    {
        $query = TransaksiPembayaran::with(['siswa.kelas', 'siswa.paket']);

        // Filter by verification status
        if ($request->filled('status')) {
            $query->where('status_verifikasi', $request->status);
        }

        // Search by student name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('siswa', function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%");
            });
        }

        $transaksi = $query->orderBy('created_at', 'desc')->get();

        return view('admin.pembayaran.index', compact('transaksi'));
    }

    /**
     * Display details of a specific payment transaction.
     */
    public function show($id)
    {
        $transaksi = TransaksiPembayaran::with(['siswa.kelas', 'siswa.paket'])->findOrFail($id);
        
        // Calculate current financial summary of student
        $siswa = $transaksi->siswa;
        $totalBayarValid = $siswa ? $siswa->totalPembayaranValid() : 0;
        $sisaTagihan = $siswa ? $siswa->sisaTagihan() : 0;

        return view('admin.pembayaran.show', compact('transaksi', 'totalBayarValid', 'sisaTagihan'));
    }

    /**
     * Verify the payment transaction status.
     */
    public function verify(Request $request, $id)
    {
        $transaksi = TransaksiPembayaran::findOrFail($id);

        $request->validate([
            'status_verifikasi' => 'required|in:Menunggu Verifikasi,Valid,Ditolak',
        ]);

        $transaksi->update([
            'status_verifikasi' => $request->status_verifikasi,
        ]);

        return redirect()->route('admin.pembayaran.show', $transaksi->id)
            ->with('success', 'Status verifikasi pembayaran berhasil diubah menjadi: ' . $request->status_verifikasi);
    }
}
