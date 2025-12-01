<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function signatureForm()
    {
        $user = auth()->user(); if (! $user) abort(403);
        $mentor = $user->mentor ?? Mentor::where('user_id', $user->id)->first();
        if (! $mentor) {
            // create minimal mentor record
            $mentor = Mentor::create(['user_id' => $user->id, 'nama_perusahaan' => 'Auto-created', 'jabatan' => 'Mentor', 'no_hp' => null]);
        }
        return view('mentor.profile.signature', compact('mentor'));
    }

    public function updateSignature(Request $request)
    {
        $user = auth()->user(); if (! $user) abort(403);
        $mentor = $user->mentor ?? Mentor::where('user_id', $user->id)->first();
        if (! $mentor) {
            $mentor = Mentor::create(['user_id' => $user->id, 'nama_perusahaan' => 'Auto-created', 'jabatan' => 'Mentor', 'no_hp' => null]);
        }

        $data = $request->validate([
            'signature' => 'required|file|mimes:png,jpg,jpeg|max:2048',
        ]);

        if ($request->hasFile('signature')) {
            // store under public/signatures/{mentor_id}
            $path = $request->file('signature')->store('signatures/'.$mentor->id, 'public');
            // delete old signature if exists
            try { if ($mentor->signature) Storage::disk('public')->delete($mentor->signature); } catch (\Exception $e) {}
            $mentor->signature = $path;
            $mentor->save();
            Log::info('Mentor uploaded signature', ['mentor_id' => $mentor->id, 'path' => $path]);
        }

        return redirect()->route('mentor.profile.signature')->with('success', 'Tanda tangan berhasil diperbarui.');
    }
}
