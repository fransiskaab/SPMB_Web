<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ItemPerlengkapan extends Model
{
    protected $table = 'item_perlengkapan';

    protected $fillable = [
        'nama_item',
    ];

    public function paketPendaftaran(): BelongsToMany
    {
        return $this->belongsToMany(PaketPendaftaran::class, 'detail_paket_item', 'item_id', 'paket_id');
    }
}
