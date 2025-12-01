<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\LaporanHarian;
use App\Models\Siswa;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Allow mentors to VIEW all reports (read-only). Editing remains restricted elsewhere.
        $query = LaporanHarian::with('siswa.user')->latest();
        // optional status filter: pending, approved, rejected
        $status = $request->query('status');
        if (in_array($status, ['pending','approved','rejected'])) {
            $query->where('status', $status);
        }

        $laporans = $query->paginate(20)->withQueryString();
        return view('mentor.laporan.index', compact('laporans','status'));
    }

    /**
     * Mentor dashboard: show counts for pending, rejected and completed reports
     */
    public function dashboard()
    {
        // For read-only visibility, show global counts and recent items. Editing remains limited to primary mentor.
        $pendingCount = LaporanHarian::where('status', 'pending')->count();
        $rejectedCount = LaporanHarian::where('status', 'rejected')->count();
        $completedCount = LaporanHarian::where('status', 'approved')->count();

        $pending = LaporanHarian::with('siswa.user')->where('status', 'pending')->latest()->limit(5)->get();
        $rejected = LaporanHarian::with('siswa.user')->where('status', 'rejected')->latest()->limit(5)->get();
        $completed = LaporanHarian::with('siswa.user')->where('status', 'approved')->latest()->limit(5)->get();

        return view('mentor.dashboard', compact(
            'pendingCount','rejectedCount','completedCount',
            'pending','rejected','completed'
        ));
    }

    /**
     * Resolve or create the Mentor record for the authenticated user.
     * This avoids 403 when a Mentor DB row is missing for a user that has role 'mentor'.
     */
    protected function getOrCreateMentor()
    {
        $user = auth()->user();
        if (! $user) return null;

        // Try relation first
        if (method_exists($user, 'mentor') && $user->mentor) {
            return $user->mentor;
        }

        // Then try lookup by user_id
        $mentor = \App\Models\Mentor::where('user_id', $user->id)->first();
        if ($mentor) return $mentor;

        // If not exists, create a minimal mentor record so user can use mentor features
        $mentor = \App\Models\Mentor::create([
            'user_id' => $user->id,
            'nama_perusahaan' => 'Auto-created',
            'jabatan' => 'Mentor',
            'no_hp' => null,
        ]);

        return $mentor;
    }

    /**
     * Show pending reports for the currently authenticated mentor (their assigned students).
     */
    public function pending()
    {
        // Allow viewing all pending reports (read-only)
        $laporans = LaporanHarian::with('siswa.user')
            ->where('status', 'pending')
            ->latest()
            ->paginate(20);

        return view('mentor.laporan.pending', compact('laporans'));
    }

    /**
     * Show rejected reports for the currently authenticated mentor.
     */
    public function rejected()
    {
        $laporans = LaporanHarian::with('siswa.user')
            ->where('status', 'rejected')
            ->latest()
            ->paginate(20);

        return view('mentor.laporan.index', ['laporans' => $laporans, 'status' => 'rejected']);
    }

    /**
     * Show completed (approved) reports for the currently authenticated mentor.
     */
    public function completed()
    {
        $laporans = LaporanHarian::with('siswa.user')
            ->where('status', 'approved')
            ->latest()
            ->paginate(20);

        return view('mentor.laporan.index', ['laporans' => $laporans, 'status' => 'approved']);
    }

    public function create()
    {
        $mentor = $this->getOrCreateMentor();
        if (! $mentor) abort(403);

        // only list students assigned to this mentor
        $siswas = Siswa::with('user')->where('mentor_id', $mentor->id)->orderBy('id','desc')->get();
        return view('mentor.laporan.create', compact('siswas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'tanggal' => 'required|date',
            'jam_masuk' => 'required',
            'jam_keluar' => 'nullable',
            'detail_kegiatan' => 'required|string',
            'path_bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'status' => 'nullable|in:pending,approved,rejected',
        ]);

        if ($request->hasFile('path_bukti')) {
            $data['path_bukti'] = $request->file('path_bukti')->store('laporan', 'public');
        }
        // authorize: siswa must belong to this mentor
        $mentor = $this->getOrCreateMentor();
        if (! $mentor) abort(403);
        $siswa = Siswa::findOrFail($data['siswa_id']);
        if ($siswa->mentor_id !== $mentor->id) {
            abort(403);
        }

        $laporan = LaporanHarian::create(array_merge($data, ['status' => $data['status'] ?? 'pending']));
        Log::info('Mentor created laporan', ['id' => $laporan->id, 'user_id' => auth()->id()]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'laporan' => $laporan]);
        }

        return redirect()->route('mentor.laporan.index')->with('success', 'Laporan berhasil dibuat.');
    }

    public function show(LaporanHarian $laporan)
    {
        $laporan->load('siswa.user');
        // Allow mentors to view laporan (read-only) even if they're not the assigned mentor.
        // Only editing/updating/deleting should be restricted to the assigned mentor.
        $mentor = $this->getOrCreateMentor();
        if (! $mentor) abort(403, 'Akses ditolak.');

        $canEdit = ($laporan->siswa && $laporan->siswa->mentor_id === $mentor->id);

        return view('mentor.laporan.show', compact('laporan', 'canEdit'));
    }

    public function edit(LaporanHarian $laporan)
    {
        $laporan->load('siswa.user');
        $mentor = $this->getOrCreateMentor();
        if (! $mentor || $laporan->siswa->mentor_id !== $mentor->id) abort(403);

        // only allow selecting students that belong to this mentor
        $siswas = Siswa::with('user')->where('mentor_id', $mentor->id)->orderBy('id','desc')->get();
        return view('mentor.laporan.edit', compact('laporan', 'siswas'));
    }

    public function updateStatus(Request $request, LaporanHarian $laporan)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'feedback_mentor' => 'nullable|string',
            'mentor_signature' => 'nullable|file|mimes:png,jpg,jpeg|max:2048',
        ]);

        // authorize: mentor can only update reports of their assigned students
        $mentor = $this->getOrCreateMentor();
        if (!$mentor || $laporan->siswa->mentor_id !== $mentor->id) {
            abort(403);
        }

        // handle mentor signature upload if provided
        if ($request->hasFile('mentor_signature')) {
            // delete old signature if exists
            try { if ($laporan->mentor_signature) \Storage::disk('public')->delete($laporan->mentor_signature); } catch (\Exception $e) {}
            $data['mentor_signature'] = $request->file('mentor_signature')->store('laporan/signatures', 'public');
        }

        $laporan->update($data);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'laporan' => $laporan->fresh()]);
        }

        return redirect()->route('mentor.laporan.index')->with('success', 'Status laporan berhasil diperbarui.');
    }

    public function update(Request $request, LaporanHarian $laporan)
    {
        $mentor = $this->getOrCreateMentor();
        if (! $mentor || $laporan->siswa->mentor_id !== $mentor->id) abort(403);

        $data = $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'tanggal' => 'required|date',
            'jam_masuk' => 'required',
            'jam_keluar' => 'nullable',
            'detail_kegiatan' => 'required|string',
            'path_bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'status' => 'nullable|in:pending,approved,rejected',
        ]);

        if ($request->hasFile('path_bukti')) {
            // delete old file if exists
            try { if ($laporan->path_bukti) \Storage::disk('public')->delete($laporan->path_bukti); } catch (\Exception $e) {}
            $data['path_bukti'] = $request->file('path_bukti')->store('laporan', 'public');
        }

        // additional check: if siswa_id changed ensure new siswa belongs to mentor
        if (isset($data['siswa_id'])) {
            $newSiswa = Siswa::findOrFail($data['siswa_id']);
            if ($newSiswa->mentor_id !== $mentor->id) abort(403);
        }

        $laporan->update($data);
        Log::info('Mentor updated laporan', ['id' => $laporan->id, 'user_id' => auth()->id(), 'updated' => $data]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'laporan' => $laporan->fresh()]);
        }

        return redirect()->route('mentor.laporan.index')->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy(Request $request, LaporanHarian $laporan)
    {
        $mentor = $this->getOrCreateMentor();
        if (! $mentor || $laporan->siswa->mentor_id !== $mentor->id) abort(403);

        try { if ($laporan->path_bukti) \Storage::disk('public')->delete($laporan->path_bukti); } catch (\Exception $e) {}
        $laporan->delete();
        Log::info('Mentor deleted laporan', ['id' => $laporan->id, 'user_id' => auth()->id()]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('mentor.laporan.index')->with('success', 'Laporan berhasil dihapus.');
    }
}
