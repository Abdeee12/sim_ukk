<x-app-layout>
    <style>
        /* match admin/siswa theme */
        nav { background-color: rgba(15, 23, 42, 0.95) !important; backdrop-filter: blur(10px); border-bottom: none !important; box-shadow: none !important; position: absolute; width: 100%; z-index: 50; }
        .min-h-screen.bg-gray-100 { background-color: #0f172a !important; }
        /* disable entrance animation to avoid cards rendering with opacity 0 */
        .animate-card { animation: none !important; opacity: 1 !important; transform: none !important; }
        .glass-dark { background: rgba(30, 41, 59, 0.68); backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,0.03); }
        .hover-neon:hover { transform: translateY(-6px); box-shadow: 0 8px 30px rgba(6, 182, 212, 0.08); }
    </style>

    <div class="pt-24 pb-12 min-h-screen relative overflow-hidden bg-[#0f172a]">
        <!-- large decorative blurs removed for clarity; kept subtle hover glows on each card instead -->

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <div class="rounded-3xl p-0.5 bg-gradient-to-r from-cyan-500 via-blue-600 to-purple-600 mb-8 animate-card shadow-[0_0_40px_rgba(6,182,212,0.06)]">
                <div class="bg-slate-900 rounded-[22px] p-6 relative overflow-hidden">
                    <div class="relative z-10 flex flex-col md:flex-row items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="relative">
                                <div class="relative w-16 h-16 bg-slate-800 rounded-2xl flex items-center justify-center text-3xl border border-slate-600">👩‍🏫</div>
                            </div>
                            <div>
                                <h1 class="text-2xl md:text-3xl font-bold text-white">Panel Mentor</h1>
                                <p class="text-slate-400 text-sm">Kelola verifikasi laporan siswa — tema konsisten dengan Admin & Siswa.</p>
                            </div>
                        </div>

                        <div class="mt-4 md:mt-0 glass-dark px-6 py-3 rounded-xl text-center border-t-4 border-t-cyan-500">
                            <span class="text-[10px] text-cyan-400 uppercase tracking-widest font-bold">HARI INI</span>
                            <div class="text-2xl font-mono font-bold text-white tracking-widest">{{ date('d M Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
                <a href="{{ route('mentor.laporan.pending') }}" class="group block h-full">
                    <div class="glass-dark rounded-3xl p-6 hover-neon h-full relative overflow-hidden group min-h-[220px] flex flex-col">
                        {{-- Header --}}
                        <div class="flex items-start justify-between w-full mb-3">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 rounded-2xl bg-slate-800 flex items-center justify-center border border-slate-700">
                                    <!-- Pending: clock icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2a10 10 0 100 20 10 10 0 000-20z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-white">Laporan Pending</h3>
                                    <p class="text-xs text-slate-400">Menunggu verifikasi</p>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="bg-slate-800 text-white text-sm font-bold px-3 py-1 rounded-full border border-slate-700">{{ $pendingCount ?? 0 }}</div>
                            </div>
                        </div>

                        {{-- Body (preview) --}}
                        <div class="flex-1 w-full">
                            @if(isset($pending) && $pending->count())
                                <ul class="space-y-2">
                                    @foreach($pending as $lap)
                                        <li class="text-sm text-slate-300 flex items-center justify-between">
                                            <a href="{{ route('mentor.laporan.show', $lap->id) }}" class="hover:underline">{{ optional($lap->siswa->user)->name ?? 'Siswa' }} — {{ \Carbon\Carbon::parse($lap->tanggal)->format('d M Y') }}</a>
                                            <span class="text-xs text-slate-500 ml-4">{{ strtoupper($lap->status) }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="text-sm text-slate-500">Tidak ada laporan pending.</div>
                            @endif
                        </div>

                        {{-- Footer --}}
                        <div class="w-full mt-4 text-right">
                            <a href="{{ route('mentor.laporan.pending') }}" class="text-xs text-cyan-400 hover:underline">Lihat Semua →</a>
                        </div>
                    </div>
                </a>

                <a href="{{ route('mentor.laporan.rejected') }}" class="group block h-full">
                    <div class="glass-dark rounded-3xl p-6 hover-neon h-full relative overflow-hidden group min-h-[220px] flex flex-col">
                        {{-- Header --}}
                        <div class="flex items-start justify-between w-full mb-3">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 rounded-2xl bg-slate-800 flex items-center justify-center border border-slate-700">
                                    <!-- Rejected: X / cross icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-rose-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-white">Laporan Ditolak</h3>
                                    <p class="text-xs text-slate-400">Dilaporkan kembali ke siswa</p>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="bg-slate-800 text-white text-sm font-bold px-3 py-1 rounded-full border border-slate-700">{{ $rejectedCount ?? 0 }}</div>
                            </div>
                        </div>

                        {{-- Body (preview) --}}
                        <div class="flex-1 w-full">
                            @if(isset($rejected) && $rejected->count())
                                <ul class="space-y-2">
                                    @foreach($rejected as $lap)
                                        <li class="text-sm text-slate-300 flex items-center justify-between">
                                            <a href="{{ route('mentor.laporan.show', $lap->id) }}" class="hover:underline">{{ optional($lap->siswa->user)->name ?? 'Siswa' }} — {{ \Carbon\Carbon::parse($lap->tanggal)->format('d M Y') }}</a>
                                            <span class="text-xs text-slate-500 ml-4">{{ strtoupper($lap->status) }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="text-sm text-slate-500">Tidak ada laporan ditolak.</div>
                            @endif
                        </div>

                        {{-- Footer --}}
                        <div class="w-full mt-4 text-right">
                            <a href="{{ route('mentor.laporan.rejected') }}" class="text-xs text-emerald-400 hover:underline">Lihat Semua →</a>
                        </div>
                    </div>
                </a>

                <a href="{{ route('mentor.laporan.completed') }}" class="group block h-full">
                    <div class="glass-dark rounded-3xl p-6 hover-neon h-full relative overflow-hidden group min-h-[220px] flex flex-col">
                        {{-- Header --}}
                        <div class="flex items-start justify-between w-full mb-3">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 rounded-2xl bg-slate-800 flex items-center justify-center border border-slate-700">
                                    <!-- Completed: check-circle icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2a10 10 0 100 20 10 10 0 000-20z" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-white">Laporan Selesai</h3>
                                    <p class="text-xs text-slate-400">Telah diverifikasi</p>
                                </div>
                            </div>
                            <div class="ml-4">
                                <div class="bg-slate-800 text-white text-sm font-bold px-3 py-1 rounded-full border border-slate-700">{{ $completedCount ?? 0 }}</div>
                            </div>
                        </div>

                        {{-- Body (preview) --}}
                        <div class="flex-1 w-full">
                            @if(isset($completed) && $completed->count())
                                <ul class="space-y-2">
                                    @foreach($completed as $lap)
                                        <li class="text-sm text-slate-300 flex items-center justify-between">
                                            <a href="{{ route('mentor.laporan.show', $lap->id) }}" class="hover:underline">{{ optional($lap->siswa->user)->name ?? 'Siswa' }} — {{ \Carbon\Carbon::parse($lap->tanggal)->format('d M Y') }}</a>
                                            <span class="text-xs text-slate-500 ml-4">{{ strtoupper($lap->status) }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div class="text-sm text-slate-500">Tidak ada laporan selesai.</div>
                            @endif
                        </div>

                        {{-- Footer --}}
                        <div class="w-full mt-4 text-right">
                            <a href="{{ route('mentor.laporan.completed') }}" class="text-xs text-indigo-400 hover:underline">Lihat Semua →</a>
                        </div>
                    </div>
                </a>
            </div>

            <div class="mt-8 animate-card delay-300">
                <div class="glass-dark rounded-xl p-4 flex items-center justify-between border-l-4 border-cyan-500">
                    <div class="flex items-center space-x-4">
                        <div class="text-cyan-400 animate-pulse">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M13 16h-1v-4h-1m1-4h.01" /></svg>
                        </div>
                        <p class="text-sm text-slate-300">Tema dan gaya diselaraskan dengan panel Admin & Siswa.</p>
                    </div>
                    <span class="text-xs text-slate-500 font-mono">v2.0 Mentor</span>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>