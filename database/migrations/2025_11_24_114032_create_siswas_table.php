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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();

            // 1. RELASI KE TABEL USERS (PENTING!)
            // Kolom ini menghubungkan data siswa ke akun loginnya.
            // constrained('users') = nyambung ke tabel users.
            // onDelete('cascade') = kalau akun user dihapus, biodata ini ikut terhapus.
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // 2. BIODATA LENGKAP
            $table->string('nisn')->unique(); // NISN wajib unik (gak boleh sama)
            $table->string('kelas');          // Contoh: XII RPL 1
            $table->string('jurusan');        // Contoh: RPL, TKJ
            $table->string('nomor_hp')->nullable(); // Boleh kosong

            // 3. TEMPAT MAGANG (Persiapan buat nanti)
            $table->string('tempat_magang')->nullable(); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};