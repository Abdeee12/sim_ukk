<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Tugas Satpam: Mengecek apakah user boleh masuk?
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Cek 1: Apakah user sudah login?
        // Kalau belum login (tamu tak diundang), tendang ke halaman login.
        if (!Auth::check()) {
            return redirect('/login');
        }

        // Cek 2: Apakah jabatannya sesuai?
        // Auth::user()->role adalah jabatan orang yang sedang login.
        // $roles adalah daftar jabatan yang DIBOLEHKAN masuk ke ruangan ini.
        if (in_array(Auth::user()->role, $roles)) {
            // Kalau cocok, silakan masuk!
            return $next($request);
        }

        // Cek 3: Kalau login tapi jabatannya salah (Misal: Siswa mau masuk ruang Admin)
        // Tampilkan pesan error 403 (Dilarang Masuk).
        abort(403, 'MAAF! Anda tidak memiliki izin untuk masuk ke halaman ini.');
    }
}