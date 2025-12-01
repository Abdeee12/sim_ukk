<x-app-layout>
    <style>
        /* CSS TEMA CYBER & HILANGKAN LOGO */
        nav { background-color: transparent !important; backdrop-filter: none !important; border-bottom: none !important; box-shadow: none !important; position: absolute; width: 100%; z-index: 50; }
        nav .shrink-0, nav .shrink-0 a, nav .shrink-0 svg { display: none !important; }
        nav .text-gray-500, nav .text-gray-800, nav a, nav button { color: #e2e8f0 !important; }
        .min-h-screen.bg-gray-100 { background-color: #0f172a !important; }
        .glass-dark { background: rgba(30, 41, 59, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(56, 189, 248, 0.2); }
        
        /* Input Style */
        input, select { background-color: #1e293b !important; border: 1px solid #334155 !important; color: white !important; }
        input:focus, select:focus { border-color: #06b6d4 !important; box-shadow: 0 0 0 2px rgba(6, 182, 212, 0.2) !important; } 
        
        /* Gaya Khusus Error */
        .input-error { border-color: #f87171 !important; } 

        /* Hilangkan spinner pada input number */
        input::-webkit-outer-spin-button, input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
        input[type=number] { -moz-appearance: textfield; }
    </style>

    <div class="pt-24 pb-12 min-h-screen bg-[#0f172a] relative">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 relative z-10">
            
            <div class="mb-6 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-slate-800/50 rounded-xl border border-cyan-500/30 shadow-[0_0_15px_rgba(6,182,212,0.2)]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>
                    <div>
                        <a href="{{ route('admin.siswa.index') }}" class="text-cyan-400 hover:text-cyan-300 text-sm mb-1 inline-block transition-transform hover:-translate-x-1">&larr; Kembali</a>
                        <h2 class="text-3xl font-bold text-white">Tambah Siswa Baru</h2>
                    </div>
                </div>
            </div>

            <div class="glass-dark rounded-2xl p-8">
                <form action="{{ route('admin.siswa.store') }}" method="POST">
                    @csrf

                    <div class="mb-6 border-b border-slate-700 pb-4">
                        <h3 class="text-cyan-400 font-bold mb-4 uppercase tracking-wider text-sm">1. Informasi Akun</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <div>
                                <label class="block text-slate-400 mb-2 text-sm">Nama Lengkap</label>
                                <input type="text" name="name" 
                                       value="{{ old('name') }}"
                                       class="w-full rounded-lg px-4 py-2 @error('name') input-error @enderror" 
                                       required placeholder="Contoh: Budi Santoso">
                                @error('name')
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="block text-slate-400 mb-2 text-sm">Email</label>
                                <input type="email" name="email" 
                                       value="{{ old('email') }}"
                                       class="w-full rounded-lg px-4 py-2 @error('email') input-error @enderror" 
                                       required placeholder="email@sekolah.sch.id">
                                @error('email')
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-cyan-400 font-bold mb-4 uppercase tracking-wider text-sm">2. Biodata Sekolah</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                            <div>
                                <label class="block text-slate-400 mb-2 text-sm">NISN (Angka Saja)</label>
                                <input type="text" name="nisn" 
                                       value="{{ old('nisn') }}"
                                       class="w-full rounded-lg px-4 py-2 font-mono @error('nisn') input-error @enderror" 
                                       required placeholder="1234567890" 
                                       inputmode="numeric" 
                                       oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                @error('nisn')
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-slate-400 mb-2 text-sm">Nomor HP (Angka Saja)</label>
                                <input type="text" name="nomor_hp" 
                                       value="{{ old('nomor_hp') }}"
                                       class="w-full rounded-lg px-4 py-2 font-mono @error('nomor_hp') input-error @enderror" 
                                       placeholder="0812xxxx" 
                                       inputmode="numeric" 
                                       oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                @error('nomor_hp')
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-slate-400 mb-2 text-sm">Kelas</label>
                                <select name="kelas" class="w-full rounded-lg px-4 py-2 @error('kelas') input-error @enderror">
                                    <option value="">-- Pilih Kelas --</option>
                                    <option value="X" {{ old('kelas') == 'X' ? 'selected' : '' }}>Kelas X</option>
                                    <option value="XI" {{ old('kelas') == 'XI' ? 'selected' : '' }}>Kelas XI</option>
                                    <option value="XII" {{ old('kelas') == 'XII' ? 'selected' : '' }}>Kelas XII</option>
                                </select>
                                @error('kelas')
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-slate-400 mb-2 text-sm">Jurusan</label>
                                <select name="jurusan" class="w-full rounded-lg px-4 py-2 @error('jurusan') input-error @enderror">
                                    <option value="">-- Pilih Jurusan --</option>
                                    <option value="RPL" {{ old('jurusan') == 'RPL' ? 'selected' : '' }}>Rekayasa Perangkat Lunak</option>
                                    <option value="TKJ" {{ old('jurusan') == 'TKJ' ? 'selected' : '' }}>Teknik Komputer Jaringan</option>
                                    <option value="DKV" {{ old('jurusan') == 'DKV' ? 'selected' : '' }}>Desain Komunikasi Visual</option>
                                    <option value="AKL" {{ old('jurusan') == 'AKL' ? 'selected' : '' }}>Akuntansi</option>
                                    <option value="OTKP" {{ old('jurusan') == 'OTKP' ? 'selected' : '' }}>Otomatisasi Tata Kelola Perkantoran</option>
                                </select>
                                @error('jurusan')
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end mt-8">
                        <button type="submit" class="bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-bold py-3 px-8 rounded-xl shadow-[0_0_20px_rgba(6,182,212,0.4)] hover:shadow-[0_0_30px_rgba(6,182,212,0.6)] transition-all transform hover:scale-105">
                            Simpan Data Siswa
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>