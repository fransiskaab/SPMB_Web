<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('kelas_id')->nullable()->constrained('kelas')->nullOnDelete();
            $table->foreignId('paket_id')->nullable()->constrained('paket_pendaftaran')->nullOnDelete();
            $table->string('nama_lengkap');
            $table->string('nama_panggilan');
            $table->string('nik_kia');
            $table->string('no_kk');
            $table->string('no_pkh')->nullable();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('agama');
            $table->integer('anak_ke');
            $table->integer('jumlah_saudara');
            $table->string('status_keluarga');
            $table->string('kewarganegaraan')->default('WNI');
            $table->enum('status_pendaftaran', ['Menunggu Verifikasi', 'Diterima', 'Ditolak'])->default('Menunggu Verifikasi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
