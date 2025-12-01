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
    <!-- CSS KHUSUS TEMA CYBER -->
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
    </style>

    <div class="pt-24 pb-12 min-h-screen bg-[#0f172a] relative">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 relative z-10">
            
            <!-- JUDUL -->
            <div class="mb-6">
                <a href="<?php echo e(route('siswa.dashboard')); ?>" class="text-cyan-400 hover:text-cyan-300 mb-2 inline-block transition-transform hover:-translate-x-1">&larr; Kembali ke Dashboard</a>
                <h2 class="text-3xl font-bold text-white">Input Laporan Harian PKL</h2>
                <p class="text-slate-400">Tanggal: <?php echo e(date('d M Y')); ?></p>
            </div>

            <!-- Pesan Peringatan Jika Sudah Lapor Hari Ini -->
            <?php if(isset($hasReportedToday) && $hasReportedToday): ?>
                <div class="bg-yellow-800/50 p-4 rounded-xl border border-yellow-600 text-yellow-200 mb-6">
                    ⚠️ Anda sudah mengisi laporan untuk hari ini. Anda tidak dapat mengisi laporan ganda.
                </div>
            <?php endif; ?>

            <!-- FORM CARD -->
            <div class="glass-dark rounded-2xl p-8">
                <!-- Tambahkan disabled jika sudah lapor hari ini -->
                <form action="<?php echo e(route('siswa.laporan.store')); ?>" method="POST" enctype="multipart/form-data" <?php if(isset($hasReportedToday) && $hasReportedToday): ?> onsubmit="return false;" <?php endif; ?>>
                    <?php echo csrf_field(); ?> 

                    <!-- Bagian 1: Jam & Kegiatan -->
                    <div class="mb-6 border-b border-slate-700 pb-6">
                        <h3 class="text-cyan-400 font-bold mb-4 uppercase tracking-wider text-sm">1. Presensi & Kegiatan</h3>
                        
                        <!-- Cek Error -->
                        <?php if($errors->any()): ?>
                            <div class="bg-red-800/50 p-3 rounded-md text-red-300 mb-4 text-sm border border-red-600">
                                Mohon periksa kembali input Anda (terutama Jam Keluar/Masuk dan Detail Kegiatan).
                            </div>
                        <?php endif; ?>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-slate-400 mb-2 text-sm">Jam Masuk (Wajib)</label>
                                <input type="time" name="jam_masuk" value="<?php echo e(old('jam_masuk')); ?>" class="w-full rounded-lg px-4 py-2 <?php $__errorArgs = ['jam_masuk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required <?php if(isset($hasReportedToday) && $hasReportedToday): ?> disabled <?php endif; ?>>
                            </div>
                            <div>
                                <label class="block text-slate-400 mb-2 text-sm">Jam Keluar (Opsional)</label>
                                <input type="time" name="jam_keluar" value="<?php echo e(old('jam_keluar')); ?>" class="w-full rounded-lg px-4 py-2 <?php $__errorArgs = ['jam_keluar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" <?php if(isset($hasReportedToday) && $hasReportedToday): ?> disabled <?php endif; ?>>
                                <?php $__errorArgs = ['jam_keluar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="text-red-400 text-xs mt-1"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div>
                            <label class="block text-slate-400 mb-2 text-sm">Detail Kegiatan Hari Ini (Min. 20 Karakter)</label>
                            <textarea name="detail_kegiatan" rows="6" class="w-full rounded-lg px-4 py-2 <?php $__errorArgs = ['detail_kegiatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required <?php if(isset($hasReportedToday) && $hasReportedToday): ?> disabled <?php endif; ?> placeholder="Jelaskan secara rinci apa yang Anda kerjakan hari ini..."><?php echo e(old('detail_kegiatan')); ?></textarea>
                             <?php $__errorArgs = ['detail_kegiatan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-400 text-xs mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <!-- Bagian 2: Bukti Pendukung -->
                    <div class="mb-6">
                        <h3 class="text-cyan-400 font-bold mb-4 uppercase tracking-wider text-sm">2. Bukti & Lampiran (Opsional)</h3>
                        
                        <div>
                            <label class="block text-slate-400 mb-2 text-sm">Unggah Bukti (Foto/Dokumen)</label>
                            <input type="file" name="path_bukti" class="w-full text-slate-300 border border-slate-700 rounded-lg p-2 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600 <?php $__errorArgs = ['path_bukti'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" <?php if(isset($hasReportedToday) && $hasReportedToday): ?> disabled <?php endif; ?>>
                            <p class="text-xs text-slate-500 mt-1">Format: JPG, PNG, PDF. Maks 2MB.</p>
                            <?php $__errorArgs = ['path_bukti'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="text-red-400 text-xs mt-1"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="flex justify-end mt-8">
                        <button type="submit" class="bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-bold py-3 px-8 rounded-xl shadow-[0_0_20px_rgba(6,182,212,0.4)] hover:shadow-[0_0_30px_rgba(6,182,212,0.6)] transition-all transform hover:scale-105 disabled:opacity-50" <?php if(isset($hasReportedToday) && $hasReportedToday): ?> disabled <?php endif; ?>>
                            Kirim Laporan
                        </button>
                    </div>

                </form>
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
<?php endif; ?><?php /**PATH C:\xampp\htdocs\simm_ukk\resources\views/siswa/laporan/create.blade.php ENDPATH**/ ?>