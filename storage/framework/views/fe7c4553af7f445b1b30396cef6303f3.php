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
    <div class="pt-24 pb-12 min-h-screen bg-[#0f172a] relative">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <div class="mb-6">
                <a href="<?php echo e(route('admin.laporan.index')); ?>" class="text-cyan-400 hover:text-cyan-300 mb-2 inline-block">&larr; Kembali ke Daftar Laporan</a>
                <h2 class="text-3xl font-bold text-white">Detail Laporan</h2>
                <p class="text-slate-400"><?php echo e($laporan->tanggal); ?> — <?php echo e(optional($laporan->siswa->user)->name ?? 'Siswa tidak diketahui'); ?></p>
            </div>

            <div class="glass-dark rounded-xl p-6">
                <div class="mb-4">
                    <h3 class="text-cyan-300 font-bold">Presensi</h3>
                    <p class="text-white">Masuk: <strong><?php echo e($laporan->jam_masuk); ?></strong> — Keluar: <strong><?php echo e($laporan->jam_keluar ?? '—'); ?></strong></p>
                </div>

                <div class="mb-4">
                    <h3 class="text-cyan-300 font-bold">Detail Kegiatan</h3>
                    <p class="text-white"><?php echo e($laporan->detail_kegiatan); ?></p>
                </div>

                <div class="mb-4">
                    <h3 class="text-cyan-300 font-bold">Bukti</h3>
                    <p class="text-white"><?php if($laporan->path_bukti): ?> <a href="<?php echo e(asset('storage/'.$laporan->path_bukti)); ?>" target="_blank" class="text-cyan-300">Lihat Bukti</a> <?php else: ?> — <?php endif; ?></p>
                </div>

                <div class="mb-6">
                    <h3 class="text-cyan-300 font-bold">Status Saat Ini</h3>
                    <p class="text-white font-bold"><?php echo e(ucfirst($laporan->status)); ?></p>
                </div>

                <form action="<?php echo e(route('admin.laporan.updateStatus', $laporan)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>

                    <div class="mb-4">
                        <label class="block text-slate-400 mb-2">Ubah Status</label>
                        <select name="status" class="w-full rounded-lg p-2 bg-slate-800 text-white">
                            <option value="pending" <?php echo e($laporan->status === 'pending' ? 'selected' : ''); ?>>Pending</option>
                            <option value="approved" <?php echo e($laporan->status === 'approved' ? 'selected' : ''); ?>>Selesai</option>
                            <option value="rejected" <?php echo e($laporan->status === 'rejected' ? 'selected' : ''); ?>>Ditolak</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-slate-400 mb-2">Catatan/Feedback (opsional)</label>
                        <textarea name="feedback_mentor" class="w-full rounded-lg p-2 bg-slate-800 text-white" rows="4"><?php echo e(old('feedback_mentor', $laporan->feedback_mentor)); ?></textarea>
                    </div>

                    <div class="flex gap-3 justify-end">
                        <button id="js-save-status" class="bg-slate-700 text-white px-4 py-2 rounded">Simpan</button>
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
<?php endif; ?>
<script>
    (function(){
        var form = document.querySelector('form[action="<?php echo e(route('admin.laporan.updateStatus', $laporan)); ?>"]');
        if (!form) return;
        var btn = document.getElementById('js-save-status');
        function getCsrfToken(){
            var el = document.querySelector('meta[name="csrf-token"]');
            if (el) return el.getAttribute('content');
            var input = form.querySelector('input[name="_token"]');
            return input ? input.value : '';
        }

        form.addEventListener('submit', function(e){
            e.preventDefault();
            if (btn) { btn.disabled = true; btn.textContent = 'Menyimpan…'; }
            var url = form.getAttribute('action');
            var fd = new FormData(form);
            fetch(url, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': getCsrfToken()
                },
                body: fd,
                credentials: 'same-origin'
            }).then(function(resp){
                if (!resp.ok) return resp.text().then(function(t){ throw new Error(t || resp.statusText); });
                return resp.json().catch(function(){ return null; });
            }).then(function(json){
                // on success, go back to list page
                window.location = '<?php echo e(route('admin.laporan.index')); ?>';
            }).catch(function(err){
                alert('Gagal menyimpan: ' + (err.message || err));
                if (btn) { btn.disabled = false; btn.textContent = 'Simpan'; }
            });
        });
    })();
</script>
<?php /**PATH C:\xampp\htdocs\simm_ukk\resources\views/admin/laporan/show.blade.php ENDPATH**/ ?>