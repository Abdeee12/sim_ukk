<x-app-layout>
    <div class="pt-24 pb-12 min-h-screen bg-[#0f172a] relative">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 relative z-10">
            <div class="mb-6">
                <a href="{{ route('admin.laporan.index') }}" class="text-cyan-400 hover:text-cyan-300 mb-2 inline-block">&larr; Kembali ke Daftar Laporan</a>
                <h2 class="text-3xl font-bold text-white">Detail Laporan</h2>
                <p class="text-slate-400">{{ $laporan->tanggal }} — {{ optional($laporan->siswa->user)->name ?? 'Siswa tidak diketahui' }}</p>
            </div>

            <div class="glass-dark rounded-xl p-6">
                <div class="mb-4">
                    <h3 class="text-cyan-300 font-bold">Presensi</h3>
                    <p class="text-white">Masuk: <strong>{{ $laporan->jam_masuk }}</strong> — Keluar: <strong>{{ $laporan->jam_keluar ?? '—' }}</strong></p>
                </div>

                <div class="mb-4">
                    <h3 class="text-cyan-300 font-bold">Detail Kegiatan</h3>
                    <p class="text-white">{{ $laporan->detail_kegiatan }}</p>
                </div>

                <div class="mb-4">
                    <h3 class="text-cyan-300 font-bold">Bukti</h3>
                    <p class="text-white">@if($laporan->path_bukti) <a href="{{ asset('storage/'.$laporan->path_bukti) }}" target="_blank" class="text-cyan-300">Lihat Bukti</a> @else — @endif</p>
                </div>

                <div class="mb-6">
                    <h3 class="text-cyan-300 font-bold">Status Saat Ini</h3>
                    <p class="text-white font-bold">{{ ucfirst($laporan->status) }}</p>
                </div>

                <div class="flex justify-end mb-4">
                    <a href="{{ route('admin.laporan.edit', $laporan) }}" class="bg-slate-700 text-white px-3 py-2 rounded mr-2">Edit Laporan</a>
                </div>

                <form action="{{ route('admin.laporan.updateStatus', $laporan) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4">
                        <label class="block text-slate-400 mb-2">Ubah Status</label>
                        <select name="status" class="w-full rounded-lg p-2 bg-slate-800 text-white">
                            <option value="pending" {{ $laporan->status === 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ $laporan->status === 'approved' ? 'selected' : '' }}>Selesai</option>
                            <option value="rejected" {{ $laporan->status === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-slate-400 mb-2">Catatan/Feedback (opsional)</label>
                        <textarea name="feedback_mentor" class="w-full rounded-lg p-2 bg-slate-800 text-white" rows="4">{{ old('feedback_mentor', $laporan->feedback_mentor) }}</textarea>
                    </div>

                    <div class="flex gap-3 justify-end">
                        <button id="js-save-status" class="bg-slate-700 text-white px-4 py-2 rounded">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
<script>
    (function(){
        var form = document.querySelector('form[action="{{ route('admin.laporan.updateStatus', $laporan) }}"]');
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
                window.location = '{{ route('admin.laporan.index') }}';
            }).catch(function(err){
                alert('Gagal menyimpan: ' + (err.message || err));
                if (btn) { btn.disabled = false; btn.textContent = 'Simpan'; }
            });
        });
    })();
</script>
