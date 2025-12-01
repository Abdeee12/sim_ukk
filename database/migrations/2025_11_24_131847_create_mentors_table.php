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
    Schema::create('mentors', function (Blueprint $table) {
        $table->id();
        
        // 1. Relasi ke Akun Login (User)
        // Jika user dihapus, data mentor ikut terhapus (cascade)
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

        // 2. Data Biodata Mentor
        $table->string('nama_perusahaan'); // Wajib diisi
        $table->string('jabatan')->nullable(); // Boleh kosong
        $table->string('no_hp')->nullable(); // Boleh kosong
        
        // 3. Tempat Tanda Tangan Digital (Disiapkan untuk Hari 5)
        $table->string('signature')->nullable(); 

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentors');
    }
};
