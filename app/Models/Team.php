<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_ssb',
        'logo',
        'kategori_usia',
        'nama_pelatih',
    ];

    // Relasi: Satu Tim memiliki banyak Pemain
    public function pemains()
    {
        return $this->hasMany(Pemain::class);
    }
public function players()
{
    return $this->hasMany(Pemain::class);
}
    // Relasi: Satu Tim memiliki banyak Official
    public function officials()
    {
        return $this->hasMany(Official::class);
    }
}