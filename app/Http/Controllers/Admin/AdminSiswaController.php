<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

// 👇 KUNCI: Class name harus AdminSiswaController
class AdminSiswaController extends Controller 
{
    /**
     * Tampilkan daftar siswa.
     */
    public function index()
    {
        $siswas = Siswa::with(['user','mentor'])->latest()->get();
        $mentors = Mentor::with('user')->get();
        return view('admin.siswa.index', compact('siswas','mentors'));
    }

    /**
     * Tampilkan form untuk menetapkan Mentor ke Siswa.
     */
    public function assignMentorForm()
    {
        $siswas = Siswa::with(['user','mentor'])->orderBy('kelas')->orderBy('nisn')->get();
        $mentors = Mentor::with('user')->get();

        return view('admin.siswa.assign', compact('siswas', 'mentors'));
    }

    /**
     * Tetapkan mentor untuk satu siswa (dari form atau AJAX).
     */
    public function assignMentor(Request $request, Siswa $siswa)
    {
        $request->validate([
            'mentor_id' => ['nullable', 'exists:mentors,id'],
        ]);

        $siswa->mentor_id = $request->mentor_id;
        $siswa->save();

        if ($request->wantsJson()) {
            return response()->json(['ok' => true, 'message' => 'Mentor berhasil ditetapkan.']);
        }

        return redirect()->back()->with('success', 'Mentor berhasil ditetapkan untuk siswa.');
    }

    /**
     * Bulk-assign: tetapkan mentor terpilih ke semua siswa yang belum memiliki mentor.
     */
    public function bulkAssignMissing(Request $request)
    {
        $request->validate([
            'mentor_id' => ['required', 'exists:mentors,id'],
        ]);

        $mentorId = $request->mentor_id;
        $updated = Siswa::whereNull('mentor_id')->orWhere('mentor_id', 0)->update(['mentor_id' => $mentorId]);

        return redirect()->back()->with('success', "Berhasil menetapkan mentor ke {$updated} siswa yang sebelumnya belum memiliki mentor.");
    }

    /**
     * Form tambah siswa.
     */
    public function create()
    {
        return view('admin.siswa.create');
    }

    /**
     * Simpan siswa baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'nisn' => 'required|numeric|unique:siswas,nisn',
            'kelas' => 'required',
            'jurusan' => 'required',
            'nomor_hp' => 'nullable|numeric',
        ]);

        // 1. Buat Akun Login (User)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make('password123'),
            'role' => 'siswa',
        ]);

        // 2. Buat Biodata Siswa
        Siswa::create([
            'user_id' => $user->id,
            'nisn' => $request->nisn,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
            'nomor_hp' => $request->nomor_hp,
        ]);

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil ditambahkan!');
    }

    /**
     * Form edit siswa.
     */
    public function edit(string $id)
    {
        $siswa = Siswa::with('user')->findOrFail($id);
        return view('admin.siswa.edit', compact('siswa'));
    }

    /**
     * Update data siswa.
     */
    public function update(Request $request, string $id)
    {
        $siswa = Siswa::findOrFail($id);
        $user = $siswa->user;

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'nisn' => ['required', 'numeric', Rule::unique('siswas')->ignore($siswa->id)],
            'kelas' => 'required',
            'jurusan' => 'required',
            'nomor_hp' => 'nullable|numeric',
        ]);

        // Update User
        $user->update(['name' => $request->name, 'email' => $request->email]);

        // Update Siswa
        $siswa->update(['nisn' => $request->nisn, 'kelas' => $request->kelas, 'jurusan' => $request->jurusan, 'nomor_hp' => $request->nomor_hp]);

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
    }

    /**
     * Hapus siswa.
     */
    public function destroy(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->user->delete(); 

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil dihapus!');
    }
}
