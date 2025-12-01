<?php

namespace App\Http\Controllers\Siswa; // Namespace di folder Siswa

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\LaporanHarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SiswaController extends Controller
{
    /**
     * Menampilkan Dashboard Siswa dan riwayat laporannya.
     */
    public function index()
    {
        $siswa = Siswa::where('user_id', Auth::id())->with(['user','mentor.user'])->first();
        
        // LOGIKA FALLBACK (KUNCI PERBAIKAN ERROR $siswa)
        if (!$siswa) {
             $siswa = (object)[
                'user' => Auth::user(), 
                'kelas' => 'N/A', 
                'jurusan' => 'N/A', 
                'nisn' => 'N/A',
                'tempat_magang' => 'Belum Ditetapkan'
            ];
            $laporans = collect([]);
            return view('siswa.dashboard', compact('siswa', 'laporans'));
        }

        $laporans = $siswa->laporans()->latest()->get();
        return view('siswa.dashboard', compact('siswa', 'laporans'));
    }

    /**
     * Menampilkan form pengisian Laporan Harian.
     */
    public function createLaporan()
    {
        $siswa = Siswa::where('user_id', Auth::id())->firstOrFail();
        $today = now()->toDateString();
        $hasReportedToday = LaporanHarian::where('siswa_id', $siswa->id)
                            ->where('tanggal', $today)
                            ->exists();

        return view('siswa.laporan.create', compact('siswa', 'hasReportedToday'));
    }

    /**
     * Menampilkan form edit laporan untuk siswa yang memiliki laporan tersebut.
     */
    public function editLaporan(LaporanHarian $laporan)
    {
        $siswa = Siswa::where('user_id', Auth::id())->firstOrFail();

        if ($laporan->siswa_id !== $siswa->id) {
            abort(403);
        }

        return view('siswa.laporan.edit', compact('laporan'));
    }

    /**
     * Memperbarui laporan yang dimiliki siswa saat ini.
     */
    public function updateLaporan(Request $request, LaporanHarian $laporan)
    {
        $siswa = Siswa::where('user_id', Auth::id())->firstOrFail();

        if ($laporan->siswa_id !== $siswa->id) {
            abort(403);
        }

        $data = $request->validate([
            'jam_masuk' => 'required|date_format:H:i',
            'jam_keluar' => 'nullable|date_format:H:i|after:jam_masuk',
            'detail_kegiatan' => 'required|string',
            'path_bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('path_bukti')) {
            if ($laporan->path_bukti) {
                Storage::disk('public')->delete($laporan->path_bukti);
            }
            $data['path_bukti'] = $request->file('path_bukti')->store('bukti_laporan', 'public');
        }

        // Saat siswa mengubah laporannya, set kembali status ke pending
        $data['status'] = 'pending';
        $data['feedback_mentor'] = null;

        $laporan->update($data);

        return redirect()->route('siswa.dashboard')->with('success', 'Laporan berhasil diperbarui.');
    }

    /**
     * Menyimpan Laporan Harian. (TERMASUK FILE UPLOAD)
     */
    public function storeLaporan(Request $request)
    {
        $siswa = Siswa::where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'jam_masuk' => 'required|date_format:H:i',
            'jam_keluar' => 'nullable|date_format:H:i|after:jam_masuk',
            'detail_kegiatan' => 'required|string',
            'path_bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', 
        ]);

        $path_bukti = null;
        if ($request->hasFile('path_bukti')) {
            $path_bukti = $request->file('path_bukti')->store('bukti_laporan', 'public');
        }

        LaporanHarian::create([
            'siswa_id' => $siswa->id,
            'tanggal' => now()->toDateString(),
            'jam_masuk' => $request->jam_masuk,
            'jam_keluar' => $request->jam_keluar,
            'detail_kegiatan' => $request->detail_kegiatan,
            'path_bukti' => $path_bukti,
            'status' => 'pending', 
            'feedback_mentor' => null,
        ]);

        return redirect()->route('siswa.dashboard')->with('success', 'Laporan Harian berhasil dikirim!');
    }
}