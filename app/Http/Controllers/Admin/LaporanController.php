<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LaporanHarian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LaporanController extends Controller
{
    /**
     * Display a listing of the laporan for admin review.
     */
    public function index(Request $request)
    {
        $laporans = LaporanHarian::with('siswa.user')->latest()->paginate(20);
        return view('admin.laporan.index', compact('laporans'));
    }

    /**
     * Display a specific laporan details.
     */
    public function show(LaporanHarian $laporan)
    {
        $laporan->load('siswa.user');
        return view('admin.laporan.show', compact('laporan'));
    }

    /**
     * Show the form for editing the specified laporan.
     */
    public function edit(LaporanHarian $laporan)
    {
        $laporan->load('siswa.user');
        return view('admin.laporan.edit', compact('laporan'));
    }

    /**
     * Update the specified laporan in storage (full update by admin).
     */
    public function update(Request $request, LaporanHarian $laporan)
    {
        $data = $request->validate([
            'jam_masuk' => 'required|date_format:H:i',
            'jam_keluar' => 'nullable|date_format:H:i|after:jam_masuk',
            'detail_kegiatan' => 'required|string',
            'path_bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'status' => 'required|in:pending,approved,rejected',
            'feedback_mentor' => 'nullable|string',
        ]);

        if ($request->hasFile('path_bukti')) {
            if ($laporan->path_bukti) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($laporan->path_bukti);
            }
            $data['path_bukti'] = $request->file('path_bukti')->store('bukti_laporan', 'public');
        }

        $laporan->update($data);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'laporan' => $laporan->fresh()]);
        }

        return redirect()->route('admin.laporan.show', $laporan)->with('success', 'Laporan diperbarui.');
    }

    /**
     * Update laporan status (e.g., set to selesai).
     */
    public function updateStatus(Request $request, LaporanHarian $laporan)
    {
        Log::info('Admin updateStatus called', ['id' => $laporan->id, 'user_id' => auth()->id()]);
        $data = $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'feedback_mentor' => 'nullable|string',
        ]);

        $laporan->update($data);
        Log::info('Admin updated laporan', ['id' => $laporan->id, 'updated' => $data]);

        // If this is an AJAX request, return JSON so client-side can update inline
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json(['success' => true, 'laporan' => $laporan->fresh()]);
        }

        // Otherwise redirect back to the list (index) with a success flash
        return redirect()->route('admin.laporan.index')->with('success', 'Status laporan berhasil diperbarui.');
    }
}
