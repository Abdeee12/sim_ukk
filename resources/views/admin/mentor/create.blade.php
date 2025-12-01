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
        input:focus, select:focus { border-color: #10b981 !important; box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2) !important; } /* Focus Hijau */
        
        /* Hilangkan spinner pada input number */
        input::-webkit-outer-spin-button, input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
        input[type=number] { -moz-appearance: textfield; }
        
        /* Gaya Khusus Error */
        .input-error { border-color: #f87171 !important; } /* Border Merah saat Error */
    </style>

    <div class="pt-24 pb-12 min-h-screen bg-[#0f172a] relative">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 relative z-10">
            
            <!-- JUDUL -->
            <div class="mb-6 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-slate-800/50 rounded-xl border border-emerald-500/30 shadow-[0_0_15px_rgba(16,185,129,0.2)]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>
                    <div>
                        <a href="{{ route('admin.mentor.index') }}" class="text-emerald-400 hover:text-emerald-300 text-sm mb-1 inline-block transition-transform hover:-translate-x-1">&larr; Kembali</a>
                        <h2 class="text-3xl font-bold text-white">Tambah Mentor Baru</h2>
                    </div>
                </div>
            </div>

            <!-- ALERT ERROR UMUM -->
            @if ($errors->any())
                <div class="bg-red-800/50 p-4 rounded-xl border border-red-600 text-red-200 mb-6">
                    Terdapat {{ $errors->count() }} kesalahan dalam pengisian formulir. Mohon cek kembali data Anda.
                </div>
            @endif

            <!-- FORM CARD -->
            <div class="glass-dark rounded-2xl p-8">
                <form action="{{ route('admin.mentor.store') }}" method="POST">
                    @csrf
                    
                    <!-- BAGIAN 1: AKUN LOGIN -->
                    <div class="mb-6 border-b border-slate-700 pb-4">
                        <h3 class="text-emerald-400 font-bold mb-4 uppercase tracking-wider text-sm">1. Informasi Akun</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <div>
                                <label class="block text-slate-400 mb-2 text-sm">Nama Lengkap</label>
                                <input type="text" name="name" 
                                       value="{{ old('name') }}"
                                       class="w-full rounded-lg px-4 py-2 @error('name') input-error @enderror" 
                                       required placeholder="Nama Mentor">
                                @error('name')
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="block text-slate-400 mb-2 text-sm">Email</label>
                                <input type="email" name="email" 
                                       value="{{ old('email') }}"
                                       class="w-full rounded-lg px-4 py-2 @error('email') input-error @enderror" 
                                       required placeholder="email@perusahaan.com">
                                @error('email')
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- BAGIAN 2: BIODATA PERUSAHAAN -->
                    <div class="mb-6">
                        <h3 class="text-emerald-400 font-bold mb-4 uppercase tracking-wider text-sm">2. Data Perusahaan</h3>
                        <div class="mb-4">
                            <label class="block text-slate-400 mb-2 text-sm">Nama Perusahaan</label>
                            <input type="text" name="nama_perusahaan" 
                                   value="{{ old('nama_perusahaan') }}"
                                   class="w-full rounded-lg px-4 py-2 @error('nama_perusahaan') input-error @enderror" 
                                   required placeholder="PT. CyberLabs Indonesia">
                            @error('nama_perusahaan')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-slate-400 mb-2 text-sm">Jabatan</label>
                                <input type="text" name="jabatan" 
                                       value="{{ old('jabatan') }}"
                                       class="w-full rounded-lg px-4 py-2 @error('jabatan') input-error @enderror" 
                                       required placeholder="Senior Developer">
                                @error('jabatan')
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-slate-400 mb-2 text-sm">Nomor HP</label>
                                <input type="text" name="no_hp" 
                                       value="{{ old('no_hp') }}"
                                       class="w-full rounded-lg px-4 py-2 font-mono @error('no_hp') input-error @enderror" 
                                       placeholder="0812xxxx" 
                                       inputmode="numeric" 
                                       oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                @error('no_hp')
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end mt-8">
                        <button type="submit" class="bg-gradient-to-r from-emerald-500 to-green-600 text-white font-bold py-3 px-8 rounded-xl shadow-[0_0_20px_rgba(16,185,129,0.4)] hover:shadow-[0_0_30px_rgba(16,185,129,0.6)] transition-all transform hover:scale-105">
                            Simpan Data Mentor
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>