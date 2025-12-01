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
                <a href="<?php echo e(route('mentor.dashboard')); ?>" class="text-cyan-400 hover:text-cyan-300 mb-2 inline-block">&larr; Kembali</a>
                <h2 class="text-3xl font-bold text-white">Daftar Laporan Harian</h2>
                <p class="text-slate-400">Monitoring laporan yang dikirim oleh siswa.</p>
            </div>

            <div class="glass-dark rounded-xl p-4 overflow-auto">
                <div class="mb-4 flex items-center gap-3">
                    <a href="<?php echo e(route('mentor.laporan.index')); ?>?status=pending" class="px-3 py-1 rounded <?php echo e((request('status')=='pending' || !request('status')) ? 'bg-cyan-600 text-white' : 'text-slate-300'); ?>">Pending</a>
                    <a href="<?php echo e(route('mentor.laporan.index')); ?>?status=approved" class="px-3 py-1 rounded <?php echo e(request('status')=='approved' ? 'bg-cyan-600 text-white' : 'text-slate-300'); ?>">Selesai</a>
                    <a href="<?php echo e(route('mentor.laporan.index')); ?>?status=rejected" class="px-3 py-1 rounded <?php echo e(request('status')=='rejected' ? 'bg-cyan-600 text-white' : 'text-slate-300'); ?>">Ditolak</a>
                </div>
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
                                <tr data-id="<?php echo e($lap->id); ?>" class="border-t border-slate-700">
                                    <td class="px-4 py-3"><?php echo e($lap->tanggal); ?></td>
                                    <td class="px-4 py-3"><?php echo e(optional($lap->siswa->user)->name ?? ''); ?></td>
                                    <td class="px-4 py-3"><?php echo e(Str::limit($lap->detail_kegiatan, 80)); ?></td>
                                    <td class="px-4 py-3"><?php if($lap->path_bukti): ?> <a href="<?php echo e(asset('storage/'.$lap->path_bukti)); ?>" target="_blank" class="text-cyan-300">Lihat</a> <?php else: ?>  <?php endif; ?></td>
                                    <td class="px-4 py-3"><?php echo e(ucfirst($lap->status)); ?></td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-2">
                                            <a href="<?php echo e(route('mentor.laporan.show', $lap)); ?>" class="text-cyan-300 text-sm">Detail</a>

                                            <?php
                                                $currentMentorId = optional(optional(auth()->user())->mentor)->id;
                                                $isPrimary = $lap->siswa && $lap->siswa->mentor_id && $currentMentorId && ($lap->siswa->mentor_id == $currentMentorId);
                                            ?>

                                            <?php if($isPrimary): ?>
                                                <form action="<?php echo e(route('mentor.laporan.updateStatus', $lap)); ?>" method="POST" class="js-quick-status" data-show-url="<?php echo e(route('mentor.laporan.show', $lap)); ?>" onsubmit="return false;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('PATCH'); ?>
                                                    <input type="hidden" name="status" value="approved">
                                                    <button type="button" data-action="<?php echo e(route('mentor.laporan.updateStatus', $lap)); ?>" data-id="<?php echo e($lap->id); ?>" class="js-open-approve-modal text-white bg-green-600 hover:bg-green-500 text-xs px-2 py-1 rounded">Approve</button>
                                                    <button type="button" data-status="rejected" class="js-quick-status-btn text-white bg-red-600 hover:bg-red-500 text-xs px-2 py-1 rounded">Reject</button>
                                                </form>
                                            <?php else: ?>
                                                <span class="text-slate-400 text-xs italic">(Hanya dapat melihat — bukan mentor pembimbing)</span>
                                            <?php endif; ?>
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
    <!-- Approve modal -->
                <div id="approveModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50">
        <div class="w-full max-w-lg p-6">
            <div class="glass-dark rounded-xl p-6">
                <h3 class="text-xl text-white font-bold mb-4">Approve Laporan — Tambah Feedback & Tanda Tangan</h3>
                <form id="approveForm" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="_method" value="PATCH">
                    <input type="hidden" name="status" value="approved">
                    <input type="hidden" name="laporan_id" value="">
                    <div class="mb-4">
                        <label class="block text-slate-400 mb-2">Catatan / Feedback</label>
                        <textarea name="feedback_mentor" rows="4" class="w-full rounded-lg p-2 bg-slate-800 text-white"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-slate-400 mb-2">Tanda Tangan Mentor (PNG/JPG)</label>
                        <input type="file" name="mentor_signature" accept="image/*" class="w-full text-slate-300" />
                        <p class="text-xs text-slate-500 mt-1">Opsional: unggah tanda tangan untuk laporan yang disetujui.</p>
                    </div>

                    <div class="flex justify-end gap-3">
                        <button type="button" id="approveCancel" class="bg-slate-600 text-white px-4 py-2 rounded">Batal</button>
                        <button type="submit" id="approveSubmit" class="bg-cyan-600 text-white px-4 py-2 rounded">Approve & Simpan</button>
                    </div>
                </form>
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

            // Reject quick action (existing behavior)
            document.querySelectorAll('.js-quick-status-btn').forEach(function(btn){
                btn.addEventListener('click', function(e){
                    var status = btn.getAttribute('data-status') || 'approved';
                    var question = status === 'approved' ? 'Setujui laporan ini?' : 'Tolak laporan ini?';
                    if (!confirm(question)) return;
                    var form = btn.closest('form.js-quick-status');
                    if (!form) return;
                    // set status input value dynamically
                    var statusInput = form.querySelector('input[name="status"]');
                    if (statusInput) statusInput.value = status;
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
                            // optional: disable both action buttons in the row
                            row.querySelectorAll('.js-quick-status-btn').forEach(function(b){ b.disabled = true; b.classList.remove('bg-green-600'); b.classList.remove('bg-red-600'); b.classList.add('bg-slate-600'); b.textContent = mapStatusLabel(newStatus); });
                        }
                    }).catch(function(err){
                        alert('Gagal menyimpan: '+ (err.message || err));
                        btn.disabled = false;
                        btn.textContent = 'Selesai';
                    });
                });
            });

            // Approve modal flow
            var approveModal = document.getElementById('approveModal');
            var approveForm = document.getElementById('approveForm');
            var approveSubmit = document.getElementById('approveSubmit');
            var approveCancel = document.getElementById('approveCancel');
            var currentApproveAction = null;

            document.querySelectorAll('.js-open-approve-modal').forEach(function(btn){
                btn.addEventListener('click', function(){
                    currentApproveAction = btn.getAttribute('data-action');
                    var laporanId = btn.getAttribute('data-id');
                    // reset form and set action + laporan id
                    approveForm.reset();
                    approveForm.action = currentApproveAction;
                    var lid = approveForm.querySelector('input[name="laporan_id"]'); if (lid) lid.value = laporanId;
                    approveModal.classList.remove('hidden');
                    approveModal.classList.add('flex');
                });
            });

            approveCancel.addEventListener('click', function(){
                approveModal.classList.add('hidden');
                approveModal.classList.remove('flex');
            });

            approveForm.addEventListener('submit', function(e){
                e.preventDefault();
                if (! currentApproveAction) return alert('URL aksi tidak tersedia');
                approveSubmit.disabled = true; approveSubmit.textContent = 'Menyimpan…';
                var fd = new FormData(approveForm);
                // include csrf
                fd.append('_token', getCsrfToken());

                fetch(currentApproveAction, {
                    method: 'POST',
                    headers: { 'X-Requested-With': 'XMLHttpRequest' },
                    body: fd,
                    credentials: 'same-origin'
                }).then(function(resp){
                    if (!resp.ok) return resp.text().then(function(t){ throw new Error(t || resp.statusText); });
                    return resp.json().catch(function(){ return null; });
                }).then(function(json){
                    // close modal
                    approveModal.classList.add('hidden'); approveModal.classList.remove('flex');
                    // if json contains laporan and status, update row by data-id
                    if (json && json.laporan) {
                        var id = json.laporan.id;
                        var tr = document.querySelector('tr[data-id="'+id+'"]');
                        if (tr) {
                            var tds = tr.querySelectorAll('td');
                            if (tds && tds.length >= 5) tds[4].textContent = mapStatusLabel(json.laporan.status);
                            // disable action buttons in row
                            tr.querySelectorAll('button').forEach(function(b){ b.disabled = true; b.classList.remove('bg-red-600'); b.classList.remove('bg-green-600'); b.classList.add('bg-slate-600'); });
                        }
                    }
                }).catch(function(err){
                    alert('Gagal menyimpan: ' + (err.message || err));
                }).finally(function(){ approveSubmit.disabled = false; approveSubmit.textContent = 'Approve & Simpan'; });
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
<?php /**PATH C:\xampp\htdocs\simm_ukk\resources\views/mentor/laporan/index.blade.php ENDPATH**/ ?>