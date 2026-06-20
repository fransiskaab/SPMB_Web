<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\ItemPerlengkapan;
use App\Models\PaketPendaftaran;
use Illuminate\Http\Request;

class PaketPendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paket = PaketPendaftaran::with(['kelas', 'items'])
            ->withCount('siswa')
            ->orderBy('nama_paket', 'asc')
            ->get();
            
        return view('admin.paket.index', compact('paket'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = Kelas::orderBy('nama_kelas', 'asc')->get();
        $items = ItemPerlengkapan::orderBy('nama_item', 'asc')->get();
        
        return view('admin.paket.create', compact('kelas', 'items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'nama_paket' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'nominal_biaya' => 'required|numeric|min:0',
            'items' => 'nullable|array',
            'items.*' => 'exists:item_perlengkapan,id',
        ]);

        $paket = PaketPendaftaran::create([
            'kelas_id' => $request->kelas_id,
            'nama_paket' => $request->nama_paket,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nominal_biaya' => $request->nominal_biaya,
        ]);

        if ($request->has('items')) {
            $paket->items()->sync($request->items);
        }

        return redirect()->route('admin.paket.index')->with('success', 'Paket pendaftaran berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $paket = PaketPendaftaran::findOrFail($id);
        $kelas = Kelas::orderBy('nama_kelas', 'asc')->get();
        $items = ItemPerlengkapan::orderBy('nama_item', 'asc')->get();
        $selectedItems = $paket->items->pluck('id')->toArray();
        
        return view('admin.paket.edit', compact('paket', 'kelas', 'items', 'selectedItems'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $paket = PaketPendaftaran::findOrFail($id);

        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'nama_paket' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'nominal_biaya' => 'required|numeric|min:0',
            'items' => 'nullable|array',
            'items.*' => 'exists:item_perlengkapan,id',
        ]);

        $paket->update([
            'kelas_id' => $request->kelas_id,
            'nama_paket' => $request->nama_paket,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nominal_biaya' => $request->nominal_biaya,
        ]);

        $paket->items()->sync($request->items ?? []);

        return redirect()->route('admin.paket.index')->with('success', 'Paket pendaftaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $paket = PaketPendaftaran::findOrFail($id);

        // Check dependency on student records
        if ($paket->siswa()->exists()) {
            return redirect()->route('admin.paket.index')->with('error', 'Paket pendaftaran tidak dapat dihapus karena sedang digunakan oleh data siswa.');
        }

        // Detach items first and delete the package
        $paket->items()->detach();
        $paket->delete();

        return redirect()->route('admin.paket.index')->with('success', 'Paket pendaftaran berhasil dihapus.');
    }
}
