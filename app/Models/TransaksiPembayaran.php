<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiPembayaran extends Model
{
    protected $table = 'transaksi_pembayaran';

    protected $fillable = [
        'siswa_id',
        'tanggal_bayar',
        'nominal',
        'bukti_pembayaran',
        'status_verifikasi',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_bayar' => 'date',
            'nominal' => 'decimal:2',
        ];
    }

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }
}
