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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <div class="mb-6">
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="text-cyan-400 hover:text-cyan-300 mb-2 inline-block">&larr; Kembali</a>
                <h2 class="text-3xl font-bold text-white">Daftar Laporan Harian</h2>
                <p class="text-slate-400">Monitoring laporan yang dikirim oleh siswa.</p>
            </div>

            <div class="glass-dark rounded-xl p-4 overflow-auto">
                <?php if($laporans->isEmpty()): ?>
                    <div class="text-slate-400 p-6">Belum ada laporan.</div>
                <?php else: ?>
                    <table class="w-full text-sm text-left text-white">
                        <thead class="text-xs uppercase bg-slate-800 text-slate-400">
                            <tr>
                                <th class="px-4 py-3">Tanggal</th>
                                <th class="px-4 py-3">Siswa</th>
                                <th class="px-4 py-3">Kegiatan</th>
                                <th class="px-4 py-3">Bukti</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $laporans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lap): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="border-t border-slate-700">
                                    <td class="px-4 py-3"><?php echo e($lap->tanggal); ?></td>
                                    <td class="px-4 py-3"><?php echo e(optional($lap->siswa->user)->name ?? '—'); ?></td>
                                    <td class="px-4 py-3"><?php echo e(Str::limit($lap->detail_kegiatan, 80)); ?></td>
                                    <td class="px-4 py-3"><?php if($lap->path_bukti): ?> <a href="<?php echo e(asset('storage/'.$lap->path_bukti)); ?>" target="_blank" class="text-cyan-300">Lihat</a> <?php else: ?> — <?php endif; ?></td>
                                    <td class="px-4 py-3"><?php echo e(ucfirst($lap->status)); ?></td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-2">
                                            <a href="<?php echo e(route('admin.laporan.show', $lap)); ?>" class="text-cyan-300 text-sm">Detail</a>
                                            <a href="<?php echo e(route('admin.laporan.edit', $lap)); ?>" class="text-slate-300 text-sm ml-2">Edit</a>

                                            <form action="<?php echo e(route('admin.laporan.updateStatus', $lap)); ?>" method="POST" class="js-quick-status" data-show-url="<?php echo e(route('admin.laporan.show', $lap)); ?>" onsubmit="return false;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PATCH'); ?>
                                                <input type="hidden" name="status" value="approved">
                                                <button type="button" class="js-quick-status-btn text-white bg-green-600 hover:bg-green-500 text-xs px-2 py-1 rounded">Selesai</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                    <div class="mt-4">
                        <?php echo e($laporans->links()); ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
                    <script>
        (function () {
            function getCsrfToken() {
                var el = document.querySelector('meta[name="csrf-token"]');
                if (el) return el.getAttribute('content');
                var input = document.querySelector('input[name="_token"]');
                return input ? input.value : '';
            }

            function mapStatusLabel(status) {
                switch (status) {
                    case 'approved': return 'Selesai';
                    case 'rejected': return 'Ditolak';
                    case 'pending':
                    default:
                        return 'Pending';
                }
            }

            document.querySelectorAll('.js-quick-status-btn').forEach(function(btn){
                btn.addEventListener('click', function(e){
                    if (!confirm('Tandai laporan ini sebagai selesai?')) return;
                    var form = btn.closest('form.js-quick-status');
                    if (!form) return;
                    var url = form.getAttribute('action');
                    var formData = new FormData(form);
                    // Disable button while processing
                    btn.disabled = true;
                    btn.textContent = 'Menyimpan…';

                    fetch(url, {
                        method: 'POST', // use POST with method spoofing
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': getCsrfToken()
                        },
                        body: formData,
                        credentials: 'same-origin'
                    }).then(function(resp){
                        if (!resp.ok) return resp.text().then(function(t){ throw new Error(t || resp.statusText); });
                        return resp.json().catch(function(){ return null; });
                    }).then(function(json){
                        // update the status cell in the same row
                        var row = btn.closest('tr');
                        if (row) {
                            var tds = row.querySelectorAll('td');
                            if (tds && tds.length >= 5) {
                                var newStatus = (json && json.laporan && json.laporan.status) ? json.laporan.status : form.querySelector('input[name="status"]').value;
                                tds[4].textContent = mapStatusLabel(newStatus);
                            }
                            // optional: disable the action button now
                            btn.textContent = 'Selesai';
                            btn.classList.remove('bg-green-600');
                            btn.classList.add('bg-slate-600');
                            btn.disabled = true;
                        }
                    }).catch(function(err){
                        alert('Gagal menyimpan: '+ (err.message || err));
                        btn.disabled = false;
                        btn.textContent = 'Selesai';
                    });
                });
            });
        })();
    </script>
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
<?php /**PATH C:\xampp\htdocs\simm_ukk\resources\views/admin/laporan/index.blade.php ENDPATH**/ ?>