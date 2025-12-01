<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class SiswaLaporanController extends Controller
{
    /**
     * Tampilkan form untuk input laporan harian.
     */
    public function create()
    {
        // 1. Ambil data Siswa yang sedang login
        // Karena data Siswa sudah dijamin ada (Anda sudah berhasil input Admin), 
        // kita bisa menggunakan relasi user->siswa
        $siswa = Auth::user()->siswa;
        
        // 2. Cek apakah Siswa sudah melaporkan hari ini
        $today = Carbon::today()->toDateString();
        $hasReportedToday = Laporan::where('siswa_id', $siswa->id)
                                    ->whereDate('tanggal', $today)
                                    ->exists();

        // Variabel $siswa dan $hasReportedToday dikirim ke view
        return view('siswa.laporan.create', compact('siswa', 'hasReportedToday'));
    }

    /**
     * Simpan laporan harian yang di-submit oleh Siswa.
     */
    public function store(Request $request)
    {
        // 1. Ambil data Siswa
        $siswa = Auth::user()->siswa;
        
        // Cek ganda, untuk menghindari submit yang sangat cepat
        $today = Carbon::today()->toDateString();
        $hasReportedToday = Laporan::where('siswa_id', $siswa->id)
                                    ->whereDate('tanggal', $today)
                                    ->exists();
        
        if ($hasReportedToday) {
            return redirect()->route('siswa.dashboard')->with('error', 'Anda sudah mengisi laporan untuk hari ini.');
        }

        // 2. Validasi Input
        $request->validate([
            'jam_masuk' => 'required|date_format:H:i',
            // Jam keluar harus setelah jam masuk (jika diisi)
            'jam_keluar' => 'nullable|date_format:H:i|after:jam_masuk', 
            'detail_kegiatan' => 'required|string|min:20', // Minimal 20 karakter agar deskriptif
            'path_bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // Max 2MB
        ]);

        $path_bukti = null;

        // 3. Upload Bukti (Jika ada)
        if ($request->hasFile('path_bukti')) {
            $file = $request->file('path_bukti');
            // Simpan file ke folder 'public/bukti_laporan'
            $path_bukti = $file->store('bukti_laporan', 'public');
        }

        // 4. Simpan ke Database (Tabel 'laporans')
        Laporan::create([
            'siswa_id' => $siswa->id,
            'tanggal' => $today, // Tanggal hari ini
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar,
            'detail_kegiatan' => $request->detail_kegiatan,
            'status_verifikasi' => 'pending', // Default
            'path_bukti' => $path_bukti,
        ]);

        return redirect()->route('siswa.dashboard')->with('success', 'Laporan harian berhasil dikirim!');
    }
}
