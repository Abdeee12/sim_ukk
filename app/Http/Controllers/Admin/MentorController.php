<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mentor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule; // Penting untuk validasi saat Edit

class MentorController extends Controller
{
    /**
     * Tampilkan daftar mentor.
     */
    public function index()
    {
        // Ambil data mentor, sekalian bawa data user-nya
        $mentors = Mentor::with('user')->latest()->get();
        return view('admin.mentor.index', compact('mentors'));
    }

    /**
     * Form tambah mentor.
     */
    public function create()
    {
        return view('admin.mentor.create');
    }

    /**
     * Simpan mentor baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Email wajib unik
            'nama_perusahaan' => 'required|string',
            'jabatan' => 'required|string',
            'no_hp' => 'nullable|numeric',
        ]);

        // 1. Buat Akun Login (Tabel USERS)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password123'), // Default password
            'role' => 'mentor', // Set role otomatis
        ]);

        // 2. Buat Biodata Mentor (Tabel MENTORS)
        Mentor::create([
            'user_id' => $user->id, // <--- KUNCI RELASI
            'nama_perusahaan' => $request->nama_perusahaan,
            'jabatan' => $request->jabatan,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('admin.mentor.index')->with('success', 'Mentor berhasil ditambahkan!');
    }

    /**
     * Form edit mentor.
     */
    public function edit(string $id)
    {
        $mentor = Mentor::with('user')->findOrFail($id);
        return view('admin.mentor.edit', compact('mentor'));
    }

    /**
     * Update data mentor.
     */
    public function update(Request $request, string $id)
    {
        $mentor = Mentor::findOrFail($id);
        $user = $mentor->user;

        // Validasi Khusus Update: Email/ID harus unik, TAPI abaikan punya user/mentor ini sendiri
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'nama_perusahaan' => 'required|string',
            'jabatan' => 'required|string',
            'no_hp' => 'nullable|numeric',
        ]);

        // 1. Update Tabel User
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // 2. Update Tabel Mentor
        $mentor->update([
            'nama_perusahaan' => $request->nama_perusahaan,
            'jabatan' => $request->jabatan,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()->route('admin.mentor.index')->with('success', 'Data mentor berhasil diperbarui!');
    }

    /**
     * Hapus mentor.
     */
    public function destroy(string $id)
    {
        $mentor = Mentor::findOrFail($id);
        
        // Hapus user-nya. Karena ada 'onDelete cascade', data mentor otomatis ikut terhapus.
        $mentor->user->delete();

        return redirect()->route('admin.mentor.index')->with('success', 'Mentor berhasil dihapus!');
    }
}