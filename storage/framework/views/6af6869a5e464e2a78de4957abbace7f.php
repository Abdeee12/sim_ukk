<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <style>
        /* Adaptasi tema gelap "cyber" agar selaras dengan halaman lain */
        body { background-color: #0f172a !important; }
        nav { background-color: transparent !important; }
        .glass-dark { background: rgba(30,41,59,0.75); backdrop-filter: blur(8px); border: 1px solid rgba(56,189,248,0.12); }
        .input-dark { background-color: #0b1220; border: 1px solid #2b3440; color: #e6eef6; }
    </style>

    <div class="min-h-screen flex items-center justify-center pt-12 pb-12">
        <div class="w-full max-w-md px-6">
            <div class="text-center mb-6">
                <!-- Ganti logo Laravel dengan ikon kustom -->
                <div class="mx-auto w-20 h-20 flex items-center justify-center">
                    <!-- Contoh ikon briefcase simple (inline SVG) -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-14 h-14 text-cyan-300" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="7" width="18" height="13" rx="2" stroke-linejoin="round"></rect>
                        <path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
                <h1 class="text-2xl text-white font-bold mt-4">Masuk ke SIMM</h1>
                <p class="text-sm text-slate-400">Silakan masuk menggunakan akun yang sudah dibuat oleh administrator.</p>
            </div>

            <div class="glass-dark rounded-2xl p-6 shadow-lg" style="background: rgba(15,23,42,0.28); backdrop-filter: blur(10px); border: 1px solid rgba(99,102,241,0.04);">

                <!-- Session status hidden on login to avoid showing verify/reset notices -->

                <form method="POST" action="<?php echo e(route('login')); ?>">
                    <?php echo csrf_field(); ?>

                    <div class="mb-4">
                        <label for="email" class="block text-slate-300 mb-2">Email</label>
                        <input id="email" class="input-dark rounded-lg w-full px-4 py-2" type="email" name="email" :value="old('email')" required autofocus autocomplete="username">
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-xs text-red-400 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-slate-300 mb-2">Kata Sandi</label>
                        <input id="password" class="input-dark rounded-lg w-full px-4 py-2" type="password" name="password" required autocomplete="current-password">
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-xs text-red-400 mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="flex items-center justify-between mb-4">
                        <label class="inline-flex items-center text-slate-300">
                            <input id="remember_me" type="checkbox" name="remember" class="me-2 form-checkbox text-cyan-400">
                            <span class="text-sm">Ingat saya</span>
                        </label>

                        
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit" class="bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-bold py-2 px-4 rounded-lg">Masuk</button>
                    </div>
                </form>

                <div class="mt-4 text-sm text-slate-400 text-center">
                    Pendaftaran ditutup. Hubungi administrator untuk membuat akun.
                </div>
            </div>
        </div>
    </div>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\simm_ukk\resources\views/auth/login.blade.php ENDPATH**/ ?>