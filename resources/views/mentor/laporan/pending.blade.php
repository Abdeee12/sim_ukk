<x-app-layout>
	<div class="pt-24 pb-12 min-h-screen bg-[#0f172a] relative">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">
			<div class="mb-6">
				<a href="{{ route('mentor.dashboard') }}" class="text-cyan-400 hover:text-cyan-300 mb-2 inline-block">&larr; Kembali</a>
				<h2 class="text-3xl font-bold text-white">Verifikasi Laporan Pending</h2>
				<p class="text-slate-400">Daftar laporan dengan status <strong>pending</strong> dari siswa bimbingan Anda.</p>
			</div>

			<div class="glass-dark rounded-xl p-4 overflow-auto">
				@if($laporans->isEmpty())
					<div class="text-slate-400 p-6">Tidak ada laporan pending.</div>
				@else
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
							@foreach($laporans as $lap)
								<tr class="border-t border-slate-700" data-laporan-row="{{ $lap->id }}">
									<td class="px-4 py-3">{{ $lap->tanggal }}</td>
									<td class="px-4 py-3">{{ optional($lap->siswa->user)->name ?? '—' }}</td>
									<td class="px-4 py-3">{{ Str::limit($lap->detail_kegiatan, 80) }}</td>
									<td class="px-4 py-3">@if($lap->path_bukti) <a href="{{ asset('storage/'.$lap->path_bukti) }}" target="_blank" class="text-cyan-300">Lihat</a> @else — @endif</td>
									<td class="px-4 py-3">{{ ucfirst($lap->status) }}</td>
									<td class="px-4 py-3">
										<div class="flex items-center gap-2">
											<a href="{{ route('mentor.laporan.show', $lap) }}" class="text-cyan-300 text-sm">Detail</a>
											<button type="button" class="js-open-review text-white bg-green-600 hover:bg-green-500 text-xs px-2 py-1 rounded" data-action="{{ route('mentor.laporan.updateStatus', $lap) }}" data-status="approved">Approve</button>
											<button type="button" class="js-open-review text-white bg-red-600 hover:bg-red-500 text-xs px-2 py-1 rounded" data-action="{{ route('mentor.laporan.updateStatus', $lap) }}" data-status="rejected">Reject</button>
										</div>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>

					<div class="mt-4">
						{{ $laporans->links() }}
					</div>
				@endif
			</div>
		</div>
	</div>

	<script>
		(function(){
			function getCsrfToken(){
				var el = document.querySelector('meta[name="csrf-token"]');
				return el ? el.getAttribute('content') : '';
			}
			function mapStatusLabel(s){
				return s === 'approved' ? 'Selesai' : (s === 'rejected' ? 'Ditolak' : 'Pending');
			}
			document.querySelectorAll('.js-quick-status-btn').forEach(function(btn){
				btn.addEventListener('click', function(){
					var status = btn.getAttribute('data-status') || 'approved';
					if(!confirm(status === 'approved' ? 'Setujui laporan ini?' : 'Tolak laporan ini?')) return;
					var form = btn.closest('form.js-quick-status');
					if(!form) return;
					var input = form.querySelector('input[name="status"]'); if(input) input.value = status;
					var url = form.getAttribute('action');
					var fd = new FormData(form);
					btn.disabled = true; btn.textContent = 'Menyimpan…';
					fetch(url, { method: 'POST', headers: { 'X-CSRF-TOKEN': getCsrfToken(), 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }, body: fd, credentials: 'same-origin' })
					.then(function(r){ if(!r.ok) return r.json().then(function(j){ throw j; }); return r.json(); })
					.then(function(json){
						var row = btn.closest('tr');
						if(row){ row.querySelectorAll('td')[4].textContent = mapStatusLabel(json.laporan.status); row.querySelectorAll('.js-quick-status-btn').forEach(function(b){ b.disabled = true; b.classList.remove('bg-green-600'); b.classList.remove('bg-red-600'); b.classList.add('bg-slate-600'); b.textContent = mapStatusLabel(json.laporan.status); }); }
					}).catch(function(err){ alert('Gagal: ' + (err.message || 'error')); btn.disabled = false; btn.textContent = status === 'approved' ? 'Approve' : 'Reject'; });
				});
			});
		})();
	</script>

</x-app-layout>

