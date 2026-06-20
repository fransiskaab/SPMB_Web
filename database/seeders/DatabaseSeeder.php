<?php

namespace Database\Seeders;

use App\Models\ItemPerlengkapan;
use App\Models\Kelas;
use App\Models\PaketPendaftaran;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ── Users ────────────────────────────────────────────
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@sipmb.test',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Kepala Sekolah',
            'email' => 'kepala@sipmb.test',
            'password' => Hash::make('password'),
            'role' => 'kepala_sekolah',
        ]);

        // ── Kelas ────────────────────────────────────────────
        $kelas0 = Kelas::create(['nama_kelas' => 'Kelas 0', 'jenjang' => 'RA']);
        $kelas1 = Kelas::create(['nama_kelas' => 'Kelas 1', 'jenjang' => 'MI']);

        // ── Item Perlengkapan ────────────────────────────────
        $items = collect([
            'Seragam Merah Putih',
            'Seragam Batik',
            'Seragam Olahraga',
            'Sepatu Hitam',
            'Sepatu Olahraga',
            'Topi',
            'Dasi',
            'Ikat Pinggang',
            'Kaos Kaki Putih',
            'Kaos Kaki Hitam',
            'Buku Tulis',
            'Tas Sekolah',
        ])->map(fn ($name) => ItemPerlengkapan::create(['nama_item' => $name]));

        // ── Paket Pendaftaran ────────────────────────────────
        $paketA = PaketPendaftaran::create([
            'kelas_id' => $kelas0->id,
            'nama_paket' => 'Paket A',
            'jenis_kelamin' => 'L',
            'nominal_biaya' => 1500000,
        ]);

        $paketB = PaketPendaftaran::create([
            'kelas_id' => $kelas0->id,
            'nama_paket' => 'Paket B',
            'jenis_kelamin' => 'P',
            'nominal_biaya' => 1600000,
        ]);

        $paketC = PaketPendaftaran::create([
            'kelas_id' => $kelas1->id,
            'nama_paket' => 'Paket C',
            'jenis_kelamin' => 'L',
            'nominal_biaya' => 1800000,
        ]);

        $paketD = PaketPendaftaran::create([
            'kelas_id' => $kelas1->id,
            'nama_paket' => 'Paket D',
            'jenis_kelamin' => 'P',
            'nominal_biaya' => 1900000,
        ]);

        // Attach some items to each package
        $allItemIds = $items->pluck('id');
        $paketA->items()->attach($allItemIds->take(8));
        $paketB->items()->attach($allItemIds->take(8));
        $paketC->items()->attach($allItemIds);
        $paketD->items()->attach($allItemIds);
    }
}
