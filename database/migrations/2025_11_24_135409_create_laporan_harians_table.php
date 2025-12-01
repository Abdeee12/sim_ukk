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
        Schema::create('laporan_harians', function (Blueprint $table) {
            $table->id();
            
            // 1. Relasi ke Siswa (Wajib diisi oleh siapa)
            // Di sini kita relasikan ke tabel `siswas`
            $table->foreignId('siswa_id')->constrained('siswas')->onDelete('cascade');

            // 2. Data Kegiatan
            $table->date('tanggal');
            $table->time('jam_masuk');
            $table->time('jam_keluar')->nullable();
            $table->text('detail_kegiatan');
            
            // 3. Status dan Bukti
            $table->string('path_bukti')->nullable(); // Tempat menyimpan nama file foto/dokumen
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('feedback_mentor')->nullable(); // Umpan balik dari mentor

            $table->timestamps();

            // PENTING: Supaya satu siswa tidak bisa mengisi laporan dua kali di tanggal yang sama
            $table->unique(['siswa_id', 'tanggal']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_harians');
    }
};