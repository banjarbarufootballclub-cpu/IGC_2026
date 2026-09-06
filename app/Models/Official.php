<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Official extends Model
{
    use HasFactory;

    // Daftar kolom yang diizinkan untuk diisi
    protected $fillable = [
        'team_id',
        'nama_official',
        'jabatan',
        'no_hp',
        'foto',
        'lisensi_ktp',
        'is_sah',
    ];

    // Relasi balik: Official ini milik siapa?
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}