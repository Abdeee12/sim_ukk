<x-app-layout>
    <div class="pt-24 pb-12 min-h-screen bg-[#071127] relative">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <div class="mb-6">
                <a href="{{ route('admin.laporan.show', $laporan) }}" class="text-cyan-400 hover:text-cyan-300 mb-2 inline-block">&larr; Kembali ke Detail</a>
                <h2 class="text-3xl font-bold text-white">Edit Laporan</h2>
                <p class="text-slate-400">Siswa: {{ $laporan->siswa->user->name }} — Tanggal: {{ $laporan->tanggal }}</p>
            </div>

            <div class="glass-dark rounded-2xl p-8">
                <form action="{{ route('admin.laporan', $laporan) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    @if ($errors->any())
                        <div class="bg-red-800/50 p-3 rounded-md text-red-300 mb-4 text-sm border border-red-600">
                            Mohon periksa kembali input Anda.
                        </div>
                    @endif

                    <div class="mb-6">
                        <label class="block text-slate-400 mb-2 text-sm">Jam Masuk</label>
                        <input type="time" name="jam_masuk" value="{{ old('jam_masuk', $laporan->jam_masuk) }}" class="w-full rounded-lg px-4 py-2" required>
                    </div>

                    <div class="mb-6">
                        <label class="block text-slate-400 mb-2 text-sm">Jam Keluar</label>
                        <input type="time" name="jam_keluar" value="{{ old('jam_keluar', $laporan->jam_keluar) }}" class="w-full rounded-lg px-4 py-2">
                    </div>

                    <div class="mb-6">
                        <label class="block text-slate-400 mb-2 text-sm">Detail Kegiatan</label>
                        <textarea name="detail_kegiatan" rows="6" class="w-full rounded-lg px-4 py-2" required>{{ old('detail_kegiatan', $laporan->detail_kegiatan) }}</textarea>
                    </div>

                    <div class="mb-6">
                        <label class="block text-slate-400 mb-2 text-sm">Bukti (Opsional)</label>
                        @if($laporan->path_bukti)
                            <p class="text-sm text-slate-300 mb-2">File saat ini: <a href="{{ asset('storage/'.$laporan->path_bukti) }}" target="_blank" class="text-cyan-300">Lihat</a></p>
                        @endif
                        <input type="file" name="path_bukti" class="w-full text-slate-300 border border-slate-700 rounded-lg p-2">
                        <p class="text-xs text-slate-500 mt-1">Format: JPG, PNG, PDF. Maks 2MB.</p>
                    </div>

                    <div class="mb-6">
                        <label class="block text-slate-400 mb-2 text-sm">Status</label>
                        <select name="status" class="w-full rounded-lg px-4 py-2">
                            <option value="pending" {{ old('status', $laporan->status) === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ old('status', $laporan->status) === 'approved' ? 'selected' : '' }}>Selesai</option>
                            <option value="rejected" {{ old('status', $laporan->status) === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    <div class="mb-6">
                        <label class="block text-slate-400 mb-2 text-sm">Feedback Mentor/Admin (Opsional)</label>
                        <textarea name="feedback_mentor" rows="4" class="w-full rounded-lg px-4 py-2">{{ old('feedback_mentor', $laporan->feedback_mentor) }}</textarea>
                    </div>

                    <div class="flex justify-end mt-8">
                        <button type="submit" class="bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-bold py-3 px-8 rounded-xl">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
