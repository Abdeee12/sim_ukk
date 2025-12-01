<x-app-layout>
    <style>
        /* FIX NAVIGASI TRANSPARAN */
        nav { background-color: rgba(15, 23, 42, 0.95) !important; backdrop-filter: blur(10px); border-bottom: none !important; box-shadow: none !important; position: absolute; width: 100%; z-index: 50; }
        nav .shrink-0, nav .shrink-0 a, nav .shrink-0 svg { display: none !important; }
        nav .text-gray-500, nav .text-gray-800, nav a, nav button { color: #e2e8f0 !important; transition: color 0.3s; }
        .min-h-screen.bg-gray-100 { background-color: #0f172a !important; }
        
        /* Animasi & Efek */
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        .animate-card { animation: fadeInUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards; opacity: 0; }
        .delay-100 { animation-delay: 0.1s; } .delay-200 { animation-delay: 0.2s; } .delay-300 { animation-delay: 0.3s; }
        .glass-dark { background: rgba(30, 41, 59, 0.6); backdrop-filter: blur(12px); border: 1px solid rgba(56, 189, 248, 0.2); }
        .hover-neon:hover { transform: translateY(-5px); box-shadow: 0 0 30px rgba(6, 182, 212, 0.4); border-color: rgba(6, 182, 212, 0.8); }
    </style>

    <div class="pt-24 pb-12 min-h-screen relative overflow-hidden bg-[#0f172a]">
        
        <div class="absolute top-0 left-0 w-[600px] h-[600px] bg-blue-700 rounded-full mix-blend-screen filter blur-[150px] opacity-20 animate-pulse"></div>
        <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-cyan-600 rounded-full mix-blend-screen filter blur-[150px] opacity-15"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">
            
            <div class="rounded-3xl p-0.5 bg-gradient-to-r from-cyan-500 via-blue-600 to-purple-600 mb-10 animate-card shadow-[0_0_40px_rgba(6,182,212,0.2)]">
                <div class="bg-slate-900 rounded-[22px] p-8 relative overflow-hidden">
                    
                    <div class="absolute inset-0 opacity-20" style="background-image: radial-gradient(#38bdf8 1px, transparent 1px); background-size: 30px 30px;"></div>

                    <div class="relative z-10 flex flex-col md:flex-row items-center justify-between">
                        <div class="flex items-center space-x-6">
                            <div class="relative">
                                <div class="absolute -inset-1 bg-gradient-to-r from-cyan-400 to-blue-600 rounded-2xl blur opacity-60"></div>
                                <div class="relative w-20 h-20 bg-slate-800 rounded-2xl flex items-center justify-center text-4xl border border-slate-600">👨‍💻</div>
                            </div>
                            <div>
                                <div class="flex items-center space-x-2 mb-1">
                                    <span class="text-cyan-400 text-lg">⚡</span>
                                    <h3 class="font-bold text-sm text-cyan-400 tracking-widest uppercase">Cyber Panel Admin</h3>
                                </div>
                                
                                <h1 class="text-3xl md:text-4xl font-bold text-white">
                                    Selamat Datang, <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-300 to-blue-400">Admin!</span>
                                </h1>
                                <div class="flex items-center mt-3 space-x-3">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-green-500/10 text-green-400 border border-green-500/20 flex items-center gap-1">
                                        <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span> ONLINE
                                    </span>
                                    <p class="text-slate-400 text-sm font-light">System v2.0 Ready</p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6 md:mt-0 glass-dark px-8 py-4 rounded-xl text-center border-t-4 border-t-cyan-500 shadow-lg">
                            <span class="text-[10px] text-cyan-400 uppercase tracking-widest font-bold">HARI INI</span>
                            <div class="text-3xl font-mono font-bold text-white tracking-widest drop-shadow-[0_0_8px_rgba(6,182,212,0.8)]">{{ date('d M Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <a href="{{ route('admin.siswa.index') }}" class="group animate-card delay-100 block h-full">
                    <div class="glass-dark rounded-3xl p-8 hover-neon h-full relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-40 h-40 bg-cyan-500 rounded-full blur-[80px] opacity-0 group-hover:opacity-20 transition-opacity duration-500"></div>
                        <div class="relative z-10 flex flex-col h-full justify-between">
                            <div class="flex justify-between items-start mb-6">
                                <div class="w-14 h-14 rounded-2xl bg-slate-800 flex items-center justify-center border border-slate-700 group-hover:border-cyan-500 group-hover:shadow-[0_0_15px_rgba(6,182,212,0.4)] transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 14l9-5-9-5-9 5 9 5z" /><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" /></svg>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-600 group-hover:text-cyan-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                            </div>
                            <div><h2 class="text-2xl font-bold text-white mb-2 group-hover:text-cyan-300 transition-colors">Siswa Magang</h2><p class="text-slate-400 text-sm">Kelola biodata, kelas, jurusan, dan penempatan.</p></div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.mentor.index') }}" class="group animate-card delay-200 block h-full">
                    <div class="glass-dark rounded-3xl p-8 hover-neon h-full relative overflow-hidden group">
                        <div class="absolute top-0 right-0 w-40 h-40 bg-emerald-500 rounded-full blur-[80px] opacity-0 group-hover:opacity-20 transition-opacity duration-500"></div>
                        <div class="relative z-10 flex flex-col h-full justify-between">
                            <div class="flex justify-between items-start mb-6">
                                <div class="w-14 h-14 rounded-2xl bg-slate-800 flex items-center justify-center border border-slate-700 group-hover:border-emerald-500 group-hover:shadow-[0_0_15px_rgba(16,185,129,0.4)] transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-600 group-hover:text-emerald-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                            </div>
                            <div><h2 class="text-2xl font-bold text-white mb-2 group-hover:text-emerald-300 transition-colors">Data Mentor</h2><p class="text-slate-400 text-sm">Kelola pembimbing industri.</p></div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.laporan.index') }}" class="group animate-card delay-300 block h-full">
                    <div class="glass-dark rounded-3xl p-8 h-full relative overflow-hidden group-hover:shadow-[0_0_20px_rgba(6,182,212,0.15)] transition-shadow">
                        <div class="absolute top-0 right-0 w-40 h-40 bg-indigo-600 rounded-full blur-[80px] opacity-0 group-hover:opacity-20 transition-opacity duration-500"></div>
                        <div class="w-14 h-14 rounded-2xl bg-slate-800 flex items-center justify-center border border-slate-700 mb-6"><svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg></div>
                        <div><h2 class="text-2xl font-bold text-white mb-2 group-hover:text-cyan-300 transition-colors">Laporan</h2><p class="text-slate-400 text-sm">Monitoring aktivitas harian.</p></div>
                    </div>
                </a>
            </div>

            <div class="mt-10 animate-card delay-300">
                <div class="glass-dark rounded-xl p-4 flex items-center justify-between border-l-4 border-cyan-500">
                    <div class="flex items-center space-x-4">
                        <div class="text-cyan-400 animate-pulse">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <p class="text-sm text-slate-300">Pastikan data <strong class="text-white">Siswa Magang</strong> selalu diperbarui setiap akhir pekan.</p>
                    </div>
                    <span class="text-xs text-slate-500 font-mono">v2.0.1 Stable</span>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>