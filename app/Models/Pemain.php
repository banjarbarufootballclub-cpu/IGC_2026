<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemain extends Model
{
    use HasFactory;

    // Daftar kolom yang diizinkan untuk diisi dari formulir
    protected $fillable = [
        'team_id',
        'nama_pemain',
        'nisn',
        'tempat_lahir',
        'tanggal_lahir',
        'tinggi_badan',
        'berat_badan',
        'posisi',
        'foto',
        'akte',
        'kk',
        'kia',
    ];
}