<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrangTua extends Model
{
    protected $table = 'orang_tua';

    protected $fillable = [
        'siswa_id',
        'hubungan',
        'nama',
        'nik',
        'pekerjaan',
        'penghasilan',
        'no_hp',
    ];

    protected function casts(): array
    {
        return [
            'penghasilan' => 'decimal:2',
        ];
    }

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class);
    }
}
