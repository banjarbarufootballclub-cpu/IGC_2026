<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            // Menyambungkan tim ini dengan akun manajer yang mendaftar
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            
            // Kolom untuk isian formulir kita tadi
            $table->string('nama_ssb');
            $table->string('kategori_usia');
            $table->string('logo')->nullable();
            $table->string('nama_pelatih');
            
            $table->timestamps();
        });
    }
};
