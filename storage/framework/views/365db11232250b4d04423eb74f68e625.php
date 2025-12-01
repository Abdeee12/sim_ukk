<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SIMM - Sistem Informasi Magang</title>
        
        <script src="https://cdn.tailwindcss.com"></script>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,600&display=swap" rel="stylesheet" />

        <style>
            /* CSS TEMA CYBER NEON */
            body {
                font-family: 'Inter', sans-serif;
                background-color: #0f172a; /* Slate 900 */
                color: white;
            }
            .glass-card {
                background: rgba(30, 41, 59, 0.7); /* Slate 800 transparan */
                backdrop-filter: blur(15px);
                border: 1px solid rgba(56, 189, 248, 0.2);
            }
            .hover-neon-button:hover {
                box-shadow: 0 0 20px rgba(6, 182, 212, 0.5);
                transform: scale(1.05);
            }
            .glow-text {
                 text-shadow: 0 0 10px rgba(6, 182, 212, 0.5);
            }
        </style>
    </head>
    <body class="antialiased min-h-screen flex items-center justify-center relative overflow-hidden">

        <header class="absolute top-0 right-0 p-6 z-20 w-full max-w-7xl mx-auto">
            <nav class="flex justify-end gap-4">
                <?php if(Route::has('login')): ?>
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(url('/dashboard')); ?>" class="py-2 px-5 rounded-full font-bold text-white bg-cyan-600 hover:bg-cyan-700 transition duration-300 shadow-lg shadow-cyan-500/30">
                            Dashboard
                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="glass-card py-2 px-5 rounded-full font-bold text-cyan-300 hover:text-white transition duration-300 hover-neon-button border border-cyan-500/30">
                            LOGIN
                        </a>

                        
                    <?php endif; ?>
                <?php endif; ?>
            </nav>
        </header>


        <div class="absolute top-0 left-0 w-[800px] h-[800px] bg-blue-700 rounded-full mix-blend-screen filter blur-[150px] opacity-20"></div>
        <div class="absolute bottom-0 right-0 w-[800px] h-[800px] bg-cyan-600 rounded-full mix-blend-screen filter blur-[150px] opacity-15"></div>

        <div class="relative z-10 text-center max-w-4xl mx-auto p-4">
            
            <div class="mb-6">
                <span class="text-7xl glow-text">💻</span>
            </div>

            <h1 class="text-5xl md:text-6xl font-extrabold mb-4 text-transparent bg-clip-text bg-gradient-to-r from-white to-cyan-400 glow-text">
                SIMM: Cyber Labs PKL
            </h1>

            <p class="text-xl text-slate-300 max-w-2xl mx-auto mb-10">
                Sistem Informasi Manajemen Magang terintegrasi untuk siswa, mentor, dan administrator.
            </p>

            <div class="flex justify-center space-x-6">
                
                <?php if(Route::has('login')): ?>
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(url('/dashboard')); ?>" class="py-3 px-8 rounded-full font-bold text-white bg-gradient-to-r from-blue-600 to-cyan-500 hover:from-blue-700 hover:to-cyan-600 transition duration-300 hover-neon-button shadow-xl shadow-cyan-500/30">
                            Masuk ke Dashboard
                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="glass-card py-3 px-8 rounded-full font-bold text-cyan-300 hover:text-white transition duration-300 hover-neon-button border border-cyan-500/30">
                            LOGIN
                        </a>

                        
                    <?php endif; ?>
                <?php endif; ?>
                
            </div>
            
            <p class="text-sm text-slate-500 mt-12">
                Laravel | Tailwind CSS
            </p>
        </div>

    </body>
</html><?php /**PATH C:\xampp\htdocs\simm_ukk\resources\views/welcome.blade.php ENDPATH**/ ?>