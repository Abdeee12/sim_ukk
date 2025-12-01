<x-app-layout>
    <div class="pt-24 pb-12 min-h-screen bg-[#0f172a]">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('mentor.students.index') }}" class="text-cyan-400 hover:text-cyan-300">&larr; Kembali</a>
                <h2 class="text-2xl font-bold text-white">Penilaian Akhir — {{ optional($siswa->user)->name }}</h2>
                <p class="text-slate-400">Isi nilai akhir dan catatan untuk siswa ini.</p>
            </div>

            <div class="glass-dark rounded-xl p-6">
                <form action="{{ route('mentor.students.assessment.store', $siswa) }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-1 gap-4">
                        <label class="block">
                            <span class="text-slate-300">Disiplin (0-100)</span>
                            <input type="number" name="final_discipline" min="0" max="100" value="{{ old('final_discipline', $siswa->final_discipline) }}" class="mt-1 block w-full" />
                        </label>

                        <label class="block">
                            <span class="text-slate-300">Kinerja (0-100)</span>
                            <input type="number" name="final_performance" min="0" max="100" value="{{ old('final_performance', $siswa->final_performance) }}" class="mt-1 block w-full" />
                        </label>

                        <label class="block">
                            <span class="text-slate-300">Komunikasi (0-100)</span>
                            <input type="number" name="final_communication" min="0" max="100" value="{{ old('final_communication', $siswa->final_communication) }}" class="mt-1 block w-full" />
                        </label>

                        <label class="block">
                            <span class="text-slate-300">Catatan Penilaian</span>
                            <textarea name="assessment_note" rows="4" class="mt-1 block w-full">{{ old('assessment_note', $siswa->assessment_note) }}</textarea>
                        </label>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-cyan-600 text-white px-4 py-2 rounded">Simpan Penilaian</button>
                        </div>
                    </div>
                </form>

                <div class="mt-6">
                    <h3 class="text-white font-semibold">Tanda Tangan Mentor</h3>
                    @if($mentor && $mentor->signature)
                        <img src="{{ asset('storage/'.$mentor->signature) }}" alt="Signature" class="h-20 mt-2" />
                    @else
                        <div class="text-slate-400">Belum mengunggah tanda tangan.</div>
                        <a href="{{ route('mentor.profile.signature') }}" class="text-cyan-300">Unggah tanda tangan</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
