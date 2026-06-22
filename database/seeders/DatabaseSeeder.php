<?php
 
namespace Database\Seeders;
 
use App\Models\ItemPerlengkapan;
use App\Models\Kelas;
use App\Models\PaketPendaftaran;
use App\Models\User;
use App\Models\Siswa;
use App\Models\OrangTua;
use App\Models\TransaksiPembayaran;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
 
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
 
        // ── 1. Users (20 Admins & 20 Calon Murid) ─────────────────
        $adminPassword = Hash::make('password');
        
        // Admin #1 (Main Admin)
        $admins = [];
        $admins[] = User::create([
            'name' => 'Administrator',
            'email' => 'admin@sipmb.test',
            'password' => $adminPassword,
            'role' => 'admin',
        ]);
 
        // Admins #2 to #20
        for ($i = 2; $i <= 20; $i++) {
            $admins[] = User::create([
                'name' => $faker->name('male'),
                'email' => "admin{$i}@sipmb.test",
                'password' => $adminPassword,
                'role' => 'admin',
            ]);
        }
 
        // Student Users #1 to #20
        $studentUsers = [];
        for ($i = 1; $i <= 20; $i++) {
            $studentUsers[] = User::create([
                'name' => $faker->name(),
                'email' => "student{$i}@sipmb.test",
                'password' => $adminPassword,
                'role' => 'calon_murid',
            ]);
        }
 
        // ── 2. Kelas (20 Kelas: 10 RA & 10 MI) ───────────────────
        $kelas = [];
        // RA Kelas: Group A1-A5, Group B1-B5
        for ($i = 1; $i <= 5; $i++) {
            $kelas[] = Kelas::create(['nama_kelas' => "RA Kelompok A{$i}", 'jenjang' => 'RA']);
            $kelas[] = Kelas::create(['nama_kelas' => "RA Kelompok B{$i}", 'jenjang' => 'RA']);
        }
        // MI Kelas: 1A, 1B, 2A, 2B, 3A, 3B, 4A, 4B, 5A, 5B
        $grades = ['1', '2', '3', '4', '5'];
        $sections = ['A', 'B'];
        foreach ($grades as $grade) {
            foreach ($sections as $section) {
                $kelas[] = Kelas::create(['nama_kelas' => "MI Kelas {$grade}{$section}", 'jenjang' => 'MI']);
            }
        }
 
        // ── 3. Item Perlengkapan (20 Items) ──────────────────────
        $itemNames = [
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
            'Seragam Pramuka',
            'Setangan Leher Pramuka',
            'Kaos Kaki Pramuka',
            'Buku Gambar',
            'Pensil Warna',
            'Kotak Pensil',
            'Penggaris',
            'Buku Penghubung'
        ];
        
        $items = collect($itemNames)->map(function ($name) {
            return ItemPerlengkapan::create(['nama_item' => $name]);
        });
        $allItemIds = $items->pluck('id');
 
        // ── 4. Paket Pendaftaran (20 Paket) ──────────────────────
        $pakets = [];
        for ($i = 0; $i < 20; $i++) {
            $currentKelas = $kelas[$i];
            $gender = $i % 2 === 0 ? 'L' : 'P';
            $genderLabel = $gender === 'L' ? 'Laki-laki' : 'Perempuan';
            $biaya = $currentKelas->jenjang === 'RA' 
                ? $faker->randomElement([1500000, 1600000, 1700000])
                : $faker->randomElement([1800000, 1900000, 2000000]);
 
            $paketName = "Paket " . str_replace("RA Kelompok ", "", str_replace("MI Kelas ", "", $currentKelas->nama_kelas)) . " ($genderLabel)";
            
            $paket = PaketPendaftaran::create([
                'kelas_id' => $currentKelas->id,
                'nama_paket' => $paketName,
                'jenis_kelamin' => $gender,
                'nominal_biaya' => $biaya,
            ]);
            
            // Attach 8 to 15 random items to this package
            $randomCount = rand(8, 15);
            $paket->items()->attach($allItemIds->random($randomCount));
            
            $pakets[] = $paket;
        }
 
        // ── 5. Siswa (20 Siswa) ──────────────────────────────────
        $siswas = [];
        $statuses = ['Menunggu Verifikasi', 'Diterima', 'Ditolak'];
        
        for ($i = 0; $i < 20; $i++) {
            $user = $studentUsers[$i];
            $gender = $i % 2 === 0 ? 'L' : 'P';
            
            // Find packages that match this gender
            $validPakets = collect($pakets)->filter(fn($p) => $p->jenis_kelamin === $gender)->values();
            $assignedPaket = $validPakets->random();
            $assignedKelasId = $assignedPaket->kelas_id;
            
            $firstName = $gender === 'L' ? $faker->firstNameMale() : $faker->firstNameFemale();
            $lastName = $faker->lastName();
            $fullName = "{$firstName} {$lastName}";
            
            $siswa = Siswa::create([
                'user_id' => $user->id,
                'kelas_id' => $assignedKelasId,
                'paket_id' => $assignedPaket->id,
                'nama_lengkap' => $fullName,
                'nama_panggilan' => $firstName,
                'nik_kia' => $faker->numerify('################'),
                'no_kk' => $faker->numerify('################'),
                'no_pkh' => $faker->boolean(20) ? $faker->numerify('################') : null,
                'tempat_lahir' => $faker->city(),
                'tanggal_lahir' => $faker->date('Y-m-d', '-6 years'),
                'jenis_kelamin' => $gender,
                'agama' => 'Islam',
                'anak_ke' => rand(1, 3),
                'jumlah_saudara' => rand(0, 4),
                'status_keluarga' => 'Anak Kandung',
                'kewarganegaraan' => 'WNI',
                'status_pendaftaran' => $faker->randomElement($statuses),
            ]);
            
            $siswas[] = $siswa;
        }
 
        // ── 6. Orang Tua (20 Orang Tua) ──────────────────────────
        $parentJobs = ['PNS', 'Karyawan Swasta', 'Wiraswasta', 'Buruh', 'Petani', 'Guru', 'Pedagang'];
        for ($i = 0; $i < 20; $i++) {
            $siswa = $siswas[$i];
            $hubungan = $i % 2 === 0 ? 'Ayah' : 'Ibu';
            $parentName = $hubungan === 'Ayah' ? $faker->name('male') : $faker->name('female');
            
            OrangTua::create([
                'siswa_id' => $siswa->id,
                'hubungan' => $hubungan,
                'nama' => $parentName,
                'nik' => $faker->numerify('################'),
                'pekerjaan' => $faker->randomElement($parentJobs),
                'penghasilan' => $faker->randomElement([2000000, 3000000, 4000000, 5000000, 7500000]),
                'no_hp' => $faker->phoneNumber(),
            ]);
        }
 
        // ── 7. Transaksi Pembayaran (20 Transaksi) ────────────────
        $paymentStatuses = ['Menunggu Verifikasi', 'Valid', 'Ditolak'];
        for ($i = 0; $i < 20; $i++) {
            $siswa = $siswas[$i];
            
            $status = $faker->randomElement($paymentStatuses);
            $nominal = $status === 'Valid' 
                ? $siswa->paket->nominal_biaya 
                : $faker->randomElement([500000, 1000000, $siswa->paket->nominal_biaya]);
 
            TransaksiPembayaran::create([
                'siswa_id' => $siswa->id,
                'tanggal_bayar' => $faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
                'nominal' => $nominal,
                'bukti_pembayaran' => 'bukti_' . ($i + 1) . '.jpg',
                'status_verifikasi' => $status,
            ]);
        }
    }
}
