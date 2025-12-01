<x-app-layout>
    <div class="pt-24 pb-12 min-h-screen bg-[#0f172a]">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('mentor.dashboard') }}" class="text-cyan-400 hover:text-cyan-300">&larr; Kembali</a>
                <h2 class="text-2xl font-bold text-white">Siswa Bimbingan</h2>
                <p class="text-slate-400">Daftar siswa yang Anda bimbing.</p>
            </div>

            <div class="glass-dark rounded-xl p-4">
                @if($siswas->isEmpty())
                    <div class="text-slate-400 p-6">Tidak ada siswa yang ditugaskan.</div>
                @else
                    <ul class="space-y-3">
                        @foreach($siswas as $s)
                            <li class="p-3 bg-slate-800 rounded flex justify-between items-center">
                                <div>
                                    <div class="text-white font-semibold">{{ optional($s->user)->name ?? '—' }}</div>
                                    <div class="text-slate-400 text-sm">NISN: {{ $s->nisn ?? '—' }} — Kelas: {{ $s->kelas ?? '—' }}</div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('mentor.students.assessment', $s) }}" class="text-cyan-300 text-sm">Penilaian</a>
                                    <a href="{{ route('mentor.laporan.index') }}?siswa_id={{ $s->id }}" class="text-slate-300 text-sm">Laporan</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>

                    <div class="mt-4">{{ $siswas->links() }}</div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
