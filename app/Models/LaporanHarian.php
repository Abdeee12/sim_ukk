<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaporanHarian extends Model
{
    // Kolom yang boleh diisi melalui mass-assignment (digunakan oleh ::create())
    protected $fillable = [
        'siswa_id',
        'tanggal',
        'jam_masuk',
        'jam_keluar',
        'detail_kegiatan',
        'path_bukti',
        'mentor_signature',
        'status',
        'feedback_mentor',
    ];

    /**
     * Relasi: Laporan milik satu Siswa
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
