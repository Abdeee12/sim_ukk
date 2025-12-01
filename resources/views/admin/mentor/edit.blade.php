<x-app-layout>
    <!-- CSS TEMA CYBER -->
    <style>
        /* CSS untuk Navigasi, Background, dan Glassmorphism */
        nav { background-color: transparent !important; backdrop-filter: none !important; border-bottom: none !important; box-shadow: none !important; position: absolute; width: 100%; z-index: 50; }
        nav .shrink-0, nav .shrink-0 a, nav .shrink-0 svg { display: none !important; }
        nav .text-gray-500, nav .text-gray-800, nav a, nav button { color: #e2e8f0 !important; }
        .min-h-screen.bg-gray-100 { background-color: #0f172a !important; }
        .glass-dark { background: rgba(30, 41, 59, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(16, 185, 129, 0.3); } /* Border Hijau */
        
        /* Input Style */
        input, select { background-color: #1e293b !important; border: 1px solid #334155 !important; color: white !important; }
        input:focus, select:focus { border-color: #10b981 !important; box-shadow: 0 0 0 2px rgba(16, 185, 129, 0.2) !important; } /* Focus Hijau */
        
        /* Hilangkan spinner */
        input::-webkit-outer-spin-button, input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
        input[type=number] { -moz-appearance: textfield; }
    </style>

    <div class="pt-24 pb-12 min-h-screen bg-[#0f172a] relative">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 relative z-10">
            
            <!-- JUDUL -->
            <div class="mb-6">
                <a href="{{ route('admin.mentor.index') }}" class="text-emerald-400 hover:text-emerald-300 mb-2 inline-block transition-transform hover:-translate-x-1">&larr; Kembali ke Daftar Mentor</a>
                <h2 class="text-3xl font-bold text-white">Edit Data Mentor</h2>
            </div>

            <!-- Form Card -->
            <div class="glass-dark rounded-2xl p-8 border-l-4 border-emerald-500">
                <form action="{{ route('admin.mentor.update', $mentor->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- PENTING: Method PUT untuk Update -->

                    <!-- BAGIAN 1: AKUN LOGIN -->
                    <div class="mb-6 border-b border-slate-700 pb-4">
                        <h3 class="text-emerald-400 font-bold mb-4 uppercase tracking-wider text-sm">1. Informasi Akun</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-slate-400 mb-2 text-sm">Nama Lengkap</label>
                                <!-- Mengambil data lama dari relasi $mentor->user->name -->
                                <input type="text" name="name" 
                                       value="{{ old('name', $mentor->user->name) }}" 
                                       class="w-full rounded-lg px-4 py-2" required>
                            </div>
                            <div>
                                <label class="block text-slate-400 mb-2 text-sm">Email</label>
                                <!-- Mengambil data lama dari relasi $mentor->user->email -->
                                <input type="email" name="email" 
                                       value="{{ old('email', $mentor->user->email) }}" 
                                       class="w-full rounded-lg px-4 py-2" required>
                            </div>
                        </div>
                    </div>

                    <!-- BAGIAN 2: DATA PERUSAHAAN -->
                    <div class="mb-6">
                        <h3 class="text-emerald-400 font-bold mb-4 uppercase tracking-wider text-sm">2. Data Perusahaan</h3>
                        
                        <div class="mb-4">
                            <label class="block text-slate-400 mb-2 text-sm">Nama Perusahaan</label>
                            <input type="text" name="nama_perusahaan" 
                                   value="{{ old('nama_perusahaan', $mentor->nama_perusahaan) }}" 
                                   class="w-full rounded-lg px-4 py-2" required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-slate-400 mb-2 text-sm">Jabatan</label>
                                <input type="text" name="jabatan" 
                                       value="{{ old('jabatan', $mentor->jabatan) }}" 
                                       class="w-full rounded-lg px-4 py-2" required>
                            </div>
                            <div>
                                <label class="block text-slate-400 mb-2 text-sm">Nomor HP</label>
                                <input type="text" name="no_hp" 
                                       value="{{ old('no_hp', $mentor->no_hp) }}" 
                                       class="w-full rounded-lg px-4 py-2 font-mono" 
                                       placeholder="0812xxxx" 
                                       inputmode="numeric" 
                                       oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="flex justify-end mt-8 space-x-4">
                         <a href="{{ route('admin.mentor.index') }}" class="px-6 py-3 rounded-xl border border-slate-600 text-slate-300 hover:bg-slate-800 transition">Batal</a>
                        <button type="submit" class="bg-gradient-to-r from-emerald-500 to-green-600 text-white font-bold py-3 px-8 rounded-xl shadow-[0_0_20px_rgba(16,185,129,0.4)] hover:shadow-[0_0_30px_rgba(16,185,129,0.6)] transition-all transform hover:scale-105">
                            Simpan Perubahan
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>