<!-- Modal for review (approve/reject with feedback and signature) -->
<div id="js-review-modal" class="fixed inset-0 z-50 hidden items-center justify-center">
	<div class="absolute inset-0 bg-black/60"></div>
	<div class="relative w-full max-w-2xl mx-auto p-6">
		<div class="glass-dark rounded-xl p-6">
			<div class="flex items-start justify-between mb-4">
				<div>
					<h3 id="js-modal-title" class="text-xl font-bold text-white">Review Laporan</h3>
					<p id="js-modal-sub" class="text-sm text-slate-400">Tambahkan catatan dan/atau tanda tangan sebelum menyimpan.</p>
				</div>
				<button id="js-modal-close" class="text-slate-300">&times;</button>
			</div>

			<form id="js-review-form" enctype="multipart/form-data">
				<input type="hidden" name="_method" value="PATCH">
				<input type="hidden" name="status" id="js-form-status" value="approved">

				<div class="mb-4">
					<label class="block text-slate-400 mb-2">Catatan/Feedback (opsional)</label>
					<textarea name="feedback_mentor" id="js-form-feedback" class="w-full rounded-lg p-2 bg-slate-800 text-white" rows="4"></textarea>
				</div>

				<div class="mb-4">
					<label class="block text-slate-400 mb-2">Tanda Tangan Mentor (opsional)</label>
					<input type="file" name="mentor_signature" id="js-form-signature" accept="image/*" class="w-full text-slate-300" />
					<p class="text-xs text-slate-500 mt-1">PNG/JPG maks 2MB. Gunakan jika ingin menyelesaikan laporan secara resmi.</p>
				</div>

				<div class="flex justify-end gap-3">
					<button type="button" id="js-modal-cancel" class="bg-slate-700 text-white px-4 py-2 rounded">Batal</button>
					<button type="submit" id="js-modal-submit" class="bg-cyan-600 text-white px-4 py-2 rounded">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	(function(){
		var modal = document.getElementById('js-review-modal');
		var form = document.getElementById('js-review-form');
		var title = document.getElementById('js-modal-title');
		var sub = document.getElementById('js-modal-sub');
		var inputStatus = document.getElementById('js-form-status');
		var btnClose = document.getElementById('js-modal-close');
		var btnCancel = document.getElementById('js-modal-cancel');
		var submitBtn = document.getElementById('js-modal-submit');
		var currentRow = null;
		var currentAction = '';

		function getCsrf(){ var el = document.querySelector('meta[name="csrf-token"]'); return el ? el.getAttribute('content') : ''; }

		function openModal(actionUrl, status, row){
			currentAction = actionUrl;
			currentRow = row;
			inputStatus.value = status || 'approved';
			title.textContent = (status === 'rejected') ? 'Tolak Laporan' : 'Setujui Laporan';
			sub.textContent = (status === 'rejected') ? 'Tambahkan alasan penolakan (opsional) dan simpan.' : 'Tambahkan catatan/tanda tangan (opsional) lalu simpan.';
			// reset fields
			form.querySelector('#js-form-feedback').value = '';
			form.querySelector('#js-form-signature').value = '';
			modal.classList.remove('hidden');
			modal.classList.add('flex');
		}

		function closeModal(){ modal.classList.add('hidden'); modal.classList.remove('flex'); }

		document.querySelectorAll('.js-open-review').forEach(function(btn){
			btn.addEventListener('click', function(){
				var action = btn.getAttribute('data-action');
				var status = btn.getAttribute('data-status') || 'approved';
				var row = btn.closest('tr');
				openModal(action, status, row);
			});
		});

		btnClose && btnClose.addEventListener('click', closeModal);
		btnCancel && btnCancel.addEventListener('click', closeModal);

		form.addEventListener('submit', function(e){
			e.preventDefault();
			if(!currentAction) return alert('Action URL tidak ditemukan.');
			submitBtn.disabled = true; submitBtn.textContent = 'Menyimpan…';
			var fd = new FormData();
			fd.append('_method', 'PATCH');
			fd.append('status', inputStatus.value);
			var feedback = form.querySelector('#js-form-feedback').value;
			if(feedback) fd.append('feedback_mentor', feedback);
			var sig = form.querySelector('#js-form-signature').files[0];
			if(sig) fd.append('mentor_signature', sig);

			fetch(currentAction, {
				method: 'POST',
				headers: { 'X-CSRF-TOKEN': getCsrf(), 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' },
				body: fd,
				credentials: 'same-origin'
			}).then(function(resp){
				if(!resp.ok) return resp.json().then(function(j){ throw j; });
				return resp.json();
			}).then(function(json){
				// update row status cell
				if(currentRow){
					var cells = currentRow.querySelectorAll('td');
					if(cells && cells.length >= 5){
						var label = inputStatus.value === 'approved' ? 'Selesai' : (inputStatus.value === 'rejected' ? 'Ditolak' : 'Pending');
						cells[4].textContent = label;
						// disable review buttons in the row
						currentRow.querySelectorAll('.js-open-review').forEach(function(b){ b.disabled = true; b.classList.remove('bg-green-600'); b.classList.remove('bg-red-600'); b.classList.add('bg-slate-600'); b.textContent = label; });
					}
				}
				closeModal();
			}).catch(function(err){
				var msg = (err && err.message) ? err.message : 'Gagal menyimpan.'; alert(msg);
			}).finally(function(){ submitBtn.disabled = false; submitBtn.textContent = 'Simpan'; });
		});
	})();
</script>
