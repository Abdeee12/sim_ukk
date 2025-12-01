<x-app-layout>
    <style>
        /* Fix Header Transparan, Hapus Logo */
        nav { background-color: transparent !important; backdrop-filter: none !important; border-bottom: none !important; box-shadow: none !important; position: absolute; width: 100%; z-index: 50; }
        nav .shrink-0, nav .shrink-0 a, nav .shrink-0 svg { display: none !important; }
        nav .text-gray-500, nav .text-gray-800, nav a, nav button { color: #e2e8f0 !important; }
        .min-h-screen.bg-gray-100 { background-color: #0f172a !important; }
        .glass-dark { background: rgba(30, 41, 59, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(56, 189, 248, 0.2); }
        
        /* Input Style */
        input:not([type="file"]), textarea, select { background-color: #1e293b !important; border: 1px solid #334155 !important; color: white !important; }
        input:focus, textarea:focus, select:focus { border-color: #06b6d4 !important; box-shadow: 0 0 0 2px rgba(6, 182, 212, 0.2) !important; }
        input[type="time"]::-webkit-calendar-picker-indicator { filter: invert(1); } /* Ikon Jam Putih */

        /* Hilangkan spinner pada input number */
        input::-webkit-outer-spin-button, input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
        input[type=number] { -moz-appearance: textfield; }

        /* Gaya Khusus Error */
        .input-error { border-color: #f87171 !important; } 
    </style>

    <div class="pt-24 pb-12 min-h-screen bg-[#0f172a] relative">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 relative z-10">
            
            <div class="mb-6">
                <a href="{{ route('siswa.dashboard') }}" class="text-cyan-400 hover:text-cyan-300 mb-2 inline-block transition-transform hover:-translate-x-1">&larr; Kembali ke Dashboard</a>
                <h2 class="text-3xl font-bold text-white">Input Laporan Harian PKL</h2>
                <p class="text-slate-400">Tanggal: {{ date('d M Y') }}</p>
            </div>

            @if(isset($hasReportedToday) && $hasReportedToday)
                <div class="bg-yellow-800/50 p-4 rounded-xl border border-yellow-600 text-yellow-200 mb-6">
                    ⚠️ Anda sudah mengisi laporan untuk hari ini. Anda tidak dapat mengisi laporan ganda.
                </div>
            @endif

            <div class="glass-dark rounded-2xl p-8">
                <form action="{{ route('siswa.laporan.store') }}" method="POST" enctype="multipart/form-data" @if(isset($hasReportedToday) && $hasReportedToday) onsubmit="return false;" @endif>
                    @csrf 

                    @if ($errors->any())
                        <div class="bg-red-800/50 p-3 rounded-md text-red-300 mb-4 text-sm border border-red-600">
                            Mohon periksa kembali input Anda (terutama Jam Keluar/Masuk dan Detail Kegiatan).
                        </div>
                    @endif

                    <div class="mb-6 border-b border-slate-700 pb-6">
                        <h3 class="text-cyan-400 font-bold mb-4 uppercase tracking-wider text-sm">1. Presensi & Kegiatan</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-slate-400 mb-2 text-sm">Jam Masuk (Wajib)</label>
                                <input type="time" name="jam_masuk" value="{{ old('jam_masuk') }}" class="w-full rounded-lg px-4 py-2 @error('jam_masuk') input-error @enderror" required @if(isset($hasReportedToday) && $hasReportedToday) disabled @endif>
                                @error('jam_masuk') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label class="block text-slate-400 mb-2 text-sm">Jam Keluar (Opsional)</label>
                                <input type="time" name="jam_keluar" value="{{ old('jam_keluar') }}" class="w-full rounded-lg px-4 py-2 @error('jam_keluar') input-error @enderror" @if(isset($hasReportedToday) && $hasReportedToday) disabled @endif>
                                @error('jam_keluar')
                                    <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-slate-400 mb-2 text-sm">Detail Kegiatan Hari Ini (Min. 20 Karakter)</label>
                            <textarea name="detail_kegiatan" rows="6" class="w-full rounded-lg px-4 py-2 @error('detail_kegiatan') input-error @enderror" required @if(isset($hasReportedToday) && $hasReportedToday) disabled @endif placeholder="Jelaskan secara rinci apa yang Anda kerjakan hari ini...">{{ old('detail_kegiatan') }}</textarea>
                             @error('detail_kegiatan')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-cyan-400 font-bold mb-4 uppercase tracking-wider text-sm">2. Bukti & Lampiran (Opsional)</h3>
                        
                        <div>
                            <label class="block text-slate-400 mb-2 text-sm">Unggah Bukti (Foto/Dokumen)</label>
                            <input type="file" name="path_bukti" class="w-full text-slate-300 border border-slate-700 rounded-lg p-2 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600 @error('path_bukti') input-error @enderror" @if(isset($hasReportedToday) && $hasReportedToday) disabled @endif>
                            <p class="text-xs text-slate-500 mt-1">Format: JPG, PNG, PDF. Maks 2MB.</p>
                            @error('path_bukti')
                                <p class="text-red-400 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end mt-8">
                        <button type="submit" class="bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-bold py-3 px-8 rounded-xl shadow-[0_0_20px_rgba(6,182,212,0.4)] hover:shadow-[0_0_30px_rgba(6,182,212,0.6)] transition-all transform hover:scale-105 disabled:opacity-50" @if(isset($hasReportedToday) && $hasReportedToday) disabled @endif>
                            Kirim Laporan
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</x-app-layout>