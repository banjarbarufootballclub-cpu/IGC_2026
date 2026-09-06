<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemains', function (Blueprint $table) {
            $table->id();
            
            // Menyambungkan pemain ini dengan timnya
            $table->foreignId('team_id')->constrained()->onDelete('cascade');
            
            // Data Teks & Angka
            $table->string('nama_pemain');
            $table->string('nisn');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir')
                        // Data Jalur File Upload
            $table->string('foto');
            $table->string('akte');
            $table->string('kk');
            $table->string('kia')->nullable(); // KIA opsional

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemains');
    }
};