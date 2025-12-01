<x-app-layout>
    <style>
        .glass-dark { background: rgba(30,41,59,0.7); backdrop-filter: blur(10px); border: 1px solid rgba(56,189,248,0.12); }
    </style>

    <div class="pt-24 pb-12 min-h-screen bg-[#0f172a]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-white">Tetapkan Mentor ke Siswa</h1>
                    <p class="text-slate-400">Gunakan halaman ini untuk menyambungkan siswa dengan mentor yang tersedia.</p>
                </div>
                <a href="{{ route('admin.siswa.index') }}" class="text-sm bg-slate-800/60 text-white px-4 py-2 rounded-md">Kembali ke Data Siswa</a>
            </div>

            <div class="glass-dark rounded-2xl p-6 mb-6">
                <form action="{{ route('admin.siswa.bulkAssignMentor') }}" method="POST" onsubmit="return confirm('Tetapkan mentor ini ke semua siswa yang belum memiliki mentor?');">
                    @csrf
                    <div class="flex items-center space-x-4">
                        <label class="text-slate-300">Pilih Mentor untuk penetapan massal:</label>
                        <select name="mentor_id" class="bg-slate-700 text-white px-3 py-2 rounded-md">
                            <option value="">-- Pilih Mentor --</option>
                            @foreach($mentors as $mentor)
                                <option value="{{ $mentor->id }}">{{ $mentor->user->name }} ({{ $mentor->user->email }})</option>
                            @endforeach
                        </select>
                        <button type="submit" class="ml-2 bg-gradient-to-r from-cyan-500 to-blue-600 text-white px-4 py-2 rounded-md">Tetapkan ke yang kosong</button>
                    </div>
                </form>
            </div>

            <div class="glass-dark rounded-2xl overflow-hidden">
                <div class="p-4 border-b border-slate-700 flex items-center justify-between">
                    <h2 class="text-lg text-white font-semibold">Daftar Siswa</h2>
                    <p class="text-slate-400 text-sm">Tentukan mentor untuk masing-masing siswa.</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-sm text-slate-300">
                        <thead class="bg-slate-800/50 text-cyan-400 uppercase font-bold tracking-wider">
                            <tr>
                                <th class="px-6 py-3">No</th>
                                <th class="px-6 py-3">Nama</th>
                                <th class="px-6 py-3">NISN</th>
                                <th class="px-6 py-3">Kelas / Jurusan</th>
                                <th class="px-6 py-3">Mentor Saat Ini</th>
                                <th class="px-6 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-700">
                            @forelse($siswas as $i => $siswa)
                                <tr>
                                    <td class="px-6 py-4 align-top">{{ $i + 1 }}</td>
                                    <td class="px-6 py-4 font-bold text-white">{{ $siswa->user->name }}</td>
                                    <td class="px-6 py-4 font-mono text-cyan-200">{{ $siswa->nisn }}</td>
                                    <td class="px-6 py-4">{{ $siswa->kelas }} / {{ $siswa->jurusan }}</td>
                                    <td class="px-6 py-4">
                                        @if($siswa->mentor)
                                            <div class="text-sm text-slate-200">{{ $siswa->mentor->user->name }}</div>
                                            <div class="text-xs text-slate-400">{{ $siswa->mentor->user->email }}</div>
                                        @else
                                            <span class="text-yellow-300">Belum ditetapkan</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('admin.siswa.assignMentor', $siswa->id) }}" method="POST" class="flex items-center space-x-2">
                                            @csrf
                                            <select name="mentor_id" class="bg-slate-700 text-white px-3 py-2 rounded-md">
                                                <option value="">-- Pilih Mentor --</option>
                                                @foreach($mentors as $mentor)
                                                    <option value="{{ $mentor->id }}" @if(optional($siswa->mentor)->id == $mentor->id) selected @endif>{{ $mentor->user->name }} ({{ $mentor->user->email }})</option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="bg-green-600 text-white px-3 py-2 rounded-md">Simpan</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6" class="px-6 py-10 text-center text-slate-500">Belum ada data siswa.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
