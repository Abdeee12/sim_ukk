<x-app-layout>
    <div class="pt-24 pb-12 min-h-screen bg-[#0f172a] relative">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <div class="mb-6">
                <a href="{{ route('mentor.laporan.index') }}" class="text-cyan-400 hover:text-cyan-300 mb-2 inline-block">&larr; Kembali ke Daftar Laporan</a>
                <h2 class="text-3xl font-bold text-white">Edit Laporan</h2>
                <p class="text-slate-400">Edit laporan #{{ $laporan->id }}</p>
            </div>

            <div class="glass-dark rounded-2xl p-8">
                <form action="{{ route('mentor.laporan.update', $laporan) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label class="block text-slate-400 mb-2 text-sm">Pilih Siswa</label>
                        <select name="siswa_id" class="w-full rounded-lg p-2 bg-slate-800 text-white" required>
                            <option value="">-- Pilih Siswa --</option>
                            @foreach($siswas as $s)
                                <option value="{{ $s->id }}" {{ $laporan->siswa_id == $s->id ? 'selected' : '' }}>{{ optional($s->user)->name ?? 'Siswa #' . $s->id }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-6 border-b border-slate-700 pb-6">
                        <h3 class="text-cyan-400 font-bold mb-4 uppercase tracking-wider text-sm">1. Presensi & Kegiatan</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-slate-400 mb-2 text-sm">Jam Masuk (Wajib)</label>
                                <input type="time" name="jam_masuk" value="{{ $laporan->jam_masuk }}" class="w-full rounded-lg px-4 py-2" required>
                            </div>
                            <div>
                                <label class="block text-slate-400 mb-2 text-sm">Jam Keluar (Opsional)</label>
                                <input type="time" name="jam_keluar" value="{{ $laporan->jam_keluar }}" class="w-full rounded-lg px-4 py-2">
                            </div>
                        </div>

                        <div>
                            <label class="block text-slate-400 mb-2 text-sm">Detail Kegiatan Hari Ini</label>
                            <textarea name="detail_kegiatan" rows="6" class="w-full rounded-lg px-4 py-2" required>{{ old('detail_kegiatan', $laporan->detail_kegiatan) }}</textarea>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-cyan-400 font-bold mb-4 uppercase tracking-wider text-sm">2. Bukti & Lampiran (Opsional)</h3>
                        <div>
                            <label class="block text-slate-400 mb-2 text-sm">Unggah Bukti (Foto/Dokumen)</label>
                            <input type="file" name="path_bukti" class="w-full text-slate-300 border border-slate-700 rounded-lg p-2 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600">
                            <p class="text-xs text-slate-500 mt-1">Format: JPG, PNG, PDF. Maks 2MB.</p>
                            @if($laporan->path_bukti)
                                <p class="text-slate-300 mt-2">Bukti saat ini: <a href="{{ asset('storage/'.$laporan->path_bukti) }}" target="_blank" class="text-cyan-300">Lihat</a></p>
                            @endif
                        </div>
                    </div>

                    <div class="flex justify-end mt-8">
                        <button type="submit" class="bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-bold py-3 px-8 rounded-xl">Simpan Perubahan</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>
