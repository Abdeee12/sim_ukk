<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    // Kolom yang diizinkan untuk diisi (dari CRUD Siswa)
    protected $fillable = [
        'user_id',
        'mentor_id',
        'nisn',
        'kelas',
        'jurusan',
        'nomor_hp',
        'tempat_magang',
        'final_discipline',
        'final_performance',
        'final_communication',
        'assessment_note',
    ];

    // Relasi 1: Siswa milik satu User (Akun Login)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // Relasi 2: Siswa memiliki banyak Laporan Harian (Kode yang Anda cari)
    public function laporans()
    {
        // hasMany menunjukkan bahwa FK (siswa_id) ada di tabel LaporanHarian
        return $this->hasMany(LaporanHarian::class);
    }

    // Relasi 3: Siswa dibimbing oleh satu Mentor (akan kita gunakan nanti)
    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }
}