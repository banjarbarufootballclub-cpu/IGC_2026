<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('officials', function (Blueprint $table) {
            $table->id();
            
            // Menyambungkan official dengan timnya
            $table->foreignId('team_id')->constrained()->onDelete('cascade');
            
            // Data Teks
            $table->string('nama_official');
            $table->string('jabatan'); // Manajer, Pelatih Kepala, Asisten Pelatih, Medis, dll
            $table->string('no_hp')->nullable();
            
            // Data File Upload
            $table->string('foto');
            $table->string('lisensi_ktp'); // Lisensi pelatih atau KTP untuk manajer/medis
            
            // Status Pengesahan dari Admin (Default: Belum sah)
            $table->boolean('is_sah')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('officials');
    }
};