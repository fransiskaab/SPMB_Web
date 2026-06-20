<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'jenjang',
    ];

    public function paketPendaftaran(): HasMany
    {
        return $this->hasMany(PaketPendaftaran::class);
    }

    public function siswa(): HasMany
    {
        return $this->hasMany(Siswa::class);
    }
}
