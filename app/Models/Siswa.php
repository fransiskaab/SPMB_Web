<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $fillable = [
        'user_id',
        'kelas_id',
        'paket_id',
        'nama_lengkap',
        'nama_panggilan',
        'nik_kia',
        'no_kk',
        'no_pkh',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'anak_ke',
        'jumlah_saudara',
        'status_keluarga',
        'kewarganegaraan',
        'status_pendaftaran',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }

    public function paket(): BelongsTo
    {
        return $this->belongsTo(PaketPendaftaran::class, 'paket_id');
    }

    public function orangTua(): HasMany
    {
        return $this->hasMany(OrangTua::class);
    }

    public function ayah()
    {
        return $this->orangTua()->where('hubungan', 'Ayah')->first();
    }

    public function ibu()
    {
        return $this->orangTua()->where('hubungan', 'Ibu')->first();
    }

    public function transaksiPembayaran(): HasMany
    {
        return $this->hasMany(TransaksiPembayaran::class);
    }

    /**
     * Calculate the total verified payments for this student.
     */
    public function totalPembayaranValid(): float
    {
        return (float) $this->transaksiPembayaran()
            ->where('status_verifikasi', 'Valid')
            ->sum('nominal');
    }

    /**
     * Calculate remaining balance (tagihan).
     */
    public function sisaTagihan(): float
    {
        if (!$this->paket) {
            return 0;
        }
        return max(0, (float) $this->paket->nominal_biaya - $this->totalPembayaranValid());
    }
}
