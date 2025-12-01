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
        /* Reuse theme from create view */
        nav { background-color: transparent !important; backdrop-filter: none !important; border-bottom: none !important; box-shadow: none !important; position: absolute; width: 100%; z-index: 50; }
        nav .shrink-0, nav .shrink-0 a, nav .shrink-0 svg { display: none !important; }
        nav .text-gray-500, nav .text-gray-800, nav a, nav button { color: #e2e8f0 !important; }
        .min-h-screen.bg-gray-100 { background-color: #0f172a !important; }
        .glass-dark { background: rgba(30, 41, 59, 0.7); backdrop-filter: blur(10px); border: 1px solid rgba(56, 189, 248, 0.2); }
        input, select { background-color: #1e293b !important; border: 1px solid #334155 !important; color: white !important; }
        input:focus, select:focus { border-color: #06b6d4 !important; box-shadow: 0 0 0 2px rgba(6, 182, 212, 0.2) !important; }
        .input-error { border-color: #f87171 !important; }
    </style>

    <div class="pt-24 pb-12 min-h-screen bg-[#0f172a] relative">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <div class="mb-6 flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="p-3 bg-slate-800/50 rounded-xl border border-cyan-500/30 shadow-[0_0_15px_rgba(6,182,212,0.2)]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <a href="<?php echo e(route('admin.siswa.index')); ?>" class="text-cyan-400 hover:text-cyan-300 text-sm mb-1 inline-block transition-transform hover:-translate-x-1">&larr; Kembali</a>
                        <h2 class="text-3xl font-bold text-white">Edit Data Siswa</h2>
                    </div>
                </div>
            </div>

            <div class="glass-dark rounded-2xl p-8">
                <form action="<?php echo e(route('admin.siswa.update', $siswa->id)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>

                    <div class="mb-6 border-b border-slate-700 pb-4">
                        <h3 class="text-cyan-400 font-bold mb-4 uppercase tracking-wider text-sm">1. Informasi Akun</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-slate-400 mb-2 text-sm">Nama Lengkap</label>
                                <input type="text" name="name" value="<?php echo e(old('name', $siswa->user->name)); ?>" class="w-full rounded-lg px-4 py-2 <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-400 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div>
                                <label class="block text-slate-400 mb-2 text-sm">Email</label>
                                <input type="email" name="email" value="<?php echo e(old('email', $siswa->user->email)); ?>" class="w-full rounded-lg px-4 py-2 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-400 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-cyan-400 font-bold mb-4 uppercase tracking-wider text-sm">2. Biodata Sekolah</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                            <div>
                                <label class="block text-slate-400 mb-2 text-sm">NISN (Angka Saja)</label>
                                <input type="text" name="nisn" value="<?php echo e(old('nisn', $siswa->nisn)); ?>" class="w-full rounded-lg px-4 py-2 font-mono <?php $__errorArgs = ['nisn'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                <?php $__errorArgs = ['nisn'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-400 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div>
                                <label class="block text-slate-400 mb-2 text-sm">Nomor HP (Angka Saja)</label>
                                <input type="text" name="nomor_hp" value="<?php echo e(old('nomor_hp', $siswa->nomor_hp)); ?>" class="w-full rounded-lg px-4 py-2 font-mono <?php $__errorArgs = ['nomor_hp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                <?php $__errorArgs = ['nomor_hp'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-400 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-slate-400 mb-2 text-sm">Kelas</label>
                                <select name="kelas" class="w-full rounded-lg px-4 py-2 <?php $__errorArgs = ['kelas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option value="">-- Pilih Kelas --</option>
                                    <option value="X" <?php echo e(old('kelas', $siswa->kelas) == 'X' ? 'selected' : ''); ?>>Kelas X</option>
                                    <option value="XI" <?php echo e(old('kelas', $siswa->kelas) == 'XI' ? 'selected' : ''); ?>>Kelas XI</option>
                                    <option value="XII" <?php echo e(old('kelas', $siswa->kelas) == 'XII' ? 'selected' : ''); ?>>Kelas XII</option>
                                </select>
                                <?php $__errorArgs = ['kelas'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-400 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div>
                                <label class="block text-slate-400 mb-2 text-sm">Jurusan</label>
                                <select name="jurusan" class="w-full rounded-lg px-4 py-2 <?php $__errorArgs = ['jurusan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option value="">-- Pilih Jurusan --</option>
                                    <option value="RPL" <?php echo e(old('jurusan', $siswa->jurusan) == 'RPL' ? 'selected' : ''); ?>>Rekayasa Perangkat Lunak</option>
                                    <option value="TKJ" <?php echo e(old('jurusan', $siswa->jurusan) == 'TKJ' ? 'selected' : ''); ?>>Teknik Komputer Jaringan</option>
                                    <option value="DKV" <?php echo e(old('jurusan', $siswa->jurusan) == 'DKV' ? 'selected' : ''); ?>>Desain Komunikasi Visual</option>
                                    <option value="AKL" <?php echo e(old('jurusan', $siswa->jurusan) == 'AKL' ? 'selected' : ''); ?>>Akuntansi</option>
                                    <option value="OTKP" <?php echo e(old('jurusan', $siswa->jurusan) == 'OTKP' ? 'selected' : ''); ?>>Otomatisasi Tata Kelola Perkantoran</option>
                                </select>
                                <?php $__errorArgs = ['jurusan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-400 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end mt-8">
                        <button type="submit" class="bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-bold py-3 px-8 rounded-xl shadow-[0_0_20px_rgba(6,182,212,0.4)] hover:shadow-[0_0_30px_rgba(6,182,212,0.6)] transition-all transform hover:scale-105">Simpan Perubahan</button>
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
<?php endif; ?><?php /**PATH C:\xampp\htdocs\simm_ukk\resources\views/admin/siswa/edit.blade.php ENDPATH**/ ?>