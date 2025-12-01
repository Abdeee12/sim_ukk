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
        nav { background-color: transparent !important; backdrop-filter: none !important; border-bottom: none !important; box-shadow: none !important; position: absolute; width: 100%; z-index: 50; }
        nav .shrink-0, nav .shrink-0 a, nav .shrink-0 svg { display: none !important; }
        nav .text-gray-500, nav .text-gray-800, nav a, nav button { color: #e2e8f0 !important; transition: color 0.3s; }
        nav .text-gray-500:hover, nav a:hover, nav button:hover { color: #22d3ee !important; text-shadow: 0 0 10px rgba(34, 211, 238, 0.6); }
        .min-h-screen.bg-gray-100 { background-color: #0f172a !important; }
        .glass-dark { background: rgba(30, 41, 59, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(56, 189, 248, 0.2); box-shadow: 0 0 20px rgba(6, 182, 212, 0.1); }
        
        /* Table Hover & Animasi */
        tr.hover-neon:hover td { background-color: rgba(16, 185, 129, 0.1); color: #ffffff; } /* Warna Hover Hijau */
        .animate-fade-in-up { animation: fadeInUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards; opacity: 0; }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    </style>

    <div class="pt-24 pb-12 min-h-screen bg-[#0f172a] relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-emerald-600 rounded-full mix-blend-screen filter blur-[150px] opacity-10"></div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">
            
            <div class="flex flex-col md:flex-row justify-between items-center mb-8 animate-fade-in-up">
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-slate-800/50 rounded-xl border border-emerald-500/30 shadow-[0_0_15px_rgba(16,185,129,0.2)]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold text-white">Data Mentor</h2>
                        <p class="text-slate-400 text-sm">Kelola pembimbing dari industri/perusahaan.</p>
                    </div>
                </div>
                <a href="<?php echo e(route('admin.mentor.create')); ?>" class="mt-4 md:mt-0 bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-400 hover:to-green-500 text-white font-bold py-2 px-6 rounded-full shadow-[0_0_15px_rgba(16,185,129,0.5)] transition-all transform hover:scale-105">
                    + Tambah Mentor
                </a>
            </div>

            <div class="glass-dark rounded-2xl overflow-hidden animate-fade-in-up" style="animation-delay: 0.1s;">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-left text-sm text-slate-300">
                        <thead class="bg-slate-800/50 text-emerald-400 uppercase font-bold tracking-wider border-b border-slate-700">
                            <tr>
                                <th class="px-6 py-4">No</th>
                                <th class="px-6 py-4">Nama Mentor</th>
                                <th class="px-6 py-4">Perusahaan</th>
                                <th class="px-6 py-4">Jabatan</th>
                                <th class="px-6 py-4">No HP</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-700">
                            <?php $__empty_1 = true; $__currentLoopData = $mentors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $mentor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="transition-colors hover-neon">
                                    <td class="px-6 py-4"><?php echo e($index + 1); ?></td>
                                    <td class="px-6 py-4 font-bold text-white"><?php echo e($mentor->user->name); ?></td>
                                    <td class="px-6 py-4 font-bold text-emerald-300"><?php echo e($mentor->nama_perusahaan); ?></td>
                                    <td class="px-6 py-4"><?php echo e($mentor->jabatan); ?></td>
                                    <td class="px-6 py-4 font-mono"><?php echo e($mentor->no_hp); ?></td>
                                    <td class="px-6 py-4 text-center flex justify-center space-x-4">
                                        
                                        <a href="<?php echo e(route('admin.mentor.edit', $mentor->id)); ?>" class="text-yellow-400 hover:text-yellow-300 transition transform hover:scale-110" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        <form action="<?php echo e(route('admin.mentor.destroy', $mentor->id)); ?>" method="POST" onsubmit="return confirm('Yakin hapus mentor <?php echo e($mentor->user->name); ?>?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="text-red-400 hover:text-red-300 transition transform hover:scale-110" title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr><td colspan="6" class="px-6 py-10 text-center text-slate-500">Belum ada data mentor. Klik Tambah Mentor untuk memulai.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
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
<?php endif; ?><?php /**PATH C:\xampp\htdocs\simm_ukk\resources\views/admin/mentor/index.blade.php ENDPATH**/ ?>