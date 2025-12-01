<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <style>
        /* Fix Header Transparan, Hapus Logo */
        nav { background-color: rgba(15, 23, 42, 0.95) !important; backdrop-filter: none !important; border-bottom: none !important; box-shadow: none !important; position: absolute; width: 100%; z-index: 50; }
        nav .shrink-0, nav .shrink-0 a, nav .shrink-0 svg { display: none !important; }
        nav .text-gray-500, nav .text-gray-800, nav a, nav button { color: #e2e8f0 !important; transition: color 0.3s; }
        nav .text-gray-500:hover, nav a:hover, nav button:hover { color: #22d3ee !important; text-shadow: 0 0 10px rgba(34, 211, 238, 0.6); }
        .min-h-screen.bg-gray-100 { background-color: #0f172a !important; }
        
        /* Glassmorphism & Hover */
        .glass-dark { background: rgba(30, 41, 59, 0.6); backdrop-filter: blur(12px); border: 1px solid rgba(56, 189, 248, 0.2); }
        .hover-neon { transition: all 0.3s ease; }
        .hover-neon:hover { transform: translateY(-3px); box-shadow: 0 0 20px rgba(6, 182, 212, 0.3); border-color: rgba(6, 182, 212, 0.6); }
        
        /* Table Hover */
        tr.hover-row:hover td { background-color: rgba(56, 189, 248, 0.1); color: #ffffff; }
    </style>

    <div class="pt-24 pb-12 min-h-screen bg-[#0f172a] relative overflow-hidden">
        
        <div class="absolute top-0 left-0 w-[600px] h-[600px] bg-cyan-600 rounded-full mix-blend-screen filter blur-[150px] opacity-15 animate-pulse"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg-px-8 relative z-10">
            
            <?php if(session('success')): ?>
                <div class="bg-green-800/50 p-4 rounded-xl border border-green-600 text-green-200 mb-6 flex justify-between">
                    <span>✅ <?php echo e(session('success')); ?></span>
                    <button onclick="this.parentElement.style.display='none';" class="text-green-200 font-bold ml-4">X</button>
                </div>
            <?php endif; ?>

            <div class="glass-dark rounded-2xl p-6 mb-8 border-l-4 border-cyan-500">
                <div class="flex items-center space-x-6">
                    <div class="w-16 h-16 bg-cyan-500/10 rounded-full flex items-center justify-center text-3xl border border-cyan-500/30">
                        🎓
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white">Halo, <?php echo e($siswa->user->name); ?>!</h1>
                        <p class="text-slate-400">
                            <?php echo e($siswa->kelas); ?> <?php echo e($siswa->jurusan); ?> | NISN: <span class="font-mono text-cyan-300"><?php echo e($siswa->nisn); ?></span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                
                <a href="<?php echo e(route('siswa.createLaporan')); ?>" class="group block">
                    <div class="glass-dark p-6 rounded-xl hover-neon flex items-center space-x-4 border-l-4 border-blue-500">
                        <div class="text-blue-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-white group-hover:text-cyan-400">Input Laporan</h3>
                            <p class="text-xs text-slate-400">Wajib diisi setiap hari!</p>
                        </div>
                    </div>
                </a>
                
                <div class="glass-dark p-6 rounded-xl flex items-center space-x-4 border-l-4 border-purple-500">
                    <div class="text-purple-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    <div>
                        <h3 class="font-bold text-white">Total Laporan</h3>
                        <p class="text-xs text-purple-400 font-bold"><?php echo e($laporans->count()); ?> Hari</p>
                    </div>
                </div>

                <div class="glass-dark p-6 rounded-xl flex items-center space-x-4 border-l-4 border-yellow-500">
                    <div class="text-yellow-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-white">Status Mentor</h3>
                        <?php if(optional($siswa)->mentor): ?>
                            <p class="text-sm text-yellow-200">Ditugaskan ke: <span class="font-bold text-white"><?php echo e($siswa->mentor->user->name); ?></span></p>
                            <p class="text-xs text-slate-400">Email: <span class="font-mono text-cyan-300"><?php echo e($siswa->mentor->user->email); ?></span></p>
                        <?php else: ?>
                            <p class="text-xs text-yellow-400 font-bold">Belum Ditetapkan</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="mt-10">
                <h2 class="text-2xl font-bold text-white mb-4">Riwayat Laporan Harian</h2>
                
                <div class="glass-dark rounded-2xl overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-left text-sm text-slate-300">
                            <thead class="bg-slate-800/50 text-cyan-400 uppercase font-bold tracking-wider border-b border-slate-700">
                                <tr>
                                    <th class="px-6 py-4">Tanggal</th>
                                    <th class="px-6 py-4">Jam Masuk - Keluar</th>
                                    <th class="px-6 py-4">Kegiatan</th>
                                    <th class="px-6 py-4 text-center">Bukti</th>
                                    <th class="px-6 py-4 text-center">Status</th>
                                    <th class="px-6 py-4">Feedback Mentor</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-700">
                                <?php $__empty_1 = true; $__currentLoopData = $laporans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $laporan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr class="transition-colors hover-row">
                                        <td class="px-6 py-4 font-mono text-cyan-300"><?php echo e(\Carbon\Carbon::parse($laporan->tanggal)->format('d M Y')); ?></td>
                                        <td class="px-6 py-4"><?php echo e($laporan->jam_masuk); ?> - <?php echo e($laporan->jam_keluar ?? 'N/A'); ?></td>
                                        <td class="px-6 py-4 max-w-xs overflow-hidden truncate"><?php echo e(Str::limit($laporan->detail_kegiatan, 50)); ?></td>
                                        <td class="px-6 py-4 text-center">
                                            <?php if($laporan->path_bukti): ?>
                                                <a href="<?php echo e(Storage::url($laporan->path_bukti)); ?>" target="_blank" class="text-sm text-yellow-400 hover:text-yellow-300">Lihat Bukti</a>
                                            <?php else: ?>
                                                <span class="text-slate-500 text-xs">Tidak Ada</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <?php
                                                $color = ['pending' => 'bg-yellow-500', 'approved' => 'bg-green-500', 'rejected' => 'bg-red-500'][$laporan->status];
                                            ?>
                                            <span class="px-3 py-1 rounded-full text-xs font-bold text-white <?php echo e($color); ?>">
                                                <?php echo e(ucfirst($laporan->status)); ?>

                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-slate-400 text-sm italic">
                                            <?php echo e($laporan->feedback_mentor ?? 'Menunggu feedback...'); ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="6" class="px-6 py-10 text-center text-slate-500">Anda belum mengirim laporan harian. Klik tombol "Input Laporan" di atas.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\simm_ukk\resources\views/siswa/dashboard.blade.php ENDPATH**/ ?>