<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaketPendaftaran extends Model
{
    protected $table = 'paket_pendaftaran';

    protected $fillable = [
        'kelas_id',
        'nama_paket',
        'jenis_kelamin',
        'nominal_biaya',
    ];

    protected function casts(): array
    {
        return [
            'nominal_biaya' => 'decimal:2',
        ];
    }

    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class);
    }

    public function items(): BelongsToMany
    {
        return $this->belongsToMany(ItemPerlengkapan::class, 'detail_paket_item', 'paket_id', 'item_id');
    }

    public function siswa(): HasMany
    {
        return $this->hasMany(Siswa::class, 'paket_id');
    }
}
