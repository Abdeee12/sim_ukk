<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    use HasFactory;

    // PASTIKAN SEMUA KOLOM YANG AKAN DIISI DARI FORM ADA DI SINI
    protected $fillable = [
        'user_id',
        'nama_perusahaan',
        'jabatan',
        'no_hp',
        'signature', // Meskipun nullable, dimasukkan lebih aman
    ];

    // Relasi User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // Relasi Siswa
    public function siswas()
    {
        return $this->hasMany(Siswa::class);
    }
}