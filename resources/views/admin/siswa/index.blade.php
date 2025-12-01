<x-app-layout>
    <style>
        nav { background-color: transparent !important; backdrop-filter: none !important; border-bottom: none !important; box-shadow: none !important; position: absolute; width: 100%; z-index: 50; }
        nav .shrink-0, nav .shrink-0 a, nav .shrink-0 svg { display: none !important; }
        nav .text-gray-500, nav .text-gray-800, nav a, nav button { color: #e2e8f0 !important; transition: color 0.3s; }
        nav .text-gray-500:hover, nav a:hover, nav button:hover { color: #22d3ee !important; text-shadow: 0 0 10px rgba(34, 211, 238, 0.6); }
        .min-h-screen.bg-gray-100 { background-color: #0f172a !important; }
        .glass-dark { background: rgba(30, 41, 59, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(56, 189, 248, 0.2); box-shadow: 0 0 20px rgba(6, 182, 212, 0.1); }
        tr.hover-neon:hover td { background-color: rgba(6, 182, 212, 0.1); color: #ffffff; }
        .animate-fade-in-up { animation: fadeInUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards; opacity: 0; }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    </style>

    <div class="pt-24 pb-12 min-h-screen bg-[#0f172a] relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-cyan-600 rounded-full mix-blend-screen filter blur-[150px] opacity-10"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">
            
            <div class="flex flex-col md:flex-row justify-between items-center mb-8 animate-fade-in-up">
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-slate-800/50 rounded-xl border border-cyan-500/30 shadow-[0_0_15px_rgba(6,182,212,0.2)]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-white">Data Siswa</h2>
                        <p class="text-slate-400 text-sm">Kelola data siswa magang terdaftar.</p>
                    </div>
                </div>
                <a href="{{ route('admin.siswa.create') }}" class="mt-4 md:mt-0 bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-bold py-2 px-6 rounded-full shadow-[0_0_15px_rgba(6,182,212,0.5)] transition-all transform hover:scale-105">
                    + Tambah Siswa
                </a>
            </div>

            <div class="glass-dark rounded-2xl overflow-hidden animate-fade-in-up" style="animation-delay: 0.1s;">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-sm text-slate-300">
                        <thead class="bg-slate-800/50 text-cyan-400 uppercase font-bold tracking-wider border-b border-slate-700">
                            <tr>
                                <th class="px-6 py-4">No</th>
                                <th class="px-6 py-4">Nama Siswa</th>
                                <th class="px-6 py-4">NISN</th>
                                <th class="px-6 py-4">Kelas / Jurusan</th>
                                <th class="px-6 py-4">Mentor</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-700">
                            @forelse($siswas as $index => $siswa)
                                <tr class="transition-colors hover-neon">
                                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4 font-bold text-white">{{ $siswa->user->name }}</td>
                                    <td class="px-6 py-4 font-mono text-cyan-200">{{ $siswa->nisn }}</td>
                                    <td class="px-6 py-4">
                                        <span class="bg-slate-700 px-2 py-1 rounded text-xs text-white">{{ $siswa->kelas }}</span>
                                        <span class="ml-2">{{ $siswa->jurusan }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('admin.siswa.assignMentor', $siswa->id) }}" method="POST" class="flex items-center space-x-2">
                                            @csrf
                                            <select name="mentor_id" class="bg-slate-700 text-white px-2 py-1 rounded-md">
                                                <option value="">-- Tidak ada --</option>
                                                @foreach($mentors as $mentor)
                                                    <option value="{{ $mentor->id }}" @if(optional($siswa->mentor)->id == $mentor->id) selected @endif>{{ $mentor->user->name }}</option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded-md">Set</button>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 text-center flex justify-center space-x-2">
                                        <a href="{{ route('admin.siswa.edit', $siswa->id) }}" class="text-yellow-400 hover:text-yellow-300 transition">Edit</a>
                                        <span class="text-slate-600">|</span>
                                        <form action="{{ route('admin.siswa.destroy', $siswa->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-300 transition">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="px-6 py-10 text-center text-slate-500">Belum ada data siswa.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>