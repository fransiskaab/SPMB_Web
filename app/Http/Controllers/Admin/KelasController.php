<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::withCount(['siswa', 'paketPendaftaran'])->orderBy('nama_kelas', 'asc')->get();
        return view('admin.kelas.index', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'jenjang' => 'required|string|max:255',
        ]);

        Kelas::create([
            'nama_kelas' => $request->nama_kelas,
            'jenjang' => $request->jenjang,
        ]);

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kelasItem = Kelas::findOrFail($id);
        return view('admin.kelas.edit', compact('kelasItem'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kelasItem = Kelas::findOrFail($id);

        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'jenjang' => 'required|string|max:255',
        ]);

        $kelasItem->update([
            'nama_kelas' => $request->nama_kelas,
            'jenjang' => $request->jenjang,
        ]);

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kelasItem = Kelas::findOrFail($id);

        // Check if class is in use by packages or students
        if ($kelasItem->siswa()->exists() || $kelasItem->paketPendaftaran()->exists()) {
            return redirect()->route('admin.kelas.index')->with('error', 'Kelas tidak dapat dihapus karena sedang digunakan oleh data siswa atau paket pendaftaran.');
        }

        $kelasItem->delete();

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }
}
