<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Mentor;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if (! $user) abort(403);
        $mentor = $user->mentor ?? Mentor::where('user_id', $user->id)->first();
        if (! $mentor) {
            // try to create a minimal mentor record to enable access
            $mentor = Mentor::create(['user_id' => $user->id, 'nama_perusahaan' => 'Auto-created', 'jabatan' => 'Mentor', 'no_hp' => null]);
        }

        $siswas = Siswa::with('user')->where('mentor_id', $mentor->id)->paginate(20);
        return view('mentor.students.index', compact('siswas'));
    }

    public function assessmentForm(Siswa $siswa)
    {
        $user = auth()->user(); if (! $user) abort(403);
        $mentor = $user->mentor ?? Mentor::where('user_id', $user->id)->first();
        if (!$mentor || $siswa->mentor_id !== $mentor->id) {
            abort(403);
        }

        return view('mentor.students.assessment', compact('siswa', 'mentor'));
    }

    public function storeAssessment(Request $request, Siswa $siswa)
    {
        $user = auth()->user(); if (! $user) abort(403);
        $mentor = $user->mentor ?? Mentor::where('user_id', $user->id)->first();
        if (!$mentor || $siswa->mentor_id !== $mentor->id) {
            abort(403);
        }

        $data = $request->validate([
            'final_discipline' => 'nullable|integer|min:0|max:100',
            'final_performance' => 'nullable|integer|min:0|max:100',
            'final_communication' => 'nullable|integer|min:0|max:100',
            'assessment_note' => 'nullable|string',
        ]);

        $siswa->update($data);

        Log::info('Mentor stored assessment', ['mentor_user_id' => auth()->id(), 'siswa_id' => $siswa->id, 'data' => $data]);

        return redirect()->route('mentor.students.index')->with('success', 'Penilaian akhir berhasil disimpan.');
    }
}
